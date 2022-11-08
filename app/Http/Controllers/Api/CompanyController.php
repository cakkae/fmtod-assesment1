<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();

        return response()->json([ 'data' => $companies ], 200);
    }

    public function show($id)
    {
        $company = Company::findOrFail($id);
        return response()->json([ 'data' => $company ], 200);
    }

    public function store(Request $request)
    {
        $values = $request->only('name', 'email', 'logo', 'website');

        $company = Company::create($values);

        return response()->json(['message' => 'Company is correctly added'], 201);
    }

    public function update(Request $request, $id)
    {
        $company = Company::find($id);
        $company->save();

        return response()->json(['message' => 'The company has been updated'], 200);
    }

    public function destroy($id)
    {
        $company= Company::find($id);

        return response()->json([ 'message' => 'The company has been deleted'], 200);
    }
}
