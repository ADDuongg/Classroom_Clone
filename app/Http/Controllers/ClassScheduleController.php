<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\ClassSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ClassScheduleController extends Controller
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
        return view('ClassSchedule.addForm');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $schedule = new ClassSchedule();
        /* dd($request->all()); */
        $id_class = $request->lophoc_id;
        $current_class = ClassSchedule::where('lophoc_id', $id_class)->first();
        $start_new = $request->start;
        $day_new = $request->day;
        $value_start_new = substr($start_new, 0, 2);
        if ($current_class) {
            $day_old = $current_class->day;
            $start = $current_class->start;
            $value_start_old = substr($start, 0, 2);
            if (($value_start_old === $value_start_new) || ($day_old === $day_new)) {
                return redirect()->back()->with('notice', "Lịch học bắt đầu vào thời gian này đã có, vui lòng xóa lịch tại lớp học và thử lại");
            }
        }




        $id = 'schedule' . uniqid();


        $schedule->lichhoc_id = $id;
        $schedule->fill($request->all());


        $schedule->save();

        return redirect()->back()->with('notice', "Thêm lịch học thành công");
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $classSchedules = DB::table('lichhoc')
            ->join('lophoc', 'lichhoc.lophoc_id', '=', 'lophoc.lophoc_id')
            ->join('monhoc', 'lichhoc.monhoc_id', '=', 'monhoc.monhoc_id')
            ->join('hocky', 'lichhoc.hocky_id', '=', 'hocky.hocky_id')
            ->select('lophoc.tenlop AS tenlop', 'monhoc.tenmonhoc AS tenmon', 'hocky.*', 'lichhoc.*')
            ->where('lichhoc.lophoc_id', '=', $id)
            ->get();




        return response()->json($classSchedules);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $classSchedules = DB::table('lichhoc')
            ->join('lophoc', 'lichhoc.lophoc_id', '=', 'lophoc.lophoc_id')
            ->join('monhoc', 'lichhoc.monhoc_id', '=', 'monhoc.monhoc_id')
            ->join('hocky', 'lichhoc.hocky_id', '=', 'hocky.hocky_id')
            ->select('lophoc.tenlop AS tenlop', 'monhoc.tenmonhoc AS tenmon', 'hocky.*', 'lichhoc.*')
            ->where('lichhoc.lophoc_id', '=', $id)
            ->get();
        /* dd($classSchedules); */
        return view('ClassSchedule.editForm', compact('classSchedules'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $classschedule = ClassSchedule::find($id);
            $classschedule->monhoc_id = $request->json()->get('monhoc_id');
            $classschedule->day = $request->json()->get('day');
            $classschedule->start = $request->json()->get('start');
            $classschedule->end = $request->json()->get('end');
            $classschedule->hocky_id = $request->json()->get('hocky_id');

            $classschedule->save();

            // Trả về phản hồi khi thành công
            return response()->json(['message' => 'Cập nhật thành công'], 200);
        } catch (\Exception $e) {
            // Trả về phản hồi khi có lỗi
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function deleteGroup(Request $request)
    {
        $arrRequest = $request->all();

        foreach ($arrRequest as $key => $value) {
            $schedule = ClassSchedule::find($value['scheduleID']);

            if ($schedule) {
                $schedule->delete();
            }
            return response()->json(['message' => 'Xóa thành công'], 200);
        }
    }



    public function destroy(string $id)
    {
        //
    }
}
