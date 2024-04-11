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
                <div class="me-3" style="font-weight: bold; font-size: 20px">Danh sách tất cả học sinh
                    <i class="fa-solid fa-graduation-cap fa-lg"></i>
                </div>
                @if (session('notice'))
                    <script>
                        alert("{{ session('notice') }}");
                    </script>
                @endif

                <div class="d-flex align-items-center">
                    <form action="" class="d-flex">
                        <input name="name" id="searchInput" type="search" class="form-control ms-3"
                            style="width: 200px;" placeholder="Nhập giá trị tìm kiếm...">
                        <button class="btn btn-primary ms-3">Tìm kiếm</button>
                    </form>
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-between ps-4 pe-4" style="width: 100%;">
                <div style="width: 100%; height: 40px;" class="d-flex align-items-center">
                    <label for="form-label">Show</label>
                    {{-- <form id="showPerPageForm" action="{{ url('allstudent') }}" method="GET">
                        <select id="showPerPage" name="showPerPage" class="ms-3 form-select" style="width: 70px;">
                            <option value="">Select</option>
                            <option value="1">1</option>
                            <option value="3">3</option>
                            <option value="5">5</option>
                        </select>
                    </form> --}}
                    <select id="showPerPage" name="showPerPage" class="ms-3 form-select" style="width: 100px;">
                        <option value="">Select</option>
                        <option value="1">1</option>
                        <option value="3">3</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <form class="d-flex" style="height: 40px" action="">
                    <select name="phuhuynh" id="" class="form-select me-3" style="width: 13rem;">
                        <option value="">Chọn tên phu huynh</option>
                        @foreach (getAllParent() as $item)
                            <option value="{{ $item->hoten }}">{{ $item->hoten }}</option>
                        @endforeach
                    </select>
                    <select name="lophoc" id="" class="form-select" style="width: 150px;">
                        <option value="">Chọn tên lớp</option>
                        @foreach (getAllClass() as $item)
                            <option value="{{ $item->tenlop }}">{{ $item->tenlop }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary d-flex justify-content-center align-items-center"><i
                            class="fa-solid fa-filter me-2"></i>Lọc</button>
                </form>
            </div>

            <table class="table table-striped" style="height: 100%; width: 100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>
                            <a
                                href="{{ request()->fullUrlWithQuery(['sortby' => 'hoten', 'sorttype' => $sortType === 'asc' ? 'desc' : 'asc']) }}">
                                Họ tên
                            </a>
                        </th>

                        <th>Giới tính</th>
                        <th>Tuổi</th>
                        <th>Ngày sinh</th>
                        <th>Số điện thoại</th>
                        <th>Phụ huynh</th>
                        <th>Lớp học</th>
                        <th>GVCN</th>
                        <th>Ảnh đại diện</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="tbody">
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $student->hocsinh_id }}</td>
                            <td>{{ $student->hoten }}</td>
                            <td>{{ $student->gender }}</td>
                            <td>{{ $student->tuoi }}</td>
                            <td>{{ $student->ngaysinh }}</td>
                            <td>{{ $student->sdt }}</td>
                            <td>
                                <select class="form-select" style="width: 150px;">
                                    @if ($student->phuhuynh_id && $student->tenphuhuynh)
                                        <option value="{{ $student->phuhuynh_id }}">{{ $student->tenphuhuynh }}</option>
                                    @else
                                        <option value="">Chưa thêm phụ huynh</option>
                                    @endif
                                </select>
                            </td>
                            <td>

                                @if (empty($student->ten_lop_hoc))
                                    <p>Học sinh này chưa có lớp học</p>
                                @else
                                    {{ $student->ten_lop_hoc }}
                                @endif
                            </td>
                            <td>
                                @if (empty($student->ten_giao_vien))
                                    <p>Học sinh này chưa có GVCN</p>
                                @else
                                    {{ $student->ten_giao_vien }}
                                @endif
                            </td>
                            <td class="text-center">
                                <img width="60" src="{{ asset('images/' . $student->avatar) }}" alt="Avatar">
                            </td>

                            <td>
                                <button class="btn btn-info dropdown-toggle" id="navbarDropdown" data-bs-toggle="dropdown"
                                    style="color: white">Action
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item d-flex justify-content-evenly align-items-center"
                                            href="{{ url('student/' . $student->hocsinh_id) . '/edit' }}"><i
                                                class="fa-solid fa-pen"></i>Update</a></li>
                                    <li>
                                        <form action="{{ url('student/' . $student->hocsinh_id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="dropdown-item d-flex justify-content-evenly align-items-center">
                                                <i class="fa-solid fa-trash"></i>Delete
                                            </button>
                                        </form>

                                    </li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                    {{-- <tr class="text-end">
                            <td class="w-100 d-flex justify-content-end">
                                <div  id="paginationData">
                                    {{ $students->appends(['showPerPage' => $showPerPage])->links() }}
                                </div>
                            </td>
                        </tr> --}}
                </tbody>
            </table>
            <div class="w-100 d-flex justify-content-end" id="paginationData">
                {{ $students->links() }}
            </div>
        </div>

    </div>
    <script>
        /* document.getElementById('searchInput').addEventListener('input', function() {
                        performSearch(this.value.trim());
                    });

                    function performSearch(searchValue) {
                        fetch(`allstudent?query=${searchValue}`, {
                                method: 'GET'
                            })
                            .then(response => response.json())
                            .then(data => {
                                // Xử lý kết quả tìm kiếm ở đây
                            })
                            .catch(error => console.error('Error:', error));
                        console.log('Đang tìm kiếm:', searchValue);
                    } */





        function updateTable(data) {
            var dataStudent = data['data']
            var paginate = data['links']
            var tbody = document.querySelector('.tbody')
            var tmp_html = ''
            var paginationHTML = '<ul class="pagination">';

            paginate.forEach(page => {
                if (page.url) {
                    if (page.active) {
                        paginationHTML +=
                            `<li class="page-item active"><span class="page-link">${page.label}</span></li>`;
                    } else {
                        paginationHTML +=
                            `<li class="page-item"><a class="page-link" href="${page.url}">${page.label}</a></li>`;
                    }
                } else {
                    paginationHTML +=
                        `<li class="page-item disabled"><span class="page-link">${page.label}</span></li>`;
                }
            });

            paginationHTML += '</ul>';

            document.getElementById('paginationData').innerHTML = paginationHTML;
            dataStudent.forEach(item => {
                tmp_html += `
                <tr>
                            <td>${item['hocsinh_id']}</td>
                            <td>${item['hoten']}</td>
                            <td>${item['gender']}</td>
                            <td>${item['tuoi']}</td>
                            <td>${item['ngaysinh']}</td>
                            <td>${item['sdt']}</td>
                            <td>
                                <select class="form-select" style="width: 150px;">
                                        ${item.phuhuynh_id && item.tenphuhuynh ?
                                `<option value="${item.phuhuynh_id}">${item.tenphuhuynh}</option>` :
                                '<option value="">Chưa thêm phụ huynh</option>'
                                        }
                                </select>
                            </td>
                            <td>
                    ${item.ten_lop_hoc ? item.ten_lop_hoc : '<p>Học sinh này chưa có lớp học</p>'}
                </td>
                <td>
                    ${item.ten_giao_vien ? item.ten_giao_vien : '<p>Học sinh này chưa có GVCN</p>'}
                </td>
                <td class="text-center">
                    <img width="60" src="{{ asset('images/') }}/${item.avatar}" alt="Avatar">
                </td>
                <td>
                                <button class="btn btn-info dropdown-toggle" id="navbarDropdown" data-bs-toggle="dropdown"
                                    style="color: white">Action
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item d-flex justify-content-evenly align-items-center"
                                        href="localhost:8000/student/${item['hocsinh_id']})/edit"><i
                                            
                                                class="fa-solid fa-pen"></i>Update</a></li>
                                    <li>
                                        <form action="localhost:8000/student/${item['hocsinh_id']})" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="dropdown-item d-flex justify-content-evenly align-items-center">
                                                <i class="fa-solid fa-trash"></i>Delete
                                            </button>
                                        </form>

                                    </li>
                                </ul>
                            </td>
                        </tr>
                `;
            });
            tbody.innerHTML = tmp_html
        }

        /* fetch */
        document.getElementById('showPerPage').addEventListener('change', function() {
            var showPerPage = this.value;

            fetch(`allstudent?showPerPage=${showPerPage}`, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {

                    console.log(data.data);

                    updateTable(data)
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
@endsection
