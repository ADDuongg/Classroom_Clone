<?php

use App\Http\Controllers\ClassRoom;
use App\Http\Controllers\ClassScheduleController;
use App\Http\Controllers\commentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MonHoc;
use App\Http\Controllers\MonHocController;
use App\Http\Controllers\numberStudentInClass;
use App\Http\Controllers\PhuHuynhController;
use App\Http\Controllers\postController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\studentHomeworkController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\testController;
use App\Http\Controllers\TomonhocController;
use App\Http\Controllers\VideoLessonController;
use App\Http\Middleware\CheckLoginMiddleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'loginPost']);
Route::get('/register', function () {
    return view('register');
})->name('register');
Route::post('/register', [LoginController::class, 'registerPost']);

Route::get('/admin', function () {
    $classrooms = DB::table("lophoc")
        ->join("giaovien", "giaovien.giaovien_id", "=", "lophoc.giaovien_id")
        ->join("hocky", "hocky.hocky_id", "=", "lophoc.hocky_id")
        ->select("lophoc.*", "giaovien.hoten AS tengiaovien", "hocky.hocky AS tenhocky", "hocky.namhoc AS namhoc")
        ->get();

    return view("admin", compact("classrooms"));
})->name('admin')->middleware(['auth']);
Route::get('/teacherclass/{teacher_id}', [HomeController::class, 'index'])->name('teacherclass')->middleware(['auth']);
Route::get('/studentclass/{student_id}', [testController::class, 'viewStudent'])->name('studentclass')->middleware(['auth']);

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/class/{id}/{iduser}', [HomeController::class, 'detailClass']);
    Route::get('/class/{id}/everyone/{iduser}', [HomeController::class, 'showEveryone']);

    Route::get('/class/{id}/homework/{iduser}', [HomeController::class, 'showHomework'])->name('homework');

    Route::resource('posts', postController::class);

    Route::put('homework/{id}', [postController::class, 'updateHomework']);

    Route::get('homework/{id}', [postController::class, 'getHomework']);

    Route::get('gethomework/{id}/{iduser}', [postController::class, 'showHomework']);
    Route::get('hwstudent/{id}/{iduser}', [postController::class, 'showHomeworkStudent']);

    Route::post('homework/store', [postController::class, 'storeHomework']);

    Route::delete('deletehomework/{id}', [postController::class, 'deleteHomework']);
    Route::get('setScore/{idpost}/{iduser}/{score}', [studentHomeworkController::class, 'setScore']);
    Route::get('studentHomework/{idpost}/{idclass}', [studentHomeworkController::class, 'getStudentHomework']);
    Route::get('fetchStudentHomework/{iduser}/{idpost}', [studentHomeworkController::class, 'fetchStudentHomework']);
    Route::resource('comments', commentController::class);
    Route::resource('studentHomework', studentHomeworkController::class);
    Route::get('fetchhomework/{id}/{user_id}', [studentHomeworkController::class, 'fetchHomework']);
    Route::post('changeStatus', [studentHomeworkController::class, 'changeStatus']);
    Route::delete('/teacherdelete/{id}', [HomeController::class, 'deleteTeacher']);
    Route::delete('/studentdelete/{id_student}/{id_class}', [HomeController::class, 'deleteStudent']);
    Route::get('pagination', [StudentController::class, 'pagination']);
    Route::get('allstudent', [StudentController::class, 'getAllStudents']);
    Route::resource('student', StudentController::class);
    Route::get('numberStudent/create/{id}', [numberStudentInClass::class, 'createNumberStudent']);
    Route::get('numberStudent/deleteform/{id}', [numberStudentInClass::class, 'formDelete']);
    Route::post('classschedule/deletegroup', [ClassScheduleController::class, 'deleteGroup']);
    Route::resource('tomonhoc', TomonhocController::class);
    Route::resource('monhoc', MonHocController::class);
    Route::resource('phuhuynh', PhuHuynhController::class);
    Route::resource('teacher', TeacherController::class);
    Route::resource('numberStudentInClass', numberStudentInClass::class);
    Route::resource('classroom', ClassRoom::class);
    Route::get('addSubteacher/{id}', [ClassRoom::class, 'addSubteacher']);
    /* Route::get('addSubteacher/{id}', [ClassRoom::class, 'addSubteacher']); */
    Route::post('subteacher/store', [ClassRoom::class, 'storeSubteacher']);
    Route::post('studentclass/store', [ClassRoom::class, 'inviteStudent']);
    Route::resource('section', SectionController::class);
    Route::resource('classschedule', ClassScheduleController::class);
    Route::resource('videolesson', VideoLessonController::class);
    Route::get('score', [StudentController::class, 'showScore']);
});
