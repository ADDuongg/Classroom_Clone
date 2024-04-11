<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\PhuHuynh;
use App\Models\Teacher;
use App\Models\ClassRoom;
use App\Models\numberStudentInClass;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\File;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        /* if ($request->has('name') || $request->has('lophoc') || $request->has('phuhuynh')) { */
        $name = $request->input('name');
        $lophoc = $request->input('lophoc');
        $phuhuynh = $request->input('phuhuynh');
        $page = $request->query('page', 1);
        $students = DB::table("hocsinh")
            ->join('soluonglop', 'hocsinh.hocsinh_id', '=', 'soluonglop.hocsinh_id')
            ->join('lophoc', 'lophoc.lophoc_id', '=', 'soluonglop.lophoc_id')
            ->join('giaovien', 'lophoc.giaovien_id', '=', 'giaovien.giaovien_id')
            ->leftJoin('phuhuynh', 'hocsinh.hocsinh_id', '=', 'phuhuynh.hocsinh_id')
            ->select('hocsinh.*', 'lophoc.tenlop AS ten_lop_hoc', 'giaovien.hoten AS ten_giao_vien', 'phuhuynh.hoten AS tenphuhuynh', 'phuhuynh.phuhuynh_id');

        if ($name) {
            $students->where(function ($query) use ($name) {
                $query->orWhere('hocsinh.hoten', 'like', '%' . $name . '%');
            });
        }
        if ($lophoc) {
            $students->where('lophoc.tenlop', 'like', '%' . $lophoc . '%');
        }
        if ($phuhuynh) {
            $students->where('phuhuynh.hoten', 'like', '%' . $phuhuynh . '%');
        }
        $students = $students->get();
        return view("student.index", compact("students"));

        /* } */
    }

    public function showScore()
    {
        $students = DB::table('studenthomework')
            ->join('hocsinh', 'hocsinh.hocsinh_id', '=', 'studenthomework.user_id')
            ->select('hocsinh.*', 'studenthomework.score', 'studenthomework.created_at', 'studenthomework.updated_at')
            /* ->first(); */
        ->paginate(5)
            ->withQueryString();

        /* $dateString = $students->created_at;
        $timestamp = strtotime($dateString);

        $newDateTimeFormat = date('d-m-Y H:i', $timestamp);
 */
        /* echo $newDateFormat; */
        /* dd($newDateTimeFormat); */
        return view('Score.index', compact('students'));
    }





    public function getAllStudents(Request $request)
    {
        $sortType = $request->input('sorttype', 'asc');
        if ($request) {
            $name = $request->input('name');
            $lophoc = $request->input('lophoc');
            $phuhuynh = $request->input('phuhuynh');
            $page = $request->query('page', 1);

            $students = DB::table('hocsinh')
                ->select('hocsinh.*', 'lophoc.tenlop AS ten_lop_hoc', 'giaovien.hoten AS ten_giao_vien', 'phuhuynh.hoten AS tenphuhuynh', 'phuhuynh.phuhuynh_id')
                ->leftJoin('soluonglop', 'hocsinh.hocsinh_id', '=', 'soluonglop.hocsinh_id')
                ->leftJoin('lophoc', 'soluonglop.lophoc_id', '=', 'lophoc.lophoc_id')
                ->leftJoin('giaovien', 'lophoc.giaovien_id', '=', 'giaovien.giaovien_id')
                ->leftJoin('phuhuynh', 'hocsinh.hocsinh_id', '=', 'phuhuynh.hocsinh_id');
            if ($name) {
                $students->where('hocsinh.hoten', 'like', '%' . $name . '%');
            }

            if ($lophoc) {
                $students->where('lophoc.tenlop', '=', $lophoc);
            }
            if ($phuhuynh) {
                $students->where('phuhuynh.hoten', '=', $phuhuynh);
            }



            if ($sortType !== null) {
                $students->orderBy('hocsinh.hoten', $sortType);
            }

            if ($request->ajax()) {
                $showPerPage = $request->query('showPerPage', 3);
                $students = $students->paginate($showPerPage)->withQueryString();
                $students->appends(['showPerPage' => $showPerPage]);
                return response()->json($students);
            } else {
                $showPerPage = $request->query('showPerPage', 3);
                $students = $students->paginate($showPerPage)->withQueryString();
                $students->appends(['showPerPage' => $showPerPage]);
                return view("student.allStudent", compact("students", "sortType"));
            }
        } else {
            $page = $request->query('page', 1);
            $searchQuery = $request->query('query');
            $query = DB::table('hocsinh')
                ->select('hocsinh.*', 'lophoc.tenlop AS ten_lop_hoc', 'giaovien.hoten AS ten_giao_vien', 'phuhuynh.hoten AS tenphuhuynh', 'phuhuynh.phuhuynh_id')
                ->leftJoin('soluonglop', 'hocsinh.hocsinh_id', '=', 'soluonglop.hocsinh_id')
                ->leftJoin('lophoc', 'soluonglop.lophoc_id', '=', 'lophoc.lophoc_id')
                ->leftJoin('giaovien', 'lophoc.giaovien_id', '=', 'giaovien.giaovien_id')
                ->leftJoin('phuhuynh', 'hocsinh.hocsinh_id', '=', 'phuhuynh.hocsinh_id');
            if ($searchQuery !== null) {
                $query->where('hocsinh.hoten', 'like', '%' . $searchQuery . '%');
            }
            if ($sortType !== null) {
                $query->orderBy('hocsinh.hoten', $sortType);
                // Thay 'hocsinh.hoten' bằng trường bạn muốn sắp xếp
            }
            if ($request->ajax()) {
                $showPerPage = $request->query('showPerPage', 3);
                $students = $query->paginate($showPerPage/* , ['*'], 'page', $page */)->withQueryString();
                $students->appends(['showPerPage' => $showPerPage]);
                return response()->json($students);
            } else {
                $showPerPage = $request->query('showPerPage', 3);
                $students = $query->paginate($showPerPage/* , ['*'], 'page', $page */)->withQueryString();
                $students->appends(['showPerPage' => $showPerPage]);
                return view("student.allStudent", compact("students", "sortType"));
            }
        }
    }





    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('student.addStudentForm');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'hoten' => 'required',
            'gender' => 'required',
            'tuoi' => 'required',
            'ngaysinh' => 'required',
            'sdt' => 'required|numeric|digits:10',
            'diachi' => 'required',
            'cmnd' => 'required|numeric|digits:12',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $id = 'hocsinh' . time() . '';

        $student = new Student();
        $student->hocsinh_id = $id;
        $student->hoten = $request->hoten;
        $student->gender = $request->gender;
        $student->tuoi = $request->tuoi;
        $student->ngaysinh = $request->ngaysinh;
        $student->sdt = $request->sdt;
        $student->diachi = $request->diachi;
        $student->cmnd = $request->cmnd;

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('images'), $avatarName);
            $student->avatar = $avatarName;
        }

        $student->save();
        /* dd($request->all()); */
        return redirect()->route('student.create');
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
        $students = Student::find($id);

        /* $phuhuynh = PhuHuynh::find('phuhuynh1704423994'); */
        /* dd($phuhuynh); */
        /* dd($students->getAttributes());  */ // Xác nhận giá trị hocsinh_id ở đây

        return view('student.formEdit', compact('students'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $student = Student::find($id);

        $oldAvatar = 'images/' . $student->avatar;


        $student->update($request->all());

        if ($request->hasFile('avatar')) {
            if (File::exists($oldAvatar)) {
                File::delete($oldAvatar);
            }

            $newAvatar = $request->file('avatar');
            $avatarName = time() . '.' . $newAvatar->getClientOriginalName();

            $newAvatar->move(public_path('images'), $avatarName);

            $student->update(['avatar' => $avatarName]);
        }


        return redirect()->back()->with('notice', 'Cập nhật thành công');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Student::find($id)->delete();
        return redirect()->back()->with('notice', 'Xóa học sinh thành công');
    }
}
