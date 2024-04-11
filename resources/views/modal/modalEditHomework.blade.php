<div class="modal fade" data-id-homework={{ $post->id }} id="edithomework{{ $post->id }}" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            @csrf
            <div class="modal-header">
                <div class="d-flex align-items-center">
                    <div style="width: 40px; height: 40px; background-color: #F3E8FD"
                        class="rounded-circle d-flex justify-content-center align-items-center">
                        <i class="fa-regular fa-file-lines" style="color: #9334E6; font-size: 20px"></i>
                    </div>
                    <h5 class="modal-title ms-3" id="exampleModalLabel">Chỉnh sửa bài tập</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0 w-100" style="background-color: #F8F9FA">
                <div class="container-fluid p-0 h-100">
                    <div class="row w-100 h-100">
                        <div
                            class="col-lg-9 col-md-6 col-sm-12 p-0 h-100 d-flex justify-content-center align-items-center ">
                            <div class="container p-3"
                                style="background-color: white;width: 80%; height: 80%;border-radius: 16px">
                                <div class="row w-100 m-0  mb-3" style="height: 15%">
                                    <input class="w-100 form-control h-100" name="header" placeholder="Tiêu đề"
                                        style="background-color: #F1F3F4">
                                </div>
                                <div class="row w-100 m-0  mb-3" style="height: 15%">
                                    <input class="w-100 form-control h-100" name="content"
                                        placeholder="Hướng dẫn(không bắt buộc)" style="background-color: #F1F3F4">
                                </div>
                                <div class="row w-100 m-0 divAllFile" style="height: auto">
                                    <div class="w-100 mt-2 divDisplay"
                                        style="height: 270px; overflow: auto; display: block">
                                        <div class="w-100 mt-2 divFileWrapper d-flex flex-column" style="height: 250px">
                                            {{-- <div class=" d-flex justify-content-between divFile mb-3"
                                                style="height: 30%; width: 100%;">
                                                <div class="w-100 h-100 d-flex">
                                                    <img src="https://th.bing.com/th/id/OIP.A-mn7nSruBp2nzOKOEnUOAHaGF?w=216&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7"
                                                        alt="" style="height: 100%; width: 15%;">
                                                    <div class="ms-3">
                                                        <a href="">name file</a>
                                                    </div>
                                                </div>

                                                <div class="h-100 d-flex align-items-center">
                                                    <i class="fa-solid fa-trash"
                                                        style="font-size: 20px; color: red"></i>
                                                </div>
                                            </div> --}}

                                        </div>
                                    </div>
                                </div>
                                <div class="row w-100 m-0" style="">
                                    <input class="mt-2 form-control" type="file" name="file"
                                        class="w-100 form-control h-100" type="file">
                                </div>
                            </div>
                        </div>
                        <div class="pt-5  col-lg-3 col-md-6 col-sm-12 pe-3 ps-3 bg-white h-100">
                            <div class="container h-100 w-100">

                                <div class="mb-3 row text-center">
                                    <label for="class">Dành cho</label>
                                    <select name="classID" id="" class="form-select w-50 mt-2 "
                                        style="background-color: #F1F3F4">
                                        @foreach (getAllClass() as $item)
                                            <option value="{{ $item->lophoc_id }}">{{ $item->tenlop }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 row">
                                    <label for="class">Điểm tối đa</label>
                                    <input type="text" name="maxScore" style="background-color: #F1F3F4"
                                        class="form-control w-50 mt-2" placeholder="VD: 100">
                                </div>
                                <div class="mb-3 row">
                                    <label for="class">Hạn nộp</label>
                                    <input type="date" name="date" style="background-color: #F1F3F4"
                                        class="form-control w-50 mt-2">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button data-id-user = "{{ auth()->user()->id_user }}" type="submit"
                    class="btn btn-primary btnaddhomework" data-id-class="{{ $classroom->lophoc_id }}">Thêm</button>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modalElement = document.getElementById('edithomework{{ $post->id }}');
            var id_post = modalElement.getAttribute('data-id-homework')
            modalElement.addEventListener('shown.bs.modal', function() {
                var arrFile1 = []
                var arr_file_old = []
                var btnaddhomework = modalElement.querySelector('.btnaddhomework')
                var divDisplay = modalElement.querySelector('.divDisplay')
                var fileList = modalElement.querySelector('.divFileWrapper');
                var lophoc_id = btnaddhomework.getAttribute('data-id-class')
                var header = modalElement.querySelector('input[name="header"]')
                var content = modalElement.querySelector('input[name="content"]')
                var date = modalElement.querySelector('input[name="date"]')
                var maxScore = modalElement.querySelector('input[name="maxScore"]')
                var fileInput = modalElement.querySelector('input[name="file"]')
                var token = document.head.querySelector('meta[name="csrf-token"]').content;

                function updateFile(dataContent) {
                    var file_Input = dataContent['file'];
                    var t_m_p = '';

                    file_Input.forEach(item => {
                        t_m_p += `
                        <div class=" d-flex justify-content-between divFile1 mb-3"
                            style="height: 30%; width: 100%;">
                            <div class="w-100 h-100 d-flex">
                                <img src="http://localhost:8000/${item['file_path']}"
                                    alt="" style="height: 100%; width: 15%;">
                                <div class="ms-3">
                                    <a target="_blank" href="url('${item['file_path']}')">${item['file_original_name']}</a>
                                </div>
                            </div>

                            <div class="h-100 d-flex align-items-center">
                                <i class="fa-solid fa-trash"
                                    style="font-size: 20px; color: red; cursor:pointer"></i>
                            </div>
                        </div>
                        `
                    })
                    fileList.innerHTML = t_m_p

                }


                function removeSelectedFile1(file1) {
                    var index = arrFile.indexOf(file1);
                    if (index !== -1) {
                        arrFile.splice(index, 1);
                    }
                }

                fetch(`http://localhost:8000/homework/${id_post}`)
                    .then(res => res.json())
                    .then(data => {
                        dataContent = JSON.parse(data['post'][0].content);
                        updateFile(dataContent);
                        console.log(data['post']);
                        dataContent['file'].forEach(item => {
                            arr_file_old.push(item)
                        })
                        var dateObject = new Date(data['post'][0].date);
                        var formattedDate =
                            `${dateObject.getFullYear()}-${(dateObject.getMonth() + 1).toString().padStart(2, '0')}-${dateObject.getDate().toString().padStart(2, '0')}`;
                        header.value = dataContent['header']
                        content.value = dataContent['content']
                        date.value = formattedDate
                        maxScore.value = data['post'][0].maxscore
                        var icon_trash_old = modalElement.querySelectorAll('.fa-trash');
                        console.log(icon_trash_old);
                        icon_trash_old.forEach((item) => {
                            item.addEventListener('click', function() {
                                var divFile = item.closest('.divFile1');
                                arr_file_old.forEach((old_file, index) => {
                                    arr_file_old.splice(index, 1);
                                    divFile.remove();
                                    console.log(arr_file_old);
                                })
                            });
                        });
                    });


                fileInput.addEventListener('change', function() {
                    var file = this.files[0];
                    arrFile1.push(file);
                    divDisplay.style.display = 'block'
                    var isImage = /\.(jpe?g|png|gif)$/i.test(file.name);
                    var fileURL = URL.createObjectURL(file);
                    if (isImage) {

                        var divFile = document.createElement('div');
                        divFile.className = 'd-flex divFile1 justify-content-between mb-3';
                        divFile.style.height = '30%';
                        divFile.style.width = '100%';


                        var imgDiv = document.createElement('div');
                        imgDiv.className = 'w-100 h-100 d-flex';
                        var img = document.createElement('img');
                        img.alt = '';
                        img.style.height = '100%';
                        img.style.width = '15%';
                        imgDiv.appendChild(img);
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            img.src = e.target.result;
                        };
                        reader.readAsDataURL(file);

                        var fileDetailsDiv = document.createElement('div');
                        fileDetailsDiv.className = 'ms-3';
                        var fileNameLink = document.createElement('a');
                        fileNameLink.href = '#';
                        fileNameLink.textContent = file.name;
                        fileDetailsDiv.appendChild(fileNameLink);


                        var deleteDiv = document.createElement('div');
                        deleteDiv.className = 'h-100 d-flex align-items-center';
                        var trashIcon = document.createElement('i');
                        trashIcon.className = 'fa-solid fa-trash';
                        trashIcon.style.fontSize = '20px';
                        trashIcon.style.color = 'red';
                        trashIcon.style.cursor = 'pointer';
                        deleteDiv.appendChild(trashIcon);

                        deleteDiv.addEventListener('click', function(event) {
                            if (event.target.classList.contains('fa-trash')) {
                                divFile.remove();
                                removeSelectedFile1(file);
                            }
                        });

                        imgDiv.appendChild(fileDetailsDiv);
                        divFile.appendChild(imgDiv);
                        divFile.appendChild(deleteDiv);


                        fileList.appendChild(divFile);
                        console.log(arrFile1);
                    }


                });
                btnaddhomework.addEventListener('click', function() {
                    idclass = btnaddhomework.getAttribute('data-id-class')
                    iduser = btnaddhomework.getAttribute('data-id-user')
                    var header = modalElement.querySelector('input[name="header"]').value
                    var content = modalElement.querySelector('input[name="content"]').value
                    var date = modalElement.querySelector('input[name="date"]').value
                    var maxScore = modalElement.querySelector('input[name="maxScore"]').value
                    var formData = new FormData()

                    formData.append('_method', 'PUT');
                    formData.append('lophoc_id', idclass)
                    formData.append('header', header)
                    formData.append('content', content)
                    formData.append('date', date)
                    formData.append('user_id', iduser)
                    formData.append('maxScore', maxScore)
                    arrFile1.forEach(item => {
                        formData.append('file[]', item);
                    })
                    formData.append('old_file', JSON.stringify(arr_file_old));
                    /* console.log(form_data); */
                    fetch(`http://localhost:8000/homework/${id_post}`, {
                            method: "POST",
                            headers: {
                                // No need to set 'Content-Type' for form_data
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
            })
        })
        /*  document.addEventListener('DOMContentLoaded', function() {
             var arrFile = []
             var btnaddhomework = document.querySelector('.btnaddhomework')
             var divDisplay = document.querySelector('.divDisplay')
             var fileList = document.querySelector('.divFileWrapper');
             var lophoc_id = btnaddhomework.getAttribute('data-id-class')

             var fileInput = document.querySelector('input[name="file"]')
             var token = document.head.querySelector('meta[name="csrf-token"]').content;
             btnaddhomework.addEventListener('click', function() {
                 
                 var user_id = btnaddhomework.getAttribute('data-id-user')
                 var header = document.querySelector('input[name="header"]').value
                 var content = document.querySelector('input[name="content"]').value
                 var date = document.querySelector('input[name="date"]').value
                 var maxScore = document.querySelector('input[name="maxScore"]').value
                 var formData = new FormData()
                 formData.append('lophoc_id', lophoc_id)
                 formData.append('header', header)
                 formData.append('content', content)
                 formData.append('date', date)
                 formData.append('user_id', user_id)
                 formData.append('maxScore', maxScore)
                 arrFile.forEach(item => {
                     formData.append('file[]', item);
                 })
                 fetch('http://localhost:8000/homework/store', {
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
             })

             function removeSelectedFile(file) {
                 var index = arrFile.indexOf(file);
                 if (index !== -1) {
                     arrFile.splice(index, 1);
                 }
                 console.log(arrFile);
             }
             fileInput.addEventListener('change', function() {
                 var file = this.files[0];
                 arrFile.push(file);
                 divDisplay.style.display = 'block'
                 var isImage = /\.(jpe?g|png|gif)$/i.test(file.name);
                 var fileURL = URL.createObjectURL(file);
                 if (isImage) {

                     var divFile = document.createElement('div');
                     divFile.className = 'd-flex divFile justify-content-between mb-3';
                     divFile.style.height = '30%';
                     divFile.style.width = '100%';


                     var imgDiv = document.createElement('div');
                     imgDiv.className = 'w-100 h-100 d-flex';
                     var img = document.createElement('img');
                     img.src = 'https://th.bing.com/th/id/OIP.A-mn7nSruBp2nzOKOEnUOAHaGF?w=216&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7';
                     img.alt = '';
                     img.style.height = '100%';
                     img.style.width = '15%';
                     imgDiv.appendChild(img);
                     var reader = new FileReader();
                     reader.onload = function(e) {
                         img.src = e.target.result;
                     };
                     reader.readAsDataURL(file);

                     var fileDetailsDiv = document.createElement('div');
                     fileDetailsDiv.className = 'ms-3';
                     var fileNameLink = document.createElement('a');
                     fileNameLink.href = '#';
                     fileNameLink.textContent = file.name;
                     fileDetailsDiv.appendChild(fileNameLink);


                     var deleteDiv = document.createElement('div');
                     deleteDiv.className = 'h-100 d-flex align-items-center';
                     var trashIcon = document.createElement('i');
                     trashIcon.className = 'fa-solid fa-trash';
                     trashIcon.style.fontSize = '20px';
                     trashIcon.style.color = 'red';
                     trashIcon.style.cursor = 'pointer';
                     deleteDiv.appendChild(trashIcon);

                     deleteDiv.addEventListener('click', function(event) {
                         if (event.target.classList.contains('fa-trash')) {
                             divFile.remove();
                             removeSelectedFile(file);
                         }
                     });

                     imgDiv.appendChild(fileDetailsDiv);
                     divFile.appendChild(imgDiv);
                     divFile.appendChild(deleteDiv);


                     fileList.appendChild(divFile);
                     console.log(arrFile);
                 }


             });

         }) */
    </script>
</div>
