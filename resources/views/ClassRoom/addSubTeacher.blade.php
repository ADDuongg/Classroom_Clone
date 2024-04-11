@extends('layoutadmin.master')

@section('sidebar')
    @include('layoutadmin.sidebar')
@endsection

@section('header')
    @include('layoutadmin.header')
@endsection

@section('content')
    <p class="ms-4" style="font-size: 25px; font-weight: bold">Add more Teacher</p>
    @if (session('notice'))
        <script>
            alert("{{ session('notice') }}");
        </script>
    @endif
    <div style=";" class="border ms-4 me-4"></div>
    <div style="width: 90%; height: 500px; margin: auto" class="border border-2 mt-3">
        <form action="{{ url('subteacher/store') }}" style="width: 40%; margin: auto" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3" style="width: 100%;">
                <label for="tenlop" class="form-label">Tên lớp học</label>
                <input type="text"  class="form-control" style="width: 100%;" readonly
                    value="{{ $classroom->tenlop }}">
            </div>
            <input type="hidden" name="lophoc_id" value="{{$classroom->lophoc_id}}">
            <div class="mb-3" style="width: 100%;">
                <label for="" class="form-label">Chọn giáo viên bộ môn dạy</label>
                {{-- <p>{{$classroom->giaovien_id}}</p> --}}
                <select name="giaovien_id" id="" class="form-select">
                    @foreach (getAllTeacher() as $subteacher)
                        @if ($classroom->giaovien_id != $subteacher->giaovien_id)
                            <option value="{{ $subteacher->giaovien_id }}">{{ $subteacher->hoten }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="d-flex justify-content-end" style="width: 100%;">
                <button type="submit" class="btn btn-primary">Thêm giáo viên</button>
            </div>
        </form>
    </div>
@endsection
