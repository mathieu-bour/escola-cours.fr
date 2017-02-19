<?php
/**
 * @var \App\View\AppView $this
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Disciplines'), ['controller' => 'Disciplines', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Discipline'), ['controller' => 'Disciplines', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Lessons'), ['controller' => 'Lessons', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Lesson'), ['controller' => 'Lessons', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Levels'), ['controller' => 'Levels', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Level'), ['controller' => 'Levels', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= h($user->type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lastname') ?></th>
            <td><?= h($user->lastname) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Firstname') ?></th>
            <td><?= h($user->firstname) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Address') ?></th>
            <td><?= h($user->address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Telephone') ?></th>
            <td><?= h($user->telephone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lesson Count') ?></th>
            <td><?= $this->Number->format($user->lesson_count) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Disciplines') ?></h4>
        <?php if (!empty($user->disciplines)): ?>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Name') ?></th>
                    <th scope="col"><?= __('Lesson Count') ?></th>
                    <th scope="col"><?= __('Student Count') ?></th>
                    <th scope="col"><?= __('Teacher Count') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($user->disciplines as $disciplines): ?>
                    <tr>
                        <td><?= h($disciplines->id) ?></td>
                        <td><?= h($disciplines->name) ?></td>
                        <td><?= h($disciplines->lesson_count) ?></td>
                        <td><?= h($disciplines->student_count) ?></td>
                        <td><?= h($disciplines->teacher_count) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'Disciplines', 'action' => 'view', $disciplines->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Disciplines', 'action' => 'edit', $disciplines->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Disciplines', 'action' => 'delete', $disciplines->id], ['confirm' => __('Are you sure you want to delete # {0}?', $disciplines->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Lessons') ?></h4>
        <?php if (!empty($user->lessons)): ?>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Teacher Id') ?></th>
                    <th scope="col"><?= __('Beginning') ?></th>
                    <th scope="col"><?= __('Duration') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($user->lessons as $lessons): ?>
                    <tr>
                        <td><?= h($lessons->id) ?></td>
                        <td><?= h($lessons->teacher_id) ?></td>
                        <td><?= h($lessons->beginning) ?></td>
                        <td><?= h($lessons->duration) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'Lessons', 'action' => 'view', $lessons->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Lessons', 'action' => 'edit', $lessons->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Lessons', 'action' => 'delete', $lessons->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lessons->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Levels') ?></h4>
        <?php if (!empty($user->levels)): ?>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Name') ?></th>
                    <th scope="col"><?= __('User Count') ?></th>
                    <th scope="col"><?= __('Teacher Count') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($user->levels as $levels): ?>
                    <tr>
                        <td><?= h($levels->id) ?></td>
                        <td><?= h($levels->name) ?></td>
                        <td><?= h($levels->user_count) ?></td>
                        <td><?= h($levels->teacher_count) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'Levels', 'action' => 'view', $levels->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Levels', 'action' => 'edit', $levels->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Levels', 'action' => 'delete', $levels->id], ['confirm' => __('Are you sure you want to delete # {0}?', $levels->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</div>
