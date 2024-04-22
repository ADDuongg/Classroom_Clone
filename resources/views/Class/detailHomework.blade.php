@extends('layoutAll.master')

@section('header')
    @include('layoutAll.header')
@endsection

@section('sidebar')
    @include('layoutAll.sidebar')
@endsection

@section('content')
    <div class="contentClass h-100" style="overflow: scroll">
        <div class="container-fluid w-100 p-0 m-0 h-100">
            @include('layoutAll.headerHomework')
            <div class="row m-0 w-100" style="height: 92%">
                @php
                    /* print_r($user->giaovien_id); */
                    $content_data = json_decode($post->content, true);
                    $header = $content_data['header'];
                    $content = $content_data['content'];
                    $files = $content_data['file'];
                    $date = $post->created_at;
                    $outdate = $post->date;
                    $score = $post->maxscore;
                @endphp
                <div class="divDetailHomework m-auto " style="width: 70%; height: 100%;">
                    <div class="container h-auto w-100 pt-4">
                        <div class="row w-100" style="height: 3rem">
                            <div class="col-10 ">
                                <div class="h-100 w-100 d-flex align-items-center">
                                    <div class="rounded-circle d-flex justify-content-center align-items-center"
                                        style="height: 100%; width: 3rem; background-color: #9334E6">
                                        <i class=" fa-solid fa-file-lines text-white" style="font-size: 25px"></i>
                                    </div>
                                    <div style="color: #7627BB; font-size:30px" class=" ms-3">{{ $header }}</div>
                                </div>
                            </div>
                            <div class="col-2 d-flex justify-content-end align-items-center">
                                <div class="d-flex col-2 btnEditPost dropstart justify-content-center align-items-center"
                                    style="width: 20px;">
                                    <i class="fa-solid fa-ellipsis-vertical" id="dropdownMenuButton1"
                                        data-bs-toggle="dropdown" aria-expanded="false"
                                        style="font-size: 20px; font-weight: bold; cursor: pointer;"></i>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <a class="dropdown-item" data-bs-toggle="modal"
                                            href="#edithomework{{ $post->id }}" style="cursor: pointer">Chỉnh sửa</a>

                                        <form action="{{ url('deletehomework/' . $post->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item"
                                                style="cursor: pointer">Xóa</button>
                                        </form>

                                    </ul>

                                </div>
                                @include('modal.modalEditHomework')
                            </div>
                        </div>
                    </div>
                    <div class="container w-100 mt-3">
                        <div class="row w-100">
                            <div class="col">
                                {{ $user->hoten }} - {{ $date }}
                            </div>
                        </div>
                        <div class="row w-100 mt-3 pb-3" {{-- style="border-bottom: 1px solid rgb(189, 24, 189)" --}}>
                            <div class="col fw-bold" style="color: #3C4043">
                                {{ $score }}
                            </div>
                            <div class="col text-end fw-bold" style="color: #3C4043">
                                {{ $outdate }}
                            </div>
                            <div style="height: 1px; width: 97%; background-color:rgb(189, 24, 189)" class="mt-3 mx-auto">
                            </div>
                        </div>
                        <div class="row w-100">
                            <div class="col fw-bold" style="color: #3C4043">
                                {{ $content }}
                            </div>
                        </div>
                        <div class="row w-100">
                            <div class="allFile mx-auto p-0  mt-3" style="height: auto;width: 97%">
                                <div class="w-100 h-100 d-flex " style="flex-wrap: wrap">
                                    @foreach ($files as $file)
                                        <div class="d-flex border-1 border me-3 mb-3 divContentFile">
                                            <img src="{{ asset($file['file_path']) }}" alt=""
                                                style="height: 100%; min-width: 30%; border-radius: 10px 0 0 10px;">
                                            <div style="height: 100%; width: 60%;">
                                                <a target="_blank" href="{{ asset($file['file_path']) }}"
                                                    class="ps-3 pe-3">{{ $file['file_name'] }}</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div style="height: 1px; width: 97%; background-color:rgb(189, 179, 179)" class="mt-3 mx-auto">
                            </div>
                        </div>

                        <div class="row w-100 mt-3">
                            <div class="showComment d-flex justify-content-start align-items-center" style="width: 100%;">
                                <div class="me-2 d-flex justify-content-start align-items-center" height: 30px; width:
                                    30px;>
                                    <i class="fa-solid fa-user-group " style="cursor: pointer; font-weight: bold"></i>
                                </div>
                                @php
                                    $numberComment = $comments->count();
                                @endphp
                                <div class="numberComment">{{ $numberComment }} nhận xét về lớp
                                    học
                                </div>
                            </div>
                        </div>
                        <div class="row w-100 mt-2">
                            <div class="allComment w-100 d-flex flex-column align-items-center mb-3" style="h-auto">
                                @foreach ($comments as $comment)
                                    <div class="divComment d-flex w-100 align-items-center justify-content-between mb-3">
                                        <div class="w-100 d-flex">
                                            <img class="rounded-circle" style="height: 50px; width: 50px"
                                                src="{{ asset('images/' . $comment->avatar) }}" alt="">
                                            <div class="ms-3 pt-1" style="height: auto">
                                                <div class=" d-flex flex-column " style="">
                                                    <div class="d-flex">
                                                        <div style="font-weight: bold; margin-right: 15px">
                                                            {{ $comment->hoten }}
                                                        </div>
                                                        {{ $comment->created_at }}
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <div class="divEditEnable" contenteditable="false">
                                                            {{ $comment->content }}
                                                        </div>
                                                        <div class="divAction mt-3" style="display: none">
                                                            <button
                                                                class="btn btn-secondary me-2 btnCancleEdit">Hủy</button>
                                                            <button data-id-comment="{{ $comment->id }}"
                                                                class="btn btn-primary btnSaveEdit">Lưu</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($user->giaovien_id == $comment->user_id || $user->hocsinh_id == $comment->user_id)
                                            <div class="divEditComment dropstart"
                                                style="height: 35px; width: 50px; text-align: center; line-height: 50px">
                                                <i class="fa-solid fa-ellipsis-vertical" id="dropdownMenuButton1"
                                                    data-bs-toggle="dropdown" aria-expanded="false"
                                                    style="cursor: pointer; height: 30px; width: 30px; font-weight: bold"></i>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <li class="dropdown-item btnEditComment" data-bs-toggle="modal"
                                                        href="" style="cursor: pointer">Chỉnh
                                                        sửa</li>

                                                    <form action="{{ url('comments/' . $comment->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item"
                                                            style="cursor: pointer">Xóa</button>
                                                    </form>

                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>

                            <div class="sendcomment w-100 d-flex align-items-center">
                                <div class="imguser rounded-circle" style="width: 7%">
                                    <img class="rounded-circle" src="{{ asset('images/' . $user->avatar) }}" alt=""
                                        style="height: 50px; width: 50px">
                                </div>
                                <div class="send ms-3 me-3 d-flex align-items-center" style="width: 93%; height: 85%;">
                                    <input class="h-100 w-100 rounded-pill form-control" name="comment"
                                        contenteditable="true">
                                    <i data-id-post="{{ $post->id }}" data-id-user="{{ $user->giaovien_id }}"
                                        class="fa-solid fa-paper-plane my-auto ms-2 btnsendcomment"
                                        style="cursor:pointer;height: auto; width: 2rem; font-size: 20px"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var btnsendcomment = document.querySelector('.btnsendcomment');

            var divComments = document.querySelectorAll('.divComment')
            btnsendcomment.addEventListener('click', function() {
                var inputvalue = document.querySelector('input[name="comment"]').value
                var token = document.head.querySelector('meta[name="csrf-token"]').content;
                var numberComment = document.querySelector('.numberComment')
                var iduser = btnsendcomment.getAttribute('data-id-user')
                var idpost = btnsendcomment.getAttribute('data-id-post')
                var formData = new FormData()
                formData.append('user_id', iduser)
                formData.append('post_id', idpost)
                formData.append('content', inputvalue)
                fetch('https://classroom.io.vn/comments', {
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': token
                        },
                        body: formData,
                    })
                    .then(res => res.json())
                    .then(data => {
                        inputvalue = ''
                        var comments = data['comments']
                        var count = comments.length
                        numberComment.textContent = `${count} nhận xét về lớp học`
                        updateComment(comments, iduser)
                        console.log(data['comments'])
                    })

                function updateComment(comments, iduser) {
                    var allComment = document.querySelector('.allComment')
                    var tmp = ''
                    comments.forEach(comment => {
                        tmp += `
                        <div class="divComment d-flex w-100 align-items-center justify-content-between mb-3">
                        <div class="w-100 d-flex">
                                    <img class="rounded-circle" style="height: 50px; width: 50px"
                                        src="https://classroom.io.vn/images/${comment['avatar']}" alt="">
                                    <div class="ms-3 pt-1" style="height: auto">
                                        <div class=" d-flex flex-column " style="">
                                            <div class="d-flex">
                                                <div style="font-weight: bold; margin-right: 15px">
                                                   ${comment.hoten}
                                                </div>
                                                ${comment.created_at}
                                            </div>
                                            <div class="d-flex flex-column">
                                                <div class="divEditEnable" contenteditable="false">
                                                    ${comment.content}
                                                </div>
                                                <div class="divAction mt-3" style="display: none">
                                                    <button class="btn btn-secondary me-2 btnCancleEdit">Hủy</button>
                                                    <button data-id-comments={{-- {{ $comment->id }} --}}
                                                        class="btn btn-primary btnSaveEdit">Lưu</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ${(iduser == comment['user_id']) ? `
                                    <div class="divEditComment dropstart"
                                        style="height: 35px; width: 50px; text-align: center; line-height: 50px">
                                        <i class="fa-solid fa-ellipsis-vertical" id="dropdownMenuButton1"
                                            data-bs-toggle="dropdown" aria-expanded="false"
                                            style="cursor: pointer; height: 30px; width: 30px; font-weight: bold"></i>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li class="dropdown-item btnEditComment" data-bs-toggle="modal"
                                                href="" style="cursor: pointer">Chỉnh
                                                sửa</li>

                                            <form action="" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item"
                                                    style="cursor: pointer">Xóa</button>
                                            </form>

                                        </ul>
                                    </div>`:''}

                                </div>
                        `
                    })
                    allComment.innerHTML = tmp
                }
            })

            divComments.forEach(divComment => {
                var btnEditComment = divComment.querySelector('.btnEditComment')
                var btnCancleEdit = divComment.querySelector('.btnCancleEdit')
                var divEditEnable = divComment.querySelector('.divEditEnable');
                var divAction = divComment.querySelector('.divAction')
                var token = document.head.querySelector('meta[name="csrf-token"]').content;
                var btnSaveEdit = divComment.querySelector('.btnSaveEdit')
                var idComment = btnSaveEdit.getAttribute('data-id-comment')
                btnSaveEdit.addEventListener('click', function() {
                    var inputEdit = divEditEnable.textContent.trim()
                    var formData = new FormData()
                    formData.append('valueInput', inputEdit)
                    formData.append('_method', 'PUT')
                    fetch(`https://classroom.io.vn/comments/${idComment}`, {
                            method: "POST",
                            headers: {
                                // No need to set 'Content-Type' for FormData
                                'X-CSRF-TOKEN': token
                            },
                            body: formData,
                        })
                        .then(() => {
                            window.location.reload()
                        })
                })
                if (btnEditComment) {
                    btnEditComment.addEventListener('click', function() {
                        divEditEnable.setAttribute('contenteditable', 'true');
                        divEditEnable.classList.add('border', 'border-1',
                            'border-primary',
                            'form-control')
                        divEditEnable.focus();
                        divAction.style.display = 'block'
                    });
                }
                btnCancleEdit.addEventListener('click', function() {
                    divEditEnable.setAttribute('contenteditable', 'false');
                    divEditEnable.classList.remove('border', 'border-1',
                        'border-primary',
                        'form-control')

                    divAction.style.display = 'none'
                })
            })

        })
    </script>
@endsection
