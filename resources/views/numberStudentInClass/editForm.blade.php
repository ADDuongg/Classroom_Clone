@extends('layoutadmin.master')

@section('sidebar')
    @include('layoutadmin.sidebar')
@endsection

@section('header')
    @include('layoutadmin.header')
@endsection

@section('content')
    <p class="ms-4" style="font-size: 25px; font-weight: bold">Update Subject</p>
    <div style=";" class="border ms-4 me-4"></div>

    <div style="width: 90%; height: 500px; margin: auto" class=" mt-3">
        @if (Session::has('notice'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('notice') }}
            </div>
        @endif
        <form class="mt-4" action="{{ url('monhoc/' . $monhoc->monhoc_id) }}" style="width: 40%; margin: auto"
            method="POST" enctype="multipart/form-data">
            {{ method_field('PUT') }}
            @csrf
            <div class="mb-3" style="width: 100%;">
                <label for="tenmonhoc" class="form-label">Tên môn hoc</label>
                <input type="text" name="tenmonhoc" class="form-control" style="width: 100%;"
                    value="{{ $monhoc->tenmonhoc }}" required>
            </div>
            <div class="mb-3" style="width: 100%;">
                <label for="tenmonhoc" class="form-label">Chọn giáo viên dạy</label>
                <select name="giaovien_id" id="" class="form-select">
                    @foreach (getAllTeacher() as $teacher)
                        <option value="{{$teacher->giaovien_id}}" @if ($monhoc->giaovien_id === $teacher->giaovien_id) selected @endif>{{$teacher->hoten}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3" style="width: 100%;">
                <label for="motamonhoc" class="form-label">Mô tả môn học</label>
                <textarea type="text" name="motamonhoc" class="form-control" style="width: 100%; height: 200px;">{{ $monhoc->motamonhoc }}</textarea>
            </div>
            <div class="d-flex justify-content-end" style="width: 100%;">
                <button type="submit" class="btn btn-primary">Save Subject</button>
            </div>
        </form>
    </div>
@endsection
