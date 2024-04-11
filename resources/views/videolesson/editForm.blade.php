@extends('layoutadmin.master')

@section('sidebar')
    @include('layoutadmin.sidebar')
@endsection

@section('header')
    @include('layoutadmin.header')
@endsection

@section('content')
    <p class="ms-4" style="font-size: 25px; font-weight: bold">Edit Video File</p>
    @if (session('notice'))
        <div class="alert alert-success">{{ session('notice') }}</div>
    @endif
    <div style=";" class="border ms-4 me-4"></div>
    <div style="width: 90%; height: 500px; margin: auto" class="border border-2 mt-3">
       {{--  {{dd($videolesson->videolesson_id)}} --}}
        <form action="{{ url('videolesson/'.$videolesson->videolesson_id) }}" style="width: 40%; margin: auto" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3" style="width: 100%;">
                <label for="tenmonhoc" class="form-label">Chọn môn học</label>
                <select name="monhoc_id" id="" class="form-select">
                    @foreach (getAllSubject() as $subject)
                        <option value="{{ $subject->monhoc_id }}">{{ $subject->tenmonhoc }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3" style="width: 100%;">
                <label for="file_subject" class="form-label">Chọn file bài giảng</label>
                <input type="file" name="file_subject" class="form-control" required>
            </div>
            <div class="d-flex justify-content-end" style="width: 100%;">
                <button type="submit" class="btn btn-primary">Update File Lesson</button>
            </div>
        </form>
    </div>
@endsection
