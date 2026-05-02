<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCriteriaTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INTEGER',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'code' => [
                'type'       => 'VARCHAR',
                'constraint' => '5',
                'after'      => 'id'
            ],
            'criteria_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'weight' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
            ],
            'type' => [
                'type'       => 'ENUM',
                'constraint' => ['benefit', 'cost'],
                'default'    => 'benefit',
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('criterias');
    }

    public function down()
    {
        $this->forge->dropTable('criterias');
    }
}
