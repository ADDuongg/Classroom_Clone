<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function loginPost(Request $request)
    {
        $this->validate($request, [
            "email" => "required",
            "password" => "required",
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            if (auth()->user()->role === 'admin') {
                return redirect()->route('admin');
            }
            if (auth()->user()->role === 'giaovien') {
                $iduser = auth()->user()->id_user;
                // Lấy thông tin của giáo viên và truyền sang route
                return redirect()->route('teacherclass', ['teacher_id' => $iduser]);
            }
            if (auth()->user()->role === 'hocsinh') {
                $iduser = auth()->user()->id_user;
                // Lấy thông tin của học sinh và truyền sang route
                return redirect()->route('studentclass', ['student_id' => $iduser]);
            }
        } else {
            echo 'sai';
        }
    }

    public function index()
    {
        return view("login");
    }
    public function registerPost(Request $request)
    {
        $this->validate($request, [
            "name" => "required",
            "email" => "required",
            "password" => "required",
            "password_confirm" => "required"
        ]);
        if ($request->password != $request->password) {
            return back()->withErrors(["err" => "Không đúng mật khẩu"]);
        } else {
            $user = User::create([
                "name" => $request->name,
                "email" => $request->email,
                "password" => bcrypt($request->password),
            ]);
            $user->save();
            return redirect()->route("login");
        }
    }

    public function logout(Request $request)
    {
        Auth::logout(); 
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login'); 
    }
}
