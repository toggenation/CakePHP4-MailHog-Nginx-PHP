<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateUsersTable extends AbstractMigration
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
        /**
         * 
         *   CREATE TABLE users (
         *     id INT AUTO_INCREMENT PRIMARY KEY,
         *     email VARCHAR(255) NOT NULL,
         *     password VARCHAR(255) NOT NULL,
         *     created DATETIME,
         *     modified DATETIME
         *   );
         */

        $this->table('users')
            ->addColumn('name', 'string', ['null' => false])
            ->addColumn('email', 'string', ['null' => false])
            ->addTimestamps('created', 'modified')
            ->create();
    }
}
