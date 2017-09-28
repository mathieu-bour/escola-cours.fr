<?php

namespace App\Mailer;

use App\Model\Entity\User;
use Cake\Mailer\Email;
use Cake\Mailer\Mailer;

/**
 * Class UserMailer
 * @package App\Mailer
 */
class UserMailer extends Mailer
{
    public function __construct($email = null)
    {
        parent::__construct($email);

        $this->setFrom(['contact@escola-cours.fr' => 'Escola']);
        $this->setReplyTo(['contact@escola-cours.fr' => 'Escola']);
        $this->setCharset('utf-8');
    }

    public function resetPassword(User $user)
    {
        $this
            ->to($user->email)
            ->setEmailFormat('both')
            ->setSubject('Réinitialisation de votre mot de passe')
            ->set(['user' => $user]);
    }


    public function recruitment(User $user, array $levels, array $disciplines)
    {
        $this->to('mathieu.tin.bour@gmail.com')
            ->setReplyTo([$user->email => $user->firstname . ' ' . $user->lastname])
            ->setEmailFormat('text')
            ->setSubject('Candidature de ' . $user->firstname . ' ' . $user->lastname)
            ->set(['user' => $user, 'levels' => $levels, 'disciplines' => $disciplines]);
    }
}