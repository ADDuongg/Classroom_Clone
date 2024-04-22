@extends('layoutAll.master')

@section('header')
    @include('layoutAll.header')
@endsection

@section('sidebar')
    @include('layoutAll.sidebar')
@endsection

@section('content')
    <div class="contentClass p-0 h-100">
        <div class="container-fluid w-100 p-0 m-0 h-100">
            @include('layoutAll.headerHomework')
            @php
                $content = json_decode($post->content, true);
                $countSubmit = $studentSubmit->count();
            @endphp
            <div class="row g-4 m-0 w-100 px-lg-0 px-3" style="height: 92%">
                <div class=" col-lg-5 col-12  border-1 border  h-100 p-0 order-lg-1 order-2">
                    <div class="w-100 ps-4 d-flex align-items-center border-1 border-bottom" style="height: 10%">
                        <div class="d-flex justify-content-center h-75 rounded-circle align-items-center"
                            style="width: 12%;;background-color: #7627BB">
                            <i class="fa-solid fa-user-group text-white"></i>
                        </div>
                        <h5 class="ms-4 h-100 d-flex align-items-center">Danh sách học sinh</h5>
                    </div>
                    <div class="mt-4 w-100 ps-4 d-flex align-items-center border-1 border-bottom " style="height: 10%">
                        <div class="d-flex justify-content-center h-75 rounded-circle align-items-center"
                            style="width: 12%;;">
                            <i class="fa-solid fa-check text-success" style="font-size: 20px"></i>
                        </div>
                        <h5 class="ms-4 h-100 d-flex align-items-center text-center">Học sinh đã nộp bài</h5>
                    </div>
                    <div class="studentSubmit d-flex flex-column w-100 mt-3" style="height: auto">
                        <div class="" style="height: 150px; overflow-y: auto">
                            @foreach ($studentSubmit as $student)
                                <div data-id-student="{{ $student->hocsinh_id }}" data-id-post = "{{ $post->id }}"
                                    class=" w-100 ps-4 pe-3 divstudent d-flex justify-content-between align-items-center mb-3"
                                    style="height: 35%">
                                    <div class="d-flex justify-content-start h-75 rounded-circle align-items-center"
                                        style="width: 50%;">
                                        <img src="{{ asset('images/' . $student->avatar) }}" alt=""
                                            class="h-100 w-25 me-3">
                                        <h5 class="ms-3 h-100 d-flex align-items-center" style="width: auto;">
                                            {{ $student->hoten }}</h5>
                                    </div>
                                    <div class="fw-bold d-flex justify-content-end h-100 align-items-center"
                                        style="cursor: pointer;color: black">
                                        @if ($student->score)
                                            <input data-id-student="{{ $student->hocsinh_id }}"
                                                data-id-post = "{{ $post->id }}" type="text"
                                                class="form-control scoreInput" style="width: 40%; height: 50%;"
                                                placeholder="{{ $student->score }}">
                                        @else
                                            <input data-id-student="{{ $student->hocsinh_id }}"
                                                data-id-post = "{{ $post->id }}" type="text"
                                                class="form-control scoreInput" style="width: 30%; height: 50%;"
                                                placeholder="/{{ $post->maxscore }}">
                                        @endif
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="mt-4 w-100 ps-4 d-flex align-items-center border-1 border-bottom " style="height: 10%">
                        <div class="d-flex justify-content-center h-75 rounded-circle align-items-center"
                            style="width: 12%;;">
                            <i class="fa-solid fa-x text-danger " style="font-size: 20px"></i>
                        </div>
                        <h5 class="ms-4 h-100 d-flex align-items-center text-danger">Học sinh chưa nộp bài</h5>
                    </div>
                    <div class="studentNotSubmit d-flex flex-column w-100 mt-3" style="height: auto">
                        <div class="" style="height: 250px; overflow-y: auto">
                            @foreach ($studentNotSubmit as $student)
                                @if ($student->isSubmit === null)
                                    <div data-id-student = "{{ $student->hocsinh_id }}"
                                        class="w-100 ps-4 pe-3 divstudent d-flex justify-content-between align-items-center mb-3"
                                        style="height: 20%">
                                        <div class="d-flex justify-content-start h-100 rounded-circle align-items-center"
                                            style="width: 50%;">
                                            <img src="{{ asset('images/' . $student->avatar) }}" alt=""
                                                class="h-100 w-25 me-3">
                                            <h5 class="ms-2 h-100 d-flex align-items-center" style="width: auto;">
                                                {{ $student->hoten }}</h5>
                                        </div>


                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-12 divDetail border-1 border h-auto order-lg-2 order-1">

                    <div class="container">
                        <div class="row mt-5 fw-bold" style="font-size: 20px">{{ $content['content'] }}</div>
                        <div class="row mt-4 h-100 w-100" style="">
                            <div class="d-flex h-100 w-100 p-0">
                                <div class="d-flex flex-column " style="width: 15%;">
                                    <div class="" style="font-size: 50px">{{ $countSubmit }}</div>
                                    <div>Đã nộp</div>
                                </div>
                                <div class="d-flex flex-column h-100 border-1 border-start ps-4" style="width: 15%;">
                                    <div class="" style="font-size: 50px">1</div>
                                    <div>Đã giao</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="container h-auto">
                        <div class="row w-100 d-flex justify-content-end mt-4"><button class="btn-close"></button></div>
                        <div class="row w-100 mt-4">
                            <div class="w-100 p-0 d-flex justify-content-between">
                                <div class=" fw-bold" style="font-size: 25px">Dương</div>
                                <div>100/100</div>
                            </div>
                        </div>
                        <div class="row w-100 mt-5 h-100">
                            <div class=" mt-2 pe-3 divHomeworkWrapper d-flex justify-content-start"
                                style="flex-wrap: wrap; height: 100%; width: 100%; border-radius: 10px">
                                <div class="border-1 border me-3 d-flex justify-content-between divFile mb-3"
                                    style="height: 5rem; width: 45%;">
                                    <div class="w-100 h-100 d-flex "
                                        style=" border-top-left-radius: 10px; border-bottom-left-radius: 10px; ">
                                        <div class="h-100 " style="width: 50%;">
                                            <img src="" alt="" style="height: 100%; width: 100%;">
                                        </div>
                                        <div class="ps-3 ">
                                            <a target="_blank" href="">123</a>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var studentSubmit = document.querySelectorAll('.studentSubmit');
            var studentNotSubmit = document.querySelectorAll('.studentNotSubmit');
            var divDetail = document.querySelector('.divDetail')
            var token = document.head.querySelector('meta[name="csrf-token"]').content;
            studentSubmit.forEach(item => {
                var divstudent = item.querySelectorAll('.divstudent')
                
                divstudent.forEach(item => {
                    var id_post = item.getAttribute('data-id-post')
                    var id_user = item.getAttribute('data-id-student')
                    var scoreInput = item.querySelector('.scoreInput');
                    console.log(item);
                    if (scoreInput) {
                        scoreInput.addEventListener('blur', function() {
                            var score = this.value;

                            if (isNaN(score)) {
                                alert('Vui lòng chỉ nhập số.');
                                this.value = ''; // Xóa nội dung nhập nếu không phải số
                            }
                            if (score.length > 3) {
                                alert('Vui lòng nhập đúng điểm.');
                                this.value = ''; // Xóa nội dung nhập nếu không phải số
                            } else if (score !== '') {
                                fetch(
                                        `https://api.classroom.io.vn/setScore/${id_post}/${id_user}/${score}`
                                        )
                                    .then(res => res.json())
                                    .then(data => {
                                        alert(data.msg)
                                        window.location.reload()
                                    })
                            }
                        });
                    }
                    item.addEventListener('click', function() {
                        fetch(
                                `https://api.classroom.io.vn/fetchStudentHomework/${id_user}/${id_post}`
                                )
                            .then(res => res.json())
                            .then(data => {
                                dataContent = JSON.parse(data['homework']['content'])
                                console.log(data['homework'])
                                updateDivDetail(data)
                                console.log(dataContent);
                            })
                    })

                })


                function updateDivDetail(data) {
                    var student = data['homework'];
                    var dataContent = JSON.parse(data['homework']['content']);
                    var tmp = '';
                    tmp += `
                            <div class="container h-auto">
                                <div class="row w-100 d-flex justify-content-end mt-4"><button class="btn-close"></button></div>
                                <div class="row w-100 mt-4">
                                    <div class="w-100 p-0 d-flex justify-content-between">
                                        <div class="fw-bold" style="font-size: 25px">${student['hoten']}</div>
                                        <div>100/100</div>
                                    </div>
                                </div>
                        `;
                    dataContent['file'].forEach(item => {
                        tmp += `
                            <div class="row w-100 mt-5 h-100">
                                <div class="mt-2 pe-3 divHomeworkWrapper d-flex justify-content-start" style="flex-wrap: wrap; height: 100%; width: 100%; border-radius: 10px">
                                    <div class="border-1 border me-3 d-flex justify-content-between divFile mb-3" style="height: 5rem; width: 50%;">
                                        <div class="w-100 h-100 d-flex justify-content-between" style="border-top-left-radius: 10px; border-bottom-left-radius: 10px;">
                                            <div class="h-100" style="width: 70%;">
                                                <img src="https://api.classroom.io.vn/${item['file_path']}" alt="" style="height: 100%; width: 100%;">
                                            </div>
                                            <div class="ps-3">
                                                <a target="_blank" href="https://api.classroom.io.vn/${item['file_path']}">${item['file_name']}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                    tmp += `</div>`;
                    divDetail.innerHTML = tmp;
                    var btnclose = divDetail.querySelector('.btn-close')
                    if (btnclose) {
                        btnclose.addEventListener('click', function() {
                            window.location.reload()
                        })
                    }
                }



            });
            studentNotSubmit.forEach(item => {

                item.addEventListener('click', function() {
                    divDetail.innerHTML = `
                    <div class="container ">
                        <div class="row w-100 d-flex justify-content-end mt-4"><button class="btn-close"></button></div>
                        <div class="row w-100 fw-bold" style="font-size: 30px">Học sinh này chưa nộp bài</div>
                    </div>
                    `
                    var btnclose = divDetail.querySelector('.btn-close')
                    if (btnclose) {
                        btnclose.addEventListener('click', function() {
                            window.location.reload()
                        })
                    }
                })
            });
        });
    </script>
@endsection
