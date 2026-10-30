<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreScoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $ignoreId = $this->route('score')?->id;
        return [
            'student_id' => ['required', 'exists:students,id'],
            'subject_id' => [
                'required',
                'exists:subjects,id',
                Rule::unique('scores')
                ->where('student_id', $this->student_id)
                ->ignore($ignoreId)
            ],
            'score' => ['required', 'numeric', 'between:0,10'],
        ];
    }
    public function messages(): array
    {
        return ['subject_id.unique' => 'Học sinh đã có điểm của môn này, hãy sửa điểm cũ'];
    }
}
