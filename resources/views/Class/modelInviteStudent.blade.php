<!-- Modal subteacher -->
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm học sinh vào lớp</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="height: 400px">
                <div class="getTeacherSelect1 pb-3 w-100 border-1 border-bottom d-flex flex-column"
                    style="height: 32%; overflow-y: auto">
                    <div data-id-class = "{{ $classroom->lophoc_id }}" class="getTeacherBysubteacher1"
                        style="height: auto">

                    </div>
                </div>
                <input type="text" name="searchName1" class="form-control w-100 mt-2 mb-2 "
                    placeholder="nhập tên giáo viên">
                <div class="dataTeacher1 w-100  border-1 border-top" style="overflow-y: auto; height: 58%;">
                    @foreach (getStudentNotBelongToClass() as $subTeacher)
                        <div data-id-div="{{ $subTeacher->hocsinh_id }}" class="subteacher1 w-100">
                            <div class=" w-100 p-2 d-flex" style="height: 20%; ">
                                <div class=" d-flex h-100 w-100 justify-content-start align-items-center">
                                    <img class="me-3" src="{{ asset('images/' . $subTeacher->avatar) }}"
                                        alt="" style="height: 100%; width: 15%;">
                                    <div>{{ $subTeacher->hoten }}</div>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="subteacher1" aria-label="Close"
                                    style="display: none"></button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="modal-footer" style="height: 10%">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal1">Hủy</button>
                <button type="button" class="btn btn-primary btn-invite-student">Mời</button>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var subteachers1 = document.querySelectorAll('.subteacher1');
            var getTeacherBysubteacher1 = document.querySelector('.getTeacherBysubteacher1');
            var token = document.head.querySelector('meta[name="csrf-token"]').content;
            var clonedSubTeachers1 = [];
            var btnInviteStudent = document.querySelector('.btn-invite-student')
            var idclass = getTeacherBysubteacher1.getAttribute('data-id-class')
            var data = {
                lophoc_id: idclass,
                hocsinh_id: clonedSubTeachers1
            };
            btnInviteStudent.addEventListener('click', function() {
                fetch('https://api.classroom.io.vn/studentclass/store', {
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
            subteachers1.forEach(function(subteacher) {
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
                    clonedSubteacher.classList.remove('subteacher1');
                    clonedSubteacher.classList.add('border', 'border-1', 'mb-2', 'cloneSubTeacher1');
                    getTeacherBysubteacher1.append(clonedSubteacher);

                    var btnClose = clonedSubteacher.querySelector('.btn-close');
                    var idTeacher = clonedSubteacher.getAttribute('data-id-div');

                    btnClose.style.display = 'block'
                    btnClose.addEventListener('click', function() {
                        var clone_subteacher = btnClose.closest('.cloneSubTeacher1')
                        var iddiv = clone_subteacher.getAttribute('data-id-div')

                        if (clone_subteacher) {
                            clone_subteacher.style.display = 'none';
                            subteacher.style.display = 'block'
                            // Tìm vị trí của id trong mảng và loại bỏ nó
                            var index = clonedSubTeachers1.indexOf(iddiv);
                            if (index !== -1) {
                                clonedSubTeachers1.splice(index, 1);
                            }
                            console.log(clonedSubTeachers1);
                        }
                    });

                    // Thêm idTeacher vào mảng
                    clonedSubTeachers1.push(idTeacher);
                    console.log(clonedSubTeachers1);
                });

                subteacher.addEventListener('mouseleave', function() {
                    subteacher.classList.remove('hover-effect');
                });
            });
        });
    </script>
</div>
