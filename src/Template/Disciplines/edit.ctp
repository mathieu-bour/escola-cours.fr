<?php
/**
 * @var \App\View\AppView $this
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $discipline->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $discipline->id)]
            )
            ?></li>
        <li><?= $this->Html->link(__('List Disciplines'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="disciplines form large-9 medium-8 columns content">
    <?= $this->Form->create($discipline) ?>
    <fieldset>
        <legend><?= __('Edit Discipline') ?></legend>
        <?php
        echo $this->Form->input('name');
        echo $this->Form->input('lesson_count');
        echo $this->Form->input('student_count');
        echo $this->Form->input('teacher_count');
        echo $this->Form->input('users._ids', ['options' => $users]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
