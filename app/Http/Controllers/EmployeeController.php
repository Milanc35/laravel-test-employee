<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Company;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    const PAGE_TITLE = 'employees';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::with('company')->orderBy('id', 'desc')->paginate(10);
        $pageTitle = self::PAGE_TITLE;

        return view('admin.employee', compact('employees', 'pageTitle'));
    }

    private function listAllCompanyIds() {
        return Company::pluck('name', 'id')->toArray();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = self::PAGE_TITLE;
        $pageBreadCurm = 'add';
        $companies = $this->listAllCompanyIds();
        return view('admin.employee_form', compact('pageTitle', 'pageBreadCurm', 'companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateinfo = $request->validate($this->getValidationRules());

        $employeeInfo = $request->all();
        $employee = Employee::create($employeeInfo);
        if (!$employee) {
            return redirect()->route('admin.employees.create')->with('error',  __('employee.add_failed'));
        }

        return redirect()->route('admin.employees.index')->with('success', __('employee.add_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        redirect()->route('admin.employees.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::find($id);
        $pageTitle = self::PAGE_TITLE;
        $pageBreadCurm = 'edit';
        $companies = $this->listAllCompanyIds();
        if (!$employee) {
            return redirect()->route('admin.employees.index')->with('error', __('employee.not_found'));
        }

        return view('admin.employee_form', compact('companies', 'employee', 'pageTitle', 'pageBreadCurm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateinfo = $request->validate($this->getValidationRules($id));

        $employee = Employee::find($id);
        if (!$employee) {
            return redirect()->route('admin.employees.index')->with('error', __('employee.not_found'));
        }

        $employeeInfo = $request->all();
        $employee->update($employeeInfo);

        return redirect()->route('admin.employees.index')->with('success', __('employee.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(["code" => 'error']);
        }
        $employee->delete();

        request()->session()->flash('success', __('employee.delete_success'));

        return response()->json(["code" => 'ok']);
    }

    private function getValidationRules($id = 0) {
        return [
            'first_name' => ['required', 'min:2', 'max:250'],
            'last_name' => ['required', 'min:2', 'max:250'],
            'email' => ['nullable', 'email', 'max:300', 'unique:App\Models\Employee,email'. ($id > 0 ? ",$id" : "")],
            'phone' => ['nullable', 'regex:/\\(?\\d{3}\\)?[-\\/\\.\\s]?\\d{3}[-\\/\\.\\s]?/'],
            'company_id' => ['required', 'exists:App\Models\Company,id'],
        ];
    }
}
