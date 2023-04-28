<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_task()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($user = User::factory()->create());

        $project = Project::factory()->create(['user_id' => $user->id]);
        //switch to the project
        session()->put('project_id', $project->id);

        $response = $this->post('/tasks', [
            'title' => 'Test Task',
            'description' => 'Test Description',
            'status' => 'todo',
        ]);

        $response->assertRedirect('/tasks');

        $this->assertCount(1, Task::all());

        $task = Task::first();
        $this->assertEquals('Test Task', $task->title);
        $this->assertEquals('Test Description', $task->description);
        $this->assertEquals($user->id, $task->user_id);
        $this->assertEquals($project->id, $task->project_id);
    }

    public function test_user_can_update_task()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($user = User::factory()->create());

        $project = Project::factory()->create(['user_id' => $user->id]);
        //switch to the project
        session()->put('project_id', $project->id);

        $task = Task::factory()->create(['user_id' => $user->id, 'project_id' => $project->id]);

        $response = $this->patch('/tasks/' . $task->id, [
            'project_id' => $project->id,
            'title' => 'Test Task',
            'description' => 'Test Description',
            'status' => 'in_progress',
        ]);

        $this->assertCount(1, Task::all());

        $task = Task::first();
        $this->assertEquals('Test Task', $task->title);
        $this->assertEquals('Test Description', $task->description);
        $this->assertEquals('in_progress', $task->status);
        $this->assertEquals($user->id, $task->user_id);
        $this->assertEquals($project->id, $task->project_id);
    }

    public function test_user_can_create_global_tasks()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($user = User::factory()->create());

        //switch to global project
        session()->put('project_id', null);

        $response = $this->post('/tasks', [
            'title' => 'Test Task',
            'description' => 'Test Description',
            'status' => 'todo',
        ]);

        $response->assertRedirect('/tasks');

        $this->assertCount(1, Task::all());

        $task = Task::first();
        $this->assertEquals('Test Task', $task->title);
        $this->assertEquals('Test Description', $task->description);
        $this->assertEquals($user->id, $task->user_id);
        $this->assertEquals(null, $task->project_id);
    }

    public function test_user_can_only_see_tasks_for_selected_project()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($user = User::factory()->create());

        $project1 = Project::factory()->create(['user_id' => $user->id]);
        $project2 = Project::factory()->create(['user_id' => $user->id]);

        //switch to project 1
        session()->put('project_id', $project1->id);

        $task1 = Task::factory()->create(['user_id' => $user->id, 'project_id' => $project1->id]);
        $task2 = Task::factory()->create(['user_id' => $user->id, 'project_id' => $project2->id]);

        $response = $this->get('/tasks');

        $response->assertSee($task1->title);
        $response->assertDontSee($task2->title);
    }

    public function test_task_are_are_sorted_by_priority()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($user = User::factory()->create());

        $project = Project::factory()->create(['user_id' => $user->id]);

        //switch to project 1
        session()->put('project_id', $project->id);

        $task1 = Task::factory()->todo()->create(['user_id' => $user->id, 'project_id' => $project->id, 'priority' => 3]);
        $task2 = Task::factory()->todo()->create(['user_id' => $user->id, 'project_id' => $project->id, 'priority' => 2]);
        $task3 = Task::factory()->todo()->create(['user_id' => $user->id, 'project_id' => $project->id, 'priority' => 1]);

        $response = $this->get('/tasks');

        $response->assertSeeInOrder([$task3->title, $task2->title, $task1->title]);
    }

    public function test_user_can_not_see_task_from_other_users()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $project = Project::factory()->create(['user_id' => $user->id]);
        //switch to project 1
        session()->put('project_id', $project->id);

        $task1 = Task::factory()->create(['user_id' => $user->id, 'project_id' => $project->id]);
        $task2 = Task::factory()->create(['user_id' => $user->id, 'project_id' => $project->id]);
        $task3 = Task::factory()->create(['user_id' => $user->id, 'project_id' => $project->id]);

        $user2 = User::factory()->create();
        $task4 = Task::factory()->create(['user_id' => $user2->id, 'project_id' => $project->id]);

        $this->actingAs($user);
        $response = $this->get('/tasks');

        $response->assertSee($task1->title);
        $response->assertSee($task2->title);
        $response->assertSee($task3->title);

        $response->assertDontSee($task4->title);
    }
}
