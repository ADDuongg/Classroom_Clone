@extends('layoutAll.master')

@section('header')
    @include('layoutAll.header')
@endsection

@section('sidebar')
    @include('layoutAll.sidebar')
@endsection

@section('content')
<div class=" contentClass  h-100">
    <div class="container w-100 h-100">
        <div class="row w-100 d-flex justify-content-start ms-3 align-items-center">
            @foreach ($classTeach as $item)
                <div class="card me-4 mt-4 mb-4 p-0 d-flex flex-column justify-content-start"
                    style="width: 20rem; height: 20rem;">
                    <div style="height: 35%;">
                        {{-- <p style="z-index: 10">Lop hoc</p> --}}
                        <img src="https://gstatic.com/classroom/themes/img_breakfast.jpg"
                            class="card-img-top w-100 h-100" alt="...">
                    </div>
                    <div class="card-body" style="height: 65%;">
                        <h5 class="card-title">{{ $item->tenlop }}</h5>
                        <div class="card-text border-1 border-bottom">
                            <div class="d-flex">
                                <p class="me-2" style="font-weight: bold; font-size: 15px">Giáo
                                    viên dạy: </p>{{ $item->hoten }}
                            </div>
                            <div class="d-flex">
                                <p class="me-2" style="font-weight: bold; font-size: 15px">Số
                                    lượng học sinh: </p>{{ getNumberStudent($item->lophoc_id) }}
                            </div>
                        </div>
                        <div class="d-flex justify-content-between w-100 mt-4">
                            <a href="{{url('class/'. $item->lophoc_id .'/' . $user->giaovien_id)}}" class="btn btn-primary">Vào lớp học<i
                                    class="fa-solid fa-arrow-right ms-3"></i></a>
                            <a href="#" class="btn btn-primary">Mở sổ điểm<i
                                    class="fa-solid fa-arrow-trend-up ms-3"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>
@endsection



   