<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\MonthlyWorkSummary;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MonthlyWorkSummaryController extends Controller
{
     public function index()
    {
        $summaries = MonthlyWorkSummary::with('employee')->latest()->paginate(10);
        return view('monthly_summaries.index', compact('summaries'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('monthly_summaries.add', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'month' => 'required|date_format:Y-m',
            'total_hours' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        MonthlyWorkSummary::create($request->all());

        return redirect()->route('monthly-summary.index')
                         ->with('success', 'Monthly summary created successfully.');
    }

    public function show(MonthlyWorkSummary $monthlySummary)
    {
        $employee = Employee::where('id', $monthlySummary->employee_id)->first();
        $summaryData = [
            'employee'  => $employee->user->name,
            'month'     => $monthlySummary->month,
            'total_hours' => $monthlySummary->total_hours,
            'notes'     => $monthlySummary->notes,
        ];

        return view('monthly_summaries.show', compact('summaryData'));
    }

           
    public function edit(MonthlyWorkSummary $monthlySummary)
    {
        $employees = Employee::all();
        return view('monthly_summaries.edit', compact('monthlySummary','employees'));
    }

    public function update(Request $request, MonthlyWorkSummary $monthlySummary)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'month' => 'required|date_format:Y-m',
            'total_hours' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $monthlySummary->update($request->all());

        return redirect()->route('monthly-summary.index')
                         ->with('success', 'Monthly summary updated successfully.');
    }

    public function destroy(MonthlyWorkSummary $monthlySummary)
    {
        $monthlySummary->delete();
        return redirect()->route('monthly-summary.index')
                         ->with('success', 'Monthly summary deleted successfully.');
    }
}
