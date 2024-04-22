@section('sidebar')
    <div class="border-2 border-end h-100 p-0 sidebarStudent" style="width: 25%; overflow: auto" >
        <div class="container-fluid p-0 h-100 offcanvas-xl offcanvas-start"id="offcanvasNavbar">
            <div class="row border-1 border-bottom w-100 m-0 " style="height: auto">
                <div class="container d-flex flex-column justify-content-start align-items-start w-100">
                    <div class="row w-100 navitem">
                        <a class=" d-flex justify-content-start align-items-center ms-4"
                            style="text-decoration: none; color: black" href="{{ url('/studentclass'.'/'.$user->hocsinh_id) }}">
                            <i class="fa-solid fa-house " style="font-size: 30px; flex:2"></i>
                            <p style="font-size: 20px;flex:8" class=" mt-3">Màn hình chính</p>
                        </a>
                    </div>
                    <div class="row w-100 navitem">
                        <div class=" d-flex justify-content-start align-items-center ms-4">
                            <i class="fa-regular fa-calendar-days " style="font-size: 30px;flex:2"></i>
                            <p style="font-size: 20px;flex:8" class=" mt-3">Lịch</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row border-1 border-bottom w-100 m-0 " style="height: auto">
                <div class="container d-flex  flex-column justify-content-start align-items-start w-100">
                    <div class="row w-100 border-2 border-bottom"
                        style="position: sticky; top:0; z-index: 3; background-color: white">
                        <div class=" d-flex justify-content-start align-items-center ms-4 ">
                            <i class="fa-solid fa-list" style="font-size: 30px;flex:2"></i>
                            <p style="font-size: 20px;flex:8;" class=" mt-3">Danh sách lớp học</p>
                        </div>
                    </div>
                    @foreach ($classTeach as $item)
                        <div class="row w-100 navitem" style="z-index: 1">
                            <a href="{{ url('class/' . $item->lophoc_id.'/'.$user->hocsinh_id) }}" style="color: black; text-decoration: none">
                                <div class=" d-flex justify-content-start align-items-center ms-4">
                                    <i class="fa-solid fa-school " style="font-size: 30px;flex:2"></i>
                                    <p style="font-size: 20px;flex:8" class=" mt-3">{{ $item->tenlop }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                    
                </div>
            </div>
            <div class="row m-0 " style="height: 50%">
                <div class="container d-flex flex-column justify-content-start align-items-start w-100">
                    <div class="row w-100 navitem">
                        <div class=" d-flex justify-content-start align-items-center ms-4 ">
                            <i class="fa-solid fa-database" style="font-size: 30px;flex:2"></i>
                            <p style="font-size: 20px;flex:8" class=" mt-3">Lớp học đã lưu trữ</p>
                        </div>
                    </div>
                    <div class="row w-100 navitem">
                        <div class=" d-flex justify-content-start align-items-center ms-4">
                            <i class="fa-solid fa-gear " style="font-size: 30px;flex:2"></i>
                            <p style="font-size: 20px;flex:8" class=" mt-3">Cài đặt</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
