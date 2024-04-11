@extends('layoutadmin.master')

@section('sidebar')
    @include('layoutadmin.sidebar')
@endsection

@section('header')
    @include('layoutadmin.header')
@endsection

@section('content')
    <p class="ms-4" style="font-size: 25px; font-weight: bold">Add new Class Schedule</p>
    @if (session('notice'))
        <script>
            alert("{{ session('notice') }}");
        </script>
    @endif
    <div style=";" class="border ms-4 me-4"></div>
    <div style="width: 90%; height: 500px; margin: auto" class="border border-2 mt-3">
        <form action="{{ url('classschedule') }}" style="width: 40%; margin: auto" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 " style="width: 100%;">
                <label for="lophoc_id" class="form-label">Chọn lớp học</label>
                <select type="text" name="lophoc_id" class="form-select ">
                    @foreach (getAllClass() as $item)
                        <option value="{{ $item->lophoc_id }}">{{ $item->tenlop }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 " style="width: 100%;">
                <label for="monhoc_id" class="form-label">Chọn môn học</label>
                <select type="text" name="monhoc_id" class="form-select ">
                    @foreach (getAllSubject() as $item)
                        <option value="{{ $item->monhoc_id }}">{{ $item->tenmonhoc }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 " style="width: 100%;">
                <label for="day" class="form-label">Ngày trong tuần</label>
                <select type="text" name="day" class="form-select ">
                    @php
                        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                    @endphp
                    @foreach ($days as $day)
                        <option value="{{ $day }}">{{ $day }}</option>
                    @endforeach
                </select>
            </div>
            @php
                $hours = [];
                for ($i = 0; $i < 24; $i++) {
                    $hours[] = sprintf('%02d:00', $i); // Thêm các giờ vào mảng
                }
            @endphp

            <!-- Select box cho giờ bắt đầu -->
            <div class="mb-3 d-flex justify-content-between" style="width: 100%;">
                <div class="d-flex me-3" style="width:50%">
                    <label for="start" class="form-label">Bắt đầu</label>
                    <select name="start" class="form-select w-100 h-75">
                        @foreach ($hours as $hour)
                            <option value="{{ $hour }}">{{ $hour }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Select box cho giờ kết thúc -->
                <div class="d-flex "style="width:50%">
                    <label for="end" class="form-label">Kết thúc</label>
                    <select name="end" class="form-select w-100 h-75">
                        @foreach ($hours as $hour)
                            <option value="{{ $hour }}">{{ $hour }}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="mb-3 " style="width: 100%;">
                <label for="hocky" class="form-label">Học kỳ</label>
                <select type="text" name="hocky_id" class="form-select ">
                    @foreach (getAllSection() as $item)
                        <option value="{{ $item->hocky_id }}">{{ $item->hocky }} năm học {{ $item->namhoc }}</option>
                    @endforeach
                </select>
            </div>

            <div class="d-flex justify-content-end" style="width: 100%;">
                <button type="submit" class="btn btn-primary">Add Class Schedule</button>
            </div>
        </form>
    </div>
@endsection
