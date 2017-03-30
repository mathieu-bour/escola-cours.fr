<?php
use Cake\Routing\Router;

$resetLink = Router::url(['controller' => 'users', 'action' => 'reset', $user->token], true);
?>
<p>Bonjour !</p>

<p>Nous avons été informés de la perte de votre mot de passe et nous en somme désolé.
    Veuillez cliquer sur le lien suivant dans votre navigateur pour réinitialiser votre mot de passe.</p>

<p><?= $this->Html->link($resetLink, $resetLink); ?></p>