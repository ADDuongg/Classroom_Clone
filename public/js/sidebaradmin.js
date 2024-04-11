document.addEventListener('DOMContentLoaded', function () {
    function toggleList(triggerId, listId) {
        var trigger = document.getElementById(triggerId);
        var list = document.getElementById(listId);

        trigger.addEventListener('click', function () {
            list.classList.toggle('active');
        });
    }

    toggleList('student', 'studentList');
    toggleList('teacher', 'teacherList');
    toggleList('parent', 'parentList');
    toggleList('class', 'classList');
    toggleList('subject', 'subjectList');
    toggleList('section', 'sectionList');
    toggleList('classSchedule', 'classScheduleList');
    toggleList('attendance', 'attendancetList');
    toggleList('score', 'scoreList');
    toggleList('videolesson', 'videolessonList');
});
