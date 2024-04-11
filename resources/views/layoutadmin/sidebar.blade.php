@section('sidebar')
    <div class=" d-flex flex-column justify-content-start">
       
        <div class="offcanvas-xl offcanvas-start px-4" style="background-color: #212B36;" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header d-flex flex-column align-items-start px-0">
                <p class="mt-4" style="color: white; font-weight: bold; font-size: 25px">Dash UI</p>
                <div style="color: white"><i class="fa-solid fa-house me-2 mt-4"></i> Dashboard</div>
            </div>
            <div class="offcanvas-body px-0" style="overflow: unset;">
                <div class="d-flex flex-column justify-content-between w-100">
                    <p style="color: #454F5B" class="mt-4">School management</p>
                    <div id="student" style="width: 100%"
                        class="divsidebar mt-4 d-flex justify-content-between align-items-center">
                        <div class="sidebarlink" href=""><i class="fa-solid fa-graduation-cap me-3"></i>Student</div>
                        <i class="fa-solid fa-chevron-down" style="color: white"></i>
                    </div>
                    <ul id="studentList" class="sidebarul w-100">
                        <li class=""><a href="{{ url('student/create') }}">Add new student</a> <i
                                class="fa-solid fa-plus ms-2"></i></li>

                        <li class="mt-2"><a href="{{ url('student') }}">View Student in Class</a> <i
                                class="fa-solid fa-eye ms-2"></i></li>
                        <li class="mt-2"><a href="{{ url('allstudent') }}">View All Student</a> <i
                                class="fa-solid fa-eye ms-2"></i></li>
                    </ul>
                    <div id="teacher" style="width: 100%"
                        class="divsidebar mt-4 d-flex justify-content-between align-items-center">
                        <div class="sidebarlink"><i class="fa-solid fa-user-group me-3"></i>Teacher</div>
                        <i class="fa-solid fa-chevron-down" style="color: white"></i>
                    </div>
                    <ul id="teacherList" class="sidebarul">
                        <li class=""><a href="{{ url('teacher/create') }}">Add new teacher</a> <i
                                class="fa-solid fa-plus ms-2"></i></li>
                        <li class="mt-2"><a href="{{ url('teacher') }}">View teacher</a> <i
                                class="fa-solid fa-eye ms-2"></i></li>
                    </ul>
                    <div id="parent" style="width: 100%"
                        class="divsidebar mt-4 d-flex justify-content-between align-items-center">
                        <div class="sidebarlink" href=""><i class="fa-solid fa-user-tie me-3"></i>Parent</div>
                        <i class="fa-solid fa-chevron-down" style="color: white"></i>
                    </div>
                    <ul id="parentList" class="sidebarul">
                        <li class=""><a href="{{ url('phuhuynh/create') }}">Add new parent</a><i
                                class="fa-solid fa-plus ms-2"></i></li>
                        <li class="mt-2"><a href="{{ url('phuhuynh') }}">View parent</a><i
                                class="fa-solid fa-eye ms-2"></i></li>
                    </ul>
                    <div id="class" style="width: 100%"
                        class="divsidebar mt-4 d-flex justify-content-between align-items-center">
                        <div class="sidebarlink"><i class="fa-solid fa-users me-3"></i>Class</div>
                        <i class="fa-solid fa-chevron-down" style="color: white"></i>
                    </div>
                    <ul id="classList" class="sidebarul">
                        <li class=""><a href="{{ url('classroom/create') }}">Add new class</a><i
                                class="fa-solid fa-plus ms-2"></i></li>
                        <li class="mt-2"><a href="{{ url('classroom') }}">View class</a><i
                                class="fa-solid fa-eye ms-2"></i></li>
                    </ul>
                    <div id="subject" style="width: 100%"
                        class="divsidebar mt-4 d-flex justify-content-between align-items-center">
                        <div class="sidebarlink" href=""><i class="fa-solid fa-book me-3"></i>Subject</div>
                        <i class="fa-solid fa-chevron-down" style="color: white"></i>
                    </div>
                    <ul id="subjectList" class="sidebarul">
                        <li class=""><a href="{{ url('monhoc/create') }}">Add subject</a><i
                                class="fa-solid fa-plus ms-2"></i>
                        </li>
                        <li class="mt-2"><a href="{{ url('/monhoc') }}">View subject</a><i
                                class="fa-solid fa-eye ms-2"></i></li>
                        <li class="mt-2"><a href="{{ url('/tomonhoc/create') }}">Add subject group</a><i
                                class="fa-solid fa-plus ms-2"></i></li>
                        <li class="mt-2"><a href="{{ url('/tomonhoc') }}">View subject group</a><i
                                class="fa-solid fa-eye ms-2"></i></li>
                    </ul>
                    <div id="videolesson" style="width: 100%"
                        class="divsidebar mt-4 d-flex justify-content-between align-items-center">
                        <div class="sidebarlink"><i class="fa-solid fa-file me-3"></i></i>Video Lesson</div>
                        <i class="fa-solid fa-chevron-down" style="color: white"></i>
                    </div>
                    <ul id="videolessonList" class="sidebarul">
                        <li class=""><a href="{{ url('videolesson/create') }}">Add new videolesson</a> <i
                                class="fa-solid fa-plus ms-2"></i></li>
                        <li class="mt-2"><a href="{{ url('videolesson') }}">View videolesson</a> <i
                                class="fa-solid fa-eye ms-2"></i></li>
                    </ul>
                    <div id="section" style="width: 100%"
                        class="divsidebar mt-4 d-flex justify-content-between align-items-center">
                        <div class="sidebarlink" href=""><i class="fa-solid fa-pager me-3"></i>Section</div>
                        <i class="fa-solid fa-chevron-down" style="color: white"></i>
                    </div>
                    <ul id="sectionList" class="sidebarul">
                        <li class=""><a href="{{ url('section/create') }}">Add new section</a> <i
                                class="fa-solid fa-plus ms-2"></i></li>
                        <li class="mt-2"><a href="{{ url('section') }}">View section</a> <i
                                class="fa-solid fa-eye ms-2"></i>
                        </li>
                    </ul>
                    <div id="classSchedule" style="width: 100%"
                        class="divsidebar mt-4 d-flex justify-content-between align-items-center">
                        <div class="sidebarlink" href=""><i class="fa-solid fa-calendar-days me-3"></i>Class
                            Schedule</div>
                        <i class="fa-solid fa-chevron-down" style="color: white"></i>
                    </div>
                    <ul id="classScheduleList" class="sidebarul">
                        <li class=""><a href="{{ url('classschedule/create') }}">Add classSchedule</a> <i
                                class="fa-solid fa-plus ms-2"></i></li>

                    </ul>
                    <div id="attendance" style="width: 100%"
                        class="divsidebar mt-4 d-flex justify-content-between align-items-center">
                        <div class="sidebarlink" href=""><i class="fa-solid fa-fingerprint me-3"></i>Attendance
                        </div>
                        <i class="fa-solid fa-chevron-down" style="color: white"></i>
                    </div>
                    <ul id="attendancetList" class="sidebarul">
                        <li class=""><a href="">Add new attendance</a> <i class="fa-solid fa-plus ms-2"></i>
                        </li>
                        <li class="mt-2"><a href="">View attendance</a> <i class="fa-solid fa-eye ms-2"></i>
                        </li>
                    </ul>
                    <div id="score" style="width: 100%"
                        class="divsidebar mt-4 d-flex justify-content-between align-items-center">
                        <div class="sidebarlink" href=""><i class="fa-solid fa-trophy me-3"></i>Score</div>
                        <i class="fa-solid fa-chevron-down" style="color: white"></i>
                    </div>
                    <ul id="scoreList" class="sidebarul">
                        <li class=""><a href="">Add new score</a> <i class="fa-solid fa-plus ms-2"></i></li>
                        <li class="mt-2"><a href="{{ url('score') }}">View score</a> <i
                                class="fa-solid fa-eye ms-2"></i>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="">
            <p class="mt-4" style="color: white; font-weight: bold; font-size: 25px">Dash UI</p>
            <div style="color: white"><i class="fa-solid fa-house me-2 mt-4"></i> Dashboard</div>
        </div>
        <div class="d-flex flex-column justify-content-between ">
            <p style="color: #454F5B" class="mt-4">School management</p>
            <div id="student" style="width: 100%"
                class="divsidebar mt-4 d-flex justify-content-between align-items-center">
                <div class="sidebarlink" href=""><i class="fa-solid fa-graduation-cap me-3"></i>Student</div>
                <i class="fa-solid fa-chevron-down" style="color: white"></i>
            </div>
            <ul id="studentList" class="sidebarul">
                <li class=""><a href="{{ url('student/create') }}">Add new student</a> <i
                        class="fa-solid fa-plus ms-2"></i></li>
               
                <li class="mt-2"><a href="{{ url('student') }}">View Student in Class</a> <i
                        class="fa-solid fa-eye ms-2"></i></li>
                <li class="mt-2"><a href="{{ url('allstudent') }}">View All Student</a> <i
                        class="fa-solid fa-eye ms-2"></i></li>
            </ul>
            <div id="teacher" style="width: 100%"
                class="divsidebar mt-4 d-flex justify-content-between align-items-center">
                <div class="sidebarlink"><i class="fa-solid fa-user-group me-3"></i>Teacher</div>
                <i class="fa-solid fa-chevron-down" style="color: white"></i>
            </div>
            <ul id="teacherList" class="sidebarul">
                <li class=""><a href="{{ url('teacher/create') }}">Add new teacher</a> <i
                        class="fa-solid fa-plus ms-2"></i></li>
                <li class="mt-2"><a href="{{ url('teacher') }}">View teacher</a> <i class="fa-solid fa-eye ms-2"></i></li>
            </ul>
            <div id="parent" style="width: 100%"
                class="divsidebar mt-4 d-flex justify-content-between align-items-center">
                <div class="sidebarlink" href=""><i class="fa-solid fa-user-tie me-3"></i>Parent</div>
                <i class="fa-solid fa-chevron-down" style="color: white"></i>
            </div>
            <ul id="parentList" class="sidebarul">
                <li class=""><a href="{{ url('phuhuynh/create') }}">Add new parent</a><i
                        class="fa-solid fa-plus ms-2"></i></li>
                <li class="mt-2"><a href="{{ url('phuhuynh') }}">View parent</a><i class="fa-solid fa-eye ms-2"></i></li>
            </ul>
            <div id="class" style="width: 100%"
                class="divsidebar mt-4 d-flex justify-content-between align-items-center">
                <div class="sidebarlink"><i class="fa-solid fa-users me-3"></i>Class</div>
                <i class="fa-solid fa-chevron-down" style="color: white"></i>
            </div>
            <ul id="classList" class="sidebarul">
                <li class=""><a href="{{ url('classroom/create') }}">Add new class</a><i
                        class="fa-solid fa-plus ms-2"></i></li>
                <li class="mt-2"><a href="{{ url('classroom') }}">View class</a><i class="fa-solid fa-eye ms-2"></i></li>
            </ul>
            <div id="subject" style="width: 100%"
                class="divsidebar mt-4 d-flex justify-content-between align-items-center">
                <div class="sidebarlink" href=""><i class="fa-solid fa-book me-3"></i>Subject</div>
                <i class="fa-solid fa-chevron-down" style="color: white"></i>
            </div>
            <ul id="subjectList" class="sidebarul">
                <li class=""><a href="{{ url('monhoc/create') }}">Add subject</a><i class="fa-solid fa-plus ms-2"></i>
                </li>
                <li class="mt-2"><a href="{{ url('/monhoc') }}">View subject</a><i class="fa-solid fa-eye ms-2"></i></li>
                <li class="mt-2"><a href="{{ url('/tomonhoc/create') }}">Add subject group</a><i
                        class="fa-solid fa-plus ms-2"></i></li>
                <li class="mt-2"><a href="{{ url('/tomonhoc') }}">View subject group</a><i
                        class="fa-solid fa-eye ms-2"></i></li>
            </ul>
            <div id="videolesson" style="width: 100%"
                class="divsidebar mt-4 d-flex justify-content-between align-items-center">
                <div class="sidebarlink"><i class="fa-solid fa-file me-3"></i></i>Video Lesson</div>
                <i class="fa-solid fa-chevron-down" style="color: white"></i>
            </div>
            <ul id="videolessonList" class="sidebarul">
                <li class=""><a href="{{ url('videolesson/create') }}">Add new videolesson</a> <i
                        class="fa-solid fa-plus ms-2"></i></li>
                <li class="mt-2"><a href="{{ url('videolesson') }}">View videolesson</a> <i
                        class="fa-solid fa-eye ms-2"></i></li>
            </ul>
            <div id="section" style="width: 100%"
                class="divsidebar mt-4 d-flex justify-content-between align-items-center">
                <div class="sidebarlink" href=""><i class="fa-solid fa-pager me-3"></i>Section</div>
                <i class="fa-solid fa-chevron-down" style="color: white"></i>
            </div>
            <ul id="sectionList" class="sidebarul">
                <li class=""><a href="{{ url('section/create') }}">Add new section</a> <i
                        class="fa-solid fa-plus ms-2"></i></li>
                <li class="mt-2"><a href="{{ url('section') }}">View section</a> <i class="fa-solid fa-eye ms-2"></i>
                </li>
            </ul>
            <div id="classSchedule" style="width: 100%"
                class="divsidebar mt-4 d-flex justify-content-between align-items-center">
                <div class="sidebarlink" href=""><i class="fa-solid fa-calendar-days me-3"></i>Class
                    Schedule</div>
                <i class="fa-solid fa-chevron-down" style="color: white"></i>
            </div>
            <ul id="classScheduleList" class="sidebarul">
                <li class=""><a href="{{ url('classschedule/create') }}">Add classSchedule</a> <i
                        class="fa-solid fa-plus ms-2"></i></li>
                
            </ul>
            <div id="attendance" style="width: 100%"
                class="divsidebar mt-4 d-flex justify-content-between align-items-center">
                <div class="sidebarlink" href=""><i class="fa-solid fa-fingerprint me-3"></i>Attendance</div>
                <i class="fa-solid fa-chevron-down" style="color: white"></i>
            </div>
            <ul id="attendancetList" class="sidebarul">
                <li class=""><a href="">Add new attendance</a> <i class="fa-solid fa-plus ms-2"></i></li>
                <li class="mt-2"><a href="">View attendance</a> <i class="fa-solid fa-eye ms-2"></i></li>
            </ul>
            <div id="score" style="width: 100%"
                class="divsidebar mt-4 d-flex justify-content-between align-items-center">
                <div class="sidebarlink" href=""><i class="fa-solid fa-trophy me-3"></i>Score</div>
                <i class="fa-solid fa-chevron-down" style="color: white"></i>
            </div>
            <ul id="scoreList" class="sidebarul">
                <li class=""><a href="">Add new score</a> <i class="fa-solid fa-plus ms-2"></i></li>
                <li class="mt-2"><a href="{{ url('score') }}">View score</a> <i class="fa-solid fa-eye ms-2"></i>
                </li>
            </ul>
        </div>
    </div> --}}
    <script src="{{ asset('js/sidebaradmin.js') }}"></script>
@endsection
