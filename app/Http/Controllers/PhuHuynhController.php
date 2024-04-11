<?php

namespace App\Http\Controllers;

use App\Models\PhuHuynh;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PhuHuynhController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parents = DB::table("phuhuynh")
            ->leftJoin("hocsinh", "hocsinh.hocsinh_id", "=", "phuhuynh.hocsinh_id")
            ->select("phuhuynh.*", "hocsinh.hoten AS hotenhocsinh", "hocsinh.hocsinh_id")
            ->get();
        return view("parent.index", compact("parents"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('parent.addForm');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /* dd($request->all()); */
        $phuhuynh = new PhuHuynh();
        $id = 'phuhuynh' . time();
        $phuhuynh->phuhuynh_id = $id;
        $phuhuynh->hocsinh_id = $request->hocsinh_id;
        $phuhuynh->hoten = $request->hoten;
        $phuhuynh->gender = $request->gender;
        $phuhuynh->tuoi = $request->tuoi;
        $phuhuynh->ngaysinh = $request->ngaysinh;
        $phuhuynh->sdt = $request->sdt;
        $phuhuynh->diachi = $request->diachi;
        $phuhuynh->cmnd = $request->cmnd;
        $phuhuynh->vaitro = $request->vaitro;
        $phuhuynh->nghenghiep = $request->nghenghiep;
        if ($request->hasFile('avatar')) {
            $avatar = $request->avatar;
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('images'), $avatarName);
            $phuhuynh->avatar = $avatarName;
        }

        $phuhuynh->save();
        return redirect()->back()->with("notice", "Thêm phụ huynh thành công");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        /* return view */
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $phuhuynh = PhuHuynh::where('phuhuynh_id', $id)->first();
        return view('parent.editForm', compact('phuhuynh'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $phuhuynh = PhuHuynh::find($id);


        

        $oldAvatar = 'images/' . $phuhuynh->avatar;

        $phuhuynh->hocsinh_id = $request->hocsinh_id;
        $phuhuynh->save();

        $phuhuynh->update($request->all());

        if ($request->hasFile('avatar')) {
            if (File::exists($oldAvatar)) {
                File::delete($oldAvatar);

                $newAvatar = $request->file('avatar');
                $newAvatarName = time() . '.' . $newAvatar->getClientOriginalName();
                $newAvatar->move(public_path('images'), $newAvatarName);
                $phuhuynh->update(['avatar' => $newAvatarName]);
            }
        }
        if ($phuhuynh) {
            return redirect()->back()->with("notice", "Cập nhật thông tin phụ huynh thành công");
        } else {
            return redirect()->back()->with("notice", "Cập nhật thông tin phụ huynh thất bại");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $parent = PhuHuynh::where('phuhuynh_id',$id);
        $parent->delete();
        return redirect()->back()->with('msg','Xóa phụ huynh thành công');
    }
}
