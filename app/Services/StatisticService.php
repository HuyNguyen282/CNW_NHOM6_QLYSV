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
        // 1. Đếm tổng số Sinh viên 
        $totalStudents = Student::when($keyword, function ($query, $keyword) {
            $query->whereHas('classRoom.major.faculty', function ($q) use ($keyword) {
                $q->where('faculties.name', 'like', "%{$keyword}%");
            })
            ->orWhereHas('classRoom.major', function ($q) use ($keyword) {
                $q->where('majors.name', 'like', "%{$keyword}%");
            })
            ->orWhereHas('classRoom', function ($q) use ($keyword) {
                $q->where('class_rooms.name', 'like', "%{$keyword}%");
            });
        })->count();

        // 2. Đếm tổng số Ngành học 
        $totalMajors = Major::when($keyword, function ($query, $keyword) {
            $query->where('name', 'like', "%{$keyword}%")
                  ->orWhereHas('faculty', function ($q) use ($keyword) {
                      $q->where('name', 'like', "%{$keyword}%");
                  });
        })->count();

        
        $totalSubjects = Subject::count();

        $studentsByMajor = Major::withCount('students')->get();

        // 3. Điểm TB theo Lớp
        $avgScoreByClass = DB::table('scores')
            ->join('students', 'scores.student_id', '=', 'students.id')
            ->join('class_rooms', 'students.class_room_id', '=', 'class_rooms.id')
            ->select('class_rooms.name', DB::raw('ROUND(AVG(scores.score), 2) as avg_score'))
            ->when($keyword, function ($query, $keyword) {
                $query->where('class_rooms.name', 'like', "%{$keyword}%");
            })
            ->groupBy('class_rooms.id', 'class_rooms.name')
            ->get();

        // 4. Điểm TB theo Ngành
        $avgScoreByMajor = DB::table('scores')
            ->join('students', 'scores.student_id', '=', 'students.id')
            ->join('class_rooms', 'students.class_room_id', '=', 'class_rooms.id')
            ->join('majors', 'class_rooms.major_id', '=', 'majors.id')
            ->select('majors.name', DB::raw('ROUND(AVG(scores.score), 2) as avg_score'))
            ->when($keyword, function ($query, $keyword) {
                $query->where('majors.name', 'like', "%{$keyword}%");
            })
            ->groupBy('majors.id', 'majors.name')
            ->get();

        // 5. Điểm TB theo Khoa
        $avgScoreByFaculty = DB::table('scores')
            ->join('students', 'scores.student_id', '=', 'students.id')
            ->join('class_rooms', 'students.class_room_id', '=', 'class_rooms.id')
            ->join('majors', 'class_rooms.major_id', '=', 'majors.id')
            ->join('faculties', 'majors.faculty_id', '=', 'faculties.id')
            ->select('faculties.name', DB::raw('ROUND(AVG(scores.score), 2) as avg_score'))
            ->when($keyword, function ($query, $keyword) {
                $query->where('faculties.name', 'like', "%{$keyword}%");
            })
            ->groupBy('faculties.id', 'faculties.name')
            ->get();

        return [
            'totalStudents' => $totalStudents,
            'totalSubjects' => $totalSubjects,
            'totalMajors' => $totalMajors,
            'studentsByMajor' => $studentsByMajor,
            'avgScoreByClass' => $avgScoreByClass,
            'avgScoreByMajor' => $avgScoreByMajor,
            'avgScoreByFaculty' => $avgScoreByFaculty,
        ];
    }
}