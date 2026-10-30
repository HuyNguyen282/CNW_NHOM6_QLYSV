<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    //
    public function index()
    {
        $user = auth()->user();

        $student = $user->student;

        if (!$student) {
            abort(404, 'Không tìm thấy thông tin học sinh.');
        }

        $scores = $student->scores()
            ->with('subject')
            ->get();

        return view('student.scores', compact('scores'));
    }
}
