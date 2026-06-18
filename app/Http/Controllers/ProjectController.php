<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a list of projects.
     */
    public function index()
    {
        $projects = Project::withCount('tasks')->get();
        
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new project.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a new project.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Project::create($validated);

        return redirect('/projects')->with('success', 'Проект создан.');
    }

    /**
     * Display the specified project with tasks.
     */
    public function show(Project $project)
    {
        $project->load(['tasks', 'tasks.project']);
        
        return view('projects.show', compact('project'));
    }

    /**
     * Remove the specified project.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect('/projects')->with('success', 'Проект удален.');
    }
}
