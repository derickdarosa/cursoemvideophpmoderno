<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafio 09</title>
    <link rel="stylesheet" href="derick.css?v=<?= time() ?>">
</head>

<body>
    <main>
        <?php
        $erros = [];
        $primeiroValor = null;
        $primeiroPeso = null;
        $segundoValor = null;
        $segundoPeso = null;
        $mediaSimples = null;
        $mediaPonderada = null;

        $formEnviado = "";

        $formEnviado = isset($_GET["primeirovalor"]) || isset($_GET["primeiropeso"]) || isset($_GET["segundovalor"]) || isset($_GET["segundopeso"]);

        if ($formEnviado) {
            $primeiroValor = trim($_GET['primeirovalor']);
            $primeiroPeso = trim($_GET['primeiropeso']);
            $segundoValor = trim($_GET['segundovalor']);
            $segundoPeso = trim($_GET['segundopeso']);

            if ($primeiroValor === "") {
                $erros[] = "Digite um primeiro valor.";
            }

            if ($primeiroPeso === "") {
                $erros[] = "Digite um primeiro peso.";
            }

            if ($segundoValor === "") {
                $erros[] = "Digite um segundo valor.";
            }

            if ($segundoPeso === "") {
                $erros[] = "Digite um segundo peso.";
            }

            if (empty($erros)) {
                $mediaSimples = ($primeiroValor + $segundoValor) / 2;
                $mediaPonderada = ($primeiroValor * $primeiroPeso + $segundoValor * $segundoPeso) / ($primeiroPeso + $segundoPeso);
            }
        }
        ?>
        <header>
            <h1>MÉDIAS ARITMÉTICAS</h1>
        </header>
        <form action="" method="get">
            <label for="primeirovalor">1º Valor</label>
            <input type="number" name="primeirovalor" id="primeirovalor" step="0.01">
            <label for="primeiropeso">1º Peso</label>
            <input type="number" name="primeiropeso" id="primeiropeso" step="0.01">
            <label for="segundovalor">2º Valor</label>
            <input type="number" name="segundovalor" id="segundovalor" step="0.01">
            <label for="segundopeso">2º Peso</label>
            <input type="number" name="segundopeso" id="segundopeso" step="0.01">


            <button type="submit">Calcular Médias</button>
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
            <h2>Cálculo das Médias</h2>
            <p>Analisando os valores <strong><?= htmlspecialchars($primeiroValor, ENT_QUOTES, 'UTF-8') ?> e <?= htmlspecialchars($segundoValor, ENT_QUOTES, 'UTF-8') ?></strong>:</p>
            <div>
                <ul>
                    <li>A <strong>Média Aritmética Simples</strong> entre os valores é igual a <?= htmlspecialchars(number_format($mediaSimples, 2, ",", "."), ENT_QUOTES, 'UTF-8') ?>.</li>
                    <li>A <strong>Média Aritmética Ponderada</strong> entre os valores <?= htmlspecialchars($primeiroPeso, ENT_QUOTES, 'UTF-8') ?> e <?= htmlspecialchars($segundoPeso, ENT_QUOTES, 'UTF-8') ?> é igual a <?= htmlspecialchars(number_format($mediaPonderada, 2, ",", "."), ENT_QUOTES, 'UTF-8') ?></strong>.</li>
                </ul>
            </div>
        </section>
    <?php endif; ?>
</body>
</html>