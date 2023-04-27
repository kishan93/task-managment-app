<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $user = User::factory([
            'name' => 'Test User',
            'email' => 'test@mail.com',
        ])
            ->createOne();

        Project::factory([
            'user_id' => $user->id,
        ])
            ->count(5)
            ->has(
                Task::factory([
                    'user_id' => $user->id,
                ])
                    ->count(10),
                'tasks'
            )
            ->create();

        $users = User::factory(10)
            ->create();
        foreach ($users as $u) {
            Project::factory([
                'user_id' => $u->id,
            ])
                ->count(3)
                ->has(
                    Task::factory([
                        'user_id' => $u->id,
                    ])
                        ->count(10),
                    'tasks'
                );
        }
    }
}
