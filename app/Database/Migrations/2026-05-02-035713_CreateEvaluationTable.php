<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEvaluationTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INTEGER',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'student_id' => [
                'type'       => 'INTEGER',
                'unsigned'   => true,
            ],
            'criteria_id' => [
                'type'       => 'INTEGER',
                'unsigned'   => true,
            ],
            'value' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'period' => [
                'type'       => 'VARCHAR',
                'constraint' => '7',
                'null'       => false,
                'after'      => 'criteria_id'
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);

        $this->forge->addForeignKey('student_id', 'students', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('criteria_id', 'criterias', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('evaluations');
    }

    public function down()
    {
        $this->forge->dropTable('evaluations');
    }
}
