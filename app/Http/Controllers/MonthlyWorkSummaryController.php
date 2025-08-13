<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\MonthlyWorkSummary;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MonthlyWorkSummaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $summaries = MonthlyWorkSummary::with('employee.user')->get();
        return view('monthly-summary.index', compact('summaries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        return view('monthly-summary.add', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'month' => 'required|date',
            'total_hours' => 'required|numeric',
            'notes' => 'nullable|string',
        ]);

        MonthlyWorkSummary::create($request->all());

        return redirect()->route('monthly-summary.index')->with('success', 'Monthly summary created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MonthlyWorkSummary $monthlyWorkSummary)
    {
        $employee = Employee::where('id', $monthlyWorkSummary->employee_id)->first();
        $summaryData = [
            'employee' => $employee->name,
            'month' => Carbon::parse($monthlyWorkSummary->month)->format('F Y'),
            'total_hours' => $monthlyWorkSummary->total_hours,
            'notes' => $monthlyWorkSummary->notes,
        ];

        return view('monthly-summary.show', compact('summaryData'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MonthlyWorkSummary $monthlyWorkSummary)
    {
        $employees = Employee::all();
        return view('monthly-summary.edit', compact('monthlyWorkSummary', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MonthlyWorkSummary $monthlyWorkSummary)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'month' => 'required|date',
            'total_hours' => 'required|numeric',
            'notes' => 'nullable|string',
        ]);

        $monthlyWorkSummary->update($request->all());

        return redirect()->route('monthly-summary.index')->with('success', 'Monthly summary updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MonthlyWorkSummary $monthlyWorkSummary)
    {
        $monthlyWorkSummary->delete();
        return redirect()->route('monthly-summary.index')->with('success', 'Monthly summary deleted successfully.');
    }
}
