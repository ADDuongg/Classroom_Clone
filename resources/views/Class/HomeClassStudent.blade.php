@extends('layoutStudent.master')

@section('header')
    @include('layoutStudent.header')
@endsection

@section('sidebar')
    @include('layoutStudent.sidebar')
@endsection

@section('content')
    <div class="h-100 contentClass" >
        <div class="container w-100 h-100">
            <div class="row w-100 d-flex justify-content-start ms-3 align-items-center">
                @foreach ($classTeach as $item)
                    <div class="card me-4 mt-4 mb-4 p-0 d-flex flex-column justify-content-start"
                        style="width: 20rem; height: 20rem;">
                        <div style="height: 35%;">
                            {{-- <p style="z-index: 10">Lop hoc</p> --}}
                            <img src="https://gstatic.com/classroom/themes/img_breakfast.jpg" class="card-img-top w-100 h-100"
                                alt="...">
                        </div>
                        <div class="card-body" style="height: 65%;">
                            <h5 class="card-title">{{ $item->tenlop }}</h5>
                            <div class="card-text border-1 border-bottom">
                                <div class="d-flex">
                                    <p class="me-2" style="font-weight: bold; font-size: 15px">Giáo
                                        viên dạy: </p>{{ $item->hoten }}
                                </div>
                                <div class="d-flex">
                                    <p class="me-2" style="font-weight: bold; font-size: 15px">Số
                                        lượng học sinh: </p>{{ getNumberStudent($item->lophoc_id) }}
                                </div>
                            </div>
                            <div class="d-flex justify-content-between w-100 mt-4">
                                <a href="{{ url('class/' . $item->lophoc_id . '/' . $user->hocsinh_id) }}"
                                    class="btn btn-primary">Vào lớp học<i class="fa-solid fa-arrow-right ms-3"></i></a>
                                {{--  <a href="#" class="btn btn-primary">Mở sổ điểm<i
                                    class="fa-solid fa-arrow-trend-up ms-3"></i></a> --}}
                            </div>
                        </div>
                    </div>
                @endforeach

                <div data-bs-toggle="modal" data-bs-target="#{{ $user->hocsinh_id }}" style="height: 5rem; width: 5rem;"
                    class="btn btn-primary ms-3 rounded-circle d-flex justify-content-center align-items-center ">
                    <i class="fa-solid fa-plus text-white" style="font-size: 30px"></i>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="{{ $user->hocsinh_id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Vào lớp học theo mã lớp</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex flex-column h-100 w-100">
                                    <div style="font-size: 25px">Mã lớp</div>
                                    <div>Đề nghị giáo viên cung cấp mã lớp rồi nhập vào đây</div>
                                    <br>

                                    <input type="text" name="lophoc_id" class="w-100 form-control" style=""
                                        placeholder="Mã lớp">

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary btnsave">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modal = document.querySelector('.modal');
            var token = document.head.querySelector('meta[name="csrf-token"]').content;
            modal.addEventListener('shown.bs.modal', function() {
                var hocsinh_id = modal.getAttribute('id')
                var btnsave = modal.querySelector('.btnsave')

                btnsave.addEventListener('click', function() {
                    var input = modal.querySelector('input[name="lophoc_id"]').value
                    var formdata = new FormData()
                    formdata.append('hocsinh_id', hocsinh_id)
                    formdata.append('code_class', input)
                    fetch('http://localhost:8000/numberStudentInClass', {
                            method: "POST",
                            headers: {
                                'X-CSRF-TOKEN': token
                            },
                            body: formdata
                        })
                        .then(res => {
                            if (res.ok) {
                                window.location.reload()
                               
                            } 
                        })

                })
            });
        });
    </script>
@endsection
