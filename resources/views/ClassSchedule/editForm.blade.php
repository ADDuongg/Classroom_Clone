@extends('layoutadmin.master')

@section('sidebar')
    @include('layoutadmin.sidebar')
@endsection

@section('header')
    @include('layoutadmin.header')
@endsection

@section('content')
    <div class="d-flex flex-column align-items-center ps-4 pe-4"
        style="height: auto; z-index: 2;  width: 100%; padding-top: 0">
        {{-- text section --}}
        <div class="mt-0 text-center" style="width: 100%; height: 45px;">
            <p style="font-weight: bold; font-size: 25px">Kỳ học một, năm học 2024</p>
        </div>

        {{-- active class --}}
        <div class="activeclass  d-flex flex-column" style="width: 100%; height: 500px; border-radius: 20px">
            <div class="d-flex justify-content-between align-items-center mb-1 ps-3 pe-3"
                style="background-color: white; height: 90px; border-radius: 10px">
                <div class="me-3" style="font-weight: bold; font-size: 20px">Lịch học của lớp
                    <i class="fa-solid fa-graduation-cap fa-lg"></i>
                    @if ($classSchedules->isNotEmpty())
                        {{-- Lấy tên lớp từ một trong các lịch học --}}
                        {{ $classSchedules->first()->tenlop }}
                    @else
                        {{-- Nếu không có lịch học, hiển thị một giá trị mặc định --}}
                    @endif
                </div>
                @if (session('notice'))
                    <script>
                        alert("{{ session('notice') }}");
                    </script>
                @endif

                <div class="d-flex align-items-center">
                    <input type="search" class="form-control ms-3" style="width: 200px;"
                        placeholder="Nhập giá trị tìm kiếm...">
                    <button class="btn btn-primary ms-3">Tìm kiếm</button>
                </div>
            </div>
            <div class="w-100 text-end pe-3">
                <button id="undoButton" class="btn btn-secondary ">Hoàn tác</button>
            </div>
            <div class="d-flex flex-column justify-content-between">
                @php
                    $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']; // Danh sách các ngày trong tuần
                @endphp

                @foreach ($daysOfWeek as $day)
                    <div class="d-flex w-100 justify-content-start mt-3">
                        <p style="flex:1; font-size: 20px; font-weight: bold">{{ $day }}</p>
                        <div class="subject d-flex justify-content-start ms-3" style="flex:9">
                            @php
                                $lichhocsOfDay = $classSchedules->where('day', $day);
                            @endphp

                            @if ($lichhocsOfDay->isNotEmpty())
                                @foreach ($lichhocsOfDay as $lichhoc)
                                    <div data-schedule-tenlop = "{{ $lichhoc->tenlop }}"
                                        data-schedule-lichhocid = "{{ $lichhoc->lichhoc_id }}"
                                        data-schedule-lophocid = "{{ $lichhoc->lophoc_id }}"
                                        data-schedule-day="{{ $lichhoc->day }}" data-schedule-id="{{ $lichhoc->monhoc_id }}"
                                        class="btn btn-primary ms-2" style="width: 15%;">
                                        <div class="w-100 d-flex justify-content-end">
                                            <p style="width: 95%; margin:0">{{ $lichhoc->tenmon }}</p>
                                            <button class=" bg-primary border-primary btn btn-secondary dropdown-toggle"
                                                type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li class="text-center " data-bs-toggle="modal"
                                                    data-bs-target="#modalschedule"><a class="dropdown-item"
                                                        href="#">Sửa lịch</a></li>


                                                <li class="text-center btndelete dropdown-item">Xóa lịch</li>
                                            </ul>

                                        </div>
                                        <div>{{ $lichhoc->start }} - {{ $lichhoc->end }}</div>
                                    </div>
                                @endforeach
                            @else
                                <p>No classes scheduled for {{ $day }}.</p>
                            @endif
                        </div>
                    </div>
                @endforeach
                {{-- modal --}}
                <div class="modal fade" id="modalschedule">
                    <div class="modal-dialog {{-- modal-dialog-centered --}}">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="modal-title">Update Schedule</div>
                            </div>
                            <div class="modal-body">
                                <form class="formupdate d-flex flex-column justify-content-center align-items-center"
                                    style="width: 100%" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="mb-3 " style="width: 400px;">
                                        <label for="lophoc_id" class="form-label">lớp học</label>
                                        <input type="text" name="inputClass" readonly class="inputClass form-control">
                                        <input type="hidden" name="lophoc_id" class="inputClassHidden">
                                    </div>
                                    <div class="mb-3 " style="width: 400px;">
                                        <label for="monhoc_id" class="form-label">Chọn môn học</label>
                                        <select type="text" name="monhoc_id" class="form-select ">
                                            @foreach (getAllSubject() as $item)
                                                <option value="{{ $item->monhoc_id }}">{{ $item->tenmonhoc }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3 " style="width: 400px;">
                                        <label for="day" class="form-label">Ngày trong tuần</label>
                                        <select type="text" name="day" class="form-select ">
                                            @php
                                                $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                                            @endphp
                                            @foreach ($days as $day)
                                                <option value="{{ $day }}">{{ $day }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @php
                                        $hours = [];
                                        for ($i = 0; $i < 24; $i++) {
                                            $hours[] = sprintf('%02d:00', $i); // Thêm các giờ vào mảng
                                        }
                                    @endphp

                                    <!-- Select box cho giờ bắt đầu -->
                                    <div class="mb-3 d-flex justify-content-between" style="width: 400px;">
                                        <div class="d-flex me-3" style="width:50%">
                                            <label for="start" class="form-label">Bắt đầu</label>
                                            <select name="start" class="form-select w-100 h-75">
                                                @foreach ($hours as $hour)
                                                    <option value="{{ $hour }}">{{ $hour }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Select box cho giờ kết thúc -->
                                        <div class="d-flex "style="width:50%">
                                            <label for="end" class="form-label">Kết thúc</label>
                                            <select name="end" class="form-select w-100 h-75">
                                                @foreach ($hours as $hour)
                                                    <option value="{{ $hour }}">{{ $hour }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="mb-3 " style="width: 400px;">
                                        <label for="hocky" class="form-label">Học kỳ</label>
                                        <select type="text" name="hocky_id" class="form-select ">
                                            @foreach (getAllSection() as $item)
                                                <option value="{{ $item->hocky_id }}">{{ $item->hocky }} năm học
                                                    {{ $item->namhoc }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="modal-footer w-100 text-end">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="w-100 text-end pe-3">
                <button class="btn btn-primary btnsave" style="width: 89px;">Save</button>
            </div>
        </div>
    </div>
    <script>
        // JavaScript code
        document.addEventListener('DOMContentLoaded', function() {

            /* edit */
            const editButtons = document.querySelectorAll(
                '[data-bs-toggle="modal"][data-bs-target="#modalschedule"]');
            editButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    const scheduleDiv = event.target.closest('.btn');
                    var formupdate = document.querySelector('.formupdate')

                    const scheduleClassID = scheduleDiv.getAttribute('data-schedule-lichhocid');
                    const lophocId = scheduleDiv.getAttribute('data-schedule-tenlop');
                    var inputClassid = document.querySelector('input[name="inputClass"]');
                    var inputClassidHidden = document.querySelector('.inputClassHidden');
                    inputClassid.value = lophocId;
                    inputClassidHidden.value = scheduleClassID
                    formupdate.action = `{{ url('classschedule') }}/${scheduleClassID}`
                });
            });
            const form = document.querySelector('.formupdate');

            form.addEventListener('submit', function(event) {
                event.preventDefault();
                var inputClassidHidden = document.querySelector('.inputClassHidden');
                const formData = new FormData(form);

                const url = form.getAttribute('action');

                // Tạo một đối tượng từ FormData
                const data = {};
                formData.forEach((value, key) => {
                    data[key] = value;
                });

                const options = {
                    method: 'PUT',
                    body: JSON.stringify(data),
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                };

                fetch(url, options)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        alert(data['message'])
                        location.reload();
                        // Xử lý thành công ở đây
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // Xử lý lỗi ở đây
                    });

            });

            /* delete */
            const deletedSchedules = [];

            const deleteButtons = document.querySelectorAll('.btndelete');


            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    const scheduleDiv = event.target.closest('.btn');
                    var inputClassid = document.querySelector('input[name="inputClass"]');
                    const scheduleDay = scheduleDiv.getAttribute('data-schedule-day');
                    const scheduleId = scheduleDiv.getAttribute('data-schedule-id');
                    const scheduleClass = scheduleDiv.getAttribute('data-schedule-lophocid');
                    const scheduleClassID = scheduleDiv.getAttribute('data-schedule-lichhocid');


                    inputClassid.value = scheduleClass
                    // Lấy thông tin lịch học và lưu vào mảng deletedSchedules
                    const scheduleInfo = {
                        id: scheduleId,
                        day: scheduleDay,
                        classID: scheduleClass,
                        scheduleID: scheduleClassID
                    };
                    deletedSchedules.push(scheduleInfo);
                    console.log(deletedSchedules);
                    scheduleDiv.style.display = 'none';
                });

            });

            function undoDelete() {
                if (deletedSchedules.length > 0) {
                    const lastDeleted = deletedSchedules.pop();
                    const deletedScheduleDiv = document.querySelector(
                        `[data-schedule-lichhocid="${lastDeleted.scheduleID}"]`);
                    console.log(deletedSchedules);
                    deletedScheduleDiv.style.display = 'block';
                }
            }

            const undoButton = document.getElementById('undoButton');
            undoButton.addEventListener('click', function() {
                undoDelete();
            });

            /* save after delete */
            var btnsave = document.querySelector('.btnsave')
            btnsave.addEventListener('click', function() {
                if (deletedSchedules.length === 0) {
                    alert('Hãy xóa 1 môn học trong lịch trước khi lưu')
                } else {
                    var data = {}
                    
                    deletedSchedules.forEach((item, key) => {
                        data[key] = item['scheduleID']

                    })
                    fetch('/classschedule/deletegroup', {
                            method: 'POST',
                            body: JSON.stringify(deletedSchedules),
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute(
                                        'content')
                            }
                        }).then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            alert(data['message'])
                            location.reload();
                            
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            
                        });
                    
                }
            })
        });
    </script>
@endsection
