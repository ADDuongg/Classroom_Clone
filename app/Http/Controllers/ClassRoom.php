<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom as ModelsClassRoom;
use App\Models\numberStudentInClass;
use App\Models\Section;
use App\Models\subTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassRoom extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classrooms = DB::table("lophoc")
            ->join("giaovien", "giaovien.giaovien_id", "=", "lophoc.giaovien_id")
            ->join("hocky", "hocky.hocky_id", "=", "lophoc.hocky_id")
            ->select("lophoc.*", "giaovien.hoten AS tengiaovien", "hocky.hocky AS tenhocky", "hocky.namhoc AS namhoc")
            ->get();
        /*  dd($classrooms); */
        return view("ClassRoom.index", compact("classrooms"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ClassRoom.addForm');
    }

    public function addSubteacher($id)
    {
        $classroom = ModelsClassRoom::where('lophoc.lophoc_id', $id)->first();
        return view('ClassRoom.addSubTeacher', compact('classroom'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        function generateRandomString($length = 6)
        {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $shuffledString = str_shuffle($characters);
            $randomString = substr($shuffledString, 0, $length);

            return $randomString;
        }
        $randomString = generateRandomString();
        $classroom = new ModelsClassRoom();
        $id = 'classroom' . time();
        $classroom->lophoc_id = $id;
        $classroom->hocky_id = $request->hocky_id;
        $classroom->giaovien_id = $request->giaovien_id;
        $classroom->soluong = 0;
        $classroom->tenlop = $request->tenlop;
        $classroom->isActive = 0;
        $classroom->codeclass = $randomString;
        $classroom->subteacher_id = '';
        $classroom->save();
        return redirect()->back()->with("notice", "Thêm lớp học thành công");
    }

    public function storeSubteacher(Request $request)
    {
        
        if ($request->ajax()) {

            $dataRequest = json_decode($request->getContent(), true);
            $lophoc_id = $dataRequest['lophoc_id'];
            foreach ($dataRequest['giaovien_id'] as $giaovien_id) {
                $existingSubteacher = subTeacher::where('giaovien_id', $giaovien_id)
                    ->where('lophoc_id', $lophoc_id)
                    ->first();
                if ($existingSubteacher) {

                    return response()->json(['error' => 'có giáo viên đã thêm trước đó']);
                }
                $subteacher = new subTeacher();
                $subteacher->giaovien_id = $giaovien_id;
                $subteacher->lophoc_id = $lophoc_id;
                $subteacher->save();

                return response()->json(['success' => 'thêm giáo viên thành công']);
            }
        }
        else{
            $existingSubteacher = subTeacher::where('giaovien_id', $request->giaovien_id)
                ->where('lophoc_id', $request->lophoc_id)
                ->first();
            if ($existingSubteacher) {
    
                return redirect()->back()->with('notice', 'Giáo viên đã được thêm vào lớp học trước đó.');
            }
            $subteacher = new subTeacher();
            $subteacher->giaovien_id = $request->giaovien_id;
            $subteacher->lophoc_id = $request->lophoc_id;
            $subteacher->save();
    
            return redirect()->back()->with('notice', 'Thêm thành công giáo viên vào lớp học');
        }
    }

    public function inviteStudent(Request $request)
    {
        /* $dataRequest = json_decode($request->getContent(), true);
        dd($dataRequest); */
        if ($request->ajax()) {

            $dataRequest = json_decode($request->getContent(), true);
            $lophoc_id = $dataRequest['lophoc_id'];
            foreach ($dataRequest['hocsinh_id'] as $hocsinh_id) {
                $existingSubteacher = numberStudentInClass::where('hocsinh_id', $hocsinh_id)
                    ->where('lophoc_id', $lophoc_id)
                    ->first();
                if ($existingSubteacher) {

                    return response()->json(['error' => 'có học sinh đã ở trong lớp']);
                }
                $numberStudent = new numberStudentInClass();
                $numberStudent->hocsinh_id = $hocsinh_id;
                $numberStudent->lophoc_id = $lophoc_id;
                $numberStudent->save();

                return response()->json(['success' => 'thêm học sinh thành công']);
            }
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
        $classroom = ModelsClassRoom::find($id);
        return view('ClassRoom.editForm', compact('classroom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $classrooms = ModelsClassRoom::find($id);
        $classroom = $classrooms->update($request->all());

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $classroom = ModelsClassRoom::find($id);
        $lophoc_id = $classroom->lophoc_id;
        $numberClassroom = numberStudentInClass::where('lophoc_id', $lophoc_id);
        /* dd($numberClassroom); */
        $numberClassroom->delete();
        $classroom->delete();
        if ($classroom) {
            return redirect()->back()->with("notice", "Xóa lớp học thành công");
        } else {
            return redirect()->back()->with("notice", "Xóa lớp học thất bại");
        }
    }
}
