<?php

namespace App\Models;

use CodeIgniter\Model;

class LancamentoModel extends Model
{
    protected $table            = 'lancamentos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields    = [
        'usuario_id',
        'categoria_id',
        'descricao',
        'valor',
        'data',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Soma o total por tipo (receita ou despesa)
     */
    public function totalPorTipo($tipo, $usuarioId, $mes, $ano)
    {
        return $this->select('SUM(valor) as total')
            ->join('categorias', 'categorias.id = lancamentos.categoria_id')
            ->where('categorias.tipo', $tipo)
            ->where('lancamentos.usuario_id', $usuarioId)
            ->where('MONTH(data)', $mes)
            ->where('YEAR(data)', $ano)
            ->first()['total'] ?? 0;
    }

    /**
     * Soma o valor agrupado por categoria
     */
    public function somaPorCategoria($usuarioId, $mes, $ano)
    {
        return $this->select('categorias.nome, SUM(valor) as total')
            ->join('categorias', 'categorias.id = lancamentos.categoria_id')
            ->where('lancamentos.usuario_id', $usuarioId)
            ->where('MONTH(data)', $mes)
            ->where('YEAR(data)', $ano)
            ->groupBy('categorias.nome')
            ->findAll();
    }
}
