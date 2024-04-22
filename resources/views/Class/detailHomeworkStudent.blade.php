@extends('layoutAll.master')

@section('header')
    @include('layoutStudent.header')
@endsection

@section('sidebar')
    @include('layoutStudent.sidebar')
@endsection

@section('content')
    <div class=" p-0 h-100 contentClass" style="overflow: auto;">
        <div class="container-fluid w-100 p-0 m-0 h-100">
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
                    $comments = DB::table('comments')
                        ->select([
                            'comments.*',
                            DB::raw('COALESCE(giaovien.giaovien_id, hocsinh.hocsinh_id) AS user_id'),
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
                <div class="divDetailHomework  mt-2 col-lg-8 p-0" style="height: auto;">
                    <div class="container w-100 mt-3 pe-0">
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

                        </div>
                    </div>
                    <div class="container w-100 mt-3 pe-0">
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
                                        <div
                                            class="d-flex border-1 border me-3 mb-3 divContentFile">
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
                                <div class="imguser rounded-circle" style="width: 4%">
                                    <img src="{{ asset('images/' . $user->avatar) }}" alt=""
                                        style="height: 100%; width: 100%">
                                </div>
                                <div class="send ms-3 me-3 d-flex align-items-center" style="width: 93%; height: 85%;">
                                    <input class="h-100 w-100 rounded-pill form-control" name="comment"
                                        contenteditable="true">
                                    <i data-id-post="{{ $post->id }}" data-id-user="{{ $user->hocsinh_id }}"
                                        class="fa-solid fa-paper-plane my-auto ms-2 btnsendcomment"
                                        style="cursor:pointer;height: auto; width: 2rem; font-size: 20px"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 p-0 shadow mt-3 mx-auto p-4"
                    style="border-radius: 15px; height: 50vh; border: 0.5px solid rgb(195, 195, 195)">
                    <div style="height: auto" class="w-100">
                        <div class="container  w-100  p-0 h-auto" style="">
                            <div class="row w-100 px-3 mx-auto">
                                <div class="col-8 p-0">
                                    <h5>Bài tập của bạn</h5>
                                </div>
                                <div class="col-4 text-end p-0 text-success status">Đã giao</div>
                            </div>
                            <div class="row  px-3 mt-3 mx-auto " style="width: 105%;;height: 150px; overflow-y: scroll">
                                <div class="h-auto w-100 p-0 divWrapper">
                                    {{--  <div class="mb-3 divFileStudent p-0 d-flex justify-content-between align-items-center border-1 border"
                                        style="border-radius: 10px">
                                        <div
                                            class="imgname ps-2 py-2 w-75 d-flex justify-content-start align-items-center">
                                            <div class="img h-100 w-25">
                                                <img src="{{ url('images/' . $user->avatar) }}" alt=""
                                                    class="h-100 w-100">
                                            </div>
                                            <div class="h-100 name w-25 ms-3">
                                                ảnh 1
                                            </div>
                                        </div>
                                        <div class="icon w-25 pe-2 h-100 d-flex align-items-center justify-content-end">
                                            <button class="btn-close"></button>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="action w-100 " style="height: 5vh">
                        <div data-id-user = "{{ $user->hocsinh_id }}" data-id-post = "{{ $post->id }}"
                            class="px-3 mx-auto mt-4 btncancle button border border-1"
                            style="height: 100%; width: 90%; color: #9B61CD; border-radius: 10px; display: none">
                            <div class="h-100 w-100 p-0 d-flex justify-content-center align-items-center">
                                <div>Hủy nộp bài</div>
                            </div>
                        </div>
                        <input type="file" name="homework" class="form-control  mx-auto mt-4 "
                            style="height: 100%; width: 90%; ">

                        <div data-id-user = "{{ $user->hocsinh_id }}" data-id-post = "{{ $post->id }}"
                            class="px-3 mx-auto mt-4 btnsubmit button"
                            style="height: 100%; width: 90%; background-color: #7627BB; border-radius: 10px">
                            <div class="h-100 w-100 p-0 d-flex justify-content-center align-items-center"
                                style="color: white">
                                <div>Nộp bài</div>
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
            var inputFile = document.querySelector('input[name="homework"]');
            var divWrapper = document.querySelector('.divWrapper');
            var btnsubmit = document.querySelector('.btnsubmit')
            var btncancle = document.querySelector('.btncancle')
            var status = document.querySelector('.status')
            var user_id = btnsubmit.getAttribute('data-id-user')
            var post_id = btnsubmit.getAttribute('data-id-post')
            var token = document.head.querySelector('meta[name="csrf-token"]').content;
            var cancleSubmit = false
            btncancle.addEventListener('click', function() {
                var formData = new FormData();
                btncancle.style.display = 'none'
                formData.append('user_id', user_id)
                formData.append('post_id', post_id)
                fetch(`https://api.classroom.io.vn/changeStatus`, {
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': token
                        },
                        body: formData,
                    })
                    .then(() => {
                        window.location.reload()
                        status.textContent = 'Đã giao'
                        inputFile.style.display = 'block'
                        btnsubmit.style.display = 'block'
                    })

            })
            var arr_file = []
            var old_file = []

            function updateHomework(data, statusFetch) {
                var tmp = '';
                data.forEach(item => {
                    tmp += `
                        <div class="mb-3 divFileStudent p-0 d-flex justify-content-between align-items-center border-1 border"
                            style="border-radius: 10px">
                            <a target="_blank" href="https://api.classroom.io.vn/${item['file_path']}"
                                class="imgname ps-2 py-2 w-75 d-flex justify-content-start align-items-center">
                                <div class="img h-100 w-25">
                                    <img src="https://api.classroom.io.vn/${item['file_path']}" alt=""
                                        class="h-100 w-100">
                                </div>
                                <div class="h-100 name w-25 ms-3">
                                    ${item['file_original_name']}
                                </div>
                            </a>
                            ${statusFetch === 1 ? '' : `
                                            <div class="icon w-25 pe-2 h-100 d-flex align-items-center justify-content-end">
                                                <button class="btn-close"></button>
                                            </div>
                                        `}
                        </div>
                `;
                });
                divWrapper.innerHTML = tmp;
            }

            fetch(`https://api.classroom.io.vn/fetchhomework/${post_id}/${user_id}`)
                .then(res => res.json())
                .then(data => {
                    var statusFetch = data['homework'][0].isSubmit
                    var dataContent = JSON.parse(data['homework'][0].content)
                    console.log(data);
                    dataContent['file'].forEach(item => {
                        old_file.push(item)
                    })
                    if (statusFetch === 1) {
                        status.textContent = 'Đã nộp'
                        btnsubmit.style.display = 'none'
                        inputFile.style.display = 'none'
                        btncancle.style.display = 'block'
                    }
                    console.log(old_file);
                    updateHomework(dataContent['file'], statusFetch)
                    var divFileStudent = document.querySelectorAll('.divFileStudent')
                    divFileStudent.forEach((item, index) => {
                        item.addEventListener('click', function(e) {
                            if (event.target.classList.contains('btn-close')) {
                                item.remove();
                                old_file.splice(index, 1);
                                console.log(old_file);
                            }
                        })
                    })

                })

            btnsubmit.addEventListener('click', function() {
                var divFileStudent = document.querySelectorAll('.divFileStudent')
                divFileStudent.forEach(item => {
                    var btnClose = item.querySelector('.btn-close')
                    btnClose.style.display = 'none'
                })

                btncancle.style.display = 'block'
                btnsubmit.style.display = 'none'
                inputFile.style.display = 'none'
                var old_file_json = JSON.stringify(old_file)
                var formData = new FormData()
                formData.append('user_id', user_id)
                formData.append('post_id', post_id)
                formData.append('old_file', old_file_json)
                formData.append('score', 0)
                arr_file.forEach(item => {
                    formData.append('file[]', item)
                })

                fetch(`https://api.classroom.io.vn/studentHomework`, {
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': token
                        },
                        body: formData,
                    })
                    .then(() => {
                        status.textContent = 'Đã nộp'
                    })

            })

            function removeSelectedFile(file) {
                var index = arr_file.indexOf(file);
                if (index !== -1) {
                    arr_file.splice(index, 1);
                    console.log(arr_file);
                }
            }
            inputFile.addEventListener('change', function() {
                var file = inputFile.files[0];
                arr_file.push(file);
                console.log(arr_file);
                var divFileStudent = document.createElement('div');
                divFileStudent.classList.add('mb-3', 'divFileStudent', 'p-0', 'd-flex',
                    'justify-content-between', 'align-items-center', 'border-1', 'border');
                divFileStudent.style.borderRadius = '10px';

                divFileStudent.addEventListener('click', function() {
                    if (event.target.classList.contains('btn-close')) {
                        console.log(123);
                        divFileStudent.remove();
                        removeSelectedFile(file);
                    }
                })

                var aTag = document.createElement('a');
                aTag.target = '_blank'
                aTag.href = URL.createObjectURL(file);
                aTag.classList.add('imgname', 'ps-2', 'py-2', 'w-75', 'd-flex', 'justify-content-start',
                    'align-items-center');

                var imgDiv = document.createElement('div');
                imgDiv.classList.add('img', 'h-100', 'w-25');
                var img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.alt = 'Ảnh';
                img.classList.add('h-100', 'w-100');
                imgDiv.appendChild(img);

                var nameDiv = document.createElement('div');
                nameDiv.classList.add('h-100', 'name', 'w-25', 'ms-3');
                nameDiv.textContent = file.name;

                aTag.appendChild(imgDiv);
                aTag.appendChild(nameDiv);

                var iconDiv = document.createElement('div');
                iconDiv.classList.add('icon', 'w-25', 'pe-2', 'h-100', 'd-flex', 'align-items-center',
                    'justify-content-end');
                var button = document.createElement('button');
                button.classList.add('btn-close');
                iconDiv.appendChild(button);

                divFileStudent.appendChild(aTag);
                divFileStudent.appendChild(iconDiv);

                divWrapper.appendChild(divFileStudent);
            });



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
                fetch('https://api.classroom.io.vn/comments', {
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
                        console.log(data)
                    })

                function updateComment(comments, iduser) {
                    var allComment = document.querySelector('.allComment')
                    var tmp = ''
                    comments.forEach(comment => {
                        tmp += `
                        <div class="divComment d-flex w-100 align-items-center justify-content-between mb-3">
                        <div class="w-100 d-flex">
                                    <img class="rounded-circle" style="height: 50px; width: 50px"
                                        src="https://api.classroom.io.vn/images/${comment['avatar']}" alt="">
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
                                            </div>
                                            `:''}
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
                    fetch(`https://api.classroom.io.vn/comments/${idComment}`, {
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
