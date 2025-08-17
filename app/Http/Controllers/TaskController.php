<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Project;
use App\Models\Status;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:manage_tasks')->only(['index', 'create', 'store']);
        $this->middleware('can:view_tasks')->only(['show']);
        $this->middleware('can:edit_tasks')->only(['edit', 'update']);
        $this->middleware('can:delete_tasks')->only(['destroy']);
    }

    
    public function index()
    {
        // Fetch all tasks
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        // Fetch necessary data for the form
        $projects = Project::all();
        $employees = Employee::all();
        $statuses = Status::all();

        return view('tasks.add', compact('projects', 'employees', 'statuses'));
    }

   
    public function store(Request $request)
    {
        // Validate and store the task
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'project_id' => 'required|exists:projects,id',
            'employee_id' => 'required|exists:employees,id',
            'status_id' => 'required|exists:statuses,id',
            'estimated_hours' => 'required|numeric',
            'hours_worked' => 'required|numeric',
            'notes' => 'nullable|string',
        ]);

        Task::create($validated);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function show(Task $task)
    {
        $employee = Employee::find($task->employee_id);
        $project = Project::find($task->project_id);
        $status = Status::find($task->status_id);

        $taskData = [
            'title'         => $task->title,
            'description'   => $task->description,
            'project'      => $project->name,
            'employee'     => $employee->name,
            'status'       => $status->name,
            'estimated_hours' => $task->estimated_hours,
            'hours_worked'   => $task->hours_worked,
            'notes'         => $task->notes,
        ];

        return view('tasks.show', compact('taskData'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        // Fetch necessary data for the form
        $projects = Project::all();
        $employees = Employee::all();
        $statuses = Status::all();

        return view('tasks.edit', compact('task', 'projects', 'employees', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        // Validate and update the task
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'project_id' => 'required|exists:projects,id',
            'employee_id' => 'required|exists:employees,id',
            'status_id' => 'required|exists:statuses,id',
            'estimated_hours' => 'required|numeric',
            'hours_worked' => 'numeric',
            'notes' => 'nullable|string',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
