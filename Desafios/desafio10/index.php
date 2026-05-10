<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafio 10</title>
    <link rel="stylesheet" href="derick.css?v=<?= time() ?>">
</head>

<body>
    <main>
        <?php
        date_default_timezone_set("America/Sao_Paulo");
        $erros = [];
        $anoAtual = date('Y');
        $nasc = null;
        $consultarAno = null;
        $resultado = null;

        $formEnviado = "";

        $formEnviado = isset($_GET["nasc"]) || isset($_GET["consultarano"]);

        if ($formEnviado) {
            $nasc = trim($_GET['nasc']);
            $consultarAno = trim($_GET['consultarano']);
        
            if ($nasc === "") {
                $erros[] = "Digite o ano de nascimento.";
            } elseif (strlen($nasc) < 4){
                $erros[] = "Digite o ano completo. Ex: 2000";
            }

            if ($consultarAno === "") {
                $erros[] = "Digite o ano que gostaria de saber sua idade.";
            } elseif($consultarAno < $nasc){
                $erros[] = "Ano para consulta inválido (menor que seu nascimento).";
            }

            if (empty($erros)) {
                $resultado = $nasc - $consultarAno;
                $resultado = abs($resultado);
            }
        }
        ?>
        <header>
            <h1>Calculando a sua idade</h1>
        </header>
        <form action="" method="get">
            <label for="nasc">Em que ano você nasceu?</label>
            <input type="number" name="nasc" id="nasc" step="1" minlength="4">
            <label for="consultarano">Quer saber sua idade em que ano? (atualmente estamos em <strong><?= $anoAtual ?></strong>)</label>
            <input type="number" name="consultarano" id="consultarano" step="1">
            

            <button type="submit">Qual será minha idade?</button>
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
            <h2>Resultado</h2>
            <?php echo "<p> Quem nasceu em " . htmlspecialchars($nasc, ENT_QUOTES, 'UTF-8') . " vai ter <strong>" . htmlspecialchars($resultado, ENT_QUOTES, 'UTF-8') . " anos</strong> em " . htmlspecialchars($consultarAno, ENT_QUOTES, 'UTF-8') . "!</p>";
            ?> 
        </section>
    <?php endif; ?>
</body>
</html>