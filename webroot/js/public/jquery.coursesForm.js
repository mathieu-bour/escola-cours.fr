/**
 * Handle most of the javascript in the /users/register page
 * @author Mathieu Bour
 */
$.fn.populate = function (data) {
    console.log(data);
    var $this = $(this);

    $.each(data, function (val, text) {
        $this.append($('<option>').attr('value', val).text(text));
    });

    return $this;
};

$.fn.coursesForm = function () {
    /**
     * @type {jQuery} the form
     */
    var $form = $(this);

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

    /**
     * Load courses
     * @returns {*}
     */
    var getLevels = function () {
        return new Promise(function (resolve, reject) {
            $.getJSON('/levels/index', {}, function (json) {
                levels = json;
                resolve(levels);
            });
        });
    };

    /**
     * Load disciplines
     * @returns {*}
     */
    var getDisciplines = function () {
        return new Promise(function (resolve, reject) {
            $.getJSON('/disciplines/index', {}, function (json) {
                disciplines = json;
                resolve(disciplines);
            });
        });
    };

    /*
     * Add course button click handler
     */
    $addCourseBtn.on('click', function (e) {
        e.preventDefault();

        console.log('Hello');

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

        /**
         * @type {jQuery} the remove course button
         */
        var $courseRemoveBtn = $courseRow.append('<div class="col-md-2"><a href="#" class="btn btn-danger btn-block remove-course">Supprimer</a></div>');

        /**
         * @type {jQuery} the select filled with the levels
         */
        var $selectLevel = $('<select name="courses[level_id]" class="form-control">').appendTo($courseLevel);
        $selectLevel.append('<option value="" disabled selected>Choisir le niveau</option>'); // Add default select option
        /**
         * @type {jQuery} the select filled with disciplines linked with the selected level
         */
        var $selectDiscipline = $('<select name="courses[discipline_id]" class="form-control">').appendTo($courseDiscipline);
        $selectDiscipline.append('<option value="" disabled selected>Choisir la discipline</option>'); // Add default select option

        getLevels().then(function (levels) {
            $selectLevel.populate(levels);
        });

        getDisciplines().then(function (disciplines) {
            $selectDiscipline.populate(disciplines);
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
    $form.on('submit', function (e) {
        var courses = [];

        $('.course').each(function () {
            var id = $(this).find('input[name*="[id"]').val();
            var level_id = $(this).find('select[name*="[level_id]"]').val();
            var discipline_id = $(this).find('select[name*="[discipline_id]"]').val();

            if (id === undefined) {
                id = null;
            }

            courses.push({
                id: id,
                level_id: level_id,
                discipline_id: discipline_id
            });
        });

        $(this).find('input[name="courses"]').val(JSON.stringify(courses));

        console.log(courses);
    });
};