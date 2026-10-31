<?php

namespace App\Services;

use App\Models\Student;
use App\Models\Subject;
use App\Models\Major;
use Illuminate\Support\Facades\DB;

class StatisticService
{
    public function getDashboardStats(?string $keyword = null)
    {
        // 1. Thống kê tổng quan 
        $totalStudents = Student::count();
        $totalSubjects = Subject::count();
        $totalMajors = Major::count();
        
        $avgScoreByFaculty = DB::table('scores')
            ->join('students', 'scores.student_id', '=', 'students.id')
            ->join('class_rooms', 'students.class_room_id', '=', 'class_rooms.id')
            ->join('majors', 'class_rooms.major_id', '=', 'majors.id')
            ->join('faculties', 'majors.faculty_id', '=', 'faculties.id')
            ->select('faculties.name', DB::raw('ROUND(AVG(scores.score), 2) as avg_score'))
            ->groupBy('faculties.id', 'faculties.name')
            ->get();

        // 2. Thống kê 
        $searchStudentsCount = 0;
        $searchSubjectsCount = 0;
        $avgScoreBySearchMajor = collect();
        $avgScoreBySearchClass = collect();

        if (!empty($keyword)) {
           

            // Điểm TB Ngành
            $avgScoreBySearchMajor = DB::table('scores')
                ->join('students', 'scores.student_id', '=', 'students.id')
                ->join('class_rooms', 'students.class_room_id', '=', 'class_rooms.id')
                ->join('majors', 'class_rooms.major_id', '=', 'majors.id')
                ->select('majors.name', DB::raw('ROUND(AVG(scores.score), 2) as avg_score'))
                ->where('majors.name', 'like', "%{$keyword}%")
                ->groupBy('majors.id', 'majors.name')
                ->get();

            // Điểm TB Lớp
            $avgScoreBySearchClass = DB::table('scores')
                ->join('students', 'scores.student_id', '=', 'students.id')
                ->join('class_rooms', 'students.class_room_id', '=', 'class_rooms.id')
                ->select('class_rooms.name', DB::raw('ROUND(AVG(scores.score), 2) as avg_score'))
                ->where('class_rooms.name', 'like', "%{$keyword}%")
                ->groupBy('class_rooms.id', 'class_rooms.name')
                ->get();
        }

        return [
            'totalStudents' => $totalStudents,
            'totalSubjects' => $totalSubjects,
            'totalMajors' => $totalMajors,
            'avgScoreByFaculty' => $avgScoreByFaculty,
            'searchStudentsCount' => $searchStudentsCount,
            'searchSubjectsCount' => $searchSubjectsCount,
            'avgScoreBySearchMajor' => $avgScoreBySearchMajor,
            'avgScoreBySearchClass' => $avgScoreBySearchClass,
        ];
    }
}