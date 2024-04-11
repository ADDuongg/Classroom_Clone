<div class="row w-100 m-0 border-1 border-bottom shadow-sm"
    style="height: 8%; position: sticky; top: 0; z-index: 3; background-color: white">
    <div style="list-style: none" class="d-flex align-items-center col-10 h-100 ">
        <div class="h-100 itemnav ms-5 " style="font-size: 20px;  text-align: center;">
            <a href="{{url('class/'.$classroom->lophoc_id.'/'.$user->hocsinh_id)}}" style="text-decoration: none; color: black"><h5 class="pe-3 ps-3" style="line-height: 300%">Bảng tin</h5></a>
        </div>
        <div class="h-100 itemnav" style="font-size: 20px;  text-align: center;  ">
            <a href="{{url('class/'.$classroom->lophoc_id.'/homework'.'/'.$user->hocsinh_id)}}" style="text-decoration: none; color: black"><h5 class="pe-3 ps-3" style="line-height: 300%">Bài tập trên lớp</h5></a>
        </div>
        <div class="h-100 itemnav" style="font-size: 20px;  text-align: center;  ">
            <a href="{{url('class/'.$classroom->lophoc_id.'/everyone'.'/'.$user->hocsinh_id)}}" style="text-decoration: none; color: black"><h5 class="pe-3 ps-3" style="line-height: 300%">Mọi người</h5></a>
        </div>
    </div>
    <div class="col-2 d-flex align-items-center justify-content-end">
        <i class="fa-solid fa-gear" style="font-size: 25px"></i>
    </div>
</div>
