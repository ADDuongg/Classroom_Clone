@extends('layoutadmin.master')

@section('sidebar')
    @include('layoutadmin.sidebar')
@endsection

@section('header')
    @include('layoutadmin.header')
@endsection

@section('content')
    <p class="ms-4" style="font-size: 25px; font-weight: bold">Add Student to Clas</p>

    <div style=";" class="border ms-4 me-4"></div>
    <div style="width: 90%; height: 500px; margin: auto" class="border border-2 mt-3">
        @if (session('notice'))
            <div class="alert alert-success">
                {{ session('notice') }}
            </div>
        @endif
        <form action="{{ url('numberStudentInClass') }}" style="width: 40%; margin: auto" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="mb-3" style="width: 100%;">
                <label for="lophoc_id" class="form-label"></label>
                <input value="{{ $classroom->tenlop }}" type="text" name="tenlop" class="form-control"
                    style="width: 100%;" readonly>
                <input value="{{ $classroom->lophoc_id }}" type="hidden" name="lophoc_id" class="form-control"
                    style="width: 100%;" required>
            </div>
            <div class="mb-3" style="width: 100%;">
                <label for="" class="form-label">Các học sinh chưa vào lớp</label>
                <select name="hocsinh_id" id="" class="form-select">
                    {{-- @if ($studentNotInClass->isEmpty())
                    <option value="">Tất cả học sinh đã có lớp</option>
                    @endif --}}
                    @foreach (getAllStudents() as $student)
                        <option value="{{ $student->hocsinh_id }}">{{ $student->hoten }}</option>
                    @endforeach
                </select>
            </div>

            <div class="d-flex justify-content-end" style="width: 100%;">
                <button type="submit" class="btn btn-primary">Add Student</button>
            </div>
        </form>
    </div>
@endsection
