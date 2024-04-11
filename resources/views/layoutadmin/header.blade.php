@section('header')
    <div class=" headeradmin  d-flex justify-content-between"
        style="height: 10%; background-color: white; max-width: 96%; margin: 0 auto; padding-top: 20px">
        <i class="fa-solid fa-bars showSidebar" data-bs-toggle="offcanvas" href="#offcanvasNavbar"
            aria-controls="offcanvasNavbar" aria-label="Toggle navigation"></i>

        <div class="d-flex">
            <div class="rounded-circle text-center me-2"
                style="line-height: 45px; height: 45px; width: 45px; background-color: #f1f5f9">
                <i class="fa-regular fa-bell " style="font-size: 20px"></i>
            </div>
            <div class="dropdown">
                <img data-bs-toggle="dropdown" aria-expanded="false" class="rounded-circle" style="height: 45px; width: 45px; cursor: pointer;"
                    src="https://tse3.mm.bing.net/th?id=OIP.ixZ69lPCOZ3ZO5UqSHQGIAHaHa&pid=Api&P=0&h=220" alt="">
                <ul class="dropdown-menu">
                    {{-- <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li> --}}
                    <li><a class="dropdown-item" href={{ url('logout') }}><i class="fa-solid fa-right-from-bracket text-danger me-3"></i>Log out</a></li>
                </ul>
            </div>
        </div>
    </div>

    {{-- <script>
        var btnbar = document.querySelector('.fa-bars')
        var sidebaradmin = document.querySelector('.sidebaradmin')
        var divAll = document.querySelector('.divAll')

        btnbar.addEventListener('click', function() {
            if (sidebaradmin.style.display === 'none') {
                sidebaradmin.style.display = 'block';
            } else {
                sidebaradmin.style.display = 'none';
            }

            divAll.style.width = '100%';
        });
    </script> --}}
@endsection
