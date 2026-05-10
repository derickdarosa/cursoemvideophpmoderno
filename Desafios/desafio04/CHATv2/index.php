<?php
declare(strict_types=1);

function formatarDataParaBancoCentral(string $data): string
{
    $dataObj = DateTime::createFromFormat('Y-m-d', $data);

    if (!$dataObj) {
        throw new Exception('Data inválida.');
    }

    return $dataObj->format('m-d-Y');
}

function buscarCotacaoBancoCentral(string $moeda, string $data): ?array
{
    $dataFormatada = formatarDataParaBancoCentral($data);

    $url = "https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/"
        . "CotacaoMoedaDia(moeda=@moeda,dataCotacao=@dataCotacao)"
        . "?\$top=100"
        . "&\$format=json"
        . "&@moeda='" . urlencode($moeda) . "'"
        . "&@dataCotacao='" . urlencode($dataFormatada) . "'";

    $resposta = file_get_contents($url);

    if ($resposta === false) {
        throw new Exception('Erro ao consultar a API do Banco Central.');
    }

    $dados = json_decode($resposta, true);

    if (!isset($dados['value']) || count($dados['value']) === 0) {
        return null;
    }

    // Pega a última cotação do dia, geralmente o fechamento.
    return end($dados['value']);
}

function converterMoeda(float $valor, float $cotacao): float
{
    return $valor * $cotacao;
}

$moedasDisponiveis = [
    'USD' => 'Dólar Americano',
    'EUR' => 'Euro',
    'GBP' => 'Libra Esterlina',
    'ARS' => 'Peso Argentino',
    'CAD' => 'Dólar Canadense',
    'AUD' => 'Dólar Australiano',
    'JPY' => 'Iene Japonês',
];

$resultado = null;
$erro = null;

$valor = $_POST['valor'] ?? '';
$moeda = $_POST['moeda'] ?? 'USD';
$data = $_POST['data'] ?? date('Y-m-d');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $valorNumerico = filter_var($valor, FILTER_VALIDATE_FLOAT);

        if ($valorNumerico === false || $valorNumerico <= 0) {
            throw new Exception('Digite um valor válido maior que zero.');
        }

        if (!array_key_exists($moeda, $moedasDisponiveis)) {
            throw new Exception('Moeda inválida.');
        }

        $cotacao = buscarCotacaoBancoCentral($moeda, $data);

        if ($cotacao === null) {
            throw new Exception('Não foi encontrada cotação para essa data. Tente um dia útil anterior.');
        }

        $valorConvertido = converterMoeda($valorNumerico, (float) $cotacao['cotacaoVenda']);

        $resultado = [
            'valorOriginal' => $valorNumerico,
            'moeda' => $moeda,
            'nomeMoeda' => $moedasDisponiveis[$moeda],
            'cotacaoVenda' => (float) $cotacao['cotacaoVenda'],
            'cotacaoCompra' => (float) $cotacao['cotacaoCompra'],
            'valorConvertido' => $valorConvertido,
            'dataHoraCotacao' => $cotacao['dataHoraCotacao'],
            'tipoBoletim' => $cotacao['tipoBoletim'],
        ];
    } catch (Exception $e) {
        $erro = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Conversor de Moedas - Banco Central</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            min-height: 100vh;
            margin: 0;
            background: #111827;
            color: #f9fafb;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .container {
            width: 100%;
            max-width: 480px;
            background: #1f2937;
            padding: 32px;
            border-radius: 18px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, .35);
        }

        h1 {
            margin-top: 0;
            font-size: 1.8rem;
        }

        p {
            color: #d1d5db;
        }

        label {
            display: block;
            margin-top: 18px;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input,
        select,
        button {
            width: 100%;
            padding: 14px;
            border-radius: 10px;
            border: none;
            font-size: 1rem;
        }

        input,
        select {
            background: #374151;
            color: #fff;
            outline: 1px solid #4b5563;
        }

        button {
            margin-top: 24px;
            background: #22c55e;
            color: #052e16;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #16a34a;
        }

        .resultado,
        .erro {
            margin-top: 24px;
            padding: 18px;
            border-radius: 12px;
        }

        .resultado {
            background: #064e3b;
        }

        .erro {
            background: #7f1d1d;
        }

        strong {
            color: #ffffff;
        }

        .detalhes {
            font-size: .9rem;
            color: #d1d5db;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Conversor de Moedas</h1>
    <p>Converta moedas estrangeiras para Real usando a cotação PTAX do Banco Central.</p>

    <form method="post">
        <label for="valor">Valor em moeda estrangeira</label>
        <input
            type="number"
            name="valor"
            id="valor"
            step="0.01"
            min="0"
            value="<?= htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8') ?>"
            required
        >

        <label for="moeda">Moeda</label>
        <select name="moeda" id="moeda">
            <?php foreach ($moedasDisponiveis as $codigo => $nome): ?>
                <option value="<?= $codigo ?>" <?= $moeda === $codigo ? 'selected' : '' ?>>
                    <?= $codigo ?> - <?= $nome ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="data">Data da cotação</label>
        <input
            type="date"
            name="data"
            id="data"
            value="<?= htmlspecialchars($data, ENT_QUOTES, 'UTF-8') ?>"
            required
        >

        <button type="submit">Converter para Real</button>
    </form>

    <?php if ($erro): ?>
        <div class="erro">
            <strong>Erro:</strong>
            <?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?>
        </div>
    <?php endif; ?>

    <?php if ($resultado): ?>
        <div class="resultado">
            <h2>Resultado</h2>

            <p>
                <?= number_format($resultado['valorOriginal'], 2, ',', '.') ?>
                <?= htmlspecialchars($resultado['moeda'], ENT_QUOTES, 'UTF-8') ?>
                =
                <strong>
                    R$ <?= number_format($resultado['valorConvertido'], 2, ',', '.') ?>
                </strong>
            </p>

            <p class="detalhes">
                Cotação venda:
                R$ <?= number_format($resultado['cotacaoVenda'], 4, ',', '.') ?>
                <br>

                Cotação compra:
                R$ <?= number_format($resultado['cotacaoCompra'], 4, ',', '.') ?>
                <br>

                Tipo do boletim:
                <?= htmlspecialchars($resultado['tipoBoletim'], ENT_QUOTES, 'UTF-8') ?>
                <br>

                Data/hora da cotação:
                <?= htmlspecialchars($resultado['dataHoraCotacao'], ENT_QUOTES, 'UTF-8') ?>
            </p>
        </div>
    <?php endif; ?>
</div>

</body>
</html>