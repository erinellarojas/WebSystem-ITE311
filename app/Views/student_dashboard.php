<!-- jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- AJAX Enrollment Script -->
<script>
$(document).ready(function(){
    $('.enroll-btn').click(function(){
        var button = $(this);
        var course_id = button.data('course-id');

        $.post("<?= site_url('course/enroll') ?>", { course_id: course_id }, function(response){
            if(response.status == 'success'){
                alert(response.message);
                button.prop('disabled', true);
                // Add newly enrolled course to the list dynamically
                $('#enrolledCourses').append('<li class="list-group-item">' + button.closest('li').text().replace('Enroll', '').trim() + '</li>');
            } else {
                alert(response.message);
            }
        }, 'json');
    });
});
</script>
