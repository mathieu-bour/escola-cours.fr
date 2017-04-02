<?php

namespace App\Model\Table;

use App\Model\Entity\Lesson;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Association\BelongsTo;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Class LessonsTable
 *
 * @author Mathieu Bour <mathieu.tin.bour@gmail.com>
 * @package App\Model\Table
 *
 * @property BelongsTo $Teachers
 * @property BelongsTo $Users
 * @property BelongsTo $Disciplines
 * @property BelongsTo $Levels
 *
 * @method Lesson get($primaryKey, $options = [])
 * @method Lesson newEntity($data = null, array $options = [])
 * @method Lesson[] newEntities(array $data, array $options = [])
 * @method Lesson|bool save(EntityInterface $entity, $options = [])
 * @method Lesson patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method Lesson[] patchEntities($entities, array $data, array $options = [])
 * @method Lesson findOrCreate($search, callable $callback = null, $options = [])
 */
class LessonsTable extends Table
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

        $this->setTable('lessons');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Disciplines');
        $this->belongsTo('Levels');
        $this->belongsTo('Teachers', [
            'className' => 'Users',
            'foreignKey' => 'teacher_id'
        ]);
        $this->belongsTo('Users');

        $this->addBehavior('CounterCache', [
            'Users' => ['lesson_count'],
            'Teachers' => ['lesson_count']
        ]);
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
            ->dateTime('beginning')
            ->allowEmpty('beginning');

        $validator
            ->numeric('duration')
            ->allowEmpty('duration');

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
        $rules->add($rules->existsIn(['teacher_id'], 'Users'));

        return $rules;
    }
}
