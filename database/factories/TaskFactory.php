<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'project_id' => \App\Models\Project::factory(),
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'priority' => $this->faker->randomFloat(2, 1, 100),
            'status' => $this->faker->randomElement(['todo', 'in_progress', 'done']),
            'user_id' => \App\Models\User::factory(),
        ];
    }

    public function todo(): TaskFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'todo',
            ];
        });
    }

    public function inProgress(): TaskFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'in_progress',
            ];
        });
    }

    public function done(): TaskFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'done',
            ];
        });
    }
}
