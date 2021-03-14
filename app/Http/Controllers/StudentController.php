<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Student::all());
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
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'age' => 'required|integer',
            'entry_year' => 'required|integer',
            'student_class_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $class = StudentClass::find($request->class_id);

        if (!$class) {
            return response()->json('There is no class with the id ' . $request->class_id, 404);
        } else {
            return response()->json(Student::create($request->all()));
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
        $student = Student::where('id', $id)->with('studentClass')->first();

        if (!$student) {
            return response()->json('There is no student with the id ' . $id, 404);
        } else {
            return response()->json($student);
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
        $student = Student::find($id);

        if (!$student) {
            return response()->json('There is no student with the id ' . $id, 404);
        } else {

            $validator = Validator::make($request->all(), [
                'firstname' => 'string',
                'lastname' => 'string',
                'age' => 'integer',
                'entry_year' => 'integer',
                'student_class_id' => 'integer'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $studentClass = StudentClass::find($request->class_id);

            if (!$studentClass && $request->promotion_id) {
                return response()->json('There is no class with the id ' . $request->promotion_id, 404);
            } else {
                $student->update($request->all());
                $student->refresh();

                return response()->json($student);
            }
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
        //
    }
}
