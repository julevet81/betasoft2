<?php

namespace App\Http\Controllers;

use App\Models\ContractType;
use App\Models\Employee;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $employees = Employee::with(['user', 'post', 'contractType'])->get();
        $users = User::all();
        $posts = Post::all();
       return view('employees.index', compact('employees', 'users', 'posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $posts = Post::all();
        $contractTypes = ContractType::all();
        return view('employees.add', compact('users', 'posts', 'contractTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = User::find($request->user_id);
        if (!$user) {
            return redirect()->back()->withErrors(['user_id' => 'User not found']);
        }
        
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'post_id' => 'required|exists:posts,id',
            'contract_type_id' => 'required|exists:contract_types,id',
            'start_date' => 'required|date',
            
        ]);

        Employee::create($validated);

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
    

        // Prepare the array you want
        $employeeData = [
            'name'      => $employee->user->name,
            'post'      => $employee->post->title,
            'contract_type' => $employee->contractType->name,
            'start_date'=> $employee->start_date,
            'email'     => $employee->user->email,
            'status'    => $employee->user->status,
            'phone'     => $employee->user->phone,
            'address'   => $employee->user->address,
            'image'     => $employee->user->image,
            'role_name' => $employee->user->role_name,
        ];

        return view('employees.show', compact('employeeData'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $posts = Post::all();
        $contractTypes = ContractType::all();
        $user = User::find($employee->user_id);
        return view('employees.edit', compact('employee', 'posts', 'contractTypes', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'post_id' => 'required|exists:posts,id',
            'contract_type_id' => 'required|exists:contract_types,id',
            'start_date' => 'required|date',
            
        ]);

        $employee->update($validated);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
