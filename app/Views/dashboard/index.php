<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <h1>Olá, <?= session()->get('usuario_nome') ?> 👋</h1>

    <h3>Resumo do mês:</h3>
    <ul>
        <li><strong>Receitas:</strong> R$ <?= number_format($receitas, 2, ',', '.') ?></li>
        <li><strong>Despesas:</strong> R$ <?= number_format($despesas, 2, ',', '.') ?></li>
        <li><strong>Saldo:</strong> R$ <?= number_format($saldo, 2, ',', '.') ?></li>
    </ul>

    <h3>Gráfico por categoria:</h3>
    <canvas id="graficoPizza" width="300" height="300"></canvas>

    <script>
        const ctx = document.getElementById('graficoPizza');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: <?= json_encode(array_column($grafico, 'nome')) ?>,
                datasets: [{
                    label: 'Por categoria',
                    data: <?= json_encode(array_column($grafico, 'total')) ?>,
                }]
            }
        });
    </script>

    <h3>Últimos Lançamentos</h3>
    <ul>
        <?php foreach ($lancamentos as $l): ?>
            <li>
                <?= $l['data'] ?> - <?= $l['titulo'] ?>: R$ <?= number_format($l['valor'], 2, ',', '.') ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>

</html>