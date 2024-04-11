 <!-- Modal -->
 <div class="modal fade" data-id-post-edit = "{{ $post->id }}" id="editpost{{ $post->id }}" tabindex="-1"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content" style="height: auto; width: 120%;">

             <div class="bg-white" style="display: block; height: 100%; width: 100%;">
                 <div class="divpost w-100 shadow-lg p-4" style="height: 100%;border-radius:15px">
                     <div class="d-flex flex-column w-100">
                         <h6>Dành cho <div>{{ $post->id }}</div>
                         </h6>
                         <div class="d-flex w-75 justify-content-start mt-4">
                             <div class="dropdown">
                                 <button class="btn btn-secondary dropdown-toggle" type="button"
                                     id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
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
                             <div class="form-control inputModelEdit"
                                 style="height: 150px; width: 100%; box-sizing: border-box; vertical-align: top; border: 1px solid #ccc; padding: 8px;"
                                 contenteditable="true" placeholder="Thông báo nội dung nào đó cho lớp học của bạn...">
                             </div>
                             <div class="Divfile1" style="display: block">
                                 <div class="divAppend1 d-flex flex-column">
                                     <div class=" divContentFile1 d-flex flex-column mt-3">

                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="w-75 mt-4 w-100 d-flex justify-content-between">
                             <div>
                                 <input type="file" class="form-control divfile1" id="fileInput1">
                             </div>
                             <div>
                                 <button data-bs-dismiss="modal" class="btn btn-secondary btncancle">Hủy</button>
                                 <button data-id-user = "{{ auth()->user()->id_user }}"
                                     data-id-class="{{ $classroom->lophoc_id }}" class="btn btnpost1"
                                     style="background-color: orange;color: white">Update</button>
                             </div>
                         </div>

                     </div>
                 </div>
             </div>
         </div>

     </div>
     <script>
         document.addEventListener('DOMContentLoaded', function() {
             var modalElement = document.getElementById('editpost{{ $post->id }}');
             var id_post = modalElement.getAttribute('data-id-post-edit')
             modalElement.addEventListener('shown.bs.modal', function() {

                 var token = document.head.querySelector('meta[name="csrf-token"]').content;
                 var btnpost1 = modalElement.querySelector('.btnpost1');
                 var Divfile1 = modalElement.querySelector('.Divfile1')
                 var inputModelEdit = modalElement.querySelector('.inputModelEdit')
                 var selectedFiles1 = [];
                 var fileInput1 = modalElement.querySelector('#fileInput1');
                 var contentFileDiv1 = modalElement.querySelector('.contentFile1');
                 var divContentFile1 = modalElement.querySelector('.divContentFile1')
                 var divAppend1 = modalElement.querySelector('.divAppend1')


                 function updateInputFile(dataContent) {
                     var file_Input = dataContent['file'];
                     var t_m_p = '';

                     file_Input.forEach(item => {
                         t_m_p += `
                    <div class="divImgNameFile1 d-flex justify-content-between">
                        <div class="contentFile1 d-flex mt-3 justify-content-between">
                            <img src="http://localhost:8000/${item['file_path']}" style="width: 100px; height: 60px;" class="me-3">
                            <a target="_blank" href="${item['file_path']}">${item['file_original_name']}</a>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-trash" style="cursor: pointer; font-size: 20px;"></i>
                        </div>    
                    </div>
        `;
                     });
                     divContentFile1.innerHTML = t_m_p;
                 }
                 var arr_file_old = []
                 fetch(`http://localhost:8000/posts/${id_post}`)
                     .then(res => res.json())
                     .then(data => {
                         dataContent = JSON.parse(data['post'][0].content);
                         console.log(JSON.parse(data['post'][0].content));
                         inputModelEdit.textContent = dataContent['content'];
                         updateInputFile(dataContent);
                         dataContent['file'].forEach(item => {
                             arr_file_old.push(item)
                         })
                         var icon_trash_old = modalElement.querySelectorAll('.fa-trash');
                         icon_trash_old.forEach((item) => {
                             item.addEventListener('click', function() {
                                 var divImgNameFile = item.closest('.divImgNameFile1');
                                 arr_file_old.forEach((old_file, index) => {
                                     arr_file_old.splice(index, 1);
                                     divImgNameFile.remove();
                                     console.log(arr_file_old);
                                 })
                             });
                         });
                         console.log(icon_trash_old);
                         console.log(arr_file_old);
                     });



                 btnpost1.addEventListener('click', function() {
                     idclass = btnpost1.getAttribute('data-id-class')
                     iduser = btnpost1.getAttribute('data-id-user')
                     var inputPost1 = document.querySelector('.inputModelEdit').textContent
                     console.log(idclass);
                     var form_data = new FormData();
                     form_data.append('_method', 'PUT');
                     form_data.append('class_id', idclass);
                     form_data.append('user_id', iduser);
                     form_data.append('content', inputPost1);
                     for (var i = 0; i < selectedFiles1.length; i++) {
                         form_data.append('file[]', selectedFiles1[i]);
                     }
                     form_data.append('old_file', JSON.stringify(arr_file_old));
                     /* console.log(form_data); */
                     fetch(`http://localhost:8000/posts/${id_post}`, {
                             method: "POST",
                             headers: {
                                 // No need to set 'Content-Type' for form_data
                                 'X-CSRF-TOKEN': token
                             },
                             body: form_data,
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


                 function removeSelectedFile1(file1) {
                     var index = selectedFiles1.indexOf(file1);
                     if (index !== -1) {
                         selectedFiles1.splice(index, 1);
                     }
                 }
                 fileInput1.addEventListener('change', function() {
                     var file1 = fileInput1.files[0];
                     Divfile1.style.display = 'block'
                     if (file1) {
                         selectedFiles1.push(file1);
                         console.log(selectedFiles1);
                         var isImage1 = /\.(jpe?g|png|gif)$/i.test(file1.name);
                         var fileURL1 = URL.createObjectURL(file1);
                         var contentFileDiv1 = document.createElement('div');
                         contentFileDiv1.classList.add('contentFile', 'd-flex', 'mt-3',
                             'justify-content-between');
                         if (isImage1) {
                             var reader = new FileReader();
                             reader.onload = function(e) {

                                 var imgElement1 = document.createElement('img');
                                 imgElement1.src = e.target.result;
                                 imgElement1.classList.add('me-3');
                                 imgElement1.alt = file1.name;

                                 imgElement1.style.width = '100px';
                                 imgElement1.style.height = '60px';
                                 contentFileDiv1.appendChild(imgElement1);

                                 var fileNameElement1 = document.createElement('a');
                                 fileNameElement1.target = "_blank"
                                 fileNameElement1.href = fileURL1;
                                 fileNameElement1.textContent = file1.name
                                 contentFileDiv1.appendChild(fileNameElement1);

                                 var divImgNameFile1 = document.createElement('div');
                                 divImgNameFile1.classList.add('divImgNameFile', 'd-flex',
                                     'justify-content-between');

                                 var ellipsisDiv1 = document.createElement('div');
                                 ellipsisDiv1.classList.add('d-flex', 'align-items-center');
                                 var ellipsisIcon1 = document.createElement('i');
                                 ellipsisIcon1.classList.add('fa-solid', 'fa-trash');
                                 ellipsisIcon1.style.cursor = "pointer";
                                 ellipsisIcon1.style.fontSize = '20px';

                                 ellipsisDiv1.addEventListener('click', function(event) {
                                     if (event.target.classList.contains('fa-trash')) {
                                         divImgNameFile1.remove();
                                         removeSelectedFile1(file1);
                                     }
                                 });
                                 ellipsisDiv1.appendChild(ellipsisIcon1)
                                 divImgNameFile1.appendChild(contentFileDiv1)
                                 divImgNameFile1.appendChild(ellipsisDiv1)

                                 divContentFile1.appendChild(divImgNameFile1);
                                 divAppend1.appendChild(divContentFile1);


                             };

                             reader.readAsDataURL(file1);
                         } else {
                             var iconFile1 = document.createElement('i');
                             iconFile1.classList.add('fa-regular', 'fa-file', 'me-3');
                             iconFile1.style.fontSize = '60px';
                             contentFileDiv1.appendChild(iconFile1);

                             var fileNameElement1 = document.createElement('a');
                             fileNameElement1.target = "_blank"
                             fileNameElement1.href = fileURL1;
                             fileNameElement1.textContent = file1.name
                             contentFileDiv1.appendChild(fileNameElement1);

                             var divImgNameFile1 = document.createElement('div');
                             divImgNameFile1.classList.add('divImgNameFile', 'd-flex',
                                 'justify-content-between');
                             divImgNameFile1.appendChild(contentFileDiv1)

                             var ellipsisDiv1 = document.createElement('div');
                             ellipsisDiv1.classList.add('d-flex', 'align-items-center');
                             var ellipsisIcon1 = document.createElement('i');
                             ellipsisIcon1.classList.add('fa-solid', 'fa-trash');
                             ellipsisIcon1.style.cursor = "pointer";
                             ellipsisIcon1.style.fontSize = '20px';

                             ellipsisDiv1.appendChild(ellipsisIcon1)

                             divImgNameFile1.appendChild(ellipsisDiv1)

                             divContentFile1.appendChild(divImgNameFile1);
                             divAppend1.appendChild(divContentFile1);
                         }
                     }
                 });
             });
         })
     </script>
 </div>
