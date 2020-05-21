<?php

namespace App\Http\Controllers;


use App\Models\Company;
use App\Mail\CompanyCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    const PAGE_TITLE = 'companies';

    public function index()
    {
        $companies = Company::orderBy('id', 'desc')->paginate(10);
        $pageTitle = self::PAGE_TITLE;

        return view('admin.company', compact('companies', 'pageTitle'));
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
        return view('admin.company_form', compact('pageTitle', 'pageBreadCurm'));
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

        $logoFileName = null;
        $file = $request->file('logo');
        if ($file) {
            $logoFileName = $file->getClientOriginalName();
            $file->move(Company::COMPANY_LOGO_PATH, $logoFileName);
        }
        $companyInfo = $request->all();
        $companyInfo['logo'] = $logoFileName;
        $company = Company::create($companyInfo);
        if (!$company) {
            return redirect()->route('admin.companies.create')->with('error', __('company.add_failed'));
        }
        if ($company->email) {
            Mail::to($company->email)->send(new CompanyCreated($company));
        }

        return redirect()->route('admin.companies.index')->with('success', __('company.add_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        redirect()->route('admin.companies.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);
        $pageTitle = self::PAGE_TITLE;
        $pageBreadCurm = 'edit';
        if (!$company) {
            return redirect()->route('admin.companies.index')->with('error', __('company.not_found'));
        }

        return view('admin.company_form', compact('company', 'pageTitle', 'pageBreadCurm'));
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

        $company = Company::find($id);
        if (!$company) {
            return redirect()->route('admin.companies.index')->with('error',  __('company.not_found'));
        }

        $oldLogFile = null;
        $logoFileName = null;
        $file = $request->file('logo');
        if ($file) {
            $oldLogFile = $company->logo;
            $logoFileName = $file->getClientOriginalName();
            $file->move(Company::COMPANY_LOGO_PATH, $logoFileName);
        }
        $companyInfo = $request->all();
        unset($companyInfo['logo']);
        if ($logoFileName) {
            $companyInfo['logo'] = $logoFileName;
        }

        $company->update($companyInfo);
        if ($oldLogFile) {
            Storage::delete($oldLogFile);
        }

        return redirect()->route('admin.companies.index')->with('success', __('company.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);

        if (!$company) {
            return response()->json(["code" => 'error']);
        }
        $company->employees()->delete();
        $company->delete();

        request()->session()->flash('success', __('company.delete_success'));

        return response()->json(["code" => 'ok']);
    }

    private function getValidationRules($id = 0) {
        return [
            'name' => ['required', 'min:2', 'max:250'],
            'email' => ['required', 'email', 'max:300', 'unique:App\Models\Company,email'. ($id > 0 ? ",$id" : "")],
            'logo' => ['nullable', 'image', 'dimensions:min_width=100,min_height=100', 'max:'. (2 * 1024)],
            'website' => ['nullable', 'url',],
        ];
    }
}
