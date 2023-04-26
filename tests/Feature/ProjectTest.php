<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_project()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($user = User::factory()->create());

        $response = $this->post('/projects', [
            'title' => 'Test Project',
            'description' => 'Test Description',
        ]);

        $this->assertCount(1, Project::all());

        $project = Project::first();
        $this->assertEquals('Test Project', $project->title);
        $this->assertEquals('Test Description', $project->description);
        $this->assertEquals($user->id, $project->user_id);
    }

    public function test_user_can_update_project()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($user = User::factory()->create());

        $project = Project::factory()->create(['user_id' => $user->id]);

        $response = $this->patch('/projects/' . $project->id, [
            'title' => 'Test Project',
            'description' => 'Test Description',
        ]);

        $this->assertCount(1, Project::all());

        $project = Project::first();
        $this->assertEquals('Test Project', $project->title);
        $this->assertEquals('Test Description', $project->description);
        $this->assertEquals($user->id, $project->user_id);
    }

    public function test_user_can_delete_project()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($user = User::factory()->create());

        $project = Project::factory()->create(['user_id' => $user->id]);

        $response = $this->delete('/projects/' . $project->id);

        $this->assertCount(0, Project::all());
    }

    public function test_user_can_view_project()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($user = User::factory()->create());

        $project = Project::factory()->create(['user_id' => $user->id]);

        $response = $this->get('/projects/' . $project->id);

        $response->assertStatus(200);
    }

    public function test_user_can_view_projects()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($user = User::factory()->create());

        $project = Project::factory()->create(['user_id' => $user->id]);

        $response = $this->get('/projects');

        $response->assertStatus(200);
    }
}
