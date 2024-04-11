<div class=" w-100 m-0 border-1 border-bottom shadow-sm"
    style="height: 8%;  z-index: 10; background-color: white">
    <div style="list-style: none" class="d-flex align-items-center  h-100 w-100">
        <div class="h-100 itemnav ms-5" style="font-size: 20px;  text-align: center;">
            <a href="{{url('gethomework/'.$post->id.'/'.$user->giaovien_id)}}" style="text-decoration: none; color: black">
                <h5 class="pe-3 ps-3" style="line-height: 300%">Hướng dẫn</h5>
            </a>
        </div>
        <div class="h-100 itemnav" style="font-size: 20px;  text-align: center;  ">
            <a href="{{url('studentHomework/'.$post->id.'/'.$user->giaovien_id)}}" style="text-decoration: none; color: black">
                <h5 class="pe-3 ps-3" style="line-height: 300%">Bài tập của học sinh</h5>
            </a>
        </div>
    </div>

</div>
