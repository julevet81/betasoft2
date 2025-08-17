<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Employee;
use App\Models\Project;
use App\Models\Status;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:manage_projects')->only(['index', 'create', 'store']);
        $this->middleware('can:view_projects')->only(['show']);
        $this->middleware('can:edit_projects')->only(['edit', 'update']);
        $this->middleware('can:delete_projects')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with(['client', 'manager.user', 'status'])->get();
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        $clients = Client::all();
        $statuses = Status::all();
        return view('projects.add', compact('employees', 'clients', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'       => 'required|string|max:255',
            'client_id'  => 'required|exists:clients,id',
            'budget'     => 'required|numeric',
            'manager_id' => 'required|exists:employees,id',
            'status_id'  => 'required|exists:statuses,id',
            'description'=> 'nullable|string',
            'start_date' => 'required|date',
            'expected_end_date'   => 'required|date|after:start_date',
        ]);

        $project = Project::create($validatedData);
        $project->save();
        return redirect()->route('projects.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $employee = Employee::where('id', $project->manager_id)->first();
        $projectData = [
            'name'      => $project->name,
            'client'    => $project->client->name,
            'budget'    => $project->budget,
            'manager'   => $employee->user->name ,
            'description' => $project->description,
            'start_date' => $project->start_date,
            'expected_end_date'   => $project->expected_end_date,
            'status'     => $project->status,
        ];

        return view('projects.show', compact('projectData'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $clients = Client::all();
        $employees = Employee::all();
        $statuses = Status::all();
        return view('projects.edit', compact('project', 'clients', 'employees', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            'name'        => 'required|string|max:255',
            'client_id'  => 'required|exists:clients,id',
            'budget'     => 'required|numeric',
            'manager_id' => 'required|exists:employees,id',
            'status_id'  => 'required|exists:statuses,id',
            'description'=> 'nullable|string',
            'start_date' => 'required|date',
            'expected_end_date'   => 'required|date|after:start_date',
        ]);
        $project->update($validatedData);
        return redirect()->route('projects.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index');
    }
}
