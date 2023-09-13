<?php

namespace App\Http\Controllers;

use App\Models\School_class;
use App\Models\Student;
use Illuminate\Http\Request;

class School_classController extends Controller
{
    // [] : menampilkan list array
    // MENAMPILKAN LIST KELAS: [{_id, school_class_name}]
    public function index()
    {
        $school_classes = School_class::get();
        return $school_classes->map->only(['_id', 'name']);
    }

    public function create()
    {
        //
    }

    // MENAMBAHKAN DATA KELAS BARU
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $school_class = School_class::create($request->all());
        $data = School_class::where('_id', $school_class->_id)->get();
        if ($data) {
            return response()->json([
                'message' => 'Data has been added successfully to Sistem Informasi Siswa.',
                'data' => $data
            ]);
        } else {
            return response()->json([
                'message' => 'Data can not be added to Sistem Informasi Siswa.'
            ]);
        }
    }

    // students[] : list array students
    // MENAMPILKAN DETAIL KELAS: {_id, school_class_name, students[{_id, student_name}])
    public function show($name)
    {
        // $class = DB::table('school_classes')->select('_id', 'name')->where('name','=',$request->name)->first();
        $class = School_class::where('name', $name)->first();

        // $school_class = School_class::where('name', '=', $request->name)->get();
        // $student = Student::select('_id', 'name')->distinct()->get();
        $student = Student::where('school_class_name', $name)->select('_id', 'name')->get();
        if ($class) {
            return response()->json([
                'message' => 'This is the detail of class '.$name.'.',
                'class id' => $class->_id,
                'class name' => $class->name,
                'student(s)' => $student
            ]);
        } else {
            return response()->json([
                'message' => 'Detail of the class can not be shown.'
            ]);
        }
    }

    public function edit($id)
    {
        //
    }

    // MEMPERBAHARUI DATA KELAS YANG SUDAH ADA
    public function update(Request $request, $name)
    {
        // try {
            /* $request->validate([
                'name' => 'required'
            ]);
            // $class = School_class::where('name', $name)->first();
            $school_class = School_class::findOrFail($name);
            $school_class->update([
                'name' => $request->name
            ]);

            $data = School_class::where('name', $name)->get(); */

            // $request->validate([
            //     'name' => 'required'
            // ]);
            // $class = School_class::where('name', $name)->first();
            // $data = School_class::find($class->name);
            // if ($data) {
            //     return response()->json([
            //         'message' => 'Data has been updated successfully.',
            //         'data' => [
            //             $data->name = $request->name
            //         ]
            //     ]);
            //     $data->save();
            // } else {
            //     return response()->json([
            //         'message' => 'Data can not be updated.'
            //     ]);
            // }
        // } catch (Exception $error) {
        //     return response()->json([
        //         'message' => 'There is an error.'
        //     ]);
        // }

        $school_class = School_class::where('name', $name)->update([
            'name' => $request->name
        ]);
        if ($school_class) {
            return response()->json([
                'message' => 'Data has been updated successfully.',
                'update' => 'class name <'.$name.'> changed to <'.$request->name.'>.'
            ]);
        } else {
            return response()->json([
                'message' => 'Data can not be updated.'
            ]);
        }
    }

    public function destroy($name)
    {
        // $school_class = School_class::find($name);
        // $school_class->delete();
        // return $school_class;
        $school_class = School_class::where('name', $name)->delete();
        return $school_class;
    }
}