<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateSleepLogs extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('sleep_logs');
        $table->addColumn('user_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('date', 'date', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('bedtime', 'time', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('wake_time', 'time', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('cycles_count', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('nap_afternoon', 'boolean', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('nap_evening', 'boolean', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('morning_form_score', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('comment', 'text', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('sports_activity', 'boolean', [
            'default' => null,
            'null' => false,
        ]);
        $table->create();
    }
}
