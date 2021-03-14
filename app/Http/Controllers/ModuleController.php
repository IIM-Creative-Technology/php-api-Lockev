<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\StudentClass;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Module::all());
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
            'name' => 'string',
            'start_date' => 'date',
            'end_date' => 'date',
            'teacher_id' => 'integer',
            'student_class_id' => 'integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $teacher = Teacher::find($request->teacher_id);
        $studentClass = StudentClass::find($request->student_class_id);

        // Verify if start_date and end_date are 5 days apart at max
        $carbon_start = Carbon::parse($request->start_date);
        $carbon_end = Carbon::parse($request->end_date);
        $dateInterval = $carbon_end->diff($carbon_start, false)->days;

        if (!$teacher && $request->teacher_id) {
            return response()->json('There is no teacher with the id ' . $request->teacher_id, 404);
        } else if (!$studentClass && $request->student_class_id) {
            return response()->json('There is no class with the id ' . $request->student_class_id, 404);
        } else if ($dateInterval > 5) {
            return response()->json('A module cannot last longer than 5 days.', 400);
        } else {
            return response()->json(Module::create($request->all()));
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
        $module = Module::where('id', $id);

        if (!$module) {
            return response()->json('There is no module with the id ' . $id, 404);
        } else {
            return response()->json($module->with(['teacher', 'studentClass'])->get());
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
        $module = Module::find($id);

        if (!$module) {
            return response()->json('There is no module with the id ' . $id, 404);
        } else {

            $validator = Validator::make($request->all(), [
                'name' => 'string',
                'start_date' => 'date',
                'end_date' => 'date',
                'teacher_id' => 'integer',
                'student_class_id' => 'integer'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $teacher = Teacher::find($request->teacher_id);
            $studentClass = StudentClass::find($request->student_class_id);

            // Verify if start_date and end_date are 5 days apart at max
            $carbon_start = Carbon::parse($request->start_date);
            $carbon_end = Carbon::parse($request->end_date);
            $dateInterval = $carbon_end->diff($carbon_start, false)->days;

            if (!$teacher && $request->teacher_id) {
                return response()->json('There is no teacher with the id ' . $request->teacher_id, 404);
            } else if (!$studentClass && $request->student_class_id) {
                return response()->json('There is no class with the id ' . $request->student_class_id, 404);
            } else if ($dateInterval > 5) {
                return response()->json('A module cannot last longer than 5 days.', 400);
            } else {
                $module->update($request->all());
                $module->refresh();
                return response()->json($module);
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
