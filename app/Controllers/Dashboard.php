<?php

namespace App\Controllers;

use App\Models\LancamentoModel;
use CodeIgniter\Controller;

class Dashboard extends BaseController
{
    public function index()
    {
        $usuarioId = session()->get('usuario_id');
        $lancModel = new LancamentoModel();

        // Data atual
        $mesAtual = date('m');
        $anoAtual = date('Y');

        // Totais
        $totalReceitas = $lancModel->totalPorTipo('receita', $usuarioId, $mesAtual, $anoAtual);
        $totalDespesas = $lancModel->totalPorTipo('despesa', $usuarioId, $mesAtual, $anoAtual);
        $saldo = $totalReceitas - $totalDespesas;

        // Últimos lançamentos
        $ultimosLancamentos = $lancModel->where('usuario_id', $usuarioId)
            ->orderBy('data', 'DESC')
            ->limit(5)
            ->findAll();

        // Dados para gráfico de pizza (por categoria)
        $grafico = $lancModel->somaPorCategoria($usuarioId, $mesAtual, $anoAtual);

        return view('dashboard/index', [
            'receitas' => $totalReceitas,
            'despesas' => $totalDespesas,
            'saldo' => $saldo,
            'lancamentos' => $ultimosLancamentos,
            'grafico' => $grafico,
        ]);
    }
}
