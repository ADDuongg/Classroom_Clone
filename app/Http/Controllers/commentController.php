<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class commentController extends Controller
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
        $comment = new Comments();
        $comment->user_id = $request->user_id;
        $comment->post_id = $request->post_id;
        $comment->content = $request->content;
        $comment->save();
        $idpost = $request->post_id;
        $userId = $request->user_id;
        $userType = User::where('id_user', $userId)->value('role');
        $comments = []; // Initialize $comments variable
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
            ->where('comments.post_id', $idpost) // Chỉ lấy comment của bài post có id là $postId
            ->orderBy('comments.created_at', 'desc')
            ->get();

        // Use map to format the 'created_at' field using Carbon
        $comments = $comments->map(function ($comment) {
            $comment->created_at = Carbon::parse($comment->created_at)->format('Y-m-d H:i:s');
            return $comment;
        });

        return response()->json(['comments' => $comments]);
    }
    /**
     * Display the specified resource.
     */

    public function show(string $id)
    {
        /* $comments = DB::table('comments')
            ->select('comments.*')
            ->leftJoin('hocsinh', 'hocsinh.hocsinh_id', '=', 'comments.user_id')
            ->leftJoin('giaovien', 'giaovien.giaovien_id', '=', 'comments.user_id')
            ->where('comments.post_id', 139)
            ->get(); */


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
            ->where('comments.post_id', $id) // Chỉ lấy comment của bài post có id là $postId
            ->orderBy('comments.created_at', 'desc')
            ->get();
        return response()->json(['comments' => $comments]);
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
        $comment = Comments::where('comments.id', $id)->first();
        $comment->content = $request->valueInput;
        $comment->save();
        return redirect()->back()->with('msg', 'Sửa bình luận thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment = Comments::where('comments.id', $id)->first();
        $comment->delete();
        return redirect()->back()->with('msg', 'Xóa bình luận thành công');
    }
}
