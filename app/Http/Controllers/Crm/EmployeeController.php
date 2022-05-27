<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Company;

class EmployeeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::with(['company'])->get();

        return view('employee.employee', ['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::get();

        return view('employee.form', ['companies' => $companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEmployeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        $credentials = $request->only([
            'first_name',
            'last_name',
            'email',
            'company_id',
            'phone',
        ]);

        $okStore = Employee::create($credentials);

        if(isset($okStore)){
            return back()
                    ->with('success','Successfully');
        }
        return back()
                ->withInput($credentials)
                ->with('error','try egain');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $companies = Company::get();
        return view('employee.form', ['employee' => $employee, 'companies' => $companies, 'edit_mode' => true]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmployeeRequest  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $credentials = $request->only([
            'first_name',
            'last_name',
            'email',
            'company_id',
            'phone',
        ]);

        $okUpdate = $employee->fill($credentials)->save();

        if(isset($okUpdate)){
            return back()
                    ->withInput(['company' => $okUpdate])
                    ->with('success','Successfully');
        }
        return back()
                ->withInput($credentials)
                ->with('error','try egain');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $delete = $employee->delete();
        if(isset($delete)){
            return back()
                    ->with('success','Successfully');
        }
        return back()
                ->with('error','first delete the employees');

    }
}
