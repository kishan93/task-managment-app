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

        $response = $this->post('/tasks', [
            'project_id' => $project->id,
            'title' => 'Test Task',
            'description' => 'Test Description',
            'status' => 'todo',
        ]);

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
}
