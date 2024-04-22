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
    <section class=" h-100 p-0 contentClass" style="overflow: auto;">
        <div class="container-fluid p-0 m-0 h-100" style="position: relative">
            @if ($includeLayout)
                @include('layoutAll.subHeader')
            @else
                @include('layoutStudent.subHeader')
            @endif
            <div class="row m-0 w-100" style="height: 92%">
                <div class="p-0 w-100">
                    <div class="container p-0" style="max-width: 80%; margin: auto; height: 100%;">
                        <div class="row ms-0 me-0  w-100 mt-4" style="position: relative">
                            <img style="border-radius: 15px" src="https://gstatic.com/classroom/themes/img_breakfast.jpg"
                                alt="" class="h-100 w-100 p-0">
                            <p class="mb-3 ms-4"
                                style="color: white; font-size: 35px; font-weight: bold; position: absolute; bottom: 0">
                                {{ $classroom->tenlop }} </p>
                        </div>
                        <div class="row g-4 ms-0 me-0 mt-4 h-100">
                            <div class="col-lg-3 col-md-12 p-0">
                                <div class="d-flex flex-column ps-4 pe-4 pt-3"
                                    style="height: 10rem; border: 0.5px solid #DADCE0; border-radius: 10px">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6>Mã lớp</h6>
                                        <i class="fa-solid fa-ellipsis-vertical" style="font-size: 35px"></i>
                                    </div>
                                    <div class="d-flex align-items-center ">
                                        <p class="m-0 me-4"
                                            style="font-size: 25px; font-weight: bold; color: rgb(205, 40, 205)">
                                            {{ $classroom->codeclass }}</p>

                                        <i class="fa-solid fa-expand"
                                            style="font-size: 25px; color:rgb(205, 40, 205); cursor: pointer; "></i>
                                    </div>
                                </div>
                                <div class="ps-4 pe-4 pt-3 mt-4"
                                    style="height: 10rem; border: 0.5px solid #DADCE0; border-radius: 10px">
                                    <h4>Mã lớp</h4>
                                    <i class="fa-solid fa-ellipsis" style="font-size: 35px"></i>
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-12 h-100 p-0">
                                <div class=" contriner-divpost ms-lg-4 ps-4 border border-1 readypost shadow"
                                    style="">
                                    <div class="w-100 h-100">
                                        <div class=" w-100 h-100 d-flex justify-content-start  align-items-center ">
                                            <img class="rounded-circle col-4" style="height: 70px; width: 70px"
                                                src="{{ asset('images/' . $user->avatar) }}" alt="">
                                            <div class="col-8 d-flex align-items-center ms-3" style="">Thông báo nội
                                                dung nào
                                                đó cho lớp học của bạn</div>
                                        </div>
                                    </div>
                                </div>
                                @if (session('msg'))
                                    <div id="successMsg" class="ms-4 alert alert-success">
                                        {{ session('msg') }}
                                    </div>
                                    <script>
                                        // Sử dụng setTimeout để ẩn thông báo sau 3000ms (3 giây)
                                        setTimeout(function() {
                                            document.getElementById('successMsg').style.display = 'none';
                                        }, 2000);
                                    </script>
                                @endif

                                <div class=" contriner-divpost1" style="display: none; height: auto;">
                                    <div class="divpost ms-4 w-100 shadow-lg p-4" style="height: 100%;border-radius:15px">
                                        <div class="d-flex flex-column w-100">
                                            <h6>Dành cho</h6>
                                            <div class="d-flex w-75 justify-content-start mt-4">
                                                <div class="dropdown me-4">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        Lớp học
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                                        <li><a class="dropdown-item" href="#">Something else here</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        Dành cho
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                                        <li><a class="dropdown-item" href="#">Another action</a>
                                                        </li>
                                                        <li><a class="dropdown-item" href="#">Something else
                                                                here</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="w-75 mt-4 w-100">
                                                <label for="" class="form-label">Thông báo nội dung nào đó cho lớp
                                                    học của bạn</label>
                                                <div class="form-control divinput"
                                                    style="height: 150px; width: 100%; box-sizing: border-box; vertical-align: top; border: 1px solid #ccc; padding: 8px;"
                                                    contenteditable="true"
                                                    placeholder="Thông báo nội dung nào đó cho lớp học của bạn...">
                                                </div>
                                                <div class="Divfile" style="display: none">
                                                    <div class="divAppend d-flex flex-column">
                                                        <div class=" divContentFile d-flex flex-column mt-3">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-75 mt-4 w-100 d-flex justify-content-between">
                                                <div>
                                                    <input type="file" class="form-control divfile" id="fileInput">
                                                </div>
                                                <div>
                                                    <button class="btn btn-secondary btncancle">Hủy</button>
                                                    <button
                                                        data-id-user="{{ $user->giaovien_id ? $user->giaovien_id : $user->hocsinh_id }}"
                                                        data-id-class="{{ $classroom->lophoc_id }}" class="btn btnpost"
                                                        style="background-color: orange; color: white">Đăng</button>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="bodypost ms-lg-4 mt-5">
                                    @foreach ($posts as $post)
                                        @php
                                            $content = $post->content;
                                            $data = json_decode($content, true);
                                            $file_data = $data['file'];
                                            $content_data = $data['content'];
                                            $id_uniqid = uniqid();
                                            $comments = DB::table('comments')
                                                ->select([
                                                    'comments.*',
                                                    DB::raw(
                                                        'COALESCE(giaovien.giaovien_id, hocsinh.hocsinh_id) AS user_id',
                                                    ),
                                                    DB::raw('COALESCE(giaovien.avatar, hocsinh.avatar) AS avatar'),
                                                    DB::raw('COALESCE(giaovien.hoten, hocsinh.hoten) AS hoten'),
                                                    DB::raw('CASE 
                                                                        WHEN giaovien.giaovien_id IS NOT NULL THEN "giaovien"
                                                                        WHEN hocsinh.hocsinh_id IS NOT NULL THEN "hocsinh"
                                                                        END AS user_type'),
                                                ])
                                                ->leftJoin('giaovien', 'comments.user_id', '=', 'giaovien.giaovien_id')
                                                ->leftJoin('hocsinh', 'comments.user_id', '=', 'hocsinh.hocsinh_id')
                                                ->where('comments.post_id', $post->id)
                                                ->orderBy('comments.created_at', 'desc')
                                                ->get();
                                            $commentCount = $comments->count();
                                        @endphp
                                        @if ($post)
                                            <div class="w-100 border border-1 mt-4 divCommentWrapper"
                                                style="border-radius: 10px; height: auto;">
                                                <div class="w-100 ps-4 pe-4 Divpost border-1 border-bottom"
                                                    style="height: auto">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="d-flex">
                                                            <img class="rounded-circle" style="height: 70px; width: 70px"
                                                                src="{{ asset('images/' . $post->avatar) }}"
                                                                alt="">
                                                            <div class=" d-flex mt-3 ms-3" style="height: 70px;">
                                                                <h5>{{ $post->hoten }}</h5>
                                                            </div>
                                                        </div>

                                                        @if ($user->giaovien_id == $post->user_id || $user->hocsinh_id == $post->user_id)
                                                            <div class="d-flex pt-4 btnEditPost dropstart">
                                                                <i class="fa-solid fa-ellipsis-vertical"
                                                                    id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                                    aria-expanded="false"
                                                                    style="font-size: 20px; font-weight: bold; cursor: pointer;"></i>
                                                                <ul class="dropdown-menu"
                                                                    aria-labelledby="dropdownMenuButton1">
                                                                    <a class="dropdown-item" data-bs-toggle="modal"
                                                                        href="#editpost{{ $post->id }}"
                                                                        style="cursor: pointer">Chỉnh sửa</a>

                                                                    <form action="{{ url('posts/' . $post->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="dropdown-item"
                                                                            style="cursor: pointer">Xóa</button>
                                                                    </form>

                                                                </ul>
                                                                @include('modal.modalEditPost')
                                                            </div>
                                                        @endif

                                                    </div>
                                                    <div class="content-post w-100 ms-3 d-flex flex-column mb-3">
                                                        <p>{{ $content_data }}</p>
                                                        <div class="d-flex " style="flex-wrap: wrap">
                                                            @foreach ($file_data as $file)
                                                                <div
                                                                    class="d-flex border-1 border me-3 mb-3"style="height: 100px; width: 312px; border-radius: 10px">
                                                                    <img src="{{ asset($file['file_path']) }}"
                                                                        alt=""
                                                                        style="height: 100%; width: 40%; border-radius: 10px 0 0 10px;">
                                                                    <div style="height: 100%; width: 60%;">
                                                                        <a target="_blank"
                                                                            href="{{ asset($file['file_path']) }}"
                                                                            class="ps-3 pe-3">{{ $file['file_original_name'] }}</a>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>

                                                <div data-id="{{ $post->id }}"
                                                    class=" w-100 p-4 d-flex flex-column justify-content-start align-items-center postComment"
                                                    style="height: auto">
                                                    <div class="showComment d-flex justify-content-start align-items-center"
                                                        style="width: 100%;">
                                                        <div class="me-2 d-flex justify-content-start align-items-center"
                                                            height: 30px; width: 30px;>
                                                            <i class="fa-solid fa-user-group "
                                                                style="cursor: pointer; font-weight: bold"></i>
                                                        </div>
                                                        <div class="numberComment">{{ $commentCount }} nhận xét về lớp
                                                            học
                                                        </div>
                                                    </div>

                                                    <div class="detailComment w-100" style="display: none">
                                                        <div class="mb-3">
                                                            <div class="divAllComment mb-3 mt-2 w-100"
                                                                style="height: auto" {{-- style="display: block" --}}>
                                                                @foreach ($comments as $comment)
                                                                    <div
                                                                        class=" divChilAllComment d-flex w-100 align-items-center justify-content-between mb-3">
                                                                        <div class="w-100 d-flex">
                                                                            <img class="rounded-circle"
                                                                                style="height: 50px; width: 50px"
                                                                                src="{{ asset('images/' . $comment->avatar) }}"
                                                                                alt="">
                                                                            <div class="ms-3 pt-1" style="height: auto">
                                                                                <div class=" d-flex flex-column "
                                                                                    style="">
                                                                                    <div class="d-flex">
                                                                                        <div
                                                                                            style="font-weight: bold; margin-right: 15px">
                                                                                            {{ $comment->hoten }}
                                                                                        </div>
                                                                                        {{ $comment->created_at }}
                                                                                    </div>
                                                                                    <div class="d-flex flex-column">
                                                                                        <div class="divEditEnable"
                                                                                            contenteditable="false">
                                                                                            {{ $comment->content }}
                                                                                        </div>
                                                                                        <div class="divAction mt-3"
                                                                                            style="display: none">
                                                                                            <button
                                                                                                class="btn btn-secondary me-2 btnCancleEdit">Hủy</button>
                                                                                            <button
                                                                                                data-id-comments={{ $comment->id }}
                                                                                                class="btn btn-primary btnSaveEdit">Lưu</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="divEditComment dropstart"
                                                                            style="height: 35px; width: 50px; text-align: center; line-height: 50px">
                                                                            @if ($user->giaovien_id == $comment->user_id || $user->hocsinh_id == $comment->user_id)
                                                                                <i class="fa-solid fa-ellipsis-vertical"
                                                                                    id="dropdownMenuButton1"
                                                                                    data-bs-toggle="dropdown"
                                                                                    aria-expanded="false"
                                                                                    style="cursor: pointer; height: 30px; width: 30px; font-weight: bold"></i>
                                                                                <ul class="dropdown-menu"
                                                                                    aria-labelledby="dropdownMenuButton1">
                                                                                    <li class="dropdown-item btnEditComment"
                                                                                        data-bs-toggle="modal"
                                                                                        href="#editpost{{ $comment->id }}"
                                                                                        style="cursor: pointer">Chỉnh
                                                                                        sửa</li>

                                                                                    <form
                                                                                        action="{{ url('comments/' . $comment->id) }}"
                                                                                        method="POST">
                                                                                        @csrf
                                                                                        @method('DELETE')
                                                                                        <button type="submit"
                                                                                            class="dropdown-item"
                                                                                            style="cursor: pointer">Xóa</button>
                                                                                    </form>

                                                                                </ul>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="divOneComment w-100 mb-3" style="display: none">
                                                        <div class="d-flex w-100 align-items-center">
                                                            <img class="rounded-circle" style="height: 50px; width: 50px"
                                                                src="{{ asset('images/' . $user->avatar) }}"
                                                                alt="">
                                                            <div class=" d-flex flex-column  mt-3 ms-3 w-100"
                                                                style="height: auto">
                                                                <div class="d-flex">
                                                                    <div style="font-weight: bold; margin-right: 15px">
                                                                        {{ $user->hoten }}</div>
                                                                    {{ $user->created_at }}
                                                                </div>
                                                                <div class="oneComment"></div>
                                                            </div>
                                                            <div
                                                                style="height: 35px; width: 50px; text-align: center; line-height: 50px">
                                                                <i class="fa-solid fa-ellipsis-vertical"
                                                                    style="cursor: pointer; height: 30px; width: 30px; font-weight: bold"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex w-100 align-items-center">
                                                        <img class="rounded-circle" style="height: 50px; width: 50px"
                                                            src="{{ asset('images/' . $user->avatar) }}" alt="">
                                                        <div class=" d-flex mt-3 ms-3 form-control w-100 divInputComment"
                                                            style="height: auto" contenteditable="true">
                                                        </div>
                                                        <div data-id-user="{{ $id_user }}"
                                                            data-id-post="{{ $post->id }}" class="btnsendcomment"
                                                            style="height: 35px; width: 50px; text-align: center; line-height: 50px">
                                                            <i class="fa-regular fa-paper-plane"
                                                                style="cursor: pointer; height: 30px; width: 30px; font-weight: bold"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach

                                </div>




                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            var itemnavs = document.querySelectorAll('.itemnav')
            itemnavs.forEach(itemnav => {
                itemnav.addEventListener('click', function() {
                    itemnavs.forEach(otherItemnav => {
                        if (otherItemnav !== itemnav) {
                            otherItemnav.classList.remove('border-2', 'border-bottom',
                                'border-primary');
                        }
                    });
                    itemnav.classList.add('border-2', 'border-bottom', 'border-primary');
                })
            })

            var btneditposts = document.querySelectorAll('.btnEditPost')
            var readypost = document.querySelector('.readypost')
            var btnpost = document.querySelector('.btnpost')
            var btncancle = document.querySelector('.btncancle')
            var container_divpost = document.querySelector('.contriner-divpost')
            var bodypost = document.querySelector('.bodypost')
            var container_divpost1 = document.querySelector('.contriner-divpost1')
            var token = document.head.querySelector('meta[name="csrf-token"]').content;
            var Divfile = document.querySelector('.Divfile')
            var selectedFiles = [];
            var fileInput = document.getElementById('fileInput');
            var contentFileDiv = document.querySelector('.contentFile');
            var divContentFile = document.querySelector('.divContentFile')
            var divAppend = document.querySelector('.divAppend')

            function removeSelectedFile(file) {
                var index = selectedFiles.indexOf(file);
                if (index !== -1) {
                    selectedFiles.splice(index, 1);
                }
            }
            fileInput.addEventListener('change', function() {
                var file = fileInput.files[0];
                Divfile.style.display = 'block'
                if (file) {
                    selectedFiles.push(file);
                    var isImage = /\.(jpe?g|png|gif)$/i.test(file.name);
                    var fileURL = URL.createObjectURL(file);
                    var contentFileDiv = document.createElement('div');
                    contentFileDiv.classList.add('contentFile', 'd-flex', 'mt-3',
                        'justify-content-between');
                    if (isImage) {
                        var reader = new FileReader();
                        reader.onload = function(e) {

                            var imgElement = document.createElement('img');
                            imgElement.src = e.target.result;
                            imgElement.classList.add('me-3');
                            imgElement.alt = file.name;

                            imgElement.style.width = '100px';
                            imgElement.style.height = '60px';
                            contentFileDiv.appendChild(imgElement);

                            var fileNameElement = document.createElement('a');
                            fileNameElement.target = "_blank"
                            fileNameElement.href = fileURL;
                            fileNameElement.textContent = file.name
                            contentFileDiv.appendChild(fileNameElement);

                            var divImgNameFile = document.createElement('div');
                            divImgNameFile.classList.add('divImgNameFile', 'd-flex',
                                'justify-content-between');

                            var ellipsisDiv = document.createElement('div');
                            ellipsisDiv.classList.add('d-flex', 'align-items-center');
                            var ellipsisIcon = document.createElement('i');
                            ellipsisIcon.classList.add('fa-solid', 'fa-trash');
                            ellipsisIcon.style.cursor = "pointer";
                            ellipsisIcon.style.fontSize = '20px';

                            ellipsisDiv.addEventListener('click', function(event) {
                                if (event.target.classList.contains('fa-trash')) {
                                    divImgNameFile.remove();
                                    removeSelectedFile(file);
                                }
                            });
                            ellipsisDiv.appendChild(ellipsisIcon)
                            divImgNameFile.appendChild(contentFileDiv)
                            divImgNameFile.appendChild(ellipsisDiv)

                            divContentFile.appendChild(divImgNameFile);
                            divAppend.appendChild(divContentFile);


                        };

                        reader.readAsDataURL(file);
                    } else {
                        var iconFile = document.createElement('i');
                        iconFile.classList.add('fa-regular', 'fa-file', 'me-3');
                        iconFile.style.fontSize = '60px';
                        contentFileDiv.appendChild(iconFile);

                        var fileNameElement = document.createElement('a');
                        fileNameElement.target = "_blank"
                        fileNameElement.href = fileURL;
                        fileNameElement.textContent = file.name
                        contentFileDiv.appendChild(fileNameElement);

                        var divImgNameFile = document.createElement('div');
                        divImgNameFile.classList.add('divImgNameFile', 'd-flex',
                            'justify-content-between');
                        divImgNameFile.appendChild(contentFileDiv)

                        var ellipsisDiv = document.createElement('div');
                        ellipsisDiv.classList.add('d-flex', 'align-items-center');
                        var ellipsisIcon = document.createElement('i');
                        ellipsisIcon.classList.add('fa-solid', 'fa-trash');
                        ellipsisIcon.style.cursor = "pointer";
                        ellipsisIcon.style.fontSize = '20px';

                        ellipsisDiv.appendChild(ellipsisIcon)

                        divImgNameFile.appendChild(ellipsisDiv)

                        divContentFile.appendChild(divImgNameFile);
                        divAppend.appendChild(divContentFile);
                    }
                }
            });


            btnpost.addEventListener('click', function() {
                idclass = btnpost.getAttribute('data-id-class')
                iduser = btnpost.getAttribute('data-id-user')
                var inputPost = document.querySelector('.divinput').textContent
                console.log(selectedFiles);
                var formData = new FormData();
                formData.append('class_id', idclass);
                formData.append('user_id', iduser);
                formData.append('content', inputPost);
                for (var i = 0; i < selectedFiles.length; i++) {
                    formData.append('file[]', selectedFiles[i]);
                }

                fetch('https://api.classroom.io.vn/posts', {
                        method: "POST",
                        headers: {
                            // No need to set 'Content-Type' for FormData
                            'X-CSRF-TOKEN': token
                        },
                        body: formData,
                    })
                    .then(response => response.json())
                    .then(data => {

                        window.location.reload()
                        console.log(data);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });

            container_divpost.addEventListener('click', function() {
                container_divpost.style.display = 'none';
                container_divpost1.style.display = 'block';
            })



            btncancle.addEventListener('click', function() {
                container_divpost1.style.display = 'none';
                container_divpost.style.display = 'block';

            })

            let ip_address = '127.0.0.1';
            let socket_port = '3001';

            // Kết nối với server Socket.IO
            const socket = io(`http://${ip_address}:${socket_port}`);

            var divCommentWrappers = document.querySelectorAll('.divCommentWrapper')
            divCommentWrappers.forEach(divCommentWrapper => {
                var divDetailComment = divCommentWrapper.querySelector('.detailComment')
                var btnsendcomments = divCommentWrapper.querySelector('.btnsendcomment')
                var divOneComment = divCommentWrapper.querySelector('.divOneComment')
                var divAllComment = divCommentWrapper.querySelector('.divAllComment')
                var numberComment = divCommentWrapper.querySelector('.numberComment')
                var postComment = divCommentWrapper.querySelector('.postComment')
                var showComment = divCommentWrapper.querySelector('.showComment')
                var oneComment = divCommentWrapper.querySelector('.oneComment')
                /* var divEditComments = divAllComment.querySelectorAll('.divEditComment') */

                var divChilAllComments = divAllComment.querySelectorAll('.divChilAllComment');

                if (divChilAllComments) {
                    divChilAllComments.forEach(divChilAllComment => {
                        var divEditEnable = divChilAllComment.querySelector('.divEditEnable');
                        var btnEditComment = divChilAllComment.querySelector('.btnEditComment');
                        var divAction = divChilAllComment.querySelector('.divAction')
                        var btnCancleEdit = divChilAllComment.querySelector('.btnCancleEdit')
                        var btnSaveEdit = divChilAllComment.querySelector('.btnSaveEdit')
                        var inputEdit = divEditEnable.textContent
                        var oldValue = divEditEnable.textContent
                        var idComment = btnSaveEdit.getAttribute('data-id-comments')
                        divEditEnable.addEventListener('input', function() {
                            // Cập nhật giá trị inputEdit khi nội dung của divEditEnable thay đổi
                            inputEdit = divEditEnable.textContent.trim();
                            console.log(inputEdit);

                        });
                        btnSaveEdit.addEventListener('click', function() {
                            console.log(inputEdit.trim());
                            var formData = new FormData()
                            formData.append('valueInput', inputEdit)
                            formData.append('_method', 'PUT')
                            fetch(`https://api.classroom.io.vn/comments/${idComment}`, {
                                method: "POST",
                                headers: {
                                    // No need to set 'Content-Type' for FormData
                                    'X-CSRF-TOKEN': token
                                },
                                body: formData,
                            })

                            divEditEnable.setAttribute('contenteditable', 'false');
                            divEditEnable.classList.remove('border', 'border-1',
                                'border-primary',
                                'form-control')

                            divAction.style.display = 'none'
                        })
                        btnCancleEdit.addEventListener('click', function() {

                            divEditEnable.setAttribute('contenteditable', 'false');
                            divEditEnable.classList.remove('border', 'border-1',
                                'border-primary',
                                'form-control')
                            divEditEnable.textContent = oldValue.trim()
                            divAction.style.display = 'none'
                        })

                        if (btnEditComment) {
                            btnEditComment.addEventListener('click', function() {
                                divEditEnable.setAttribute('contenteditable', 'true');
                                divEditEnable.classList.add('border', 'border-1',
                                    'border-primary',
                                    'form-control')
                                divEditEnable.focus();
                                divAction.style.display = 'block'
                                oldValue = inputEdit
                            });
                        }



                    });
                }

                /* var divEditEnables = divAllComment.querySelectorAll('.divEditEnable')
                divEditComments.forEach(divEditComment => {
                    divEditEnables.forEach(divEditEnable => {
                    var btnEditComment = divEditComment.querySelector('.btnEditComment')
                    var isEdit = divEditEnable.getAttribute('contenteditable')
                    btnEditComment.addEventListener('click', function(){
                        alert(123)
                        isEdit = 'true';
                    })
                })
                }) */
                function updateCommentAll(data) {
                    var tm_p = ''
                    data.forEach(item => {
                        tm_p += `
                        <div class="d-flex w-100 align-items-center justify-content-between mb-3">
                                <div class="w-100 d-flex">
                                    <img class="rounded-circle"
                                        style="height: 50px; width: 50px"
                                        src="https://api.classroom.io.vn/images/${item['avatar']}"
                                        alt="">
                                    <div class="ms-3 pt-1"
                                        style="height: 50px">
                                        <div class=" d-flex flex-column "
                                            style="">
                                            <div class="d-flex">
                                                <div
                                                    style="font-weight: bold; margin-right: 15px">
                                                    ${item['hoten']}</div>
                                                ${item.created_at}
                                            </div>
                                            <div>${item.content}</div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    style="height: 35px; width: 50px; text-align: center; line-height: 50px">
                                    <i class="fa-solid fa-ellipsis-vertical"
                                        style="cursor: pointer; height: 30px; width: 30px; font-weight: bold"></i>
                                </div>
                            </div>
                        `
                    })
                    divAllComment.innerHTML = tm_p

                }
                if (showComment) {
                    var isDivAllCommentVisible = true;
                    /* var isDivOneCommentVisible = true; */
                    showComment.addEventListener('click', function() {

                        divDetailComment.style.display = isDivAllCommentVisible ? "block" : "none";
                        isDivAllCommentVisible = !isDivAllCommentVisible;
                        /* var numberMatch = numberComment.textContent.match(/\d+/);

                        if (numberMatch) {
                            var number = parseInt(numberMatch[0]);
                        } else {
                            console.log("Không tìm thấy số trong chuỗi");
                        } */
                        /* if (numberMatch == 0) {
                            console.log(0);
                            divOneComment.style.display = 'none'

                        } else if (numberMatch !== 0) {
                            console.log(1);
                            divOneComment.style.display = "none"
                            isDivOneCommentVisible = !isDivOneCommentVisible
                        } */

                    });
                }




                btnsendcomments.addEventListener('click', function() {
                    var input = divCommentWrapper.querySelector('.divInputComment').textContent;
                    var id_user = btnsendcomments.getAttribute('data-id-user');
                    var id_post = btnsendcomments.getAttribute('data-id-post');
                    var formData = new FormData();
                    formData.append('user_id', id_user);
                    formData.append('post_id', id_post);
                    formData.append('content', input);
                    fetch('https://api.classroom.io.vn/comments', {
                            method: "POST",
                            headers: {
                                // No need to set 'Content-Type' for FormData
                                'X-CSRF-TOKEN': token
                            },
                            body: formData,
                        })
                        .then(response => response.json())
                        .then(data => {
                            updateCommentAll(data['comments'])
                            console.log(data);

                            number = data['comments'].length
                            numberComment.textContent = `${number} nhận xét về lớp học`
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        })
                    /* .then(errorMessage => {
                        console.error('Error message from server:', errorMessage);
                    }); */
                    divDetailComment.style.display = "block"

                    /* socket.emit('chat message', input); */
                    /* divDetailComment.style.display = "block" */
                    /* if (divDetailComment.style.display = "block") {
                        divOneComment.style.display = "none"
                    } else {
                        divOneComment.style.display = "block"
                    } */
                    /* divOneComment.style.display = "block" */
                    /* divOneComment.style.display = 'block' */
                    /* if (oneComment.textContent != '') {
                        divOneComment.style.display = 'block'
                    } else if (oneComment.textContent === '') {
                        divOneComment.style.display = 'none'
                    } */
                })

                /* socket.on('chat message', (msg) => {
                    var oneComment = divOneComment.querySelector('.oneComment');
                    oneComment.textContent = `${msg}`;
                }); */

            })
        })
    </script>
@endsection
