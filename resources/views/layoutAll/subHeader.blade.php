<div class="row w-100 m-0 border-1 border-bottom shadow-sm subheader"
    style=" min-height: 50px; z-index: 3; background-color: white; position: sticky; top: 0">
    <div style="list-style: none" class="d-flex align-items-center col-10 ">
        <a  href="{{url('class/'.$classroom->lophoc_id.'/'.$user->giaovien_id)}}" class="h-100 itemnav ms-5 ">
            Bảng tin
            {{-- <a href="{{url('class/'.$classroom->lophoc_id.'/'.$user->giaovien_id)}}" style="text-decoration: none; color: black">Bảng tin</a> --}}
        </a>
        <a href="{{url('class/'.$classroom->lophoc_id.'/homework'.'/'.$user->giaovien_id)}}" class="h-100 itemnav mx-3">
            Bài tập trên lớp
            {{-- <a href="{{url('class/'.$classroom->lophoc_id.'/homework'.'/'.$user->giaovien_id)}}" style="text-decoration: none; color: black">Bài tập trên lớp</a> --}}
        </a>
        <a href="{{url('class/'.$classroom->lophoc_id.'/everyone'.'/'.$user->giaovien_id)}}" class="h-100 itemnav">
            Mọi người
            {{-- <a href="{{url('class/'.$classroom->lophoc_id.'/everyone'.'/'.$user->giaovien_id)}}" style="text-decoration: none; color: black">Mọi người</a> --}}
        </a>
        {{-- <div class="h-100 itemnav" style="font-size: 20px;  text-align: center;  ">
            <h5 class="pe-3 ps-3" style="line-height: 300%">Điểm</h5>
        </div> --}}
    </div>
    <div class="col-2 d-flex align-items-center justify-content-end">
        <i class="fa-solid fa-gear" style="font-size: 25px"></i>
    </div>
</div>
