<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsuarios extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'nome' => ['type' => 'VARCHAR', 'constraint' => 100],
            'email' => ['type' => 'VARCHAR', 'constraint' => 100],
            'senha' => ['type' => 'VARCHAR', 'constraint' => 255],
            'criado_em' => ['type' => 'DATETIME', 'null' => false, 'default' => date('Y-m-d H:i:s')],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('usuarios');
    }



    public function down()
    {
        $this->forge->dropTable('usuarios');
    }
}
