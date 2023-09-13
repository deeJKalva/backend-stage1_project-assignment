<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\Student;
use App\Models\Student_subject;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // [{}]: list array
    // MENAMPILKAN LIST SISWA: [{_id & name & school_class_name}]
    public function index()
    {
        $student = Student::get();
        return $student->map->only(['_id', 'name', 'school_class_name']);
    }

    public function create()
    {
        //
    }

    // MENAMBAHKAN DATA SISWA BARU
    public function store(Request $request)
    {
        // $request->validate([
        //     // 'school_class_name' => ['required', 'unique:school_classes'],
        //     'school_class_name' => 'required|unique:school_classes',
        //     'name' => 'required',
        //     'date_of_birth' => 'required',
        //     'registration_number' => 'required'
        // ]);
        // $data = Student::create($request->all());
        // if ($data) {
        //     return response()->json([
        //         'message' => 'Data has been added successfully to Sistem Informasi Siswa.',
        //         'data' => [
        //             $data
        //             // 'namaKelas' => $request->namaKelas,
        //             // 'namaSiswa' => $request->namaSiswa,
        //             // 'DOB' => $request->DOB,
        //             // 'NIS' => $request->NIS
        //         ]
        //     ]);
        // } else {
        //     return response()->json([
        //         'message' => 'Data can not be added.'
        //     ]);
        // }

        $request->validate([
            'school_class_name' => 'required|unique:school_classes',
            'name' => 'required',
            'date_of_birth' => 'required|size:10',
            'registration_number' => 'required|size:10'
        ]);
        $student = Student::create($request->all());
        $data = Student::where('_id', $student->_id)->get();
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

    // MENAMPILKAN DETAIL SISWA: {_id & name & school_class_name & scores{subjects}}
    public function show($id)
    {
        $student = Student::where('_id', $id)->first();
        $student_subject = Student_subject::where('student_id', $id)->select('subject_name', 'score_final')->get();
        if ($student) {
            return response()->json([
                'message' => 'This is the detail of the student with ID '.$id.'.',
                'student id' => $student->_id,
                'student name' => $student->name,
                'class name' => $student->school_class_name,
                'score(s)' => $student_subject
            ]);
        } else {
            return response()->json([
                'message' => 'Detail of the student can not be shown.'
            ]);
        }
    }

    public function edit($id)
    {
        //
    }

    // MEMPERBAHARUI DATA SISWA YANG SUDAH ADA
    public function update(Request $request, $id)
    {
        // try {
        //     $request->validate([
        //         'school_class_name' => 'required|unique:school_classes',
        //         'name' => 'required',
        //         'date_of_birth' => 'required',
        //         'registration_number' => 'required'
        //     ]);
        //     $student = Student::findOrFail($id);
        //     $student->update([
        //         'school_class_name' => $request->school_class_name,
        //         'name' => $request->name,
        //         'date_of_birth' => $request->date_of_birth,
        //         'registration_number' => $request->registration_number
        //     ]);
        //     $data = Student::where('_id', '=', $id)->get();
        //     if ($data) {
        //         return response()->json([
        //             'message' => 'Data has been updated successfully.',
        //             'data' => [
        //                 $data
        //             ]
        //         ]);
        //     } else {
        //         return response()->json([
        //             'message' => 'Data can not be updated.'
        //         ]);
        //     }
        // } catch (Exception $error) {
        //     return response()->json([
        //         'message' => 'There is an error.'
        //     ]);
        // }

        // $request->validate([
        //     'school_class_name' => 'required|unique:school_classes',
        //     'name' => 'required'
        // ]);
        $studentBefore = Student::where('_id', $id)->first();
        $studentAfter = Student::where('_id', $id)->first();
        $studentAfter->update([
            'school_class_name' => $request->school_class_name,
            'name' => $request->name
        ]);
        if (($studentBefore->school_class_name != $studentAfter->school_class_name) && ($studentBefore->name != $studentAfter->name)) {
            return response()->json([
                'message' => 'Data has been updated successfully.',
                'updates' => '<'.$studentBefore->name.'> changed name to <'.$studentAfter->name.'> AND transfered from class <'.$studentBefore->school_class_name.'> to class <'.$studentAfter->school_class_name.'>.'
            ]);
        } else if (($studentBefore->school_class_name != $studentAfter->school_class_name) && ($studentBefore->name === $studentAfter->name)) {
            return response()->json([
                'message' => 'Data has been updated successfully.',
                'update' => '<'.$studentAfter->name.'> transfered from class <'.$studentBefore->school_class_name.'> to class <'.$studentAfter->school_class_name.'>.'
            ]);
        } else if (($studentBefore->school_class_name === $studentAfter->school_class_name) && ($studentBefore->name != $studentAfter->name)) {
            return response()->json([
                'message' => 'Data has been updated successfully.',
                'update' => '<'.$studentBefore->name.'> in class <'.$studentAfter->school_class_name.'> changed name to <'.$studentAfter->name.'>.'
            ]);
        } else {
            return response()->json([
                'message' => 'Updated nothing.'
            ]);
        }
    }

    public function destroy($id)
    {
        $student = Student::find($id);
        $student->delete();
        return $student;
    }
}