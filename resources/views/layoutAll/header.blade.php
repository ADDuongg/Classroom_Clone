@section('header')
    <div class="d-flex justify-content-between h-100 w-100" style="background-color: white">
        <div class="d-flex align-items-center h-100">
            <i class="fa-solid fa-house ms-4 me-4" style="font-size: 30px"></i>
            <nav class="me-4 mt-2" aria-label="breadcrumb" style="font-size: 25px; font-weight: bold">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item "><a style="text-decoration: none; color: black" href="#">Class
                            Room</a></li>
                </ol>
            </nav>
            <i class="fa-solid hiddenSidebar fa-bars ms-4 me-4" style="font-size: 30px" data-bs-toggle="offcanvas"
                href="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation"></i>
        </div>
        <div class=" d-flex align-items-center justify-content-end h-100 p-1">
            <i class="fa-solid fa-bell me-4" style="font-size: 30px"></i>
            @if ($user && $user->avatar)
                <img data-bs-toggle="dropdown" style="height: 100%; min-width: 20%; cursor: pointer;" class="me-4 mt-2"
                    src="{{ asset('images/' . $user->avatar) }}">
                <ul class="dropdown-menu">
                    <li class="d-flex align-items-center">
                        <a class="dropdown-item" href="{{url('/logout')}}">
                            <i class="fa-solid fa-right-from-bracket text-danger me-3"></i>Logout
                        </a>
                    </li>
                </ul>
            @endif
        </div>
    </div>
@endsection
