<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreScoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Lấy model Score từ tham số của Route (nếu đang ở hàm update)
        $score = $this->route('score');

        // Tạo rule kiểm tra trùng lặp cặp (student_id, subject_id)
        $uniqueRule = Rule::unique('scores')->where(function ($query) {
            return $query->where('student_id', $this->student_id)
                         ->where('subject_id', $this->subject_id);
        });

        // Nếu đang ở thao tác Update, cho phép giữ nguyên ID hiện tại
        if ($score) {
            $uniqueRule->ignore($score->id);
        }

        return [
            'student_id' => ['required', 'exists:students,id'],
            'subject_id' => [
                'required',
                'exists:subjects,id',
                $uniqueRule,
            ],
            'score' => ['required', 'numeric', 'min:0', 'max:10'],
        ];
    }

    public function messages(): array
    {
        return [
            'student_id.required' => 'Vui lòng chọn sinh viên.',
            'student_id.exists'   => 'Sinh viên không tồn tại trên hệ thống.',
            'subject_id.required' => 'Vui lòng chọn môn học.',
            'subject_id.exists'   => 'Môn học không tồn tại trên hệ thống.',
            'subject_id.unique'   => 'Sinh viên này đã có điểm môn học này rồi!',
            'score.required'      => 'Vui lòng nhập điểm số.',
            'score.numeric'       => 'Điểm số phải là dạng số.',
            'score.min'           => 'Điểm số không được nhỏ hơn 0.',
            'score.max'           => 'Điểm số không được vượt quá 10.',
        ];
    }
}