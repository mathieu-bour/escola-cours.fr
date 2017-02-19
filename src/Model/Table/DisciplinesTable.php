<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Disciplines Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Users
 *
 * @method \App\Model\Entity\Discipline get($primaryKey, $options = [])
 * @method \App\Model\Entity\Discipline newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Discipline[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Discipline|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Discipline patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Discipline[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Discipline findOrCreate($search, callable $callback = null, $options = [])
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

        $this->table('disciplines');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsToMany('Users', [
            'foreignKey' => 'discipline_id',
            'targetForeignKey' => 'user_id',
            'joinTable' => 'disciplines_users'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
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
