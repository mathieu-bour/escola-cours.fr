<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\Association\HasMany;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;

/**
 * Class UsersTable
 *
 * @author Mathieu Bour <mathieu.tin.bour@gmail.com>
 * @package App\Model\Table
 *
 * @property HasMany $Courses
 * @property HasMany $Slots
 *
 * @method User get($primaryKey, $options = [])
 * @method User newEntity($data = null, array $options = [])
 * @method User[] newEntities(array $data, array $options = [])
 * @method User|bool save(EntityInterface $entity, $options = [])
 * @method User patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method User[] patchEntities($entities, array $data, array $options = [])
 * @method User findOrCreate($search, callable $callback = null, $options = [])
 */
class UsersTable extends AppTable
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        // Behaviors
        $this->addBehavior('Timestamp');

        // Relations
        $this->hasMany('Courses');
        $this->hasMany('Slots');
    }

    /**
     * Default validation rules.
     *
     * @param Validator $validator Validator instance.
     * @return Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            // id
            ->integer('id')
            ->allowEmpty('id', 'create')
            // email
            ->email('email')
            ->allowEmpty('email', false, 'Votre e-mail est nécessaire')
            // password
            ->sameAs('password', 'password_confirm', 'les mots de passe ne correspondent pas.')
            ->requirePresence('password', 'create', 'Votre mot de passe ne peut être vide')
            // type
            ->inList('type', ['student', 'teacher'], 'Veuillez sélectionner un type de compte')
            ->allowEmpty('type', false, 'Veuillez sélectionner un type de compte')
            // lastname
            ->lengthBetween('lastname', [1, 60], 'Votre nom doit être compris entre 1 et 60 caractères')
            ->allowEmpty('lastname', false, 'Votre nom est nécessaire')
            // firstname
            ->lengthBetween('firstname', [1, 60], 'Votre prénom doit être compris entre 1 et 60 caractères')
            ->allowEmpty('firstname', false, 'Votre prénom est nécessaire')
            // telephone
            ->lengthBetween('telephone', [10, 20], 'Votre numéro de téléphone doit être compris entre 10 et 20 caractères')
            ->allowEmpty('telephone', false, 'Votre numéro de téléphone est nécessaire')
            // address
            ->lengthBetween('address', [1, 255], 'Votre adresse doit être compris entre 1 et 255 caractères')
            ->allowEmpty('address', false, 'Votre adresse est nécessaire')
            // zip_code
            ->lengthBetween('zip_code', [1, 10], 'Votre code postal doit être compris entre 1 et 10 caractères')
            ->allowEmpty('zip_code', false, 'Votre code postal est nécessaire')
            // city
            ->lengthBetween('city', [1, 60], 'Votre ville doit être compris entre 1 et 60 caractères')
            ->allowEmpty('city', false, 'Votre ville est nécessaire')
            // lesson_count
            ->integer('lesson_count')
            ->allowEmpty('lesson_count')
            // created
            ->allowEmpty('created', 'create');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param RulesChecker $rules The rules object to be modified.
     * @return RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }

    /*= Hooks
     *=====================================================*/
    public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options)
    {
        if (!empty($data['new_password'])) {
            $data['password'] = $data['new_password'];
            $data['password_confirm'] = $data['new_password_confirm'];
            unset($data['new_password'], $data['new_password_confirm']);
        }
    }

    /*= Finders
     *=====================================================*/
    public function findTeachers(Query $query, array $options) {
        $query->innerJoinWith('Courses', function (Query $q) use ($options) {
            return $q->where([
                'Courses.level_id' => $options['level_id'],
                'Courses.discipline_id' => $options['discipline_id']
            ]);
        })
            ->where(['type' => 'teacher']);
        return $query;
    }
}