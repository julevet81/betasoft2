<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission as ModelsPermission;
use Spatie\Permission\Models\Role as ModelsRole;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = ModelsRole::all(); // Assuming you have a Role model
        return view('roles.index', compact('roles')); // Adjust the view name as needed
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        ModelsRole::create([
            'name' => $request->input('name'),
            'guard_name' => 'web', // Assuming you are using the 'web' guard
        ]);
        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = ModelsRole::findOrFail($id); // Find the role by ID

        $roleData = [
            'name' => $role->name,
            'guard_name' => $role->guard_name,
            'permissions' => $role->permissions->pluck('name')->toArray(),
        ];

        return view('roles.show', compact('roleData'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = ModelsRole::findOrFail($id); // Find the role by ID
        $permissions = ModelsPermission::all(); // Fetch all permissions for the role
        $rolePermissions = $role->permissions->pluck('id')->toArray(); // Get the permissions assigned to the role
        return view('roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
        'name' => 'required|string|max:255',
        'permissions' => 'array|required',
    ]);

    $role = ModelsRole::findOrFail($id);
    $role->update(['name' => $request->name]);

    // Convert IDs to names
    $permissionNames = ModelsPermission::whereIn('id', $request->permissions)->pluck('name')->toArray();

    // Sync by name
    $role->syncPermissions($permissionNames);

    return redirect()->route('roles.index')
                     ->with('success', 'Role updated successfully.');
    }

    public function assignPermissions(Request $request, string $id)
    {
        $role = ModelsRole::findOrFail($id);
        $permissions = $request->input('permissions', []); // Get permissions from the request
        $role->syncPermissions($permissions); // Sync permissions with the role
        return redirect()->route('roles.index')->with('success', 'Permissions assigned successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = ModelsRole::findOrFail($id);
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
