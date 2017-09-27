<div class="panel">
    <div class="panel-heading">
        <h2>Ajouter un cours</h2>
    </div>

    <div class="panel-body">
        <?= $this->Form->create(); ?>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <?= $this->Form->input('student_id', [
                    'type' => 'select',
                    'label' => 'Élève',
                    'data' => $students,
                    'append' => [
                        $this->Form->button('+', ['class' => 'btn-primary'])
                    ]
                ]); ?>
                <?= $this->Form->select('duration', [
                    'label' => 'Durée',
                    'options' => [
                        '1' => '1 heure',
                        '1.5' => '1 heure 30',
                        '2' => '2 heures',
                        '2.5' => '2 heures 30',
                        '3' => '3 heures'
                    ]
                ]); ?>
                <?= $this->Form->input('level_id', [
                    'type' => 'select',
                    'label' => 'Niveau',
                    'data' => [],
                    'append' => [
                        $this->Form->button('+', ['class' => 'btn-primary'])
                    ]
                ]); ?>
                <?= $this->Form->input('discipline_id', [
                    'type' => 'select',
                    'label' => 'Discipline',
                    'data' => [],
                    'append' => [
                        $this->Form->button('+', ['class' => 'btn-primary'])
                    ]
                ]); ?>

            </div>
        </div>
        <?= $this->Form->end(); ?>
    </div>
</div>

<div class="panel">
    <div class="panel-content">
    </div>
</div>