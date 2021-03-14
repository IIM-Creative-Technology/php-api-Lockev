<?php

namespace App\Http\Controllers;

use App\Models\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(StudentClass::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'graduation_year' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $studentClass = StudentClass::firstWhere(['name' => $request->name], ['graduation_year' => $request->graduation_year]);

        if ($studentClass) {
            return response()->json('This class already exists', 400);
        } else {
            return response()->json(StudentClass::create($request->all()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $studentClass = StudentClass::where('id', $id);

        if (!$studentClass) {
            return response()->json('There is no class with the id ' . $id, 404);
        } else {
            return response()->json($studentClass->with('students')->get());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $studentClass = StudentClass::find($id);

        if (!$studentClass) {
            return response()->json('There is no class with the id ' . $id, 404);
        } else {

            $validator = Validator::make($request->all(), [
                'graduation_year' => 'integer'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $studentClass->update($request->all());
            $studentClass->refresh();
            return response()->json($studentClass);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student_class = StudentClass::find($id);

        if (!$student_class) {
            return response()->json('There is no class with the id ' . $id, 404);
        } else {
            $student_class->delete();
            return response()->json('Removed class with id ' . $id . ' from database.');
        }
    }
}
