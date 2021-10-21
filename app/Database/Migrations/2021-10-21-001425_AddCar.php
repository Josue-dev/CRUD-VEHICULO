<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCar extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'placa' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ],
            'tipo' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ],
            'marca' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'linea' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'modelo' => [
                'type' => 'INT',
                'constraint' => 100,
                'null' => false
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
            'created_at datetime default current_timestamp',
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('car');
    }

    public function down()
    {
        $this->forge->dropTable('car');
    }
}
