<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Exception;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    // MENAMBAHKAN DATA NILAI BARU
    public function store(Request $request)
    {
        $request->validate([
            'student_registration_number' => 'required|unique:students',
            'practice_1' => 'required',
            'practice_2' => 'required',
            'practice_3' => 'required',
            'practice_4' => 'required',
            'daily_test_1' => 'required',
            'daily_test_2' => 'required',
            'midterm_test' => 'required',
            'endterm_test' => 'required',
            'final' => 'required'
        ]);
        $data = Score::create($request->all());
        if ($data) {
            return response()->json([
                'message' => 'Data has been added successfully to Sistem Informasi Siswa.',
                'data' => [
                    $data
                ]
            ]);
        } else {
            return response()->json([
                'message' => 'Data can not be added.'
            ]);
        }
    }

    // MENAMPILKAN DETAIL NILAI PER SISWA PER MAPEL: {student_id, subject_id, score_final, detail[practice[], daily_test[], midterm_test, endterm_test]}
    public function show($id)
    {
        $data = Score::where('_id', '=', $id)->get();
        if ($data) {
            return response()->json([
                'message' => 'This is the detail of the student with ID '.$id.'.',
                'data' => [
                    '_id' => $data->_id,
                    'name' => $data->name,
                    'school_class_name' => $data->school_class_name
                ]
            ]);
        } else {
            return response()->json([
                'message' => 'Data can not be shown.'
            ]);
        }
    }

    public function edit($id)
    {
        //
    }

    // MEMPERBAHARUI DATA NILAI YANG SUDAH ADA
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'practice_1' => 'required',
                'practice_2' => 'required',
                'practice_3' => 'required',
                'practice_4' => 'required',
                'daily_test_1' => 'required',
                'daily_test_2' => 'required',
                'midterm_test' => 'required',
                'endterm_test' => 'required',
                'final' => 'required'
            ]);
            $score = Score::findOrFail($id);
            $score->update([
                'practice_1' => $request->practice_1,
                'practice_2' => $request->practice_2,
                'practice_3' => $request->practice_3,
                'practice_4' => $request->practice_4,
                'daily_test_1' => $request->daily_test_1,
                'daily_test_2' => $request->daily_test_2,
                'midterm_test' => $request->midterm_test,
                'endterm_test' => $request->endterm_test,
                'final' => $request->final
            ]);
            $data = Score::where('_id', '=', $id)->get();
            if ($data) {
                return response()->json([
                    'message' => 'Data has been updated successfully.',
                    'data' => [
                        $data
                    ]
                ]);
            } else {
                return response()->json([
                    'message' => 'Data can not be updated.'
                ]);
            }
        } catch (Exception $error) {
            return response()->json([
                'message' => 'There is an error.'
            ]);
        }
    }

    public function destroy($id)
    {
        $score = Score::find($id);
        $score->delete();
        return $score;
    }
}