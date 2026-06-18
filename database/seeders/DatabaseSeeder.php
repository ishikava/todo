<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Создаем 10 пользователей
        User::factory()->count(10)->create();

        // Создаем 10 проектов
        $projects = Project::factory()->count(10)->create();

        // Для каждого проекта создаем по 5 задач
        $projects->each(function ($project) {
            Task::factory()->count(5)->create([
                'project_id' => $project->id,
            ]);
        });
    }
}
