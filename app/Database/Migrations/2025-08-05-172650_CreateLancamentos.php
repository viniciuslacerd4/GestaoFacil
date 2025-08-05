<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLancamentos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'titulo' => ['type' => 'VARCHAR', 'constraint' => 255],
            'valor' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'data' => ['type' => 'DATE'],
            'categoria_id' => ['type' => 'INT'],
            'usuario_id' => ['type' => 'INT'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('categoria_id', 'categorias', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('usuario_id', 'usuarios', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('lancamentos');
    }


    public function down()
    {
        $this->forge->dropTable('lancamentos');
    }
}
