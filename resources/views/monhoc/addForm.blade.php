@extends('layoutadmin.master')

@section('sidebar')
    @include('layoutadmin.sidebar')
@endsection

@section('header')
    @include('layoutadmin.header')
@endsection

@section('content')
    <p class="ms-4" style="font-size: 25px; font-weight: bold">Add new Subject</p>
    @if (session('notice'))
        <script>
            alert("{{ session('notice') }}");
        </script>
    @endif
    <div style=";" class="border ms-4 me-4"></div>
    <div style="width: 90%; height: 500px; margin: auto" class="border border-2 mt-3">
        <form action="{{ url('monhoc') }}" style="width: 40%; margin: auto" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3" style="width: 100%;">
                <label for="tenmonhoc" class="form-label">Tên môn học</label>
                <input type="text" name="tenmonhoc" class="form-control" style="width: 100%;" required>
            </div>
            <div class="mb-3" style="width: 100%;">
                <label for="tenmonhoc" class="form-label">Chọn giáo viên dạy</label>
                <select name="giaovien_id" id="" class="form-select">
                    @foreach (getAllTeacher() as $teacher)
                        <option value="{{$teacher->giaovien_id}}">{{$teacher->hoten}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3" style="width: 100%;">
                <label for="motamonhoc" class="form-label">Mô tả môn học</label>
                <textarea  type="text" name="motamonhoc" class="form-control" style="width: 100%; height: 200px;" required></textarea>
            </div>

            <div class="d-flex justify-content-end" style="width: 100%;">
                <button type="submit" class="btn btn-primary">Add Subject</button>
            </div>
        </form>
    </div>
@endsection
