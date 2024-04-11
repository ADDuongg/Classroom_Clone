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
                <div class="me-3" style="font-weight: bold; font-size: 20px">Danh sách điểm học sinh
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

            <div class="d-flex align-items-center justify-content-end ps-4 " style="width: 100%;">
                {{-- <div style="width: 100%; height: 40px;" class="d-flex align-items-center">
                    <label for="form-label">Show</label>

                    <select id="showPerPage" name="showPerPage" class="ms-3 form-select" style="width: 100px;">
                        <option value="">Select</option>
                        <option value="1">1</option>
                        <option value="3">3</option>
                        <option value="5">5</option>
                    </select>
                </div> --}}
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
                        {{-- <th>#</th> --}}
                        <th>
                            {{-- <a
                                href="{{ request()->fullUrlWithQuery(['sortby' => 'hoten', 'sorttype' => $sortType === 'asc' ? 'desc' : 'asc']) }}"> --}}
                            Họ tên
                            {{-- </a> --}}
                        </th>

                        <th>Giới tính</th>
                        <th>Tuổi</th>
                        <th>Ngày sinh</th>
                        <th>Ảnh đại diện</th>
                        <th>Điểm số</th>
                        <th>Thời gian chấm điểm</th>
                        <th>Thời gian cập nhật điểm</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="tbody">
                    @foreach ($students as $student)
                        <tr>
                            {{-- <td>{{ $student->hocsinh_id }}</td> --}}
                            <td>{{ $student->hoten }}</td>
                            <td>{{ $student->gender }}</td>
                            <td>{{ $student->tuoi }}</td>
                            <td>{{ $student->ngaysinh }}</td>
                            <td class="text-center">
                                <img width="60" src="{{ asset('images/' . $student->avatar) }}" alt="Avatar">
                            </td>
                            <td class="fw-bold">
                                {{$student->score}}
                            </td>
                            <td>{{ $student->created_at }}</td>
                            <td>{{ $student->updated_at }}</td>
                            <td>
                                <button class="btn btn-info dropdown-toggle" id="navbarDropdown" data-bs-toggle="dropdown"
                                    style="color: white">Action
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item d-flex justify-content-evenly align-items-center"
                                            href=""><i class="fa-solid fa-pen"></i>Update</a></li>
                                    <li>
                                        <form action="" method="POST">
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

                </tbody>
            </table>
            {{-- <div class="w-100 d-flex justify-content-end" id="paginationData">
                {{ $students->links() }}
            </div> --}}
        </div>

    </div>
@endsection
