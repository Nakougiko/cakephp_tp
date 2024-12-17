<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SleepLog Entity
 *
 * @property int $id
 * @property int $user_id
 * @property \Cake\I18n\Date $date
 * @property \Cake\I18n\Time $bedtime
 * @property \Cake\I18n\Time $wake_time
 * @property int $cycles_count
 * @property bool $nap_afternoon
 * @property bool $nap_evening
 * @property int $morning_form_score
 * @property string $comment
 * @property bool $sports_activity
 *
 * @property \App\Model\Entity\User $user
 */
class SleepLog extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'user_id' => true,
        'date' => true,
        'bedtime' => true,
        'wake_time' => true,
        'cycles_count' => true,
        'nap_afternoon' => true,
        'nap_evening' => true,
        'morning_form_score' => true,
        'comment' => true,
        'sports_activity' => true,
        'user' => true,
    ];

    protected $_dates = ['date'];
}
