<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Comments;
use App\Models\Homework;
use App\Models\Post;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class postController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $array_file = [];
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
        $request->validate([
            'class_id' => 'required',
            'user_id' => 'required',
            'content' => 'required',
            'file' => 'nullable',
        ]);

        $post = new Post();
        $post->user_id = $request->user_id;
        $post->lophoc_id = $request->class_id;


        $existingContent = $post->content ? json_decode($post->content, true) : [];


        $newContent = [
            'content' => $request->content,
            'file' => [],
        ];


        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $file) {
                $fileName = 'filepost' . uniqid() . '.' . $file->getClientOriginalExtension();
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

        $id_post = $post->id;
        $numberComment = DB::table('comments')->where('comments.post_id', '=', $id_post)->count();

        $userType = User::where('id_user', $userId)->value('role');
        if ($userType === 'giaovien') {
            $userInfo = DB::table('users')->join('giaovien', 'users.id_user', '=', 'giaovien.giaovien_id')
                ->select('giaovien.avatar', 'giaovien.hoten', 'users.*')
                ->where('users.id_user', $userId)
                ->first();
        } elseif ($userType === 'hocsinh') {
            $userInfo = DB::table('users')->join('hocsinh', 'users.id_user', '=', 'hocsinh.hocsinh_id')
                ->select('hocsinh.avatar', 'hocsinh.hoten', 'users.*')
                ->where('users.id_user', $userId)
                ->first();
        } else {
            $userInfo = null;
        }
        return response()->json(['post' => $post, 'userInfo' => $userInfo, 'numberComment' => $numberComment]);
    }


    public function storeHomework(Request $request)
    {
        /* dd($request->all()); */
        $request->validate([
            'lophoc_id' => 'required',
            'header' => 'required',
            'maxScore' => 'required',
            'file' => 'nullable',
            'date'=>'required'
        ]);

        $post = new Homework();
        $post->user_id = $request->user_id;
        $post->lophoc_id = $request->lophoc_id;
        $post->maxscore = $request->maxScore;
        $post->date = $request->date;
        $existingContent = $post->content ? json_decode($post->content, true) : [];


        $newContent = [
            'content' => $request->content,
            'header' => $request->header,
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
        return response()->json(['msg', 'thêm bài tập thành công']);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::where('posts.id', $id)->get();

        return response()->json(['post' => $post]);
    }

    public function getHomework($id)
    {
        $post = Homework::where('homework.id', $id)->get();

        return response()->json(['post' => $post]);
    }

    public function showHomework($id, $iduser)
    {
        $id_user = $iduser;

        $post = Homework::find($id);
        $classTeach = $this->getClassTeach($id_user);
        $user = Teacher::where('giaovien_id', $id_user)->first();
        $postid = $post->id;
        $classid = $post->lophoc_id;
        $comments = DB::table('comments')
            ->select([
                'comments.*',
                DB::raw('COALESCE(giaovien.giaovien_id, hocsinh.hocsinh_id) AS user_id'),
                DB::raw('COALESCE(giaovien.avatar, hocsinh.avatar) AS avatar'),
                DB::raw('COALESCE(giaovien.hoten, hocsinh.hoten) AS hoten'),
                DB::raw('CASE 
            WHEN giaovien.giaovien_id IS NOT NULL THEN "giaovien"
            WHEN hocsinh.hocsinh_id IS NOT NULL THEN "hocsinh"
            END AS user_type')
            ])
            ->leftJoin('giaovien', 'comments.user_id', '=', 'giaovien.giaovien_id')
            ->leftJoin('hocsinh', 'comments.user_id', '=', 'hocsinh.hocsinh_id')
            ->where('comments.post_id', $postid) // Chỉ lấy comment của bài post có id là $postId
            ->orderBy('comments.created_at', 'desc')
            ->get();
        $classroom = ClassRoom::where('lophoc_id', $classid)->first();
        return view('Class.detailHomework', compact('post', 'classTeach', 'user', 'comments', 'classroom'));
    }
    public function showHomeworkStudent($id, $iduser)
    {
        $id_user = $iduser;
        $classTeach = DB::table('soluonglop')
            ->join('lophoc', 'lophoc.lophoc_id', '=', 'soluonglop.lophoc_id')
            ->join('giaovien', 'lophoc.giaovien_id', '=', 'giaovien.giaovien_id')
            ->select('lophoc.*', 'giaovien.*')
            ->where('soluonglop.hocsinh_id', '=', $id_user)
            ->get();
        $post = Homework::find($id);
        $user = Student::where('hocsinh_id', $id_user)->first();
        $postid = $post->id;
        $classid = $post->lophoc_id;
        /*  $comments = Comments::where('post_id', $postid)->get(); */
        $classroom = ClassRoom::where('lophoc_id', $classid)->first();
        return view('Class.detailHomeworkStudent', compact('post', 'user', 'classroom', 'classTeach'));
    }

    protected function getClassTeach($id_user)
    {
        return DB::table('lophoc')
            ->select('lophoc.*', 'giaovien.*')
            ->join('giaovien', 'giaovien.giaovien_id', '=', 'lophoc.giaovien_id')
            ->where('giaovien.giaovien_id', $id_user)
            ->get();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $post = Post::where('posts.id', $id)->first();

        $existingContent = $post->content ? json_decode($post->content, true) : [];

        $postData = $request->all();
        $new_files = $request->file;
        $old_file = $request->old_file;

        $arrayData = json_decode($old_file, true);
        /* foreach ($arrayData as $file_old) {
            dd($file_old['file_name']);
        } */
        if ($new_files && count($arrayData) == 0) {
            $newContent = [
                'content' => $request->content,
                'file' => [],
            ];
            foreach ($new_files as $file) {
                $fileName = 'filepost' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/video', $fileName);

                $newContent['file'][] = [
                    'file_name' => $fileName,
                    'file_path' => 'storage/video/' . $fileName,
                    'file_original_name' => $file->getClientOriginalName(),
                ];
            }
            $post->content = json_encode(array_merge($existingContent, $newContent));
            $post->save();
            return response()->json(['message' => 'Resource updated successfully']);
        } else if (count($arrayData) != 0 && $new_files) {
            $newContent = [
                'content' => $request->content,
                'file' => [],
            ];
            foreach ($new_files as $file) {
                $fileName = 'filepost' . uniqid() . '.' . $file->getClientOriginalExtension();
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
            $post->content = json_encode(array_merge($existingContent, $newContent));
            $post->save();
            return response()->json(['message' => 'Resource updated successfully']);
        } else if (count($arrayData) != 0 && !isset($new_file)) {
            $newContent = [
                'content' => $request->content,
            ];
            foreach ($arrayData as $file_old) {
                $newContent['file'][] = [
                    'file_name' => $file_old['file_name'],
                    'file_path' => $file_old['file_path'],
                    'file_original_name' => $file_old['file_original_name'],
                ];
            }
            $post->content = json_encode(array_merge($existingContent, $newContent));
            $post->save();
            return response()->json(['message' => 'Resource updated successfully']);
        } else if (count($arrayData) == 0 && !isset($new_file)) {
            $newContent = [
                'content' => $request->content,
                'file' => [],
            ];

            $post->content = json_encode(array_merge($existingContent, $newContent));
            $post->save();
            return response()->json(['message' => 'Resource updated successfully']);
        }

        /* return response()->json(['message' => 'Resource updated successfully']); */
    }

    public function updateHomework(Request $request, $id)
    {
        $post = Homework::where('homework.id', $id)->first();

        $existingContent = $post->content ? json_decode($post->content, true) : [];

        $postData = $request->all();
        $new_files = $request->file;
        $old_file = $request->old_file;

        $arrayData = json_decode($old_file, true);
        /* foreach ($arrayData as $file_old) {
            dd($file_old['file_name']);
        } */
        if ($new_files && count($arrayData) == 0) {
            $newContent = [
                'content' => $request->content,
                'header' => $request->header,
                'file' => [],
            ];

            foreach ($new_files as $file) {
                $fileName = 'filepost' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/video', $fileName);

                $newContent['file'][] = [
                    'file_name' => $fileName,
                    'file_path' => 'storage/video/' . $fileName,
                    'file_original_name' => $file->getClientOriginalName(),
                ];
            }
            $post->content = json_encode(array_merge($existingContent, $newContent));
            $post->maxscore = $request->maxScore;
            $post->date = $request->date;
            $post->save();
            return response()->json(['message' => 'Resource updated successfully']);
        } else if (count($arrayData) != 0 && $new_files) {
            $newContent = [
                'content' => $request->content,
                'header' => $request->header,
                'file' => [],
            ];
            foreach ($new_files as $file) {
                $fileName = 'filepost' . uniqid() . '.' . $file->getClientOriginalExtension();
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
            $post->content = json_encode(array_merge($existingContent, $newContent));
            $post->maxscore = $request->maxScore;
            $post->date = $request->date;
            $post->save();
            return response()->json(['message' => 'Resource updated successfully']);
        } else if (count($arrayData) != 0 && !isset($new_file)) {
            $newContent = [
                'content' => $request->content,
                'header' => $request->header,
                'file' => [],
            ];
            foreach ($arrayData as $file_old) {
                $newContent['file'][] = [
                    'file_name' => $file_old['file_name'],
                    'file_path' => $file_old['file_path'],
                    'file_original_name' => $file_old['file_original_name'],
                ];
            }
            $post->content = json_encode(array_merge($existingContent, $newContent));
            $post->maxscore = $request->maxScore;
            $post->date = $request->date;
            $post->save();
            return response()->json(['message' => 'Resource updated successfully']);
        } else if (count($arrayData) == 0 && !isset($new_file)) {
            $newContent = [
                'content' => $request->content,
                'header' => $request->header,
                'file' => [],
            ];

            $post->content = json_encode(array_merge($existingContent, $newContent));
            $post->maxscore = $request->maxScore;
            $post->date = $request->date;
            $post->save();
            return response()->json(['message' => 'Resource updated successfully']);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $comments = Comments::where('post_id', $id)->get();
        $posts_content = $post->content ? json_decode($post->content, true) : [];

        /* dd($posts_content['file']); */
        foreach ($posts_content['file'] as $content) {
            Storage::delete('public/video/' . $content['file_name']);
        }
        foreach ($comments as $comment) {
            $comment->delete();
        }
        $post->delete();

        return redirect()->back()->with('msg', 'Xóa bài đăng và bình luận thành công');
    }

    public function deleteHomework($id)
    {
        $post = Homework::where('homework.id', $id)->first();
        $idclass = $post->lophoc_id;
        $userid = $post->user_id;
        $comments = Comments::where('post_id', $id)->get();

        $posts_content = $post->content ? json_decode($post->content, true) : [];


        foreach ($posts_content['file'] as $content) {
            Storage::delete('public/video/' . $content['file_name']);
        }
        foreach ($comments as $comment) {
            $comment->delete();
        }
        $post->delete();

        return redirect()->route('homework', ['id' => $idclass, 'iduser' => $userid]);
    }
}
