<?php

namespace App\Services;

use App\Models\Score;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ScoreService
{
    /** Bảng điểm của một học sinh (Người 4 dùng cho trang xem điểm) */
    public function getByStudent(int $studentId): Collection
    {
        return Score::with('subject')
            ->where('student_id', $studentId)
            ->get()
            ->sortBy(fn ($score) => $score->subject->name)
            ->values();
    }

    /** Điểm trung bình của một học sinh, null nếu chưa có điểm */
    public function averageByStudent(int $studentId): ?float
    {
        $avg = Score::where('student_id', $studentId)->avg('score');

        return $avg === null ? null : round((float) $avg, 2);
    }

    /** Danh sách cho admin, có tìm theo tên/mã học sinh và lọc theo môn */
    public function paginate(?string $keyword = null, ?int $subjectId = null, int $perPage = 10): LengthAwarePaginator
    {
        return Score::with(['student.classRoom', 'subject'])
            ->when($keyword, function ($query, $keyword) {
                $query->whereHas('student', function ($q) use ($keyword) {
                    $q->where('full_name', 'like', "%{$keyword}%")
                      ->orWhere('student_code', 'like', "%{$keyword}%");
                });
            })
            ->when($subjectId, fn ($query, $id) => $query->where('subject_id', $id))
            ->latest()
            ->paginate($perPage)
            ->withQueryString();
    }

    public function create(array $data): Score
    {
        return Score::create($data);
    }

    public function update(Score $score, array $data): Score
    {
        $score->update($data);

        return $score;
    }

    public function delete(Score $score): void
    {
        $score->delete();
    }
}
