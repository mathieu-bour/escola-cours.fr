<?php use Cake\Routing\Router; ?>
<div class="panel">
    <div class="panel-heading">
        <h2>Ajouter un cours</h2>
    </div>

    <div class="panel-body">
        <?= $this->Form->create(); ?>
            <?= $this->Form->input('student_id', [
                'type' => 'select',
                'data-url' => Router::url(['controller' => 'students', 'action' => 'index'])
            ]); ?>
            <?= $this->Form->select('level_id'); ?>
            <?= $this->Form->select('duration'); ?>
            <?= $this->Form->select('price_per_hour'); ?>
            <?= $this->Form->select('salary_per_hour'); ?>
            <?= $this->Form->select('starting_week'); ?>
        <?= $this->Form->end(); ?>
    </div>
</div>