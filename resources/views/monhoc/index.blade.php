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
                <div class="me-3" style="font-weight: bold; font-size: 20px">Danh sách môn học
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
            <div style="overflow-x: auto">
                <table class="table table-striped" style="height: 100%; width: 100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên môn học</th>
                            <th>Giáo viên dạy</th>
                            <th style="width: 700px;">Mô tả môn học</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($monhocs as $monhoc)
                            <tr>
                                <td>{{ $monhoc->monhoc_id }}</td>
                                <td>{{ $monhoc->tenmonhoc }}</td>
                                <td>{{ $monhoc->tengiaovien }}</td>
                                <td>
                                    <textarea name="" id="" style="width: 100%;">{{ $monhoc->motamonhoc }}</textarea>
                                </td>
                                <td>
                                    <button class="btn btn-info dropdown-toggle" id="navbarDropdown" data-bs-toggle="dropdown"
                                        style="color: white">Action
                                        {{-- <i class="fa-solid fa-caret-down fa-lg ms-3"></i> --}}
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item d-flex justify-content-evenly align-items-center"
                                                href="{{ url('monhoc/' . $monhoc->monhoc_id) . '/edit' }}"><i
                                                    class="fa-solid fa-pen"></i>Update</a></li>
                                        <li>
                                            <form action="{{ url('monhoc/' . $monhoc->monhoc_id) }}" method="POST">
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
            </div>
            {{-- <div class="d-flex justify-content-start align-items-center mb-3"
                style="background-color: white; height: 90px;">
            </div> --}}
        </div>
    </div>
@endsection
