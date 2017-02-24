/**
 * Handle most of the javascript in the /users/register page
 * @author Mathieu Bour
 */

/**
 * @type {jQuery} the form
 */
var $userRegisterForm = $('#user-register-form');
/**
 * @type {number} the courses iterator, used to be sure that the courses[] array submitted has different keys; they will be ignored during processing
 */
var coursesIterator = -1;
/**
 * @type {jQuery} the courses container
 */
var $coursesContainer = $('#courses-container');
/**
 * @type {jQuery} the "add course" button
 */
var $addCourseBtn = $('#add-course');
/*
 * Add course button click handler
 */
$addCourseBtn.on('click', function (e) {
    e.preventDefault();

    coursesIterator++; // First, increment

    /**
     * @type {jQuery} the course container
     */
    var $course = $('<div class="course">').appendTo($coursesContainer);
    /**
     * @type {jQuery} the courses Bootstrap row
     */
    var $courseRow = $('<div class="row"><div class="col-md-5"></div><div class="col-md-5"></div></div>').appendTo($course);
    /**
     * @type {jQuery} the course level Bootstrap .form-group
     */
    var $courseLevel = $('<div class="form-group select"></div>').appendTo($courseRow.find('div[class^="col-"]')[0]);
    /**
     * @type {jQuery} the course discipline Bootstrap .form-group
     */
    var $courseDiscipline = $('<div class="form-group select"></div>').appendTo($courseRow.find('div[class^="col-"]')[1]);


    // First, get the available levels
    $.getJSON('/levels/index', {}, function (json) {
        /**
         * @type {jQuery} the select filled with the levels
         */
        var $selectLevel = $('<select name="courses[' + coursesIterator + '][level]" class="form-control">').appendTo($courseLevel);
        $selectLevel.append('<option value="" disabled selected>Choisir le niveau</option>'); // Add default select option
        /**
         * @type {jQuery|undefined} the select filled with disciplines linked with the selected level
         */
        var $selectDiscipline;

        // Fill the level select
        $.each(json, function (key, val) {
            $selectLevel.append($('<option>').attr('value', key).text(val));
        });


        // On level change/select, refresh the disciplines based on the selected level id
        $selectLevel.on('change', function () {
            // If not exists, create the discipline select the DOM; else, remove it options
            if ($selectDiscipline === undefined) {
                $selectDiscipline = $('<select name="courses[' + coursesIterator + '][discipline]" class="form-control">').appendTo($courseDiscipline);
            } else {
                $selectDiscipline.text('');
            }

            // If not exists, create the remove course button
            if ($courseRow.find('.remove-course').length == 0) {
                $courseRow.append('<div class="col-md-2"><a href="#" class="btn btn-danger btn-block remove-course">Supprimer</a></div>');
            }

            // Finally, fill the discipline select with the proper disciplines based on the selected level id
            $.getJSON('/disciplines/by-level/' + $selectLevel.val(), {}, function (json) {
                $selectDiscipline.append('<option value="" disabled selected>Choisir la matière</option>');

                $.each(json, function (key, val) {
                    $selectDiscipline.append($('<option>').attr('value', key).text(val));
                });
            });
        })
    });
});


/**
 * Remove course button handler
 * @link http://stackoverflow.com/a/15090957
 */
$coursesContainer.on('click', '.remove-course', function (e) {
    e.preventDefault();

    $(this).parents('.course').remove();
});


/*
 * On submit action, create a json string with the selected courses
 */
$userRegisterForm.on('submit', function () {
    var courses = [];

    $('.course').each(function () {
        var level = $(this).find('select[name*="level"]').val();
        var discipline = $(this).find('select[name*="discipline"]').val();

        courses.push({
            level: level,
            discipline: discipline
        });
    });

    $(this).find('input[name="courses"]').val(JSON.stringify(courses));
});
