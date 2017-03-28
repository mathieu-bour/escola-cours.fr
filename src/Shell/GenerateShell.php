<?php

namespace App\Shell;

use App\Model\Table\UsersTable;
use Cake\Console\Shell;
use Cake\I18n\Time;
use Cake\Utility\Text;

/**
 * Class Generate
 * @package App\Shell
 *
 * @property UsersTable $Users
 */
class GenerateShell extends Shell
{
    public $usersData = [
        'firstname' => ['Emma', 'Léa', 'Chloé', 'Manon', 'Inès', 'Lola', 'Jade', 'Camille', 'Sarah', 'Louise', 'Zoé',
            'Lilou', 'Léna', 'Maelys', 'Clara', 'Éva', 'Lina', 'Anaïs', 'Louna', 'Romane', 'Nathan', 'Lucas', 'Enzo',
            'Léo', 'Louis', 'Hugo', 'Gabriel', 'Ethan', 'Mathis', 'Jules', 'Raphaël', 'Arthur', 'Tom', 'Théo', 'Noah',
            'Timeo', 'Matheo', 'Clément', 'Maxime', 'Yanis'],
        'lastname' => ['Martin', 'Bernard', 'Thomas', 'Petit', 'Robert', 'Richard', 'Durand', 'Dubois', 'Moreau',
            'Laurent', 'Simon', 'Michel', 'Lefebvre', 'Leroy', 'Roux', 'David', 'Bertrand', 'Morel', 'Fournier',
            'Girard', 'Bonnet', 'Dupont', 'Lambert', 'Fontaine', 'Rousseau', 'Vincent', 'Muller', 'Lefevre',
            'Faure', 'Andre', 'Mercier', 'Blanc', 'Guerin', 'Boyer', 'Garnier', 'Chevalier', 'Francois', 'Legrand',
            'Gauthier', 'Garcia'],
        'type' => ['student', 'teacher'],
        'street' => ['Rue Alcan', 'Rue de la Source', 'Rue du Brabant', 'Rue Jacques-François Blondel',
            'Rue Alexandre Dumas', 'Rue de la Tête d\'Or', 'Rue du Bugey', 'Rue Jean Aubrion', 'Rue Alfred de Vigny',
            'Rue de la Tortue', 'Rue du C.E.F.', 'Rue Jean Bauchez', 'Rue Alfred Krieger', 'Rue de la Vachotte',
            'Rue du Cambout', 'Rue Jean Burger', 'Rue Alfred Mézières', 'Rue de la Valériane',
            'Rue du Capitaine Claude', 'Rue Jean d\'Apremont', 'Rue Amalaire', 'Rue de la Vienne',
            'Rue du Champé', 'Rue Jean Giraudoux', 'Rue Ambroise Paré', 'Rue de la Vignotte', 'Rue du Change',
            'Rue Jean Laurain', 'Rue Ambroise Thomas', 'Rue de la Visitation', 'Rue du Chanoine Collin',
            'Rue Jean Nicolas Collignon', 'Rue Anatole France', 'Rue de Ladoucette', 'Rue du Chanoine Lesprand',
            'Rue Jean-Adolphe Lasaulce', 'Rue Ancillon', 'Rue de Lancieux', 'Rue du Chanoine Morhain',
            'Rue Jean-Antoine Chaptal']
    ];


    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Users');
    }

    public function users()
    {

        $users = [];

        for ($i = 0; $i < 100; $i++) {
            $user = [
                'firstname' => $this->usersData['firstname'][array_rand($this->usersData['firstname'])],
                'lastname' => $this->usersData['lastname'][array_rand($this->usersData['lastname'])],
                'new_password' => 'test',
                'new_password_confirm' => 'test',
                'type' => $this->usersData['type'][array_rand($this->usersData['type'])],
                'address' => random_int(1, 20) . ' ' . $this->usersData['street'][array_rand($this->usersData['street'])],
                'telephone' => '06' . random_int(10000000, 99999999),
                'zip_code' => '57000',
                'city' => 'Metz',
                'created' => Time::now()
                    ->subDays(random_int(0, 30))
                    ->subHours(random_int(0, 24))
                    ->subMinutes(random_int(0, 60))
                    ->subSeconds(random_int(0, 60))
            ];
            $user['email'] = strtolower(Text::slug($user['firstname']) . '.' . Text::slug($user['lastname'])) . random_int(1, 1000) . '@gmail.com';
            $users[] = $user;
        }

        $users = $this->Users->newEntities($users);

        $this->Users->saveMany($users);
    }
}