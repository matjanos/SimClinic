<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Analyze Entity.
 *
 * @property int $id
 * @property int $examination_id
 * @property \App\Model\Entity\Examination $examination
 * @property int $doctor_id
 * @property \App\Model\Entity\User $user
 * @property \Cake\I18n\Time $date
 * @property \App\Model\Entity\Parameter[] $parameters
 */
class Analyze extends Entity
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
}
