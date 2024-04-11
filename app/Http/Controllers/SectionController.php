<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::all();
        return view('section.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('section.addForm');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /* dd($request->all()); */
        $id = 'hocky'.time();
        $section = new Section();
        $section->hocky_id = $id;
        $section->hocky = $request->hocky;
        $section->namhoc = $request->namhoc;
        $section->save();
        return redirect()->back()->with('notice', 'Thêm học kỳ mới thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
