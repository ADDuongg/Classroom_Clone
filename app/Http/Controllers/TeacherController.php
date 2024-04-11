<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $querySearch = $request->query('query');

        $teachersQuery = Teacher::query(); // Khởi tạo một builder

        if (!empty($querySearch)) {
            $teachersQuery->where('hoten', 'like', '%' . $querySearch . '%');
            // Thêm điều kiện tìm kiếm theo tên hoặc môn học, thay 'name' và 'subject' bằng các trường tương ứng trong bảng giáo viên
        }

        $teachers = $teachersQuery->paginate(4)->withQueryString();

        return view("teacher.index", compact("teachers", "querySearch"));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /* $teacher = Teacher::all(); */
        return view("teacher.addForm");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        /* $request->validate([
            'hoten' => 'required',
            'gender' => 'required',
            'tuoi' => 'required',
            'ngaysinh' => 'required',
            'sdt' => 'required|numeric|digits:10',
            'diachi' => 'required',
            'cmnd' => 'required|numeric|digits:12',
            'chuvu' => 'required',
            'bangcap' => 'required',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',

        ]); */

        $teacher = new Teacher();
        $id = 'giaovien' . time();
        $teacher->giaovien_id = $id;
        $teacher->hoten = $request->hoten;
        $teacher->gender = $request->gender;
        $teacher->tuoi = $request->tuoi;
        $teacher->ngaysinh = $request->ngaysinh;
        $teacher->sdt = $request->sdt;
        $teacher->diachi = $request->diachi;
        $teacher->cmnd = $request->cmnd;
        $teacher->chucvu = $request->chucvu;
        $teacher->bangcap = $request->bangcap;
        if ($request->hasFile('avatar')) {
            $avatar = $request->avatar;
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('images'), $avatarName);
            $teacher->avatar = $avatarName;
        }
        /* dd($teacher); */
        $teacher->save();
        return redirect()->back()->with("notice", "Thêm giáo viên thành công");
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
        $teacher = Teacher::find($id);
        return view("teacher.editForm", compact("teacher"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $teacher = Teacher::find($id);

        $oldAvatar = 'images/' . $teacher->avatar;

        $teacher->update($request->all());
        if ($request->hasFile('avatar')) {
            if (File::exists($oldAvatar)) {
                File::delete($oldAvatar);
            }
            $newAvatar = $request->file('avatar');
                $newAvatarName = time() . '.' . $newAvatar->getClientOriginalName();
                $newAvatar->move(public_path('images'), $newAvatarName);
                $teacher->update(['avatar' => $newAvatarName]);
        }
        if ($teacher) {
            return redirect()->back()->with("notice", "Cập nhật thông tin giáo viên thành công");
        } else {
            return redirect()->back()->with("notice", "Cập nhật thông tin giáo viên thất bại");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $teacher = Teacher::find($id);
        $teacher->delete();
        if ($teacher) {
            return redirect()->back()->with("notice", "Xóa thông tin giáo viên thành công");
        } else {
            return redirect()->back()->with("notice", "Xóa thông tin giáo viên thất bại");
        }
    }
}
