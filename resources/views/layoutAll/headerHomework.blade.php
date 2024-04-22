<div class="row w-100 m-0 border-1 border-bottom shadow-sm"
    style="min-height: 50px; position: sticky; top: 0; z-index: 3; background-color: white">

    <div style="list-style: none" class="d-flex align-items-center col-10 ">
        <a href="{{url('gethomework/'.$post->id.'/'.$user->giaovien_id)}}" class="h-100 itemnav ms-5 " style="font-size: 20px;  text-align: center;">
            {{-- <a href="{{url('class/'.$classroom->lophoc_id.'/'.$user->hocsinh_id)}}" style="text-decoration: none; color: black"><h5 class="pe-3 ps-3" style="line-height: 300%">Bảng tin</h5></a> --}}
            Hướng dẫn
        </a>
        <a href="{{url('studentHomework/'.$post->id.'/'.$user->giaovien_id)}}" class="h-100 itemnav mx-3" style="font-size: 20px;  text-align: center;  ">
            {{-- <a href="{{url('class/'.$classroom->lophoc_id.'/homework'.'/'.$user->hocsinh_id)}}" style="text-decoration: none; color: black"><h5 class="pe-3 ps-3" style="line-height: 300%">Bài tập trên lớp</h5></a> --}}
            Bài tập của học sinh
        </a>
    </div>

</div>
