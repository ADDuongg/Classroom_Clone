@extends('layoutadmin.master')

@section('sidebar')
    @include('layoutadmin.sidebar')
@endsection

@section('header')
    @include('layoutadmin.header')
@endsection

@section('content')
    {{-- div content --}}
    <div class=" ps-4 pe-4 container" style="height: auto; width: 100%; padding: 30px 20px; ">
        {{-- 4 div --}}
        <div class="divContainer w-100 row">
            <div class="container" style="" class="mt-5">
                <div class="row g-4 justify-content-around" style="width: 100%">
                    <div class="d-flex flex-column col-lg-3 col-md-6 col-12"
                        style="width: 17rem; background-color: white; border-radius: 10px">
                        <div class="d-flex justify-content-between ps-4 pe-4 pt-3" style="flex: 6">
                            <p style="font-size: 25px">Student</p>
                            <div class="text-center"
                                style="width: 40px; height: 40px; background-color: #e0dcfe; line-height: 40px">
                                <i class="fa-solid fa-graduation-cap" style="color: #7f6dff"></i>
                            </div>
                        </div>
                        <p class="ps-4 pe-4" style="flex: 8; font-size: 35px; font-weight: bold">18</p>
                    </div>
                    <div class="d-flex flex-column col-lg-3 col-md-6 col-12"
                        style="width: 17rem; background-color: white; border-radius: 10px">
                        <div class="d-flex justify-content-between ps-4 pe-4 pt-3" style="flex: 6">
                            <p style="font-size: 25px">Teacher</p>
                            <div class="text-center"
                                style="width: 40px; height: 40px; background-color: #e0dcfe; line-height: 40px">
                                <i class="fa-solid fa-user-group" style="color: #7f6dff"></i>
                            </div>
                        </div>
                        <p class="ps-4 pe-4" style="flex: 8; font-size: 35px; font-weight: bold">18</p>
                    </div>
                    <div class="d-flex flex-column col-lg-3 col-md-6 col-12"
                        style="width: 17rem; background-color: white; border-radius: 10px">
                        <div class="d-flex justify-content-between ps-4 pe-4 pt-3" style="flex: 6">
                            <p style="font-size: 25px">Parent</p>
                            <div class="text-center"
                                style="width: 40px; height: 40px; background-color: #e0dcfe; line-height: 40px">
                                <i class="fa-solid fa-user-tie" style="color: #7f6dff"></i>
                            </div>
                        </div>
                        <p class="ps-4 pe-4" style="flex: 8; font-size: 35px; font-weight: bold">18</p>
                    </div>
                    <div class="d-flex flex-column col-lg-3 col-md-6 col-12"
                        style="width: 17rem; background-color: white; border-radius: 10px">
                        <div class="d-flex justify-content-between ps-4 pe-4 pt-3" style="flex: 6">
                            <p style="font-size: 25px">Class</p>
                            <div class="text-center"
                                style="width: 40px; height: 40px; background-color: #e0dcfe; line-height: 40px">

                                <i class="fa-solid fa-users" style="color: #7f6dff"></i>
                            </div>
                        </div>
                        <p class="ps-4 pe-4" style="flex: 8; font-size: 35px; font-weight: bold">18</p>
                    </div>
                </div>
            </div>
        </div>
        {{-- text section --}}
        <div class="mt-5 text-center row" style="width: 100%; height: 80px;">
            <p style="font-weight: bold; font-size: 25px">Kỳ học một, năm học 2024</p>
        </div>

        {{-- active class --}}
        <div class="tableClassAdmin w-100 row">
            <div class="activeclass  container" style="width: 100%; height: 500px; border-radius: 20px">
                <div class="row">
                    <div class="d-flex justify-content-start align-items-center mb-3 ps-3"
                        style="background-color: white; height: 90px; border-radius: 10px">
                        <div class="me-3" style="font-weight: bold; font-size: 20px">Các lớp đang hoạt động
                        </div>
                        <div style="height: 15px; width: 15px; background-color:#8ce98c" class="rounded-circle">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <table class="table table-striped" style="height: 100%; width: 100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên lớp</th>
                                <th>Giáo viên phụ trách</th>
                                <th>Học kỳ</th>
                                <th>Số lượng hiện tại</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>dsd</td>
                                <td>dsdsd</td>
                                <td>dsds</td>
                                <td>dsds</td>
                                <td>dsds</td>
                                <td>dsd</td>
                            </tr>
                            <tr>
                                <td>dsd</td>
                                <td>dsdsd</td>
                                <td>dsds</td>
                                <td>dsds</td>
                                <td>dsds</td>
                                <td>dsd</td>
                            </tr>
                            <tr>
                                <td>dsd</td>
                                <td>dsdsd</td>
                                <td>dsds</td>
                                <td>dsds</td>
                                <td>dsds</td>
                                <td>dsd</td>
                            </tr>
                            <tr>
                                <td>dsd</td>
                                <td>dsdsd</td>
                                <td>dsds</td>
                                <td>dsds</td>
                                <td>dsds</td>
                                <td>dsd</td>
                            </tr>
                            <tr>
                                <td>dsd</td>
                                <td>dsdsd</td>
                                <td>dsds</td>
                                <td>dsds</td>
                                <td>dsds</td>
                                <td>dsd</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-start align-items-center mb-3"
                        style="background-color: white; height: 90px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
