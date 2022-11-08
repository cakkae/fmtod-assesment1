<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();

        return response()->json([ 'data' => $employees ], 200);
    }

    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return response()->json([ 'data' => $employee ], 200);
    }

    public function store(Request $request)
    {
        $values = $request->only('name', 'email', 'logo', 'website');

        $employee = Employee::create($values);

        return response()->json(['message' => 'Employee is correctly added'], 201);
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
        $employee->save();

        return response()->json(['message' => 'The employee has been updated'], 200);
    }

    public function destroy($id)
    {
        $employee= Employee::find($id);

        return response()->json([ 'message' => 'The employee has been deleted'], 200);
    }
}
