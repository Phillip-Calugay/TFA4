<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPasswordToUsers extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'default' => '$2y$10$tJqNq32NpRZPouRvVCrcRunRsiEqNxlrGWuqvUrfkRImkqflpCO1K',
                'after' => 'full_name',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'password');
    }
}
