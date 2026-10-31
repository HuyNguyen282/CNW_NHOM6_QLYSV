<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreScoreRequest;
use App\Models\Score;
use App\Models\Student;
use App\Models\Subject;
use App\Services\ScoreService;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function __construct(private ScoreService $scores) {}

    public function index(Request $request)
    {
        return view('admin.scores.index', [
            'scores'   => $this->scores->paginate($request->input('q'), $request->integer('subject_id') ?: null),
            'subjects' => Subject::orderBy('name')->get(),
        ]);
    }

    public function create(Request $request)
    {
        $selectedStudentId = $request->integer('student_id') ?: null;
        $subjects = collect();

        // Nếu đã có sinh viên được chọn, chỉ lấy các môn thuộc ngành của sinh viên đó
        if ($selectedStudentId) {
            $student = Student::with('classRoom.major.subjects')->find($selectedStudentId);
            $subjects = $student?->classRoom?->major?->subjects ?? collect();
        } else {
            // Hoặc mặc định lấy tất cả (hoặc để trống tùy ý bạn)
            $subjects = Subject::orderBy('name')->get();
        }

        return view('admin.scores.create', [
            'score'             => new Score(),
            'students'          => Student::orderBy('full_name')->get(),
            'subjects'          => $subjects,
            'selectedStudentId' => $selectedStudentId,
        ]);
    }

    public function store(Request $request)
{
    $request->validate([
        'student_id' => 'required|exists:students,id',
        'subject_id' => 'required|exists:subjects,id',
        'score'      => 'required|numeric|min:0|max:10',
    ]);

    $student = Student::with('classRoom.major.subjects')->findOrFail($request->student_id);

   
    $allowedSubjectIds = $student->classRoom?->major?->subjects->pluck('id')->toArray() ?? [];

    
    if (!in_array($request->subject_id, $allowedSubjectIds)) {
        return back()->withErrors(['subject_id' => 'Môn học này không thuộc ngành đào tạo của sinh viên!'])->withInput();
    }

    
    Score::create([
        'student_id' => $request->student_id,
        'subject_id' => $request->subject_id,
        'score'      => $request->score,
    ]);

    return redirect()->route('admin.scores.index')->with('success', 'Đã thêm điểm thành công.');
}

    public function edit(Score $score)
    {
        return view('admin.scores.edit', [
            'score'    => $score,
            'students' => Student::orderBy('full_name')->get(),
            'subjects' => Subject::orderBy('name')->get(),
        ]);
    }

    public function update(StoreScoreRequest $request, Score $score)
    {
        $this->scores->update($score, $request->validated());

        return redirect()->route('admin.scores.index')->with('success', 'Đã cập nhật điểm.');
    }
    public function byClass($classRoomId)
    {
        
        $classRoom = ClassRoom::with(['major.subjects', 'students.scores'])->findOrFail($classRoomId);
        
        $subjects = $classRoom->major->subjects ?? collect();
        $students = $classRoom->students;

        return view('admin.statistics.by_class', compact('classRoom', 'subjects', 'students'));
    }
    public function destroy(Score $score)
    {
        $this->scores->delete($score);

        return redirect()->route('admin.scores.index')->with('success', 'Đã xóa điểm.');
    }
}
