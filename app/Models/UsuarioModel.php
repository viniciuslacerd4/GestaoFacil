<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nome', 'email', 'senha', 'criado_em'];
    protected $returnType = 'array';

    public function getByEmail($email)
    {
        return $this->where('email', $email)->first();
    }
}
