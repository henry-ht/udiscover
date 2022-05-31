<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;

class CompanyController extends Controller
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
        $companies = Company::withCount(['employee'])->paginate(5);

        return view('company.companies', ['companies' => $companies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.form', []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCompanyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyRequest $request)
    {
        $credentials = $request->only([
            'name',
            'email',
            'logo',
            'web_page',
        ]);

        try {
            if(isset($credentials['logo'])){
                $logo = $request->file('logo');
                $filePath = $logo->storeAs('uploads', $logo->getClientOriginalName(), 'public');
                $credentials['logo'] = '/storage/' . $filePath;
            }
            $okStore = Company::create($credentials);

            if(isset($okStore)){
                return back()
                    ->with('success','Successfully');
            }
            return back()
                ->withInput($credentials)
                ->with('error','try egain');

        } catch (\Throwable $th) {
            return back()
                ->withInput($credentials)
                ->with('error','ups not working');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('company.form', ['company' => $company, 'edit_mode' => true]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCompanyRequest  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $credentials = $request->only([
            'name',
            'email',
            'logo',
            'web_page',
        ]);

        try {
            if(isset($credentials['logo'])){
                $logo = $request->file('logo');
                $filePath = $logo->storeAs('uploads', $logo->getClientOriginalName(), 'public');
                $credentials['logo'] = '/storage/' . $filePath;
            }

            $okUpdate = $company->fill($credentials)->save();

            if(isset($okUpdate)){
                return back()
                    ->withInput(['company' => $okUpdate])
                    ->with('success','Successfully');
            }
            return back()
                ->withInput($credentials)
                ->with('error','try egain');

        } catch (\Throwable $th) {
            return back()
                ->withInput($credentials)
                ->with('error','ups not working');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        if($company->loadCount(['employee'])->employee_count == 0){
            $delete = $company->delete();
            if(isset($delete)){
                return back()
                        ->with('success','Successfully');
            }
        }else{
            return back()
                    ->with('error','first delete the employees');
        }


    }
}
