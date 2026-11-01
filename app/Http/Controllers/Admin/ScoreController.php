<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreScoreRequest;
use App\Models\ClassRoom;
use App\Models\Score;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Major;
use App\Services\ScoreService;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function __construct(private ScoreService $scores) {}

    public function index(Request $request)
    {
        return view('admin.scores.index', [
            'scores'   => $this->scores->paginate($request->input('q'), $request->integer('subject_id') ?: null, $request->integer('major_id') ?: null),
            'subjects' => Subject::orderBy('name')->get(),
            'majors'=> Major::orderBy('name')->get(),
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
            'score'    => new Score(),
            'subjects' => Subject::orderBy('name')->get(), // JS sẽ lọc theo ngành sau khi gõ mã SV
        ]);
    }

    public function store(StoreScoreRequest $request)
    {
        $data = $request->validated();

        $this->scores->create([
            'student_id' => $data['student_id'],
            'subject_id' => $data['subject_id'],
            'score' => $data['score'],
        ]);

        return redirect()->route('admin.scores.index')
            ->with('success', 'Đã thêm điểm thành công.');
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
        $this->scores->update($score, $request->safe()->only(['student_id', 'subject_id', 'score']));

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
    public function lookupStudent(Request $request)
    {
        $code = strtoupper(trim((string) $request->query('code')));

        // chỉ gõ số thì hiểu là SVxxxx
        if ($code !== '' && ctype_digit($code)) {
            $code = 'SV' . str_pad($code, 4, '0', STR_PAD_LEFT);
        }

        $student = Student::with('classRoom.major.faculty', 'classRoom.major.subjects')
            ->where('student_code', $code)
            ->first();

        if (!$student) {
            return response()->json(['found' => false]);
        }

        return response()->json([
            'found'    => true,
            'code'     => $student->student_code,
            'name'     => $student->full_name,
            'class'    => $student->classRoom->name ?? null,
            'major'    => $student->classRoom->major->name ?? null,
            'faculty'  => $student->classRoom->major->faculty->name ?? null,
            'subjects' => ($student->classRoom?->major?->subjects ?? collect())
                ->sortBy('name')->values()
                ->map(fn($s) => ['id' => $s->id, 'name' => $s->name]),
        ]);
    }
}
