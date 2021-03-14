<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use App\Models\Module;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class MarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Mark::all());
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
            'value' => 'required|integer',
            'student_id' => 'required|integer',
            'module_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        if ($request->value < 0 || $request->value > 20) {
            return response()->json('A mark must have a value within 0-20 range, your value : ' . $request->value, 400);
        }

        $student = Student::find($request->student_id);
        $module = Module::find($request->module_id);

        if (!$student) {
            return response()->json('There is no student with the id ' . $request->student_id, 404);
        } else if (!$module) {
            return response()->json('There is no module with the id ' . $request->module_id, 404);
        } {
            return response()->json(Mark::create($request->all()));
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
        $mark = Mark::where('id', $id)->with(['module', 'student'])->first();

        if (!$mark) {
            return response()->json('There is no mark with the id ' . $id, 404);
        } else {
            return response()->json($mark);
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
        $mark = Mark::find($id);

        if (!$mark) {
            return response()->json('There is no mark with the id ' . $id, 404);
        } else {

            $validator = Validator::make($request->all(), [
                'value' => 'integer',
                'student_id' => 'integer',
                'module_id' => 'integer'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            if ($request->value < 0 || $request->value > 20) {
                return response()->json('A mark must have a value within 0-20 range, your value : ' . $request->value, 400);
            }

            $student = Student::find($request->student_id);
            $module = Module::find($request->module_id);

            if (!$student) {
                return response()->json('There is no student with the id ' . $request->student_id, 404);
            } else if (!$module) {
                return response()->json('There is no module with the id ' . $request->module_id, 404);
            } {
                return response()->json(Mark::create($request->all()));
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
        $mark = Mark::find($id);
        if (!$mark) {
            return response()->json('There is no mark with the id ' . $id, 404);
        } else {
            $mark->delete();
            return response()->json('Removed mark with id ' . $id . ' from database.');
        }
    }
}
