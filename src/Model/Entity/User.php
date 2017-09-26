<?php

namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\I18n\FrozenDate;
use Cake\ORM\Entity;

/**
 * Class User
 *
 * @author Mathieu Bour <mathieu.tin.bour@gmail.com>
 * @package App\Model\Entity;
 *
 * @property int $id
 * @property bool $admin
 * @property string $token
 * @property string $email
 * @property string $password
 * @property string $type
 * @property string $lastname
 * @property string $firstname
 * @property string $telephone
 * @property string $address
 * @property string $zip_code
 * @property string $city
 * @property string $social_security_number
 * @property string $urssaf_email
 * @property string $urssaf_password
 * @property int $lesson_count
 * @property FrozenDate $created
 *
 * @property Course[] $courses
 * @property Lesson[] $lessons
 */
class User extends Entity
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
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

    /**
     * Setter for password field
     * @param string $password
     * @see DefaultPasswordHasher
     * @return bool|string
     */
    protected function _setPassword(string $password)
    {
        return (new DefaultPasswordHasher)->hash($password);
    }
}
