<!-- Modal subteacher -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm giáo viên vào lớp</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="height: 400px">
                <div class="getTeacherSelect pb-3 w-100 border-1 border-bottom d-flex flex-column"
                    style="height: 32%; overflow-y: auto">
                    <div data-id-class = "{{ $classroom->lophoc_id }}" class="getTeacherBysubteacher"
                        style="height: auto">

                    </div>
                </div>
                <input type="text" name="searchName" class="form-control w-100 mt-2 mb-2 "
                    placeholder="nhập tên giáo viên">
                <div class="dataTeacher w-100  border-1 border-top" style="overflow-y: auto; height: 58%;">
                    @foreach (getAllTeacher() as $subTeacher)
                        @if ($subTeacher->giaovien_id != $user->giaovien_id)
                            <div data-id-div="{{ $subTeacher->giaovien_id }}" class="subteacher w-100">
                                <div class=" w-100 p-2 d-flex" style="height: 20%; ">
                                    <div class=" d-flex h-100 w-100 justify-content-start align-items-center">
                                        <img class="me-3" src="{{ asset('images/' . $subTeacher->avatar) }}"
                                            alt="" style="height: 100%; width: 15%;">
                                        <div>{{ $subTeacher->hoten }}</div>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="subteacher"
                                        aria-label="Close" style="display: none"></button>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="modal-footer" style="height: 10%">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-primary btn-invite-teacher">Mời</button>
            </div>
        </div>
    </div>
</div>
