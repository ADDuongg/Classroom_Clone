@extends('layoutadmin.master')

@section('sidebar')
    @include('layoutadmin.sidebar')
@endsection

@section('header')
    @include('layoutadmin.header')
@endsection

@section('content')
    <p class="ms-4" style="font-size: 25px; font-weight: bold">Add Student to Clas</p>

    <div style=";" class="border ms-4 me-4"></div>
    <div style="width: 90%; height: 500px; margin: auto" class="border border-2 mt-3">
        @if (session('notice'))
            <div class="alert alert-success">
                {{ session('notice') }}
            </div>
        @endif
        <div style="width: 40%; margin: auto">
            <div class="mb-3" style="width: 100%;">
                <label for="lophoc_id" class="form-label"></label>
                <input value="{{ $classroom->tenlop }}" type="text" name="tenlop" class="form-control"
                    style="width: 100%;" readonly>
                <input value="{{ $classroom->lophoc_id }}" type="hidden" name="lophoc_id" class="form-control"
                    style="width: 100%;" required>
            </div>
            <div class="mb-3" style="width: 100%;">
                <label for="" class="form-label">Các học sinh đã vào lớp</label>
                <select name="hocsinh_id" class="form-select" id="studentSelect">
                    @if ($studentInClass->isEmpty())
                        <option value="không có học sinh nào">Không có học sinh nào</option>
                    @else
                        @foreach ($studentInClass as $student)
                            <option class="option-id" value="{{ $student->hocsinh_id }}">{{ $student->hoten }}</option>
                        @endforeach
                    @endif
                </select>

            </div>
            <div class="d-flex justify-content-end" style="width: 100%;">
                <button href="" class="btn btn-primary btndelete">Delete Student</button>
            </div>
        </div>
    </div>
    <script>
        var deletebtn = document.querySelector('.btndelete');
        var selectElement = document.getElementById('studentSelect');

        deletebtn.addEventListener('click', function(event) {
            /* event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết */

            var selectedOption = selectElement.options[selectElement.selectedIndex];
            var selectedStudentId = selectedOption.value;
            var token = document.head.querySelector('meta[name="csrf-token"]').content;
            if (selectedStudentId) {

                fetch(`http://localhost:8000/numberStudentInClass/${selectedStudentId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token
                        },
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        alert(data['message'])
                        location.reload();
                    })
                    .catch(error => {
                        console.error('Delete error:', error);
                        // Xử lý lỗi nếu có
                    });
            } else {
                console.error('Invalid student ID');
            }
        });
    </script>
@endsection
