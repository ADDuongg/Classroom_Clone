<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\numberStudentInClass as ModelsNumberStudentInClass;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class numberStudentInClass extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $numberStudentInClass = DB::table("soluonglop")
            ->join("lophoc", "lophoc.lophoc_id", "=", "soluonglop.lophoc_id")
            ->join("hocsinh", "hocsinh.hocsinh_id", "=", "soluonglop.hocsinh_id")
            ->select("soluonglop.*", "lophoc.tenlop", "lophoc.soluong")
            ->get();
        return view("numberStudentInClass.index", compact("numberStudentInClass"));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function createNumberStudent(string $id)
    {
        $classroom = ClassRoom::find($id);
        /* $studentNotInClass = DB::table('hocsinh')
            ->leftJoin('soluonglop', function ($join) {
                $join->on('hocsinh.hocsinh_id', '=', 'soluonglop.hocsinh_id');
            })
            ->where('soluonglop.hocsinh_id', '=', Null)
            ->select('hocsinh.*')
            ->get(); */
        return view("numberStudentInClass.addForm", compact(/* 'studentNotInClass', */'classroom'));
    }
    /* public function create()
    {
        
    } */

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /* dd($request->all()); */
        $codeclass = $request->code_class;
        if ($codeclass) {
            $hocsinh_id = $request->input('hocsinh_id');
            $lophoc = ClassRoom::where('codeclass',$codeclass)->first();
            /* dd($lophoc->lophoc_id); */
            $lophoc_id = $lophoc->lophoc_id;
            $existingSubteacher = ModelsNumberStudentInClass::where('hocsinh_id', $hocsinh_id)
                ->where('lophoc_id', $lophoc_id)
                ->first();
            if ($existingSubteacher) {
                return redirect()->back()->with('notice', 'học sinh này đã có trong lớp, vui lòng thêm lại');
            }
            ModelsNumberStudentInClass::create([
                'lophoc_id' => $lophoc_id,
                'hocsinh_id' => $request->input('hocsinh_id'),
            ]);
            return redirect()->back()->with('notice', 'Bạn đã vào lớp thành công');
        } else {
            $hocsinh_id = $request->input('hocsinh_id');
            $lophoc_id = $request->input('lophoc_id');
            $existingSubteacher = ModelsNumberStudentInClass::where('hocsinh_id', $hocsinh_id)
                ->where('lophoc_id', $lophoc_id)
                ->first();
            if ($existingSubteacher) {
                return redirect()->back()->with('notice', 'học sinh này đã có trong lớp, vui lòng thêm lại');
            }
            ModelsNumberStudentInClass::create([
                'lophoc_id' => $request->input('lophoc_id'),
                'hocsinh_id' => $request->input('hocsinh_id'),
            ]);
            return redirect()->back()->with('notice', 'Thêm học sinh thành công');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
    public function formDelete(string $id)
    {
        $classroom = ClassRoom::find($id);

        $studentInClass = DB::table('soluonglop')
            ->join('lophoc', 'lophoc.lophoc_id', '=', 'soluonglop.lophoc_id')
            ->join('hocsinh', 'hocsinh.hocsinh_id', '=', 'soluonglop.hocsinh_id')
            ->select('hocsinh.*', 'lophoc.tenlop AS tenlophoc')
            ->where('lophoc.lophoc_id', $id) // Điều kiện lớp học được chọn
            ->get();

        return view("numberStudentInClass.deleteForm", compact('studentInClass', 'classroom'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $numberStudentInClass = ModelsNumberStudentInClass::where('hocsinh_id', $id)->delete();

        if ($numberStudentInClass > 0) {
            return response()->json(['success' => true, 'message' => 'Xóa thành công học sinh khỏi lớp học']);
        } else {
            return response()->json(['success' => false, 'message' => 'Không có học sinh được xóa khỏi lớp học']);
        }
    }
}
