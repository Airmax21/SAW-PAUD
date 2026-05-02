<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateClassTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INTEGER',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'class_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'academic_year' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'null'       => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('classes');
    }

    public function down()
    {
        $this->forge->dropTable('classes');
    }
}
