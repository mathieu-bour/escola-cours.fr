<?php
use Cake\Routing\Router;

$this->start('script'); ?>
<script>
    var dataTable = $('.dataTable').DataTable({
        "language": {
            "url": '/i18n/dataTables.fr_FR.json'
        },
        "rowId": "id",
        "processing": true,
        "serverSide": true,
        "ajax": '/admin/lessons',
        "columns": [
            {
                "title": "Date",
                "name": "Lessons.beginning",
                "data": "beginning",
                "render": function (data, type, row) {
                    return moment(row.beginning).format('dddd DD MMMM YYYY [à] HH:mm');
                }
            },
            {
                "title": "Durée",
                "name": "Lessons.duration",
                "data": "duration",
                "render": function (data, type, row) {
                    return row.duration + (row.duration > 1 ? ' heures' : ' heure');
                }
            },
            {
                "title": "Élève",
                "name": "Users.lastname",
                "data": "user.lastname",
                "render": function (data, type, row) {
                    return row.user.lastname + ' ' + row.user.firstname
                }
            },
            {
                "title": "Professeur",
                "name": "Users.lastname",
                "data": "teacher.lastname",
                "render": function (data, type, row) {
                    return row.teacher.lastname + ' ' + row.teacher.firstname
                }
            },
            {
                "title": "Discipline",
                "name": "Disciplines.name",
                "data": "discipline.name"
            },
            {
                "title": "Niveau",
                "name": "Levels.name",
                "data": "level.name"
            }
        ],
        "order": [0, "desc"]
    });
</script>
<?php $this->end(); ?>
