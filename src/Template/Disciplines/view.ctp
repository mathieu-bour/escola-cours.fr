<?php
/**
 * @var \App\View\AppView $this
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Discipline'), ['action' => 'edit', $discipline->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Discipline'), ['action' => 'delete', $discipline->id], ['confirm' => __('Are you sure you want to delete # {0}?', $discipline->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Disciplines'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Discipline'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="disciplines view large-9 medium-8 columns content">
    <h3><?= h($discipline->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($discipline->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($discipline->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lesson Count') ?></th>
            <td><?= $this->Number->format($discipline->lesson_count) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Student Count') ?></th>
            <td><?= $this->Number->format($discipline->student_count) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Teacher Count') ?></th>
            <td><?= $this->Number->format($discipline->teacher_count) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Users') ?></h4>
        <?php if (!empty($discipline->users)): ?>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Email') ?></th>
                    <th scope="col"><?= __('Password') ?></th>
                    <th scope="col"><?= __('Type') ?></th>
                    <th scope="col"><?= __('Lastname') ?></th>
                    <th scope="col"><?= __('Firstname') ?></th>
                    <th scope="col"><?= __('Address') ?></th>
                    <th scope="col"><?= __('Telephone') ?></th>
                    <th scope="col"><?= __('Lesson Count') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($discipline->users as $users): ?>
                    <tr>
                        <td><?= h($users->id) ?></td>
                        <td><?= h($users->email) ?></td>
                        <td><?= h($users->password) ?></td>
                        <td><?= h($users->type) ?></td>
                        <td><?= h($users->lastname) ?></td>
                        <td><?= h($users->firstname) ?></td>
                        <td><?= h($users->address) ?></td>
                        <td><?= h($users->telephone) ?></td>
                        <td><?= h($users->lesson_count) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</div>
