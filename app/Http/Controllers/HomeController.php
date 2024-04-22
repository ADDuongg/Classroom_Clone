<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Comments;
use App\Models\Homework;
use App\Models\numberStudentInClass;
use App\Models\Post;
use App\Models\Student;
use App\Models\subTeacher;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public $teacher;
    public $student;
    public $idUser;
    public function __construct(Teacher $teacher, Student $student)
    {
        $this->teacher = $teacher;
        $this->student = $student;
    }

    public function index($id)
    {
        $this->idUser = $id;
        $classTeach = $this->getClassTeach($id);
        $user = $this->teacher->where('giaovien_id', $id)->first();
        return view('Class.HomeClassTeacher', compact('classTeach', 'user'));
    }


    protected function getClassTeach($id_user)
    {
        return DB::table('lophoc')
            ->select('lophoc.*', 'giaovien.*')
            ->join('giaovien', 'giaovien.giaovien_id', '=', 'lophoc.giaovien_id')
            ->where('giaovien.giaovien_id', $id_user)
            ->get();
    }
    protected function getClassTeachStudent($id_user)
    {
        return DB::table('lophoc')
            ->select('lophoc.*')
            ->join('soluonglop', 'soluonglop.lophoc_id', '=', 'lophoc.lophoc_id')
            ->where('soluonglop.hocsinh_id', '=', $id_user)
            ->get();
    }
    public function detailClass($id, $iduser)
    {
        $id_user = $iduser;
        $userType = User::where('id_user', $id_user)->value('role');
        $query = DB::table('posts')
            ->select([
                'posts.*',
                DB::raw('COALESCE(giaovien.giaovien_id, hocsinh.hocsinh_id) AS user_id'),
                DB::raw('COALESCE(giaovien.avatar, hocsinh.avatar) AS avatar'),
                DB::raw('COALESCE(giaovien.hoten, hocsinh.hoten) AS hoten'),
                DB::raw('CASE 
            WHEN giaovien.giaovien_id IS NOT NULL THEN "giaovien"
            WHEN hocsinh.hocsinh_id IS NOT NULL THEN "hocsinh"
        END AS user_type')
            ])
            ->leftJoin('giaovien', 'posts.user_id', '=', 'giaovien.giaovien_id')
            ->leftJoin('hocsinh', 'posts.user_id', '=', 'hocsinh.hocsinh_id')

            ->where('posts.lophoc_id', $id)
            ->orderBy('posts.created_at', 'desc');


        $posts = $query->get();
        if ($userType === 'giaovien') {
            // Nếu là giáo viên
            $user = $this->teacher->where('giaovien_id', $id_user)->first();
            $classroom = ClassRoom::where('lophoc_id', $id)->first();
            $homeworks = Homework::where('lophoc_id', $id)
                ->orderBy('created_at', 'desc')
                ->get();
            $number_posts = DB::table('posts')
                ->leftJoin('comments', 'comments.post_id', '=', 'posts.id')
                ->where('posts.lophoc_id', $id)
                ->count();
            /* $comments = Comments::all(); */
            $classTeach = $this->getClassTeach($id_user);
            return view('Class.detailClass', compact('homeworks', 'classroom', 'user', 'classTeach', 'posts', 'id_user',/*  'comments', */ 'number_posts'));
        } elseif ($userType === 'hocsinh') {
            $user = $this->student->where('hocsinh_id', $id_user)->first();
            $classroom = ClassRoom::where('lophoc_id', $id)->first();
            $homeworks = Homework::where('lophoc_id', $id)
                ->orderBy('created_at', 'desc')
                ->get();
            /* $comments = Comments::all(); */
            $classTeach = DB::table('soluonglop')
                ->join('lophoc', 'lophoc.lophoc_id', '=', 'soluonglop.lophoc_id')
                ->join('giaovien', 'lophoc.giaovien_id', '=', 'giaovien.giaovien_id')
                ->select('lophoc.*', 'giaovien.*')
                ->where('soluonglop.hocsinh_id', '=', $id_user)
                ->get();
            return view('Class.detailClass', compact('homeworks', 'user', 'posts', 'classroom',/*  'comments', */ 'classTeach', 'id_user'));
        }
    }



    public function showEveryone($id_class, $iduser)
    {
        $id_user = $iduser;
        $userType = User::where('id_user', $id_user)->value('role');
        if ($userType === 'giaovien') {
            $user = $this->teacher->where('giaovien_id', $id_user)->first();
            $classroom = ClassRoom::where('lophoc_id', $id_class)->first();
            $classTeach = $this->getClassTeach($id_user);
            $teacher = DB::table('lophoc')
            ->select('lophoc.*', 'giaovien.*')
            ->join('giaovien', 'giaovien.giaovien_id', '=', 'lophoc.giaovien_id')
            ->where('giaovien.giaovien_id', $id_user)
            ->first();
            return view('Class.everyOne', compact('user', 'classTeach', 'classroom', 'id_user','teacher'));
        } elseif ($userType === 'hocsinh') {
            $user = $this->student->where('hocsinh_id', $id_user)->first();
            $classroom = ClassRoom::where('lophoc_id', $id_class)->first();
            $teacher = DB::table('soluonglop')
                ->join('lophoc', 'lophoc.lophoc_id', '=', 'soluonglop.lophoc_id')
                ->join('giaovien', 'lophoc.giaovien_id', '=', 'giaovien.giaovien_id')
                ->select('lophoc.*', 'giaovien.*')
                ->where('soluonglop.hocsinh_id', '=', $id_user)
                ->first();
            $classTeach = $this->getClassTeachStudent($id_user);
            return view('Class.everyOne', compact('classTeach', 'user', 'teacher', 'classroom', 'id_user'));
        }
    }

    public function showHomework($id_class, $iduser)
    {
        $id_user = $iduser;
        $userType = User::where('id_user', $id_user)->value('role');
        if ($userType === 'giaovien') {
            $user = $this->teacher->where('giaovien_id', $id_user)->first();
            $classroom = ClassRoom::where('lophoc_id', $id_class)->first();
            $posts = Homework::where('lophoc_id', $id_class)
                ->orderBy('created_at', 'desc')
                ->get();
            $classTeach = $this->getClassTeach($id_user);
            $comments = Comments::all();
            return view('Class.homeWork', compact('user', 'classTeach', 'classroom', 'posts', 'comments', 'id_user'));
        } elseif ($userType === 'hocsinh') {
            $user = $this->student->where('hocsinh_id', $id_user)->first();
            $classroom = ClassRoom::where('lophoc_id', $id_class)->first();
            $posts = Homework::where('lophoc_id', $id_class)
                ->orderBy('created_at', 'desc')
                ->get();
            $classTeach = DB::table('soluonglop')
                ->join('lophoc', 'lophoc.lophoc_id', '=', 'soluonglop.lophoc_id')
                ->join('giaovien', 'lophoc.giaovien_id', '=', 'giaovien.giaovien_id')
                ->select('lophoc.*', 'giaovien.*')
                ->where('soluonglop.hocsinh_id', '=', $id_user)
                ->get();
            $comments = Comments::all();
            return view('Class.homeWork', compact('user', 'classTeach', 'classroom', 'posts', 'comments', 'id_user'));
        }
    }

    public function deleteTeacher($id)
    {
        $teacher = subTeacher::where('subteacher.giaovien_id', $id);
        $teacher->delete();
        return redirect()->back()->with('msg', 'Xóa giáo viên khỏi lớp học thành công');
    }
    public function deleteStudent($id_student, $id_class)
    {
        $student = numberStudentInClass::where([
            'hocsinh_id' => $id_student,
            'lophoc_id' => $id_class,
        ])->first();

        $student->delete();
        return redirect()->back()->with('msg', 'Xóa học sinh khỏi lớp học thành công');
    }
}
