<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;
/**
 * User Entity.
 *
 * @property int $id
 * @property string $login
 * @property string $password
 * @property string $role
 * @property \Cake\I18n\Time $creation_date
 * @property \App\Model\Entity\PersonalData[] $personal_data
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
        'id' => false,
    ];

   protected function _getFullName()
    {
        return $this->personal_data[0]->first_name . '  ' .
            $this->personal_data[0]->last_name;
    }

    protected function _setPassword($password)
    {
        return (new DefaultPasswordHasher)->hash($password);
    }
}
