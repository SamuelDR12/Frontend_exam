<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use App\Models\Employees;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeesRequest;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employees::simplePaginate(10);
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Companies::all();
        return view('employees.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeesRequest $request)
    {
        // Validation passed;
        $validatedData = $request->validated();

        $employee = Employees::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'company_id' => $request->company_id,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        if (!$employee) {
            return redirect()->back()->with('error', 'Sorry, there was a problem while adding a employee.');
        }

        return redirect()->route('employees.index')->with('success', 'Success, your employee has been added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employees $employees)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employees $employee)
    {
        $companies = Companies::all();
        return view('employees.edit')->with([
            'employee' => $employee,
            'companies' => $companies,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeesRequest $request, Employees $employees)
    {
    // Validate the request data
    $validatedData = $request->validated();
    $employee = Employees::find($request->id);
    $employee->first_name = $validatedData['first_name'];
    $employee->last_name = $validatedData['last_name'];
    $employee->company_id = $validatedData['company_id'];
    $employee->email = $validatedData['email'];
    $employee->phone = $validatedData['phone'];
// dd($validatedData);
    if (!$employee->save()) {
        return redirect()->back()->with('error', 'Sorry, there\'re a problem while updating your employee.');
    }
    return redirect()->route('employees.index')->with('success', 'Success, your employee have been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employees $employee)
    {
        // Check if the employee exists
    if (!$employee) {
        return response()->json(['message' => 'Company not found'], 404);
    }

    // Delete the company
    $employee->delete();

    return response()->json(['message' => 'Company deleted successfully']);
    }
}
