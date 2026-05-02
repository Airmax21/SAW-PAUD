<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSubCriteriaTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INTEGER',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'criteria_id' => [
                'type'     => 'INTEGER',
                'unsigned' => true,
            ],
            'sub_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('criteria_id', 'criterias', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('sub_criterias');
    }

    public function down()
    {
        $this->forge->dropTable('sub_criterias');
    }
}
