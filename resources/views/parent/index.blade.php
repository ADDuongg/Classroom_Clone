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
                <div class="me-3" style="font-weight: bold; font-size: 20px">Danh sách phụ huynh
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
                        <th>#</th>
                        <th>Họ tên</th>
                        <th>Giới tính</th>
                        <th>Tuổi</th>
                        <th>Ngày sinh</th>
                        <th>Số điện thoại</th>
                        <th>Vai trò</th>
                        <th>Nghề nghiệp</th>
                        <th>Phu huynh của</th>
                        <th>Ảnh đại diện</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($parents as $parent)
                        <tr>
                            <td>{{ $parent->phuhuynh_id }}</td>
                            <td>{{ $parent->hoten }}</td>
                            <td class="text-center">
                                @if ($parent->gender === 1) 
                                    <i style="font-size: 20px" class="fa-solid fa-mars"></i> 
                                @else
                                    <i style="font-size: 20px" class="fa-solid fa-venus"></i>
                                @endif

                            </td>
                            <td>{{ $parent->tuoi }}</td>
                            <td>{{ $parent->ngaysinh }}</td>
                            <td>{{ $parent->sdt }}</td>
                            <td>{{ $parent->vaitro }}</td>
                            <td>{{ $parent->nghenghiep }}</td>
                            <td>
                                <option value="{{ $parent->hocsinh_id }}">{{ $parent->hotenhocsinh }}</option>
                            </td>
                            <td class="text-center">
                                <img width="60" src="{{ asset('images/' . $parent->avatar) }}" alt="Avatar">
                            </td>

                            <td>
                                <button class="btn btn-info dropdown-toggle" id="navbarDropdown" data-bs-toggle="dropdown"
                                    style="color: white">Action
                                    {{-- <i class="fa-solid fa-caret-down fa-lg ms-3"></i> --}}
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item d-flex justify-content-evenly align-items-center"
                                            href="{{ url('phuhuynh/' . $parent->phuhuynh_id) . '/edit' }}"><i
                                                class="fa-solid fa-pen"></i>Update</a></li>
                                    <li>
                                        <form action="{{ url('phuhuynh/' . $parent->phuhuynh_id) }}" method="POST">
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
            {{-- <div class="d-flex justify-content-start align-items-center mb-3"
                style="background-color: white; height: 90px;">
            </div> --}}
        </div>
    </div>
@endsection
