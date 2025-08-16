<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       
        $status = $request->query('status');
        $type = $request->query('type');
        $user = Auth::user();

    // If user has admin or accountant role => show all payments
    if ($user->hasRole('admin') || $user->hasRole('accountant')) {
        $payments = Payment::with(['employee', 'client'])
        ->when($status, function ($query, $status) {
            return $query->where('status', $status);
        })
        ->when($type, function ($query, $type) {
            return $query->where('type', $type);
        })
        ->latest()
        ->paginate(10);
    }
    // If user is employee => show only his payments
    elseif ($user->hasRole('employee')) {
        $payments = Payment::where('user_id', $user->id)
                ->with('employee')
                ->when($status, function ($query, $status) {
                    return $query->where('status', $status);
                })
                ->when($type, function ($query, $type) {
                    return $query->where('type', $type);
                })
                ->latest()
                ->paginate(10);
    }
    // If user is client => show only his payments
    elseif ($user->hasRole('client')) {
        $payments = Payment::where('user_id', $user->id)
                ->with('client')
                ->when($status, function ($query, $status) {
                    return $query->where('status', $status);
                })
                ->when($type, function ($query, $type) {
                    return $query->where('type', $type);
                })
                ->latest()
                ->paginate(10);
    } 
    else {
        abort(403, 'Unauthorized');
    }

        // $payments = Payment::when($status, function ($query, $status) {
        //     return $query->where('status', $status);
        // })
        //     ->when($type, function ($query, $type) {
        //         return $query->where('type', $type);
        //     })
        //     ->orderBy('payment_date', 'desc')
        //     ->paginate(10);

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
            'method' => 'required|in:credit_card,debit_card,paypal,bank_transfer,cash',
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
