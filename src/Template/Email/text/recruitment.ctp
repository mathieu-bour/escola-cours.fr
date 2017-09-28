<?= $user->firstname ?> <?= $user->lastname ?> est intéressé pour travailler avec Escola dans les matières suivantes :
<?php foreach($user->courses as $course) {
    echo '- ' .  $disciplines[$course->discipline_id] . ' (' . $levels[$course->level_id] . ")\n";
} ?>

Disponibilités :
<?= $user->availabilities; ?>

Contacts de <?= $user->firstname ?> <?= $user->lastname ?> :
- E-mail : <?= $user->email . "\n" ?>
- Télephone : <?= $user->telephone ?>
