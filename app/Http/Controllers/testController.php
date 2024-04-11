<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class testController extends Controller
{
    public function viewStudent($id)
    {

        $classTeach = DB::table('soluonglop')
            ->join('lophoc', 'lophoc.lophoc_id', '=', 'soluonglop.lophoc_id')
            ->join('giaovien', 'lophoc.giaovien_id', '=', 'giaovien.giaovien_id')
            ->select('lophoc.*', 'giaovien.*')
            ->where('soluonglop.hocsinh_id', '=', $id)
            ->get();

        $user = Student::where('hocsinh_id', $id)->first();

        return view('Class.HomeClassStudent', compact('classTeach', 'user'));
    }
}
