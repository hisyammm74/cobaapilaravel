<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\employee;

class employeecontroller extends Controller
{

    public function index(){ // get
        return response()->json(employee::all());
    }



  
    public function store(Request $request){ // post
        $request->validate([
            'nama'=>'required',
            'posisi'=>'required'
        ]);
        $employee = employee::create($request->all());
        return response()->json($employee,201);
    }

    public function show(string $id){ // seperti get namun 1 row
        $employee = employee::findOrFail($id);
        return response()->json($employee);
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id){ // put
        $request->validate([
            'nama'=>'required',
            'posisi'=>'required'
        ]);
        $employee = employee::findOrFail($id);
        $employee->update($request->all());
        return response()->json($employee);
    }

    public function destroy(string $id){ // delete
        $employee = employee::findOrFail($id);
        $employee->delete();
        return response()->json(null,204);
    }
}
