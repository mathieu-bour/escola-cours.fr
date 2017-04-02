<div class="row">
    <div class="col-md-3">
        <div class="panel bg-primary">
            <div class="panel-body">
                <div class="stat">
                    <div class="stat-number"><?= $stats['userCount']; ?></div>
                    <div class="stat-text">Utilisateurs inscrits</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel bg-danger">
            <div class="panel-body">
                <div class="stat">
                    <div class="stat-number"><?= $stats['studentCount']; ?></div>
                    <div class="stat-text">Élèves inscrits</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel bg-success">
            <div class="panel-body">
                <div class="stat">
                    <div class="stat-number"><?= $stats['teacherCount']; ?></div>
                    <div class="stat-text">Professeurs inscrits</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel bg-warning">
            <div class="panel-body">
                <div class="stat">
                    <div class="stat-number"><?= (int)$stats['lessonsTotalDuration']; ?></div>
                    <div class="stat-text">Heures enseignées</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-heading">
                <h3>Inscriptions (semaine)</h3>
            </div>
            <div class="panel-body">
                <canvas id="user-registration-chart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-heading">
                <h3>Cours donnés par date (semaine)</h3>
            </div>
            <div class="panel-body">
                <canvas id="lessons-given-by-date-chart"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-heading">
                <h3>Détails des cours donnés (semaine)</h3>
            </div>
            <div class="panel-body">
                <canvas id="lessons-given-detail-chart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="panel">
            <div class="panel-heading">
                <h3>Matières les plus étudiés</h3>
            </div>
            <div class="panel-body">
                <canvas id="students-by-discipline-chart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="panel">
            <div class="panel-heading">
                <h3>Matières plus enseignées</h3>
            </div>
            <div class="panel-body">
                <canvas id="teachers-by-discipline-chart"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-heading">
                <h3>Professeurs les plus actifs</h3>
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Disciplines</th>
                            <th>Cours donnés</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tables['bestTeachers'] as $teacher): ?>
                            <tr>
                                <td><?= $teacher->lastname . ' ' . $teacher->firstname; ?></td>
                                <td>
                                    <?php foreach ($teacher->courses as $course): ?>
                                        <span class="label label-primary">
                                            <?= $course->discipline->name . ' (' . $course->level->name . ')'; ?>
                                        </span>&nbsp;
                                    <?php endforeach; ?>
                                </td>
                                <td><?= $teacher->lesson_count; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="panel">
            <div class="panel-heading">
                <h3>Élèves les plus actifs</h3>
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Disciplines</th>
                            <th>Cours suivis</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tables['bestStudents'] as $student): ?>
                            <tr>
                                <td><?= $student->lastname . ' ' . $student->firstname; ?></td>
                                <td>
                                    <?php foreach ($student->courses as $course): ?>
                                        <span class="label label-primary">
                                            <?= $course->discipline->name . ' (' . $course->level->name . ')'; ?>
                                        </span>&nbsp;
                                    <?php endforeach; ?>
                                </td>
                                <td><?= $student->lesson_count; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php $this->start('script'); ?>
<script>
    new Chart($('#user-registration-chart'), <?= json_encode($charts['userRegistration']); ?>);
    new Chart($('#lessons-given-by-date-chart'), <?= json_encode($charts['lessonsGivenByDate']); ?>);
    new Chart($('#lessons-given-detail-chart'), <?= json_encode($charts['lessonsGivenDetail']); ?>);
    new Chart($('#students-by-discipline-chart'), <?= json_encode($charts['studentsByDisciplineChart']); ?>);
    new Chart($('#teachers-by-discipline-chart'), <?= json_encode($charts['teachersByDisciplineChart']); ?>);
</script>
<?php $this->end(); ?>
