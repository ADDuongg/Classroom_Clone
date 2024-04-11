<?php

namespace App\Http\Controllers;

use App\Models\Homework;
use App\Models\studentHomework;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Teacher;

class studentHomeworkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /* dd($request->all()); */
        $request->validate([
            'post_id' => 'required',
            'user_id' => 'required',
            'file' => 'nullable',
            'score' => 'nullable',
        ]);

        $oldPost = studentHomework::where('post_id', $request->post_id)
            ->where('user_id', $request->user_id)
            ->first();
        if ($oldPost) {
            $existingContent = $oldPost->content ? json_decode($oldPost->content, true) : [];
            $new_files = $request->file;
            $old_file = $request->old_file;
            $oldPost->score = $request->score;
            $arrayData = json_decode($old_file, true);
            if ($new_files && count($arrayData) == 0) {
                $newContent = [
                    'file' => [],
                ];
                foreach ($new_files as $file) {
                    $fileName = 'homework' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->storeAs('public/video', $fileName);

                    $newContent['file'][] = [
                        'file_name' => $fileName,
                        'file_path' => 'storage/video/' . $fileName,
                        'file_original_name' => $file->getClientOriginalName(),
                    ];
                }
                $oldPost->content = json_encode(array_merge($existingContent, $newContent));
                $oldPost->isSubmit = 1;
                $oldPost->score = $request->score;
                $oldPost->save();
                return response()->json(['message' => 'Resource updated successfully']);
            } else if (count($arrayData) != 0 && $new_files) {
                $newContent = [
                    'file' => [],
                ];
                foreach ($new_files as $file) {
                    $fileName = 'homework' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->storeAs('public/video', $fileName);

                    $newContent['file'][] = [
                        'file_name' => $fileName,
                        'file_path' => 'storage/video/' . $fileName,
                        'file_original_name' => $file->getClientOriginalName(),
                    ];
                }
                foreach ($arrayData as $file_old) {
                    $newContent['file'][] = [
                        'file_name' => $file_old['file_name'],
                        'file_path' => $file_old['file_path'],
                        'file_original_name' => $file_old['file_original_name'],
                    ];
                }
                $oldPost->content = json_encode(array_merge($existingContent, $newContent));
                $oldPost->isSubmit = 1;
                $oldPost->score = $request->score;
                $oldPost->save();
                return response()->json(['message' => 'Resource updated successfully']);
            } else if (count($arrayData) != 0 && !isset($new_file)) {
                foreach ($arrayData as $file_old) {
                    $newContent['file'][] = [
                        'file_name' => $file_old['file_name'],
                        'file_path' => $file_old['file_path'],
                        'file_original_name' => $file_old['file_original_name'],
                    ];
                }
                $oldPost->isSubmit = 1;
                $oldPost->score = $request->score;
                $oldPost->content = json_encode(array_merge($existingContent, $newContent));
                $oldPost->save();
                return response()->json(['message' => 'Resource updated successfully']);
            } else if (count($arrayData) == 0 && !isset($new_file)) {
                $newContent = [
                    'file' => [],
                ];
                $oldPost->isSubmit = 1;
                $oldPost->score = $request->score;
                $oldPost->content = json_encode(array_merge($existingContent, $newContent));
                $oldPost->save();
                return response()->json(['message' => 'Resource updated successfully']);
            }
        } else {
            $post = new studentHomework();
            $post->user_id = $request->user_id;
            $post->post_id = $request->post_id;
            $post->isSubmit = 1;



            $existingContent = $post->content ? json_decode($post->content, true) : [];


            $newContent = [
                'file' => [],
            ];


            if ($request->hasFile('file')) {
                foreach ($request->file('file') as $file) {
                    $fileName = 'homework' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->storeAs('public/video', $fileName);

                    $newContent['file'][] = [
                        'file_name' => $fileName,
                        'file_path' => 'storage/video/' . $fileName,
                        'file_original_name' => $file->getClientOriginalName(),
                    ];
                }
            }

            $post->content = json_encode(array_merge($existingContent, $newContent));

            $userId = $request->user_id;
            $post->save();
            return redirect()->back()->with('msg', 'nộp bài thành công');
        }
    }

    public function fetchHomework($post_id, $user_id)
    {
        $homework = studentHomework::where('post_id', $post_id)
            ->where('user_id', $user_id)
            ->get();
        return response()->json(['homework' => $homework]);
    }

    public function changeStatus(Request $request)
    {
        $post_id = $request->post_id;
        $user_id = $request->user_id;
        $homework = studentHomework::where('post_id', $post_id)
            ->where('user_id', $user_id)
            ->first();
        if ($homework) {
            $homework->isSubmit = 0;
            $homework->save();
            return redirect()->back();
        } else {
            return redirect()->back()->with('error', 'Không tìm thấy bài tập.');
        }
    }

    public function getStudentHomework($id_post, $id_user)
    {
        /* $homework = Homework::where('post_id', $id_post)
            ->where('lophoc_id', $id_class)
            ->first(); */
        $post = Homework::where('id', $id_post)->first();
        $classTeach =  DB::table('lophoc')
            ->select('lophoc.*', 'giaovien.*')
            ->join('giaovien', 'giaovien.giaovien_id', '=', 'lophoc.giaovien_id')
            ->where('giaovien.giaovien_id', $id_user)
            ->get();
        $user = Teacher::where('giaovien_id', $id_user)->first();
        $studentSubmit = studentHomework::where('post_id', $id_post)
            ->where('isSubmit', 1)
            ->join('hocsinh', 'hocsinh.hocsinh_id', '=', 'studenthomework.user_id')
            ->select('hocsinh.*', 'studenthomework.*')
            ->get();
        $studentNotSubmit = DB::table('hocsinh')
            ->select('hocsinh.*', 'studenthomework.*')
            ->leftJoin('studenthomework', 'hocsinh.hocsinh_id', '=', 'studenthomework.user_id')
            ->where('studenthomework.post_id', '=', $id_post)
            ->orWhereNull('studenthomework.user_id')
            ->get();

        return view('Class.studentHomework', compact(/* 'homework', */'studentSubmit', 'studentNotSubmit', 'user', 'classTeach', 'post'));
    }
    /**
     * Display the specified resource.
     */
    public function setScore($id_post, $id_user, $score)
    {
        // Kiểm tra tồn tại của bài làm
        $homework = studentHomework::where('user_id', $id_user)
            ->where('post_id', $id_post)
            ->first();

        if (!$homework) {
            return response()->json(['error' => 'Không tìm thấy bài làm'], 404);
        }

        // Cập nhật điểm
        $homework->score = $score;
        $homework->save();

        return response()->json(['msg' => 'Chấm điểm thành công']);
    }


    public function fetchStudentHomework($id_user, $id_homework)
    {
        $homework = studentHomework::where('user_id', $id_user)
            ->where('post_id', $id_homework)
            ->join('hocsinh','hocsinh.hocsinh_id','=','studenthomework.user_id')
            ->first();

        return response()->json(['homework' => $homework]);
    }
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
