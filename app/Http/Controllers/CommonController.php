<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CommonController extends Controller
{
    public function __construct()
    {
        Task::addGlobalScope(function ($query) {
            $query->where('project_id', session()->get('project_id', null));
        });
    }

    public function dashboard()
    {
        $activeProject = Project::find(session()->get('project_id'));
        $pendingTasks = Task::where('status', 'todo')->count();
        $inProgressTasks = Task::where('status', 'in_progress')->count();
        $completedTasks = Task::where('status', 'done')->count();

        $totalTasks = $pendingTasks + $inProgressTasks + $completedTasks;

        return Inertia::render('Dashboard', [
            'activeProject' => $activeProject,
            'totalTasks' => $totalTasks,
            'pendingTasks' => $pendingTasks,
            'inProgressTasks' => $inProgressTasks,
            'completedTasks' => $completedTasks,
        ]);
    }
}
