@extends('layoutAll.master')
@php
    $includeLayout = strpos($id_user, 'giaovien') !== false;
@endphp
@if ($includeLayout)
    @section('header')
        @include('layoutAll.header')
    @endsection

    @section('sidebar')
        @include('layoutAll.sidebar')
    @endsection
@else
    @section('header')
        @include('layoutStudent.header')
    @endsection

    @section('sidebar')
        @include('layoutStudent.sidebar')
    @endsection

@endif
{{-- @section('header')
    @include('layoutAll.header')
@endsection

@section('sidebar')
    @include('layoutAll.sidebar')
@endsection --}}

@section('content')
    <div class="contentClass p-0 h-100" style="overflow: auto;">
        <div class="container-fluid w-100 p-0 m-0 h-100">
            @if ($includeLayout)
                @include('layoutAll.subHeader')
            @else
                @include('layoutstudent.subHeader')
            @endif
            <div class="row m-0 w-100" style="height: 92%">
                <div class="divEveryone m-auto" style="width: 75%; height: 100%;">
                    <div class="container h-auto w-100 pt-4">
                        <div class="row border-1 border-primary border-bottom pb-3">
                            <div class="col" style="font-size: 40px; color: rgb(163, 33, 163) ">
                                Giáo viên 
                            </div>
                            @if ($includeLayout)
                                <div class="col justify-content-end d-flex align-items-center pt-3">
                                    <i class="fa-solid fa-user-plus" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                        style="color: rgb(163, 33, 163); font-size: 18px; cursor:pointer"></i>
                                </div>
                            @else
                                <div></div>
                            @endif
                        </div>
                        @include('Class.modelSubTeacher')

                        <div class="row divAllTeacher pt-4 ">
                            <div
                                class="divMainTeacher pb-2 d-flex justify-content-start align-items-center border-1 border-bottom border-secondary w-100">
                                <img src="{{ asset('images/' . $teacher->avatar) }}" alt="" class="rounded-circle me-4"
                                    style="height: 50px; width: 50px">
                                <p class="m-0" style="font-size: 18px; color: #56575a"><b>Giáo viên chủ nhiệm:
                                    </b>{{ $teacher->hoten }} </p>
                                    {{-- @php
                                     dd($teacher);
                                     
                                    @endphp --}}
                            </div>
                            @foreach (getSubTeacherBelongToClass($classroom->lophoc_id) as $subTeacher)
                                <div
                                    class="divSubTeacher pt-3 pb-2 d-flex justify-content-between align-items-center border-1 border-bottom border-secondary w-100">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('images/' . $subTeacher->avatar) }}" alt=""
                                            class="rounded-circle me-4" style="height: 50px; width: 50px">
                                        <p class="m-0" style="font-size: 18px; color: #56575a">{{ $subTeacher->hoten }}
                                        </p>
                                    </div>
                                    @if ($includeLayout)
                                        <form action="{{ url('teacherdelete/' . $subTeacher->giaovien_id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="border: none">
                                                <i class="fa-solid fa-trash btnDeleteTeacher"
                                                    style="font-size: 20px;cursor:pointer; color: red"></i>
                                            </button>
                                        </form>
                                    @else
                                        <div></div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="container h-auto w-100 mt-5">
                        <div class="row border-1 border-primary border-bottom pb-3">
                            <div class="col" style="font-size: 40px; color: rgb(163, 33, 163) ">
                                Bạn học
                            </div>
                            @if ($includeLayout)
                                <div class="col justify-content-end d-flex align-items-center pt-3">
                                    <i class="fa-solid fa-user-plus" data-bs-toggle="modal" data-bs-target="#exampleModal1"
                                        style="color: rgb(163, 33, 163); font-size: 18px; cursor:pointer"></i>
                                </div>
                            @else
                                <div></div>
                            @endif
                        </div>
                        @include('Class.modelInviteStudent')
                        @foreach (getStudentBelongToClass($classroom->lophoc_id) as $student)
                            <div
                                class="divAllStudent pt-3 pb-2 d-flex justify-content-between align-items-center border-1 border-bottom border-secondary w-100">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('images/' . $student->avatar) }}" alt=""
                                        class="rounded-circle me-4" style="height: 50px; width: 50px">
                                    <p class="m-0" style="font-size: 18px; color: #56575a">{{ $student->hoten }}
                                    </p>
                                </div>
                                @if ($includeLayout)
                                    <form
                                        action="{{ url('studentdelete/' . $student->hocsinh_id . '/' . $classroom->lophoc_id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="border: none">
                                            <i class="fa-solid fa-trash btnDeleteStudent"
                                                style="font-size: 20px;cursor:pointer; color: red"></i>
                                        </button>
                                    </form>
                                @else
                                    <div></div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var subteachers = document.querySelectorAll('.subteacher');
            var getTeacherBysubteacher = document.querySelector('.getTeacherBysubteacher');
            var token = document.head.querySelector('meta[name="csrf-token"]').content;
            var clonedSubTeachers = [];
            var btnInviteTeacher = document.querySelector('.btn-invite-teacher')
            var idclass = getTeacherBysubteacher.getAttribute('data-id-class')
            var data = {
                lophoc_id: idclass,
                giaovien_id: clonedSubTeachers
            };
            btnInviteTeacher.addEventListener('click', function() {


                fetch('https://api.classroom.io.vn/subteacher/store', {
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token,
                            'X-Requested-With': 'XMLHttpRequest'

                        },
                        body: JSON.stringify(data)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data['success']) {
                            alert(data['success'])

                            window.location.reload();
                        } else if (data['error']) {
                            alert(data['error'])

                        }

                    })
                    .catch(error => console.error('Error:', error));
            })
            subteachers.forEach(function(subteacher) {
                subteacher.addEventListener('mouseenter', function() {
                    subteacher.classList.add('hover-effect');
                });

                subteacher.addEventListener('click', function(e) {
                    subteacher.style.display = 'none';

                    var clonedSubteacher = subteacher.cloneNode(true);
                    clonedSubteacher.style.display = 'block';
                    clonedSubteacher.style.height = '60px';
                    var childElement = clonedSubteacher.querySelector(':first-child');
                    if (childElement) {
                        childElement.style.height = '100%';
                    }
                    clonedSubteacher.style.marginBottom = '10px';
                    clonedSubteacher.classList.remove('subteacher');
                    clonedSubteacher.classList.add('border', 'border-1', 'mb-2', 'cloneSubTeacher');
                    getTeacherBysubteacher.append(clonedSubteacher);

                    var btnClose = clonedSubteacher.querySelector('.btn-close');
                    var idTeacher = clonedSubteacher.getAttribute('data-id-div');

                    btnClose.style.display = 'block'
                    btnClose.addEventListener('click', function() {
                        var clone_subteacher = btnClose.closest('.cloneSubTeacher')
                        var iddiv = clone_subteacher.getAttribute('data-id-div')

                        if (clone_subteacher) {
                            clone_subteacher.style.display = 'none';
                            subteacher.style.display = 'block'
                            // Tìm vị trí của id trong mảng và loại bỏ nó
                            var index = clonedSubTeachers.indexOf(iddiv);
                            if (index !== -1) {
                                clonedSubTeachers.splice(index, 1);
                            }
                            console.log(clonedSubTeachers);
                        }
                    });

                    // Thêm idTeacher vào mảng
                    clonedSubTeachers.push(idTeacher);
                    console.log(clonedSubTeachers);
                });

                subteacher.addEventListener('mouseleave', function() {
                    subteacher.classList.remove('hover-effect');
                });
            });
        });
    </script>
@endsection
