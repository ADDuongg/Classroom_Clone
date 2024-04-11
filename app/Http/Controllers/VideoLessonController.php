<?php

namespace App\Http\Controllers;

use App\Models\VideoLesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class VideoLessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videolessons = DB::table('videolesson')
            ->select('videolesson.*', 'monhoc.tenmonhoc')
            ->join('monhoc', 'monhoc.monhoc_id', '=', 'videolesson.monhoc_id')
            ->get();
        /*  dd($videolesson); */
        return view('videolesson.index', compact('videolessons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('videolesson.addForm');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'monhoc_id' => 'required',
            'file_subject' => 'required',
        ]);

        // Xử lý tệp tin được tải lên

        $id = 'file' . time();
        // Tạo mới đối tượng VideoLesson và lưu vào cơ sở dữ liệu
        $videolesson = new VideoLesson();
        $videolesson->videolesson_id = $id;
        $videolesson->monhoc_id = $request->monhoc_id;
        if ($request->hasFile('file_subject')) {
            $file = $request->file('file_subject');
            $filename = 'file' . time() . '.' . $file->getClientOriginalExtension();
            // Lưu tệp tin vào thư mục storage/app/your_directory
            $file->storeAs('public/video', $filename);
            $videolesson->file_subject = $filename;
            $videolesson->file_path = 'storage/video/' . $filename;
        }
        $videolesson->save();

        return redirect()->back()->with('notice', 'Bài giảng video đã được thêm thành công!');
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
        $videolesson = VideoLesson::find($id);
        /*  dd($videolesson); */
        return view('videolesson.editForm', compact('videolesson'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $videolesson = VideoLesson::find($id);
        $file_collection = $videolesson->file_subject;
        if ($videolesson) {
            $videolesson->monhoc_id = $request->monhoc_id;
            $file = $request->file_subject;
            Storage::delete('public/video/' . $file_collection);
            $filename = 'file' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/video', $filename);
            $path = 'storage/video/' . $filename;
            $videolesson->file_subject = $filename;
            $videolesson->file_path = $path;
        }
        $videolesson->save();
        return redirect()->back()->with('notice', 'Bài giảng video đã được cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $videolesson = VideoLesson::find($id);
        $file_collection = $videolesson->file_subject;
        $videolesson->delete();
        Storage::delete('public/video/' . $file_collection);
        return redirect()->back()->with('notice', 'Xóa thành công');
    }
}
