<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Route Entity
 *
 * @property int $id
 * @property string $origin_route
 * @property string $destiny_route
 * @property int $altonomy_route
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $modified
 */
class Route extends Entity
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
        'origin_route' => true,
        'destiny_route' => true,
        'altonomy_route' => true,
        'created' => true,
        'modified' => true
    ];
}
