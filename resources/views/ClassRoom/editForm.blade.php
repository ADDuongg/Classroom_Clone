@extends('layoutadmin.master')

@section('sidebar')
    @include('layoutadmin.sidebar')
@endsection

@section('header')
    @include('layoutadmin.header')
@endsection

@section('content')
    <p class="ms-4" style="font-size: 25px; font-weight: bold">Update Class</p>
    <div style=";" class="border ms-4 me-4"></div>

    <div style="width: 90%; height: 500px; margin: auto" class=" mt-3">
        @if (Session::has('notice'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('notice') }}
            </div>
        @endif
        <form class="mt-4" action="{{ url('classroom/' . $classroom->lophoc_id) }}" style="width: 40%; margin: auto"
            method="POST" enctype="multipart/form-data">
            {{ method_field('PUT') }}
            @csrf
            <div class="mb-3" style="width: 100%;">
                <label for="tenlop" class="form-label">Tên lớp học</label>
                <input type="text" name="tenlop" class="form-control" style="width: 100%;"
                    value="{{ $classroom->tenlop }}" required>
            </div>
            <div class="mb-3" style="width: 100%;">
                <label for="" class="form-label">Chọn giáo viên chủ nhiệm</label>
                <select name="giaovien_id" id="" class="form-select">
                    @foreach (getAllTeacher() as $teacher)
                        @php
                            $isteacher = $teacher->giaovien_id === $classroom->giaovien_id ? 'selected' : '';
                        @endphp
                        <option value="{{ $teacher->giaovien_id }}" {{$isteacher}}>{{ $teacher->hoten }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 " style="width: 100%;">
                <label for="hocky" class="form-label">Học kỳ</label>
                @foreach (getAllSection() as $item)
                    <select type="text" name="hocky_id" class="form-select ">
                        <option value="{{ $item->hocky_id }}">{{ $item->hocky }} năm học {{ $item->namhoc }}</option>
                    </select>
                @endforeach
            </div>
            <div class="d-flex justify-content-end" style="width: 100%;">
                <button type="submit" class="btn btn-primary">Save Class</button>
            </div>
        </form>
    </div>
@endsection
