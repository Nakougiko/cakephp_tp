<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SleepLogsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SleepLogsTable Test Case
 */
class SleepLogsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SleepLogsTable
     */
    protected $SleepLogs;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.SleepLogs',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('SleepLogs') ? [] : ['className' => SleepLogsTable::class];
        $this->SleepLogs = $this->getTableLocator()->get('SleepLogs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->SleepLogs);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\SleepLogsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\SleepLogsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
