<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Inertia\Inertia;

class TaskController extends Controller
{


    public function __construct()
    {
        Task::addGlobalScope(function ($query) {
            if (session()->has('project_id')) {
                $query->where('project_id', session()->get('project_id'));
            }
        });
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::with('project')
            ->orderBy('priority', 'asc')
            ->get();
        return Inertia::render('Tasks/TaskIndex', [
            'tasks' => $tasks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Tasks/TaskCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        //remove null values
        $data = collect($request->all())->filter()->toArray();
        $data['project_id'] = session()->get('project_id');
        Task::create($data);

        if ($request->expectsJson()){
            return response()->json([
                'message' => 'Task created.',
            ]);
        }

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return Inertia::render('Tasks/TaskShow', [
            'task' => $task->load('project'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return Inertia::render('Tasks/TaskEdit', [
            'task' => $task,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->validated());

        if ($request->expectsJson()){
            return response()->json([
                'message' => 'Task updated.',
            ]);
        }

        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index');
    }
}
