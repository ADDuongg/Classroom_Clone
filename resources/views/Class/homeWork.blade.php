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

@section('content')
    <div class=" p-0 h-100 contentClass" style="overflow: auto;">
        <div class="container-fluid w-100 p-0 m-0 h-100">
            @if ($includeLayout)
                @include('layoutAll.subHeader')
            @else
                @include('layoutStudent.subHeader')
            @endif
            <div class="row m-0 w-100" style="height: 92%">
                <div class="divEveryone m-auto ">
                    <div class="container w-100 mt-3">
                        <div class="row">
                            @if ($includeLayout)
                                <button
                                    class="btn btn-primary d-flex justify-content-center p-3 align-items-center rounded-pill"
                                    style=" height: 60px; width: 130px; border: none; font-size: 20px; color: white"
                                    data-bs-toggle="modal" data-bs-target="#modelHomework"><i
                                        class="fa-solid fa-plus me-3"></i>
                                    Tạo</button>
                            @else
                                <h3 style="color: #8A47C5">Danh sách bài tập</h3>
                            @endif
                        </div>
                    </div>
                    @include('modal.modalHomework')
                    <div class="container mt-2 w-100 ">
                        <div class="row allHomework w-100 h-auto d-flex flex-column">
                            <div class="bodypost">
                                @foreach ($posts as $post)
                                    @if ($post)
                                        @php
                                            $content = $post->content;
                                            $data = json_decode($content, true);
                                            $post_id = $post->id;
                                            $file_data = $data['file'];
                                            $commentsForPost = $comments->where('post_id', $post->id);
                                            $commentCount = $commentsForPost->count();
                                            $header = $data['header'];
                                            $content = $data['content'];
                                            $id_uniqid = uniqid();
                                        @endphp
                                        <div class="w-100 border border-1 mt-4 postHomework"
                                            style="border-radius: 10px; height: auto;">
                                            <div class="w-100 h-100 d-flex border-1 border-bottom justify-content-between postHomework1"
                                                style="border-radius: 10px">
                                                <div class="w-100 ps-4 pe-2 headerHomework" style="height: auto">
                                                    <div class="d-flex justify-content-start">
                                                        <div class="d-flex align-items-center " style="width: 100%;">
                                                            <div class="rounded-circle d-flex justify-content-center align-items-center"
                                                                style="height: 82%; width: 3rem; background-color: #9334E6">
                                                                <i class=" fa-solid fa-file-lines text-white"
                                                                    style="font-size: 25px"></i>
                                                            </div>
                                                            <p class=" d-flex mt-3 ms-3 fw-bold" style="">
                                                                {{ $header }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                   
                                                </div>
                                                @if ($includeLayout)
                                                    <div class="d-flex   btnEditPost dropstart justify-content-center align-items-center"
                                                        style="width: 20px;">
                                                        <i class="fa-solid fa-ellipsis-vertical" id="dropdownMenuButton1"
                                                            data-bs-toggle="dropdown" aria-expanded="false"
                                                            style="font-size: 20px; font-weight: bold; cursor: pointer;"></i>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                            <a class="dropdown-item" data-bs-toggle="modal"
                                                                href="#edithomework{{ $post->id }}"
                                                                style="cursor: pointer">Chỉnh sửa</a>

                                                            <form action="{{ url('homework/' . $post->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item"
                                                                    style="cursor: pointer">Xóa</button>
                                                            </form>

                                                        </ul>
                                                        @include('modal.modalEditHomework')
                                                    </div>
                                                @else
                                                    <div class=" justify-content-end d-flex align-items-center me-3">Đến
                                                        hạn: {{ $post->date }}</div>
                                                @endif
                                            </div>
                                            <div class="w-100 h-100 bodyHomework" style="display: none">
                                                <div class="border-1 border-bottom w-100 d-flex flex-column p-4"
                                                    style="height: 55%">
                                                    <p>Đã đăng vào {{ $post->created_at }}</p>
                                                    <div class="d-flex justify-content-between w-100">
                                                        @if ($includeLayout)
                                                            <p>{{ $content }}</p>
                                                            <div class="d-flex justify-content-around w-25">
                                                                <div class="d-flex flex-column border-3 ps-3 border-start">
                                                                    <h1>0</h1>
                                                                    <p>Đã nộp</p>
                                                                </div>
                                                                <div class="d-flex flex-column border-3 ps-3 border-start">
                                                                    <h1>1</h1>
                                                                    <p>Đã giao</p>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <p>{{ $content }}</p>
                                                        @endif
                                                    </div>
                                                    <div class="w-100 mt-2 pe-3 divHomeworkWrapper d-flex flex-column"
                                                        style="height: {{ count($file_data) > 0 ? '15rem' : '0px' }}; overflow-y: auto">
                                                        @foreach ($file_data as $file)
                                                            <div class=" d-flex   justify-content-between divFile mb-3"
                                                                style="height: 30%; width: 100%;">
                                                                <div class="w-100 h-100 d-flex"
                                                                    style=" border-top-left-radius: 10px; border-bottom-left-radius: 10px">

                                                                    <img src="{{ asset($file['file_path']) }}"
                                                                        alt="" style="height: 100%; width: 15%;">
                                                                    <div class="ps-3 ">
                                                                        <a target="_blank"
                                                                            href="{{ asset($file['file_path']) }}">{{ $file['file_original_name'] }}</a>
                                                                    </div>

                                                                </div>

                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    @if ($includeLayout)
                                                        <div data-bs-toggle="modal"
                                                            data-bs-target="#exampleModal{{ $post->id }}"
                                                            data-id-post = "{{ $post->id }}"
                                                            class="mt-2 fw-bold showcmt "
                                                            style="width: 19%; height: auto; ; cursor: pointer;">
                                                            {{ $commentCount }} nhận xét lớp học</div>
                                                        @include('modal.modalComment')
                                                    @else
                                                    @endif
                                                </div>
                                                @if ($includeLayout)
                                                    <div data-id-user="{{ $user->giaovien_id }}" {{-- data-id-class="{{$classroom->id}}" --}}
                                                        data-id-post="{{ $post_id }}" class="p-4 fw-bold btnGuide"
                                                        style="color: #9334E6; cursor:pointer">
                                                        Xem hướng dẫn
                                                    </div>
                                                @else
                                                    <div data-id-user="{{ $user->hocsinh_id }}" {{-- data-id-class="{{$classroom->id}}" --}}
                                                        data-id-post="{{ $post_id }}" class="p-4 fw-bold">
                                                        <a href="{{ url('hwstudent/' . $post_id . '/' . $user->hocsinh_id) }}"
                                                            style="color: #9334E6; cursor:pointer; text-decoration: none">Xem
                                                            hướng dẫn</a>
                                                    </div>
                                                @endif
                                            </div>

                                        </div>
                                    @else
                                    @endif
                                @endforeach
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var postHomeworks = document.querySelectorAll('.postHomework')
        postHomeworks.forEach(postHomework => {
            var headerHomework = postHomework.querySelector('.headerHomework')
            var bodyHomework = postHomework.querySelector('.bodyHomework')
            var btnGuide = postHomework.querySelector('.btnGuide')
            if (btnGuide) {
                var showcmt = postHomework.querySelector('.showcmt')
                var idpost = btnGuide.getAttribute('data-id-post')
                var iduser = btnGuide.getAttribute('data-id-user')
                btnGuide.addEventListener('click', function() {
                    window.location.href = `https://api.classroom.io.vn/gethomework/${idpost}/${iduser}`
                })
            }
            var isDisplay = true
            headerHomework.addEventListener('click', function() {
                bodyHomework.style.display = isDisplay ? 'block' : 'none'
                isDisplay = !isDisplay
            })
        })
    </script>
@endsection
