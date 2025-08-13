<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::all();
        $projects = Project::all();
        $status = $request->query('status');
        $type = $request->query('type');

        $payments = Payment::when($status, function ($query, $status) {
            return $query->where('status', $status);
        })
            ->when($type, function ($query, $type) {
                return $query->where('type', $type);
            })
            ->orderBy('payment_date', 'desc')
            ->paginate(10);

        return view('payments.index', compact('payments', 'status', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $projects = Project::all();
        return view('payments.add', compact('projects', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric',
            'user_id' => 'required|exists:users,id',
            'project_id' => 'required|exists:projects,id',
            'payment_date' => 'required|date',
            'type' => 'required|in:salary,bonus,client_payment',
            'status' => 'required|in:pending,completed,cancelled',
            'method' => 'required|in:credit_card,debit_card,paypal',
            'reference' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:1000',
        ]);

        $payment = Payment::create($validated);
        $payment->save();
        return redirect()->route('payments.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        return view('payments.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        $users = User::all();
        $projects = Project::all();
        return view('payments.edit', compact('payment', 'projects', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric',
            'user_id' => 'required|exists:users,id',
            'project_id' => 'required|exists:projects,id',
            'payment_date' => 'required|date',
            'type' => 'required|in:salary,bonus,client_payment',
            'status' => 'required|in:pending,completed,cancelled',
            'method' => 'required|in:credit_card,debit_card,paypal',
            'reference' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:1000',
        ]);

        $payment->update($validated);
        return redirect()->route('payments.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index');
    }
}
