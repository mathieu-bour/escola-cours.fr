<?php

namespace App\Model\Table;

use App\Model\Entity\Level;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Association\HasMany;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Class LevelsTable
 *
 * @author Mathieu Bour <mathieu.tin.bour@gmail.com>
 * @package App\Model\Table
 *
 * @property HasMany $Courses
 * @property HasMany $Lessons
 *
 * @method Level get($primaryKey, $options = [])
 * @method Level newEntity($data = null, array $options = [])
 * @method Level[] newEntities(array $data, array $options = [])
 * @method Level|bool save(EntityInterface $entity, $options = [])
 * @method Level patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method Level[] patchEntities($entities, array $data, array $options = [])
 * @method Level findOrCreate($search, callable $callback = null, $options = [])
 */
class LevelsTable extends Table
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

        $this->setTable('levels');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Courses');
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('name');

        $validator
            ->integer('user_count')
            ->allowEmpty('user_count');

        $validator
            ->integer('teacher_count')
            ->allowEmpty('teacher_count');

        return $validator;
    }
}
