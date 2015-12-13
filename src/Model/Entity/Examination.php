<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Examination Entity.
 *
 * @property int $id
 * @property int $technican_id
 * @property int $patient_id
 * @property \App\Model\Entity\User $user
 * @property \Cake\I18n\Time $date
 * @property int $eye_side
 * @property string $image_path
 * @property \App\Model\Entity\Analyze[] $analyzes
 */
class Examination extends Entity
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
