<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission as ModelsPermission;

class PermissionController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:manage_permissions')->only(['index', 'create', 'store']);
        $this->middleware('can:view_permissions')->only(['show']);
        $this->middleware('can:edit_permissions')->only(['edit', 'update']);
        $this->middleware('can:delete_permissions')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('permissions.index', compact('permissions'));
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
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        ModelsPermission::create([
            'name' => $request->input('name'),
            'guard_name' => 'web', // Assuming you are using the 'web' guard
        ]);

        return redirect()->route('permissions.index')->with('success', 'Permission created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permission = Permission::findOrFail($id);
        return view('permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $permission = ModelsPermission::findOrFail($id);
        $permission->update([
            'name' => $request->input('name'),
        ]);
        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = ModelsPermission::findOrFail($id);
        $permission->delete();
        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully.');
    }
}
