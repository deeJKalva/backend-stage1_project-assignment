<?php

namespace App\Http\Controllers;

use App\Models\Subject;
// use Exception;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    // [{}]: menampikan list array
    // MENAMPILKAN LIST MAPEL: [{_id & name}]
    public function index()
    {
        $subjects = Subject::get();
        return $subjects->map->only(['_id', 'name']);
    }

    public function create()
    {
        //
    }

    // MENAMBAHKAN DATA MAPEL BARU
    public function store(Request $request)
    {
        $request->validate([
            'school_class_name' => 'required|unique:school_classes',
            'name' => 'required',
            'teacher_name' => 'required'
        ]);
        $subject = Subject::create([
            'school_class_name' => $request->school_class_name,
            'name' => $request->name,
            'teacher_name' => $request->teacher_name
        ]);
        // $subject = Subject::create($request->all());
        $data = Subject::where('_id', $subject->id)->get();
        if ($data) {
            return response()->json([
                'message' => 'Data has been added successfully to Sistem Informasi Siswa.',
                'data' => $data
            ]);
        } else {
            return response()->json([
                'message' => 'Data can not be added.'
            ]);
        }
    }

    // MENAMPILKAN DETAIL MAPEL: {_id & name & teacher_name & school_class_name}
    public function show($name)
    {
        $subject = Subject::where('name', $name)->first();
        if ($subject) {
            return response()->json([
                'message' => 'This is the detail of subject <'.$name.'>.',
                'subject id' => $subject->_id,
                'subject name' => $subject->name,
                'teached by' => $subject->teacher_name,
                'for class' => $subject->school_class_name
            ]);
        } else {
            return response()->json([
                'message' => 'Detail of the subject can not be shown.'
            ]);
        }
    }

    public function edit($id)
    {
        //
    }

    // MEMPERBAHARUI DATA MAPEL YANG SUDAH ADA
    public function update(Request $request, $name)
    {
        $subjectBefore = Subject::where('name', $name)->first();
        $subjectAfter = Subject::where('name', $name)->first();
        $subjectAfter->update([
            'name' => $request->name,
            'teacher_name' => $request->teacher_name,
            'school_class_name' => $request->school_class_name
        ]);
        if (($subjectBefore->name != $subjectAfter->name) && ($subjectBefore->teacher_name != $subjectAfter->teacher_name) && ($subjectBefore->school_class_name != $subjectAfter->school_class_name)) {
            return response()->json([
                'message' => 'Data has been updated successfully.',
                'updates' => [
                    'subject <'.$subjectBefore->name.'> changed name to <'.$subjectAfter->name.'>,',
                    '<'.$subjectBefore->teacher_name.'> who teaches this subject is replaced by <'.$subjectAfter->teacher_name.'>,',
                    'AND',
                    'this subject is no longer taught in class <'.$subjectBefore->school_class_name.'>, but in class <'.$subjectAfter->school_class_name.'>.'
                ]
            ]);
        } else if (($subjectBefore->name != $subjectAfter->name) && ($subjectBefore->teacher_name != $subjectAfter->teacher_name) && ($subjectBefore->school_class_name === $subjectAfter->school_class_name)) {
            return response()->json([
                'message' => 'Data has been updated successfully.',
                'updates' => 'subject <'.$subjectBefore->name.'> changed name to <'.$subjectAfter->name.'> AND <'.$subjectBefore->teacher_name.'> who teaches this subject is replaced by <'.$subjectAfter->teacher_name.'>.'
            ]);
        } else if (($subjectBefore->name != $subjectAfter->name) && ($subjectBefore->teacher_name === $subjectAfter->teacher_name) && ($subjectBefore->school_class_name != $subjectAfter->school_class_name)) {
            return response()->json([
                'message' => 'Data has been updated successfully.',
                'updates' => 'subject <'.$subjectBefore->name.'> changed name to <'.$subjectAfter->name.'> AND this subject is no longer taught in class <'.$subjectBefore->school_class_name.'>, but in class <'.$subjectAfter->school_class_name.'>.'
            ]);
        } else if (($subjectBefore->name === $subjectAfter->name) && ($subjectBefore->teacher_name != $subjectAfter->teacher_name) && ($subjectBefore->school_class_name != $subjectAfter->school_class_name)) {
            return response()->json([
                'message' => 'Data has been updated successfully.',
                'updates' => '<'.$subjectBefore->teacher_name.'> who teaches this subject is replaced by <'.$subjectAfter->teacher_name.'> AND this subject is no longer taught in class <'.$subjectBefore->school_class_name.'>, but in class <'.$subjectAfter->school_class_name.'>.'
            ]);
        } else if (($subjectBefore->name != $subjectAfter->name) && ($subjectBefore->teacher_name === $subjectAfter->teacher_name) && ($subjectBefore->school_class_name === $subjectAfter->school_class_name)) {
            return response()->json([
                'message' => 'Data has been updated successfully.',
                'update' => 'subject <'.$subjectBefore->name.'> changed name to <'.$subjectAfter->name.'>.'
            ]);
        } else if (($subjectBefore->name === $subjectAfter->name) && ($subjectBefore->teacher_name != $subjectAfter->teacher_name) && ($subjectBefore->school_class_name === $subjectAfter->school_class_name)) {
            return response()->json([
                'message' => 'Data has been updated successfully.',
                'update' => '<'.$subjectBefore->teacher_name.'> who teaches this subject is replaced by <'.$subjectAfter->teacher_name.'>.'
            ]);
        } else if (($subjectBefore->name === $subjectAfter->name) && ($subjectBefore->teacher_name === $subjectAfter->teacher_name) && ($subjectBefore->school_class_name != $subjectAfter->school_class_name)) {
            return response()->json([
                'message' => 'Data has been updated successfully.',
                'update' => 'this subject is no longer taught in class <'.$subjectBefore->school_class_name.'>, but in class <'.$subjectAfter->school_class_name.'>.'
            ]);
        } else {
            return response()->json([
                'message' => 'Updated nothing.'
            ]);
        }
    }

    public function destroy($name)
    {
        $subject = Subject::find($name);
        $subject->delete();
        return $subject;
    }
}