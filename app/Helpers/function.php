<?php

use App\Models\MonHoc;
use App\Models\PhuHuynh;
use App\Models\Section;
use App\Models\subTeacher;
use App\Models\Teacher;
use App\Models\ClassRoom;
use App\Models\numberStudentInClass;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

function getAllParent()
{
    $parent = new PhuHuynh;
    return $parent->all();
}

function getAllTeacher()
{
    $teacher = new Teacher;
    return $teacher->all();
}
function getClassById($id)
{
    $classroom = ClassRoom::where('lophoc.lophoc_id', $id);
    return $classroom->first();
}

function getAllClass()
{
    $classroom = ClassRoom::all();
    return $classroom;
}

function getParentStudent()
{
    $parent = DB::table('hocsinh')
        ->leftJoin('phuhuynh', 'hocsinh.hocsinh_id', '=', 'phuhuynh.hocsinh_id')
        ->select('phuhuynh.*')
        ->get();
    return $parent;
}

function getAllTeacherNotTeach()
{
    $teachers = DB::table('lophoc')
        ->rightJoin('giaovien', 'giaovien.giaovien_id', '=', 'lophoc.giaovien_id')
        ->whereNull('lophoc.giaovien_id')
        ->get();
    return $teachers;
}
function getAllSection()
{
    $section = Section::all();
    return $section;
}
function getAllSubject()
{
    $subject = MonHoc::all();
    return $subject;
}
function getAllStudents()
{
    $student = new Student;
    return $student->all();
}
function getNumberStudent($id_class)
{
    $number = NumberStudentInClass::where('lophoc_id', $id_class)->count();
    return $number;
}
function getSubTeacherBelongToClass($id_class)
{
    $subteacher = DB::table('subteacher')
        ->select('giaovien.*')
        ->join('giaovien', 'giaovien.giaovien_id', 'subteacher.giaovien_id')
        ->where('subteacher.lophoc_id', '=', $id_class)
        ->get();

    return $subteacher;
}
function getStudentBelongToClass($id_class)
{
    $students = DB::table('hocsinh')
        ->select('hocsinh.*')
        ->join('soluonglop', 'soluonglop.hocsinh_id', 'hocsinh.hocsinh_id')
        ->where('soluonglop.lophoc_id', '=', $id_class)
        ->get();

    return $students;
}

function getAllSubTeacher()
{
    $subteacher = subTeacher::all();
    return $subteacher;
}

function getStudentNotBelongToClass()
{
    $result = DB::table('hocsinh')
        ->leftJoin('soluonglop', 'hocsinh.hocsinh_id', '=', 'soluonglop.hocsinh_id')
        ->whereNull('soluonglop.hocsinh_id')
        ->select('hocsinh.*')
        ->get();


    return $result;
}

/* function getAll($id_class){
    $homework = DB::table('homework')
    ->join('comments','comments.post_id','=',)
}
 */