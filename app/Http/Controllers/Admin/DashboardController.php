<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Major;
use App\Models\Subject;
use App\Models\Faculty;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        // 1. Tổng quan hệ thống
        $totalStudents = Student::count();
        $totalMajors = Major::count();
        $totalSubjects = Subject::count();

        // 2. Điểm trung bình theo khoa
        $avgScoreByFaculty = Faculty::leftJoin('majors', 'faculties.id', '=', 'majors.faculty_id')
            ->leftJoin('class_rooms', 'majors.id', '=', 'class_rooms.major_id')
            ->leftJoin('students', 'class_rooms.id', '=', 'students.class_room_id')
            ->leftJoin('scores', 'students.id', '=', 'scores.student_id')
            ->select('faculties.name', DB::raw('ROUND(AVG(scores.score), 2) as avg_score'))
            ->groupBy('faculties.id', 'faculties.name')
            ->get();

        $searchMajorsResult = collect();
        $searchClassesResult = collect();

        if (!empty($keyword)) {
           
            $matchedMajors = Major::where('name', 'LIKE', "%{$keyword}%")->get();
            
            foreach ($matchedMajors as $major) {

                $subjectsAvg = DB::table('major_subject')
                    ->join('subjects', 'major_subject.subject_id', '=', 'subjects.id')
                    ->leftJoin('class_rooms', 'class_rooms.major_id', '=', 'major_subject.major_id')
                    ->leftJoin('students', 'students.class_room_id', '=', 'class_rooms.id')
                    ->leftJoin('scores', function($join) {
                        $join->on('scores.student_id', '=', 'students.id')
                             ->on('scores.subject_id', '=', 'subjects.id');
                    })
                    ->where('major_subject.major_id', $major->id)
                    ->select('subjects.name as subject_name', DB::raw('ROUND(AVG(scores.score), 2) as avg_score'))
                    ->groupBy('subjects.id', 'subjects.name')
                    ->get();

                $searchMajorsResult->push([
                    'major_name' => $major->name,
                    'subjects'   => $subjectsAvg
                ]);
            }

           
            $matchedClasses = ClassRoom::with('major.subjects')->where('name', 'LIKE', "%{$keyword}%")->get();

            foreach ($matchedClasses as $classRoom) {
                $majorId = $classRoom->major_id;
                
                $subjectsAvg = collect();
                if ($majorId) {
                    $subjectsAvg = DB::table('major_subject')
                        ->join('subjects', 'major_subject.subject_id', '=', 'subjects.id')
                        ->leftJoin('students', function($join) use ($classRoom) {
                            $join->on('students.class_room_id', '=', DB::raw($classRoom->id));
                        })
                        ->leftJoin('scores', function($join) {
                            $join->on('scores.student_id', '=', 'students.id')
                                 ->on('scores.subject_id', '=', 'subjects.id');
                        })
                        ->where('major_subject.major_id', $majorId)
                        ->select('subjects.name as subject_name', DB::raw('ROUND(AVG(scores.score), 2) as avg_score'))
                        ->groupBy('subjects.id', 'subjects.name')
                        ->get();
                }

                $searchClassesResult->push([
                    'class_name' => $classRoom->name,
                    'major_name' => $classRoom->major?->name ?? 'N/A',
                    'subjects'   => $subjectsAvg
                ]);
            }
        }

        $stats = [
            'totalStudents'       => $totalStudents,
            'totalMajors'         => $totalMajors,
            'totalSubjects'       => $totalSubjects,
            'avgScoreByFaculty'   => $avgScoreByFaculty,
            'searchMajorsResult'  => $searchMajorsResult,
            'searchClassesResult' => $searchClassesResult,
        ];

        return view('admin.dashboard', compact('stats', 'keyword'));
    }
}