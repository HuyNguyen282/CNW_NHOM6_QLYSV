<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.classes.index', [
            'classes' => ClassRoom::with('major')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $majors = Major::with('faculty')->get();

        return view('admin.classes.create', compact('majors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:class_rooms,name',
            'description' => 'nullable|string',
            'major_id' => 'required|exists:majors,id'
        ], [
            'name.required' => 'Vui lòng nhập tên lớp.',
            'name.unique' => 'Tên lớp đã tồn tại.',
            'major_id.required' => 'Vui lòng chọn ngành học.',
            'major_id.exists' => 'Ngành học không tồn tại.'
        ]);

        DB::table('class_rooms')->insert([
            'name' => $request->name,
            'description' => $request->description,
            'major_id' => $request->major_id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('admin.classes.index')->with('success', 'Thêm lớp học thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ClassRoom $class)
    {
        $class->load('major.faculty');
        return view('admin.classes.show', compact('class'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassRoom $class)
    {
        $majors = Major::with('faculty')->get();
        return view('admin.classes.edit', compact('class', 'majors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  ClassRoom $class)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:class_rooms,name,' . $class->id,
            'description' => 'nullable|string',
            'major_id' => 'required|exists:majors,id'
        ], [
            'name.required' => 'Vui lòng nhập tên lớp.',
            'name.unique' => 'Tên lớp đã tồn tại.',
            'major_id.required' => 'Vui lòng chọn ngành học.',
            'major_id.exists' => 'Ngành học không tồn tại.'
        ]);

        $class->update([
            'name' => $request->name,
            'description' => $request->description,
            'major_id' => $request->major_id
        ]);

        return redirect()->route('admin.classes.index')->with('success', 'Cập nhật lớp học thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassRoom $class)
    {
        $class->delete();
        return redirect()->route('admin.classes.index')->with('success', 'Xóa lớp học thành công.');
    }
}
