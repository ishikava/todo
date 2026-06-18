<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Store a new task for a specific project.
     */
    public function store(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $validated['project_id'] = $project->id;

        Task::create($validated);

        return redirect('/projects/' . $project->id)->with('success', 'Задача создана.');
    }

    /**
     * Update task status.
     */
    public function update(Request $request, Project $project, Task $task)
    {
        // Проверка, что задача принадлежит проекту
        if ($task->project_id !== $project->id) {
            abort(404);
        }

        $validated = $request->validate([
            'completed' => 'boolean',
        ]);

        $task->update($validated);

        return redirect('/projects/' . $project->id)->with('success', 'Статус задачи обновлен.');
    }

    /**
     * Remove a task.
     */
    public function destroy(Project $project, Task $task)
    {
        // Проверка, что задача принадлежит проекту
        if ($task->project_id !== $project->id) {
            abort(404);
        }

        $task->delete();

        return redirect('/projects/' . $project->id)->with('success', 'Задача удалена.');
    }
}
