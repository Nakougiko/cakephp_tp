<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class UpdateUsersTableActifConstraint extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('users');
        $table->changeColumn('actif', 'boolean', [
            'default' => 0,
            'null' => false
        ])
        ->update();
    }
}
