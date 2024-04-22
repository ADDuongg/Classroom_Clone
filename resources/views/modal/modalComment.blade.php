<div data-id-post="{{ $post->id }}" class="modal fade" id="exampleModal{{ $post->id }}" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nhận xét của lớp học</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="commentWrapper w-100 h-100">

                </div>
                <div class="sendcomment w-100 d-flex align-items-center">
                    <div class="imguser rounded-circle" style="width: 7%">
                        <img src="{{ asset('images/' . $user->avatar) }}" alt=""
                            style="height: 100%; width: 100%">
                    </div>
                    <div class="send ms-3 me-3 d-flex align-items-center" style="width: 93%; height: 85%;">
                        <input class="h-100 w-100 rounded-pill form-control" name="comment" contenteditable="true">
                        <i data-id-post="{{ $post->id }}" data-id-user="{{ $user->giaovien_id }}"
                            class="fa-solid fa-paper-plane my-auto ms-2 btnsendcomment"
                            style="cursor:pointer;height: auto; width: 2rem; font-size: 20px"></i>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modalElement = document.querySelector('#exampleModal{{ $post->id }}');
            var idpost = modalElement.getAttribute('data-id-post');
            modalElement.addEventListener('shown.bs.modal', function() {
                var btnsendcomment = modalElement.querySelector('.btnsendcomment')
                var user_id = btnsendcomment.getAttribute('data-id-user')
                function updateModalComment(data, user_id) {
                    var commentWrapper = modalElement.querySelector('.commentWrapper');
                    var dataUser = data['user'];
                    var dataComment = data['comments'];
                    var tm_p = ''
                    dataComment.forEach(comment => {
                        tm_p += `
                        <div class="allComment w-100 d-flex flex-column align-items-center mb-3" style="h-auto">
                            <div class="divComment d-flex w-100 align-items-center justify-content-between mb-3">
                                <div class="w-100 d-flex">
                                    <img class="rounded-circle" style="height: 50px; width: 50px"
                                        src="https://classroom.io.vn/images/${comment['avatar']}" alt="">
                                    <div class="ms-3 pt-1" style="height: auto">
                                        <div class=" d-flex flex-column " style="">
                                            <div class="d-flex">
                                                <div style="font-weight: bold; margin-right: 15px">
                                                    ${comment['hoten']}
                                                </div>
                                                ${comment['created_at']}
                                            </div>
                                            <div class="d-flex flex-column">
                                                <div class="divEditEnable" contenteditable="false">
                                                    ${comment['content']}
                                                </div>
                                                <div class="divAction mt-3" style="display: none">
                                                    <button class="btn btn-secondary me-2 btnCancleEdit">Hủy</button>
                                                    <button data-id-comment="${comment['id']}" class="btn btn-primary btnSaveEdit">Lưu</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ${(user_id == comment['user_id']) ? `
                                    <div class="divEditComment dropstart" style="height: 35px; width: 50px; text-align: center; line-height: 50px">
                                        <i class="fa-solid fa-ellipsis-vertical" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer; height: 30px; width: 30px; font-weight: bold"></i>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li class="dropdown-item btnEditComment" data-bs-toggle="modal" href="" style="cursor: pointer">Chỉnh sửa</li>
                                            <form action="{{ url('comments/') }}/${comment.id}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item" style="cursor: pointer">Xóa</button>
                                            </form>
                                        </ul>
                                    </div>
                                ` : ''}
                            </div>
                        </div>

                        `
                        commentWrapper.innerHTML = tm_p
                        var allComments = modalElement.querySelectorAll('.allComment')
                        allComments.forEach(allComment => {
                            var token = document.head.querySelector(
                                'meta[name="csrf-token"]').content;
                            var btnSaveEdit = allComment.querySelector('.btnSaveEdit')
                            var idComment = btnSaveEdit.getAttribute('data-id-comment')
                            btnSaveEdit.addEventListener('click', function() {
                                var inputEdit = divEditEnable.textContent.trim()
                                console.log(inputEdit);
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
                            var btnEditComment = allComment.querySelector('.btnEditComment')
                            var btnCancleEdit = allComment.querySelector('.btnCancleEdit')
                            var divEditEnable = allComment.querySelector('.divEditEnable');
                            var divAction = allComment.querySelector('.divAction')
                            if(btnEditComment){
                                btnEditComment.addEventListener('click', function() {
                                    divEditEnable.setAttribute('contenteditable',
                                        'true');
                                    divEditEnable.classList.add('border', 'border-1',
                                        'border-primary',
                                        'form-control')
                                    divEditEnable.focus();
                                    divAction.style.display = 'block'
                                });
                            }
                            btnCancleEdit.addEventListener('click', function() {
                                divEditEnable.setAttribute('contenteditable',
                                    'false');
                                divEditEnable.classList.remove('border', 'border-1',
                                    'border-primary',
                                    'form-control')

                                divAction.style.display = 'none'
                            })

                        })

                    });
                }
                console.log('Modal được hiển thị');
                var btnClose = modalElement.querySelector('.btn-close')






                btnClose.addEventListener('click', function() {
                    window.location.reload();
                })
                fetch(`https://classroom.io.vn/comments/${idpost}`)
                    .then(res => res.json())
                    .then(data => {
                        console.log(data)
                        updateModalComment(data, user_id)
                    });


                btnsendcomment.addEventListener('click', function() {
                    var inputvalue = modalElement.querySelector('input[name="comment"]').value
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
                            console.log(data);
                            var dataCMT = data['comments']
                            updateComment(dataCMT, user_id)
                        })

                    function updateComment(data, user_id) {
                        var commentWrapper = modalElement.querySelector('.commentWrapper');
                        var tmp = ''
                        data.forEach(comment => {
                            tmp += `
                        <div class="allComment w-100 d-flex flex-column align-items-center mb-3" style="h-auto">
                            <div class="divComment d-flex w-100 align-items-center justify-content-between mb-3">
                                <div class="w-100 d-flex">
                                    <img class="rounded-circle" style="height: 50px; width: 50px"
                                        src="https://classroom.io.vn/images/${comment['avatar']}" alt="">
                                    <div class="ms-3 pt-1" style="height: auto">
                                        <div class=" d-flex flex-column " style="">
                                            <div class="d-flex">
                                                <div style="font-weight: bold; margin-right: 15px">
                                                    ${comment['hoten']}
                                                </div>
                                                ${comment['created_at']}
                                            </div>
                                            <div class="d-flex flex-column">
                                                <div class="divEditEnable" contenteditable="false">
                                                    ${comment['content']}
                                                </div>
                                                <div class="divAction mt-3" style="display: none">
                                                    <button class="btn btn-secondary me-2 btnCancleEdit">Hủy</button>
                                                    <button class="btn btn-primary btnSaveEdit">Lưu</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ${(user_id == comment['user_id']) ? `
                                    <div class="divEditComment dropstart" style="height: 35px; width: 50px; text-align: center; line-height: 50px">
                                        <i class="fa-solid fa-ellipsis-vertical" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer; height: 30px; width: 30px; font-weight: bold"></i>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li class="dropdown-item btnEditComment" data-bs-toggle="modal" href="" style="cursor: pointer">Chỉnh sửa</li>
                                            <form action="{{ url('comments/') }}/${comment.id}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item" style="cursor: pointer">Xóa</button>
                                            </form>
                                        </ul>
                                    </div>
                                ` : ''}
                            </div>
                        </div>

                        `
                        })
                        commentWrapper.innerHTML = tmp
                    }
                })

            });
        });
    </script>
</div>
