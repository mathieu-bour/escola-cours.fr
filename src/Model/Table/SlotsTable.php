<?php

namespace App\Model\Table;

use App\Model\Entity\Slot;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Association\BelongsTo;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Class SlotsTable
 *
 * @author Mathieu Bour <mathieu.tin.bour@gmail.com>
 * @package App\Model\Table
 *
 * @property BelongsTo $Users
 *
 * @method Slot get($primaryKey, $options = [])
 * @method Slot newEntity($data = null, array $options = [])
 * @method Slot[] newEntities(array $data, array $options = [])
 * @method Slot|bool save(EntityInterface $entity, $options = [])
 * @method Slot patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method Slot[] patchEntities($entities, array $data, array $options = [])
 * @method Slot findOrCreate($search, callable $callback = null, $options = [])
 */
class SlotsTable extends Table
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

        $this->setTable('slots');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Courses');
        $this->belongsTo('Levels');
        $this->belongsTo('Users');
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
            ->integer('day')
            ->allowEmpty('day');

        $validator
            ->integer('hour')
            ->allowEmpty('hour');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
