<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafio 06</title>
    <link rel="stylesheet" href="derick.css?v=<?= time() ?>">
</head>

<body>
    <?php
    // Bloco de Estado Inicial, criado para evitar erros.
    $erros = [];
    $resto = null;
    $resultadoDivisao = null;

    $dividendo = "";
    $divisor = "";

    //Bloco que Verifica se o Formulário foi Enviado (depende do $_GET, valor na URL)
    $formEnviado = isset($_GET['dividendo']) || isset($_GET['divisor']);

    //Bloco de Captura de dados (depende do $formEnviado)
    if ($formEnviado) {
        $dividendo = trim($_GET['dividendo'] ?? "");
        $divisor = trim($_GET['divisor'] ?? "");

        //Bloco de Validação (dependências $formEnviado, valor em $dividendo, valor em $divisor e valor em $erros)
        if ($dividendo === "") {
            $erros[] = "Digite um dividendo válido.";
        }

        if ($divisor === "") {
            $erros[] = "Digite um divisor válido.";
        }

        if ($dividendo !== "" && !is_numeric($dividendo)) {
            $erros[] = "O dividendo precisa ser um número.";
        }

        if ($divisor !== "" && !is_numeric($divisor)) {
            $erros[] = "O divisor precisa ser um número.";
        }

        if ($divisor !== "" && (float)$divisor == 0) {
            $erros[] = "O divisor não pode ser zero(0).";
        }

        //Bloco de Processamento, calcula apenas se não houver erros (dependências de $formEnviado, principalmente de valor em $erros, $dividendo e $divisor)
        if (empty($erros)) {
            $valorDividendo = (int)$dividendo;
            $valorDivisor = (int)$divisor;

            $resto = $valorDividendo % $valorDivisor;
            $resultadoDivisao = intdiv($valorDividendo, $valorDivisor);
        }
    }
    ?>

    <!-- Bloco do Formulário para Captação dos Dados com o Usuário (dependências de $dividendo e $divisor) -->
    <main>
        <h1>Anatomia de uma Divisão</h1>
        <form action="" method="get">
            <label for="dividendo">Dividendo:</label>
            <input type="number" name="dividendo" id="dividendo" value="<?=htmlspecialchars($dividendo, ENT_QUOTES, 'UTF-8')?>">
            <label for="divisor">Divisor:</label>
            <input type="number" name="divisor" id="divisor" value="<?=htmlspecialchars($divisor, ENT_QUOTES, 'UTF-8')?>">

            <button type="submit">Analisar</button>
        </form>
    </main>

    <!-- //Bloco de Exibição de Erros (depende de $erros) -->
    <?php if (!empty($erros)): ?>
        <section>
            <?php foreach ($erros as $erro): ?>
                <h1 class="aviso"><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></h1>
            <?php endforeach; ?>
        </section>
    <?php endif; ?>

    <!-- //Bloco de Exibição de Resultados (dependências de $resto, $resultadoDivisao, $dividendo e $divisor, principalmente de $resto !== null) -->
    <?php if ($resto !== null): ?>
        <section>
            <h2>Estrutura da Divisão</h2>
            <div id="container-res">
                <div id="res1"><?= htmlspecialchars($dividendo, ENT_QUOTES, 'UTF-8'); ?></div>
                <div id="res2"><?= htmlspecialchars($resto, ENT_QUOTES, 'UTF-8'); ?></div>
                <div id="res3"><?= htmlspecialchars($divisor, ENT_QUOTES, 'UTF-8'); ?></div>
                <div id="res4"><?= htmlspecialchars($resultadoDivisao, ENT_QUOTES, 'UTF-8'); ?></div>
            </div>
        </section>
    <?php endif; ?>
</body>

</html>