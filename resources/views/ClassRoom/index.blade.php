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
        <div class="mt-3 text-center" style="width: 100%; height: 45px;">
            <p style="font-weight: bold; font-size: 25px">Kỳ học một, năm học 2024</p>
        </div>

        {{-- active class --}}
        <div class="activeclass  d-flex flex-column" style="width: 100%; height: 500px; border-radius: 20px">
            <div class="d-flex justify-content-between align-items-center mb-3 ps-3 pe-3"
                style="background-color: white; height: 90px; border-radius: 10px">
                <div class="me-3" style="font-weight: bold; font-size: 20px">Danh sách lớp học
                    <i class="fa-solid fa-graduation-cap fa-lg"></i>
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

            <div class="d-flex align-items-center justify-content-between ps-4 pe-4" style="width: 100%;">
                <div style="width: 100%; height: 40px;" class="d-flex align-items-center">
                    <label for="form-label">Show</label>
                    <select class=" ms-3 form-select" style="width: 70px;">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                    </select>
                </div>
                <div class="d-flex" style="height: 40px">
                    {{-- <select name="" id="" class="form-select me-3" style="width: 150px;">
                        @foreach (getAllParent() as $item)
                            <option value="{{ $item->phuhuynh_id }}">{{ $item->hoten }}</option>
                        @endforeach
                    </select>
                    <select name="" id="" class="form-select" style="width: 150px;">
                        @foreach (getAllParent() as $item)
                            <option value="{{ $item->phuhuynh_id }}">{{ $item->hoten }}</option>
                        @endforeach
                    </select> --}}
                    <button class="btn btn-primary d-flex justify-content-center align-items-center"><i
                            class="fa-solid fa-filter me-2"></i>Lọc</button>
                </div>
            </div>

            <table class="table table-striped" style="height: 100%; width: 100%">
                <thead>
                    <tr>
                        {{-- <th>#</th> --}}
                        <th>Tên lớp học</th>
                        <th>Giáo viên chủ nhiệm</th>
                        <th>Giáo viên phụ</th>
                        <th>Số lượng học sinh</th>
                        <th>Học kỳ</th>
                        <th>Năm học</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classrooms as $classroom)
                        @php
                            $id = uniqid();
                        @endphp
                        <tr class="w-auto">
                            {{-- <td>{{ $monhoc->monhoc_id }}</td> --}}
                            <th scope="row">{{ $classroom->tenlop }}</th>
                            <td>{{ $classroom->tengiaovien }}</td>

                            <td class="">
                                <select name="subteacher" id="" class="form-select m-auto" style="width: 80%;">
                                    @foreach (getSubTeacherBelongToClass($classroom->lophoc_id) as $item)
                                        <option value="">{{$item->hoten}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>{{ $classroom->soluong }}</td>
                            <td>{{ $classroom->tenhocky }}</td>
                            <td>{{ $classroom->namhoc }}</td>
                            <td>
                                <button class="btn btn-info dropdown-toggle" id="navbarDropdown" data-bs-toggle="dropdown"
                                    style="color: white">Action
                                    {{-- <i class="fa-solid fa-caret-down fa-lg ms-3"></i> --}}
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><button data-name = "{{ $classroom->tenlop }}" type="button"
                                            class="view w-100 btn btn-light d-flex justify-content-start align-items-center"
                                            data-bs-toggle="modal" data-bs-target="#modal"
                                            data-idclass="{{ $classroom->lophoc_id }}">
                                            <i class="fa-solid fa-eye me-3"></i>Xem lịch học
                                        </button>
                                    </li>
                                    <li><a class=" dropdown-item d-flex justify-content-start align-items-center"
                                        href="{{ url('addSubteacher/' . $classroom->lophoc_id) }}"><i
                                            class="me-3 fa-solid fa-plus"></i>Thêm giáo viên bộ môn</a></li>
                                    <li><a class=" dropdown-item d-flex justify-content-start align-items-center"
                                            href="{{ url('classschedule/' . $classroom->lophoc_id) . '/edit' }}"><i
                                                class="me-3 fa-solid fa-pen"></i>Sửa lịch học</a></li>
                                    <li><a class=" dropdown-item d-flex justify-content-start align-items-center"
                                            href="{{ url('classroom/' . $classroom->lophoc_id) . '/edit' }}"><i
                                                class="me-3 fa-solid fa-pen"></i>Sửa lớp học</a></li>
                                    <li><a class=" dropdown-item d-flex justify-content-start align-items-center"
                                            href="{{ url('numberStudent/create/' . $classroom->lophoc_id) }}"><i
                                                class="me-3 fa-solid fa-plus"></i>Thêm học sinh</a></li>
                                    <li><a class=" dropdown-item d-flex justify-content-start align-items-center"
                                            href="{{ url('numberStudent/deleteform/' . $classroom->lophoc_id) }}"><i
                                                class="me-3 fa-solid fa-minus"></i>Xóa học sinh</a></li>
                                    <li>
                                        <form action="{{ url('classroom/' . $classroom->lophoc_id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class=" dropdown-item d-flex justify-content-start align-items-center">
                                                <i class="me-3 fa-solid fa-trash"></i>Xóa lớp học
                                            </button>
                                        </form>

                                    </li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach

                </tbody>

            </table>
            <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg ">
                    <div class="modal-content" style="width: 800px;">
                        <div class="modal-header">
                            <h5 class="modal-title text-center w-100" id="exampleModalLabel">

                            </h5>

                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body d-flex flex-column justify-content-between">


                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="d-flex justify-content-start align-items-center mb-3"
                style="background-color: white; height: 90px;">
            </div> --}}
            </div>
        </div>
        <script>
            var section = document.querySelector('.modal-title');
            document.querySelectorAll('.view').forEach(btn => {
                btn.addEventListener('click', () => {
                    const classroomId = btn.getAttribute('data-idclass');
                    var nameclass = btn.getAttribute('data-name')
                    console.log(nameclass);
                    fetch(`/classschedule/${classroomId}`)
                        .then(response => response.json())
                        .then(data => {
                            const modalBody = document.querySelector('.modal-body');
                            modalBody.innerHTML = '';
                            console.log(data);
                            if (data.length === 0) {
                                var btnadd = document.createElement('a')
                                btnadd.className = 'btn btn-primary'
                                btnadd.href = 'classschedule/create'
                                btnadd.textContent = 'Thêm lịch học'
                                section.textContent = `Lịch học của ${nameclass}`
                                modalBody.innerHTML = 'chưa có lịch';
                                modalBody.appendChild(btnadd);

                            } else {
                                section.textContent = `Lịch học của ${nameclass}`
                                /* + ' ' + data[0]['hocky'] + ' ' +
                                                                    `năm học ${data[0]['namhoc']}` */
                                ;


                                const daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday',
                                    'Saturday', 'Sunday'
                                ];

                                daysOfWeek.forEach(day => {

                                    const lichhocsOfDay = data.filter(item => item.day === day);

                                    const dayElement = document.createElement('div');
                                    dayElement.classList.add('d-flex', 'w-100',
                                        'justify-content-start',
                                        'mt-3');

                                    const dayTitle = document.createElement('p');
                                    dayTitle.style.width = '15%';
                                    dayTitle.style.fontSize = '20px';
                                    dayTitle.style.fontWeight = 'bold';
                                    dayTitle.textContent = day;

                                    const subjectsContainer = document.createElement('div');
                                    subjectsContainer.classList.add('subject', 'd-flex',
                                        'justify-content-start', 'ms-3');
                                    subjectsContainer.style.width = '85%';

                                    if (lichhocsOfDay.length > 0) {
                                        lichhocsOfDay.forEach(lichhoc => {
                                            const button = document.createElement('button');
                                            button.className = 'btn btn-primary ms-2';
                                            button.style.width = '20%';
                                            button.style.height = '60px';
                                            const subjectName = document.createElement('p');
                                            subjectName.textContent = lichhoc.tenmon;
                                            subjectName.style.margin = "0"
                                            const timeInfo = document.createElement('div');
                                            timeInfo.innerHTML =
                                                `${lichhoc.start} - ${lichhoc.end}`;

                                            button.appendChild(subjectName);
                                            button.appendChild(timeInfo);

                                            subjectsContainer.appendChild(button);
                                        });
                                    } else {
                                        const message = document.createElement('p');
                                        message.textContent = `No classes scheduled for ${day}`;
                                        subjectsContainer.appendChild(message);
                                    }

                                    dayElement.appendChild(dayTitle);
                                    dayElement.appendChild(subjectsContainer);
                                    modalBody.appendChild(dayElement);
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching data:', error);
                        });
                });
            });
        </script>
    @endsection
