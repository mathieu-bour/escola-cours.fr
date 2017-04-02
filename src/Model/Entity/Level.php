<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Class Level
 *
 * @author Mathieu Bour <mathieu.tin.bour@gmail.com>
 * @package App\Model\Entity
 *
 * @property int $id
 * @property string $name
 *
 * @property Course[] $courses
 * @property Lesson[] $lessons
 */
class Level extends Entity
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
