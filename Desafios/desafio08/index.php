<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafio 08</title>
    <link rel="stylesheet" href="derick.css?v=<?= time() ?>">
</head>

<body>
    <main>
        <?php
        $erros = [];
        $numero = "";
        $raizQuadrada = null;
        $raizCubica = null;

        $formEnviado = "";

        $formEnviado = isset($_GET["numero"]);

        if ($formEnviado) {
            $numero = trim($_GET['numero']);

            if ($numero === "" && $numero < 0) {
                $erros[] = "Digite um número maior ou igual a zero para calcular a raíz quadrada.";
            }

            if (empty($erros)) {
                $numero = (float)$numero;

                $raizQuadrada = sqrt($numero);
                $raizCubica = $numero ** (1 / 3);
            }
        }
        ?>
        <header>
            <h1>Informe um Número</h1>
        </header>
        <form action="" method="get">
            <label for="numero">Número</label>
            <input type="number" name="numero" id="numero" step="0.01">

            <button type="submit">Calcular Raízes</button>
        </form>
    </main>

    <?php if (!empty($erros)): ?>
        <section>
            <?php foreach ($erros as $erro): ?>
                <h1 class="aviso"><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></h1>
                <h1></h1>
            <?php endforeach; ?>
        </section>
    <?php endif; ?>

    <?php if ($formEnviado && empty($erros)): ?>
        <section>
            <h2>Resultado Final</h2>
            <p>Analisando o <strong>número <?= htmlspecialchars($numero, ENT_QUOTES, 'UTF-8') ?></strong>, temos:</p>
            <div>
                <ul>
                    <li>A sua raíz quadrada é <strong><?= htmlspecialchars(number_format($raizQuadrada, 3, ",", "."), ENT_QUOTES, 'UTF-8') ?></strong>.</li>
                    <li>A sua raíz cúbica é <strong><?= htmlspecialchars(number_format($raizCubica, 3, ",", "."), ENT_QUOTES, 'UTF-8') ?></strong>.</li>
                </ul>
            </div>
        </section>
    <?php endif; ?>
</body>
</html>