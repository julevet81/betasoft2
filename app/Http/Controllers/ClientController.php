<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::with('user')->get();
        $users = User::all();
        return view('clients.index', compact('clients', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('clients.add', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        // Get the selected user
        $user = User::findOrFail($request->user_id);

        $existingClient = Client::withTrashed()
        ->where('email', $user->email)
        ->first();

        if ($existingClient) {
        if ($existingClient->trashed()) {
            // Restore if soft deleted
            $existingClient->restore();
            return redirect()->route('clients.index')
                ->with('success', 'Client restored successfully.');
        } else {
            // Already exists and active
            return redirect()->back()
                ->withErrors(['email' => 'This client already exists.']);
        }
    }

        // Create client using user data
        Client::create([

            'user_id' => $user->id,
            'name'    => $user->name,
            'email'   => $user->email,
            'phone'   => $user->phone,
            'address' => $user->address,
        ]);

        return redirect()->route('clients.index')->with('success', 'Client added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        $clientData = [
            'name'      => $client->user->name,
            'email'     => $client->user->email,
            'phone'     => $client->user->phone,
            'address'   => $client->user->address,
            'image'     => $client->user->image,
            
        ];

        return view('clients.show', compact('clientData'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        $users = User::all();
        return view('clients.edit', compact('client', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $client->update($request->all());
        return redirect()->route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index');
    }
}
