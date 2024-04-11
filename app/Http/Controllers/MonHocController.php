<?php

namespace App\Http\Controllers;

use App\Models\MonHoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MonHocController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /* $monhocs = MonHoc::all(); */
        $monhocs = DB::table("monhoc")
        ->join("giaovien","giaovien.giaovien_id","=","monhoc.giaovien_id")
        ->select('monhoc.*', 'giaovien.hoten AS tengiaovien')
        ->get();
        return view("monhoc.index", compact("monhocs"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("monhoc.addForm");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "tenmonhoc" => "required",
            "motamonhoc" => "required",
        ]);

        $monhoc = new MonHoc([
            'monhoc_id' => uniqid('monhoc', true),
            'tenmonhoc' => $request->input('tenmonhoc'),
            'motamonhoc' => $request->input('motamonhoc'),
            'giaovien_id'=> $request->input('giaovien_id'),
        ]);

        /* dd($monhoc); */

        if ($monhoc->save()) {
            return redirect()->back()->with("notice", "Thêm môn học thành công");
        } else {
            return redirect()->back()->with("notice", "Thêm môn học không thành công");
        }
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
        $monhoc = MonHoc::find($id);
        return view("monhoc.editForm", compact("monhoc"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $monhoc = MonHoc::find($id);
        $request->validate([
            "tenmonhoc"=>["required"],
            "motamonhoc"=>["required"],
            "giaovien_id"=>["required"],
        ]);
        $monhoc->update($request->all());
        return redirect()->back()->with("notice","Cập nhật thông tin môn học thành công");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
