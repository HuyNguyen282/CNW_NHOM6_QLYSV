<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
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
            'classes' => ClassRoom::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.classes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:class_rooms,name',
            'description' => 'nullable|string'
        ], [
            'name.required' => 'Vui lòng nhập tên lớp.',
            'name.unique' => 'Tên lớp đã tồn tại.'
        ]);

        $name = $request->input('name');
        $description = $request->input('description');

        DB::table('class_rooms')->insert([
            'name' => $name,
            'description' => $description,
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
        return view('admin.classes.show', compact('class'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassRoom $class)
    {
        return view('admin.classes.edit', compact('class'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  ClassRoom $class)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:class_rooms,name,' . $class->id,
            'description' => 'nullable|string'
        ], [
            'name.required' => 'Vui lòng nhập tên lớp.',
            'name.unique' => 'Tên lớp đã tồn tại.'
        ]);

        $class->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect()->route('admin.classes.index')->with('success', 'Cập nhật lớp học thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassRoom $class)
    {
        $class->delete();

        return redirect()->route('admin.classes.index')
            ->with('success', 'Xóa lớp học thành công.');
    }
}
