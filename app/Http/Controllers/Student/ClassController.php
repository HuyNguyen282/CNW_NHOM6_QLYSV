<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $student = $user->student;

        if (!$student) {
            return view('student.class', [
                'student' => null,
                'classRoom' => null
            ]);
        }

        $student->load('classRoom.major.faculty');

        return view('student.class', [
            'student' => $student,
            'classRoom' => $student->classRoom
        ]);
    }
}
