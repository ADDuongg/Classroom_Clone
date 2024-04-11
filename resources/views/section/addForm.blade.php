@extends('layoutadmin.master')

@section('sidebar')
    @include('layoutadmin.sidebar')
@endsection

@section('header')
    @include('layoutadmin.header')
@endsection

@section('content')
    <p class="ms-4" style="font-size: 25px; font-weight: bold">Add new Section</p>
    @if (session('notice'))
        <script>
            alert("{{ session('notice') }}");
        </script>
    @endif
    <div style=";" class="border ms-4 me-4"></div>
    <div style="width: 90%; height: 500px; margin: auto" class="border border-2 mt-3">
        <form action="{{ url('section') }}" style="width: 40%; margin: auto" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3" style="width: 100%;">
                <label for="hocky" class="form-label">Học kỳ</label>
                <select name="hocky" id="" class="form-select">
                    <option value="Học kỳ 1">Học kỳ 1</option>
                    <option value="Học kỳ 2">Học kỳ 2</option>
                </select>
            </div>
            <div class="mb-3" style="width: 100%;">
                <label for="namhoc" class="form-label">Năm học</label>
                @php
                    $currentYear = date('Y');
                    $nextFiveYears = [];
                    for ($i = 0; $i < 5; $i++) {
                        $nextFiveYears[$i] = $currentYear + $i;
                    }
                @endphp
                <select name="namhoc" id="" class="form-select">
                    @foreach ($nextFiveYears as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>

            </div>

            <div class="d-flex justify-content-end" style="width: 100%;">
                <button type="submit" class="btn btn-primary">Add Section</button>
            </div>
        </form>
    </div>
@endsection
