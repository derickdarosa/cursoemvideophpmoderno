<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercício Form Retroalimentado</title>
    <link rel="stylesheet" href="derick.css?v=<?= time() ?>">
</head>

<body>
    <main>
        <div class="main-title">
            <h2>Calculadora Prática</h2>
            <p>Digite dois números e clique em <strong>Calcular</strong> para obter o resultado</p>
        </div>
        <form action="" method="get">
            <label for="first-number">Digite o primeiro número: </label>
            <input type="number" name="first-number" id="first-number" step="1">
            <label for="second-number">Digite o segundo número: </label>
            <input type="number" name="second-number" id="second-number" step="1">

            <button type="submit">Calcular</button>
        </form>
    </main>
    <?php
        $erros = [];
        $soma = null;

        if($_SERVER['REQUEST_METHOD'] === "GET"){
            $first_number = trim($_GET['first-number'] ?? "");
            $second_number = trim($_GET['second-number'] ?? "");

            if($first_number === "") {
                $erros[] = "Digite o primeiro número.";
            }

            if($second_number === "") {
                $erros[] = "Digite o segundo número.";
            }

            if($first_number !== "" && !is_numeric($first_number)){
                $erros[] = "O primeiro valor precisa ser número";
            }

            if($second_number !== "" && !is_numeric($second_number)){
                $erros[] = "O segundo valor precisa ser número";
            }

            if(empty($erros)){
                $first_number_converted = (float)$first_number;
                $second_number_converted = (float)$second_number;

                $soma = $first_number_converted + $second_number_converted;
            }
        }
    ?>

    <?php if(!empty($erros)): ?>
        <section class="erros">
            <?php foreach($erros as $erro): ?>
                <h1 class="aviso"><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></h1>
            <?php endforeach; ?>
        </section>
    <?php endif; ?>

    <?php if($soma !== null): ?>
        <section>
            <h1> A soma dos valores é <?= htmlspecialchars($soma, ENT_QUOTES, 'UTF-8')?>!</h1>
    </section>
    <?php endif; ?>
</body>
</html>