<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafio 12</title>
    <link rel="stylesheet" href="derick.css?v=<?= time() ?>">
</head>

<body>
    <main>
          <?php
        $erros = [];
        $valorSegundos = null;
        $semanas = null;
        $dias = null;
        $horas = null;
        $minutos = null;
        $semanas = null;
        $segundos = null;
        $resto = null;


        $formEnviado = "";

        $formEnviado = isset($_GET["segundos"]);

        if ($formEnviado) {
            $valorSegundos = trim($_GET['segundos']);
    

            if ($valorSegundos === "") {
                $erros[] = "Digite uma quantidade de segundos.";
            }

            if (empty($erros)) {
                $semanas = intdiv($valorSegundos, 604800);
                $resto = $valorSegundos % 604800;

                $dias = intdiv($resto, 86400);
                $resto = $resto % 86400;

                $horas = intdiv($resto, 3600);
                $resto = $resto % 3600;

                $minutos = intdiv($resto, 60);
                $segundos = $resto % 60;
            }
        }
        ?>
        <header>
            <h1>Reajustador de Preços</h1>
        </header>
        <form action="" method="get">
            <label for="segundos">Qual é o total de segundos?</label>
            <input type="number" name="segundos" id="segundos" step="0.01" value="<?= htmlspecialchars($valorSegundos, ENT_QUOTES, 'UTF-8') ?>">
        

            <button type="submit">Calcular</button>
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
            <h2>Totalizando tudo</h2>
            <p>Analisando o valor que você digitou, <?= htmlspecialchars($valorSegundos, ENT_QUOTES, 'UTF-8') . " segundos" ?> equivalem a um total de:</p>
            <ul>
                <li><?= htmlspecialchars($semanas, ENT_QUOTES, 'UTF-8') ?> semanas</li>
                <li><?= htmlspecialchars($dias, ENT_QUOTES, 'UTF-8') ?> dias</li>
                <li><?= htmlspecialchars($horas, ENT_QUOTES, 'UTF-8') ?> horas</li>
                <li><?= htmlspecialchars($minutos, ENT_QUOTES, 'UTF-8') ?> minutos</li>
                <li><?= htmlspecialchars($segundos, ENT_QUOTES, 'UTF-8') ?> segundos</li>
            </ul>
            
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