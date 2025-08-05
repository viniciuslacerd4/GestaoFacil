<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCategorias extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'nome' => ['type' => 'VARCHAR', 'constraint' => 100],
            'tipo' => ['type' => 'ENUM', 'constraint' => ['receita', 'despesa']],
            'usuario_id' => ['type' => 'INT'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('usuario_id', 'usuarios', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('categorias');
    }


    public function down()
    {
        $this->forge->dropTable('categorias');
    }
}
