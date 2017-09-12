<div class="panel">
    <div class="panel-heading">
        <h2>Ajouter un cours</h2>
    </div>

    <div class="panel-body">
        <div class="row">
            <div class="col-md-4">
                <?= $this->Form->create(); ?>
                <?= $this->Form->input('user_id', [
                    'type' => 'select',
                    'id' => 'user-select2',
                    'label' => 'Élève'
                ]); ?>
                <?= $this->Form->input('course', [
                    'type' => 'select',
                    'id' => 'course-select2',
                    'label' => 'Cours'
                ]); ?>
                <?= $this->Form->input('teacher_id', [
                    'type' => 'select',
                    'id' => 'teacher-select2',
                    'label' => 'Professeur'
                ]); ?>

                <?= $this->Form->input('beginning', [
                    'type' => 'date',
                    'templates' => [
                        'dateWidget' => '<div class="row">{{day}}{{month}}{{year}}</div>'
                    ],
                    'label' => 'Date'
                ]); ?>
                <?= $this->Form->input('beginning', [
                    'type' => 'time',
                    'interval' => 30,
                    'label' => 'Heure'
                ]); ?>
                <?= $this->Form->input('duration', [
                    'type' => 'select',
                    'options' => [
                        '1' => '1 heure',
                        '1.5' => '1 heure 30 minutes',
                        '2' => '2 heures',
                    ],
                    'label' => 'Durée'
                ]); ?>

                <button class="btn btn-block btn-primary">Enregister</button>
                <?= $this->Form->end(); ?>
            </div>

            <div class="col-md-8">
                <div class="table-responsive">
                    <table class="table table-bordered slots">
                        <thead>
                            <tr>
                                <th>Heure</th>
                                <th>Lundi</th>
                                <th>Mardi</th>
                                <th>Mercredi</th>
                                <th>Jeudi</th>
                                <th>Vendredi</th>
                                <th>Samedi</th>
                                <th>Dimanche</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < 24; $i++) { ?>
                                <tr>
                                    <td>
                                        <?= $i < 10 ? '0' . $i : $i; ?>:00
                                        - <?= $i + 1 < 10 ? '0' . ($i + 1) : $i + 1; ?>
                                        :00
                                    </td>
                                    <?php for ($j = 0; $j < 7; $j++) { ?>
                                        <td class="slot" id="slot-<?= $j . '-' . $i ?>"></td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->start('script'); ?>
<script>
    var $userSelect2 = $('#user-select2').select2({
        ajax: {
            dataType: 'json',
            url: '/admin/users/students/list',
            processResults: function (json) {
                var results = [];
                $.each(json.data, function (key, val) {
                    results.push({
                        id: val.id.toString(),
                        text: val.lastname + ' ' + val.firstname
                    });
                });
                return {
                    results: results
                };
            }
        }
    }).on('change', function () {
        var $courseSelect2 = $('#course-select2').select2({
            ajax: {
                dataType: 'json',
                url: '/admin/courses/user/' + $userSelect2.val(),
                processResults: function (json) {
                    var results = [];
                    $.each(json.data, function (key, val) {
                        results.push({
                            id: val.level_id + '/' + val.discipline_id,
                            text: val.discipline.name + ' (' + val.level.name + ')'
                        });
                    });
                    return {
                        results: results
                    };
                }
            }
        }).on('change', function () {
            var $teacherSelect2 = $('#teacher-select2').select2({
                ajax: {
                    dataType: 'json',
                    url: '/admin/users/teachers/' + $courseSelect2.val(),
                    processResults: function (json) {
                        var results = [];
                        $.each(json.data, function (key, val) {
                            results.push({
                                id: val.id.toString(),
                                text: val.lastname + ' ' + val.firstname
                            });
                        });
                        return {
                            results: results
                        };
                    }
                }
            }).on('change', function () {
                $.getJSON('/admin/slots/common/' + $userSelect2.val() + '/' + $teacherSelect2.val(), {}, function (json) {
                    $.each(json.data, function (key, val) {
                        $('#slot-' + val.day + '-' + val.hour).addClass('common');
                    });
                });
            });
        });
    });
</script>
<?php $this->end(); ?>
