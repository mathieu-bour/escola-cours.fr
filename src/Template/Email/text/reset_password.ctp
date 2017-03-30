<?php
use Cake\Routing\Router;

$resetLink = Router::url(['controller' => 'users', 'action' => 'reset', $user->token], true);
?>
    Bonjour !

    Nous avons été informés de la perte de votre mot de passe et nous en somme désolé.
    Veuillez copier/coller le lien suivant dans votre navigateur pour réinitialiser votre mot de passe.

<?= $resetLink; ?>