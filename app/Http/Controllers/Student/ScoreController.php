<?php

namespace App\Http\Controllers\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScoreController extends Controller
{
    public function index()
    {
        $user = Auth::user();

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
