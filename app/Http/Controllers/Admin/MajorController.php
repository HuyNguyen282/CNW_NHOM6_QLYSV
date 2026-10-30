<?php

namespace App\Http\Controllers\Admin; 

use App\Http\Controllers\Controller;
use App\Models\Major;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $faculties = DB::table('faculties')->get();
        return view('admin.majors.create', compact('faculties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $Name = $request->input('name');
        $FacultyID = $request->input('faculty_id');
        
        $validateData = $request->validate([
            'name'       => 'required',
            'faculty_id' => 'required',
        ]);

        DB::table('majors')->insert([
            'name'       => $Name,
            'faculty_id' => $FacultyID,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.majors.index')->with('success', 'Major Added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Major $major)
    {
        return view('admin.majors.show', compact('major'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Major $major)
    {
        $faculties = Faculty::all();
        return view('admin.majors.edit', [
            'faculties' => $faculties,
            'major'     => $major
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Major $major)
    {
        $Name = $request->input('name');
        $FacultyID = $request->input('faculty_id');

        $validateData = $request->validate([
            'name'       => 'required',
            'faculty_id' => 'required',
        ]);

        $major->update([
            'name'       => $Name,
            'faculty_id' => $FacultyID
        ]);

        return redirect()->route('admin.majors.index')
                         ->with('success', 'Major Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Major $major)
    {
        $major->delete();

        return redirect()->route('admin.majors.index')
            ->with('success', 'Major Data deleted successfully.');
    }
}