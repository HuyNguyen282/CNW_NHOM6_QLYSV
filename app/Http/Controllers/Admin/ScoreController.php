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
        return view('admin.scores.create', [
            'score'             => new Score(),
            'students'          => Student::orderBy('full_name')->get(),
            'subjects'          => Subject::orderBy('name')->get(),
            'selectedStudentId' => $request->integer('student_id') ?: null,
        ]);
    }

    public function store(StoreScoreRequest $request)
    {
        $this->scores->create($request->validated());

        return redirect()->route('admin.scores.index')->with('success', 'Đã thêm điểm.');
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

    public function destroy(Score $score)
    {
        $this->scores->delete($score);

        return redirect()->route('admin.scores.index')->with('success', 'Đã xóa điểm.');
    }
}
