<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;

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
        // get all companies
        $companies = Company::paginate(10);

        // load the view and pass the companies
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'nullable|email',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:max_width=100,max_height=100',
            'website' => 'nullable'
        ]);

        if ($request->hasFile('logo')) {
            $filename = Storage::putFile(
                'public',
                $request->file('logo'));

            $validatedData['logo'] = $request->file('logo')->hashName();
        }

        Company::create($validatedData);

        return redirect('/companies')->with('success', 'Company is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::findOrFail($id);

        return view('companies.edit', compact('company'));
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
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'nullable|email',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:max_width=100,max_height=100',
            'website' => 'nullable'
        ]);

        if ($request->hasFile('logo')) {
            $filename = Storage::putFile(
                'public',
                $request->file('logo'));

            $validatedData['logo'] = $request->file('logo')->hashName();
        }

        Company::whereId($id)->update($validatedData);

        return redirect('/companies')->with('success', 'Company is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();

        return redirect('/companies')->with('success', 'Company is successfully deleted');
    }
}
