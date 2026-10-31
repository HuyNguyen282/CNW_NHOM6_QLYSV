<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FacultyController extends Controller
{
    public function index()
    {
        $faculties = Faculty::withCount('majors')->orderBy('name')->get();

        return view('admin.faculties.index', compact('faculties'));
    }

    public function create()
    {
        return view('admin.faculties.form', ['faculty' => new Faculty()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:faculties,name'],
        ], $this->messages());

        Faculty::create($data);

        return redirect()->route('admin.faculties.index')->with('success', 'Đã thêm khoa.');
    }

    public function edit(Faculty $faculty)
    {
        return view('admin.faculties.form', compact('faculty'));
    }

    public function update(Request $request, Faculty $faculty)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('faculties', 'name')->ignore($faculty->id)],
        ], $this->messages());

        $faculty->update($data);

        return redirect()->route('admin.faculties.index')->with('success', 'Đã cập nhật khoa.');
    }

    public function destroy(Faculty $faculty)
    {
        // Migration đặt cascade: xóa khoa sẽ xóa luôn ngành và lớp bên dưới, nên chặn lại
        if ($faculty->majors()->exists()) {
            return back()->with('error', 'Không thể xóa: khoa này còn ngành. Hãy xóa hoặc chuyển ngành trước.');
        }

        $faculty->delete();

        return redirect()->route('admin.faculties.index')->with('success', 'Đã xóa khoa.');
    }

    private function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên khoa.',
            'name.unique'   => 'Tên khoa này đã tồn tại.',
            'name.max'      => 'Tên khoa tối đa 255 ký tự.',
        ];
    }
}
