<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Subject;


class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   
    public function index()
    {
        //
        
       return view('admin.subjects.index', [
        'subjects' => Subject::paginate(10)
    ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|unique:subjects,name',
            'credits' => 'required|integer|min:1|max:255',
        ]);

        $name = $request->input('name');
        $credits = $request->input('credits');

        Subject::create([
            'name' => $name,
            'credits' => $credits,
        ]);

        return redirect()
            ->route('admin.subjects.index')
            ->with('success', 'Thêm môn học thành công.');
        }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        //
       
        return view('admin.subjects.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        //
        
        return view('admin.subjects.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        //
        $request->validate([
            'name' => 'required|unique:subjects,name,' . $subject->id,
            'credits' => 'required|integer|min:1|max:255',
        ]);
        $name = $request->input('name');
        $credits = $request->input('credits');

        $subject->update([
            'name' => $name,
            'credits' => $credits,
        ]);

        return redirect()
            ->route('admin.subjects.index')
            ->with('success', 'Cập nhật môn học thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        //
        $subject->delete();

        return redirect()
            ->route('admin.subjects.index')
            ->with('success', 'Xóa môn học thành công.');
        }
}
