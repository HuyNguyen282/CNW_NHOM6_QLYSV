<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Major;
use App\Models\Faculty;
use App\Models\Subject;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.majors.index', ['majors' => Major::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $faculties = Faculty::all();
        $subjects = Subject::orderBy('name')->get();
        return view('admin.majors.create', compact('faculties', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'       => 'required|string|max:255',
            'faculty_id' => 'required|exists:faculties,id',
            'subject_ids'   => 'nullable|array',
            'subject_ids.*' => 'exists:subjects,id',
        ]);

        // Sử dụng Eloquent Model
        $major = Major::create([
            'name'       => $request->input('name'),
            'faculty_id' => $request->input('faculty_id'),
        ]);

        // Đồng bộ danh sách môn học
        if ($request->has('subject_ids')) {
            $major->subjects()->sync($request->input('subject_ids'));
        }

        return redirect()->route('admin.majors.index')->with('success', 'Thêm ngành học thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Lấy thông tin ngành kèm theo Khoa, các lớp học và danh sách môn học thuộc ngành
        $major = Major::with(['faculty', 'classRooms', 'subjects'])->findOrFail($id);

        return view('admin.majors.show', compact('major'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Major $major)
    {
        $faculties = Faculty::all();
        $subjects = Subject::orderBy('name')->get();

        // Lấy mảng ID các môn học của ngành
        $selectedSubjects = $major->subjects->pluck('id')->toArray();

        return view('admin.majors.edit', [
            'faculties'        => $faculties,
            'subjects'         => $subjects,
            'major'            => $major,
            'selectedSubjects' => $selectedSubjects
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Major $major)
    {
        $validatedData = $request->validate([
            'name'       => 'required|string|max:255',
            'faculty_id' => 'required|exists:faculties,id',
            'subject_ids'   => 'nullable|array',
            'subject_ids.*' => 'exists:subjects,id',
        ]);

        $major->update([
            'name'       => $request->input('name'),
            'faculty_id' => $request->input('faculty_id')
        ]);

        // Đồng bộ lại danh sách môn học
        $major->subjects()->sync($request->input('subject_ids', []));

        return redirect()->route('admin.majors.index')
            ->with('success', 'Cập nhật ngành học thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Major $major)
    {

        $major->delete();

        return redirect()->route('admin.majors.index')
            ->with('success', 'Xoá ngành học thành công');
    }
}
