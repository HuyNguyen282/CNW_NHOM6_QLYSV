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
                'bail',
                'required',
                'exists:subjects,id',
                Rule::unique('scores')
                    ->where('student_id', $this->student_id)
                    ->ignore($ignoreId),
                function ($attribute, $value, $fail) {
                    $student = Student::with('classRoom.major.subjects')->find($this->student_id);
                    $allowed = $student?->classRoom?->major?->subjects?->pluck('id')->all() ?? [];

                    if ($student && !in_array((int) $value, $allowed, true)) {
                        $fail('Môn học này không thuộc ngành đào tạo của sinh viên!');
                    }
                },
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
            'score.between'       => 'Điểm số phải nằm trong khoảng từ 0 đến 10.',
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
