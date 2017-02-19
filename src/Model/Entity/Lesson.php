<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Lesson Entity
 *
 * @property int $id
 * @property int $teacher_id
 * @property \Cake\I18n\Time $beginning
 * @property float $duration
 *
 * @property \App\Model\Entity\User $teacher
 * @property \App\Model\Entity\User[] $users
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


    /**
     * Get the users ids linked with a lesson
     * @return array the users ids
     */
    public function getUsersIds()
    {
        $ids = [$this->teacher_id];

        foreach ($this->users as $user) {
            $ids[] = $user->id;
        }

        return $ids;
    }
}
