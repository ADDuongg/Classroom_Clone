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
    <div style="width: 90%; height: 500px; margin: auto" class="border border-2 mt-3">
        <form action="{{ url('student/' . $students->hocsinh_id) }}" style="width: 40%; margin: auto" method="POST"
            enctype="multipart/form-data">
            {{ method_field('PUT') }}
            @csrf
            {{-- <div class="mb-3" style="width: 100%;">
                <label for="hocsinh_id" class="form-label">ID</label>
                <input type="text" name="hocsinh_id" class="form-control" style="width: 100%;"
                    value="{{ old('hocsinh_id', $students->hocsinh_id) }}" required>

            </div> --}}
            <div class="mb-3" style="width: 100%;">
                <label for="hoten" class="form-label">Họ tên</label>
                <input type="text" name="hoten" class="form-control" style="width: 100%;"
                    value="{{ $students->hoten }}" required>
            </div>
            <div class="mb-3 d-flex justify-content-between align-items-center" style="width: 100%;">
                <div>
                    <label for="tuoi" class="form-label">Tuổi</label>
                    <input type="text" name="tuoi" class="form-control" style="width: 80%;"
                        value="{{ $students->tuoi }}" required>
                </div>
                <div class="ms-4 mt-4" style="width: 30%;">
                    <label for="gender-fermale" class="form-label">Nam</label>
                    <input type="radio" name="gender" id="gender-fermale" class="" style="" value="1"
                        @if ($students->gender == 1) checked @endif required>
                    <label for="gender-male" class="form-label">Nữ</label>
                    <input type="radio" name="gender" id="gender-male" class="" style="" value="0"
                        @if ($students->gender == 0) checked @endif required>
                </div>

            </div>
            <div class="mb-3 d-flex justify-content-between" style="width: 100%;">
                <div style="width: 50%;">
                    <label for="ngaysinh" class="form-label">Ngày sinh</label>
                    <input type="date" name="ngaysinh" class="form-control" style=""
                        value="{{ date('Y-m-d', strtotime($students->ngaysinh)) }}" required>

                </div>
                <div class="ms-3" style="width: 50%;">
                    <label for="sdt" class="form-label">Số điện thoại</label>
                    <input type="text" name="sdt" class="form-control" style="" value="{{ $students->sdt }}"
                        required>
                </div>
            </div>
            <div class="mb-3" style="width: 100%;">
                <label for="diachi" class="form-label">Địa chỉ</label>
                <input type="text" name="diachi" class="form-control" style="" value="{{ $students->diachi }}"
                    required>
            </div>
            <div class="mb-3 d-flex justify-content-between" style="width: 100%;">
                <div style="width: 60%;">
                    <label for="cmnd" class="form-label">Chứng minh nhân dân</label>
                    <input type="text" name="cmnd" class="form-control" style="" value="{{ $students->cmnd }}"
                        required>
                </div>
                <div class="ms-3" style="width: 40%;">
                    <label for="avatar" class="form-label">Ảnh đại diện</label>
                    <input type="file" name="avatar" class="form-control" style="">
                </div>
            </div>
            <div class="d-flex justify-content-end" style="width: 100%;">
                <button type="submit" class="btn btn-primary">Save student</button>
            </div>
        </form>
    </div>
@endsection
