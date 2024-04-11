@extends('layoutadmin.master')

@section('sidebar')
    @include('layoutadmin.sidebar')
@endsection

@section('header')
    @include('layoutadmin.header')
@endsection

@section('content')
    <p class="ms-4" style="font-size: 25px; font-weight: bold">Update Parent</p>
    <div style=";" class="border ms-4 me-4"></div>
    <div style="width: 90%; height: 500px; margin: auto" class="border border-2 mt-3">
        <form class="d-flex justify-content-between mt-3" action="{{ url('phuhuynh/' . $phuhuynh->phuhuynh_id) }}"
            style="width: 90%; margin: auto" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="me-5" style="flex:5">
                <div class="mb-3" style="">
                    <label for="hoten" class="form-label">Họ tên</label>
                    <input value="{{ $phuhuynh->hoten }}" type="text" name="hoten" class="form-control"
                        style="width: 100%;" required>
                </div>
                <div class="mb-3 d-flex justify-content-between align-items-center" style="">
                    <div>
                        <label for="tuoi" class="form-label">Tuổi</label>
                        <input value="{{ $phuhuynh->tuoi }}" type="text" name="tuoi" class="form-control"
                            style="width: 80%;" required>
                    </div>
                    <div class="ms-4 mt-4" style="">
                        <label for="gender-fermale" class="form-label">Nam</label>
                        <input type="radio" name="gender" id="gender-fermale" class="" style=""
                            value="1" @if ($phuhuynh->gender == 1) checked @endif required>
                        <label for="gender-male" class="form-label">Nữ</label>
                        <input @if ($phuhuynh->gender == 0) checked @endif type="radio" name="gender"
                            id="gender-male" class="" style="" value="0" required>
                    </div>
                </div>
                <div class="mb-3 d-flex justify-content-between" style="">
                    <div style="width: 50%;">
                        <label for="ngaysinh" class="form-label">Ngày sinh</label>
                        <input value="{{ date('Y-m-d', strtotime($phuhuynh->ngaysinh)) }}" type="date" name="ngaysinh"
                            class="form-control" style="" required>
                    </div>
                    <div class="ms-3" style="width: 50%;">
                        <label for="sdt" class="form-label">Số điện thoại</label>
                        <input value="{{ $phuhuynh->sdt }}" type="text" name="sdt" class="form-control"
                            style="" required>
                    </div>
                </div>
                <div class="mb-3" style="">
                    <label for="diachi" class="form-label">Địa chỉ</label>
                    <input value="{{ $phuhuynh->diachi }}" type="text" name="diachi" class="form-control" style=""
                        required>
                </div>
                <div class="mb-3 d-flex justify-content-between" style="">
                    <label for="diachi" class="form-label">Phụ huynh của</label>
                    <select type="text" name="hocsinh_id" class="form-select w-75" style="">
                        @foreach (getAllStudents() as $student)
                            @php
                                $selected = $phuhuynh->hocsinh_id === $student->hocsinh_id ? 'selected' : '';
                            @endphp
                            <option value="{{ $student->hocsinh_id }}" {{ $selected }}>
                                {{ $student->hoten }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div style="flex: 5">
                <div class="mb-3">
                    <label for="vaitro" class="form-label">Vai trò</label>
                    <input value="{{ $phuhuynh->vaitro }}" type="text" name="vaitro" class="form-control" style=""
                        required>
                </div>
                <div class="mb-3">
                    <label for="nghenghiep" class="form-label">Nghề nghiệp</label>
                    <input value="{{ $phuhuynh->nghenghiep }}" type="text" name="nghenghiep" class="form-control"
                        style="" required>
                </div>
                <div class="mb-3">
                    <label for="cmnd" class="form-label">Chứng minh nhân dân</label>
                    <input value="{{ $phuhuynh->cmnd }}" type="text" name="cmnd" class="form-control"
                        style="" required>
                </div>
                <div class="mb-3">
                    <label for="avatar" class="form-label">Ảnh đại diện</label>
                    <input value="{{ $phuhuynh->avatar }}" type="file" name="avatar" class="form-control"
                        style="">
                </div>
                <div class="d-flex justify-content-end" style="width: 100%; text-align: end">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection
