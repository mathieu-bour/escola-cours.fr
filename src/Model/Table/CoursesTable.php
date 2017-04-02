<?php
namespace App\Model\Table;

use App\Model\Entity\Course;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Association\BelongsTo;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Class CoursesTable
 *
 * @author Mathieu Bour <mathieu.tin.bour@gmail.com>
 * @package App\Model\Table
 *
 * @property BelongsTo $Users
 * @property BelongsTo $Levels
 * @property BelongsTo $Disciplines
 *
 * @method Course get($primaryKey, $options = [])
 * @method Course newEntity($data = null, array $options = [])
 * @method Course[] newEntities(array $data, array $options = [])
 * @method Course|bool save(EntityInterface $entity, $options = [])
 * @method Course patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method Course[] patchEntities($entities, array $data, array $options = [])
 * @method Course findOrCreate($search, callable $callback = null, $options = [])
 */
class CoursesTable extends Table
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

        $this->setTable('courses');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        // Relations
        $this->belongsTo('Users');
        $this->belongsTo('Levels');
        $this->belongsTo('Disciplines');
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
        $rules->add($rules->existsIn(['level_id'], 'Levels'));
        $rules->add($rules->existsIn(['discipline_id'], 'Disciplines'));

        return $rules;
    }
}
