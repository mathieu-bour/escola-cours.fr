<?php

namespace App\Mailer;

use App\Model\Entity\User;
use Cake\Mailer\Mailer;

/**
 * Class UserMailer
 * @package App\Mailer
 */
class UserMailer extends Mailer
{
    public function resetPassword(User $user)
    {
        $this->to($user->email)
            ->setEmailFormat('both')
            ->setSubject('Réinitialisation de votre mot de passe')
            ->set(['user' => $user]);
    }
}