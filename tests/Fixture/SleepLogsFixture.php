<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SleepLogsFixture
 */
class SleepLogsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'user_id' => 1,
                'date' => '2024-12-03',
                'bedtime' => '14:39:26',
                'wake_time' => '14:39:26',
                'cycles_count' => 1,
                'nap_afternoon' => 1,
                'nap_evening' => 1,
                'morning_form_score' => 1,
                'comment' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'sports_activity' => 1,
            ],
        ];
        parent::init();
    }
}
