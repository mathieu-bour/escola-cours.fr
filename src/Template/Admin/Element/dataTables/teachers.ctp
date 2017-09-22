<?php
use Cake\Routing\Router;

$this->start('script'); ?>
<script>
    var dataTable = $('.dataTable').DataTable({
        "responsive": true,
        "language": {
            "url": '<?=Router::url('/i18n/dataTables.fr_FR.json'); ?>'
        },
        "rowId": "id",
        "processing": true,
        "serverSide": true,
        "ajax": '<?= Router::url(['controller' => 'users', 'action' => 'teachers']); ?>',
        "columns": [
            {
                "title": "Nom",
                "name": "Users.lastname",
                "data": "lastname"
            },
            {
                "title": "Prénom",
                "name": "Users.firstname",
                "data": "firstname"
            },
            {
                "title": "Cours dispensés",
                "render": function (data, type, row) {
                    var html = '';

                    $.each(row.courses, function (key, course) {
                        html = html + '<span class="label label-primary">' + course.discipline.name + ' (' + course.level.name + ')</span> ';
                    });

                    return html;
                },
                "orderable": false,
                "searchable": false
            },
            {
                "title": "Cours donnés",
                "name": "Users.lesson_count",
                "data": "lesson_count",
                "searchable": false
            },
            {
                "title": "Adresse e-mail",
                "name": "Users.email",
                "data": "email"
            },
            {
                "title": "Téléphone",
                "name": "Users.telephone",
                "data": "telephone"
            },
            {
                "title": "Adresse",
                "name": "Users.address",
                "data": "address"
            },
            {
                "title": "Actions",
                "render": function (data, type, row) {
                    return '<a href="/admin/users/edit/' + row.id + '" class="label label-warning">Éditer</a>';
                }
            }
        ]
    });
</script>
<?php $this->end(); ?>
