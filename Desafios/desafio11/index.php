<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafio 11</title>
    <link rel="stylesheet" href="derick.css?v=<?= time() ?>">
</head>

<body>
    <main>
        <?php
        $erros = [];
        $valorProduto = null;
        $reajustePercentual = null;
        $resultado = null;

        $formEnviado = "";

        $formEnviado = isset($_GET["valorproduto"]) || isset($_GET["reajustepercentual"]);

        if ($formEnviado) {
            $valorProduto = trim($_GET['valorproduto']);
            $reajustePercentual = trim($_GET['reajustepercentual']);

            if ($valorProduto === "") {
                $erros[] = "Digite o valor do produto.";
            }

            if (empty($erros)) {
                    $resultado = (($valorProduto * $reajustePercentual) / 100) + $valorProduto;
            }
        }
        ?>
        <header>
            <h1>Reajustador de Preços</h1>
        </header>
        <form action="" method="get">
            <label for="valorproduto">Preço do Produto (R$)</label>
            <input type="number" name="valorproduto" id="valorproduto" step="0.01" value="<?= htmlspecialchars($valorProduto, ENT_QUOTES, 'UTF-8') ?>">
            <div class="range-box">
                <label for="reajustepercentual">Qual será o percentual de reajuste? (<span id="percentual">50</span>%)
                </label>
                <input type="range" name="reajustepercentual" id="reajustepercentual" step="1" minlength="0" maxlength="100" value="50">
            </div>

            <button type="submit">Reajustar?</button>
        </form>
    </main>

    <?php if (!empty($erros)): ?>
        <section>
            <?php foreach ($erros as $erro): ?>
                <h2 class="aviso"><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></h2>
                <h1></h1>
            <?php endforeach; ?>
        </section>
    <?php endif; ?>

    <?php if ($formEnviado && empty($erros)): ?>
        <section>
            <h2>Resultado do reajuste</h2>
            <?php echo "<p> O produto que custava R$" . htmlspecialchars(number_format($valorProduto, 2 ,",", "."), ENT_QUOTES, 'UTF-8') . ", com <strong>" . htmlspecialchars($reajustePercentual, ENT_QUOTES, 'UTF-8') . "% de aumento</strong> vai passar a custar R$" . htmlspecialchars(number_format($resultado, 2, ",", "."), ENT_QUOTES, 'UTF-8') . " a partir de agora!</p>";
            ?>
        </section>
    <?php endif; ?>
    <script>
        const rangeInput = document.getElementById('reajustepercentual');
        const valorDisplay = document.getElementById('percentual');

        rangeInput.addEventListener('input', function(){
            valorDisplay.textContent = this.value;
        });
    </script>
</body>

</html>