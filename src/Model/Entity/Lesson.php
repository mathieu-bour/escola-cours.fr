<?php
namespace App\Model\Entity;

use Cake\I18n\Time;
use Cake\ORM\Entity;

/**
 * Class Lesson
 *
 * @author Mathieu Bour <mathieu.tin.bour@gmail.com>
 * @package App\Model\Entity
 *
 * @property int $id
 * @property Time $beginning
 * @property float $duration
 * @property int $teacher_id
 * @property int $user_id
 * @property int $level_id
 * @property int $discipline_id
 *
 * @property User $teacher
 * @property User $user
 * @property Level $level
 * @property Discipline $discipline
 */
class Lesson extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
