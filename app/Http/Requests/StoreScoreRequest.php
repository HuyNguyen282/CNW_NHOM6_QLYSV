<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Student;

class StoreScoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $ignoreId = $this->route('score')?->id;

        return [
            'student_code' => ['required', 'exists:students,student_code'],
            'student_id'   => ['nullable', 'integer'],
            'subject_id'   => [
                'required',
                'exists:subjects,id',
                Rule::unique('scores')
                    ->where('student_id', $this->student_id)
                    ->ignore($ignoreId),
            ],
            'score' => ['required', 'numeric', 'between:0,10'],
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
            'student_code.exists' => 'Không tìm thấy sinh viên có mã này.',
            'student_code.required' => 'Vui lòng nhập mã sinh viên.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $student = Student::where('student_code', trim((string) $this->student_code))->first();

        $this->merge(['student_id' => $student?->id]);
    }
}
