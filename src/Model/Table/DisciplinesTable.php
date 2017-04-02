<?php

namespace App\Model\Table;

use App\Model\Entity\Discipline;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Association\HasMany;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Class DisciplinesTable
 *
 * @author Mathieu Bour <mathieu.tin.bour@gmail.com>
 * @package App\Model\Table
 *
 * @property HasMany $Courses
 * @property HasMany $Lessons
 *
 * @method Discipline get($primaryKey, $options = [])
 * @method Discipline newEntity($data = null, array $options = [])
 * @method Discipline[] newEntities(array $data, array $options = [])
 * @method Discipline|bool save(EntityInterface $entity, $options = [])
 * @method Discipline patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method Discipline[] patchEntities($entities, array $data, array $options = [])
 * @method Discipline findOrCreate($search, callable $callback = null, $options = [])
 */
class DisciplinesTable extends Table
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

        $this->setTable('disciplines');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        // Relations
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
            ->integer('lesson_count')
            ->allowEmpty('lesson_count');

        $validator
            ->integer('student_count')
            ->allowEmpty('student_count');

        $validator
            ->integer('teacher_count')
            ->allowEmpty('teacher_count');

        return $validator;
    }
}
