<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercício Form Retroalimentado</title>
    <link rel="stylesheet" href="derick.css?v=<?= time() ?>">
</head>

<body>
    <?php 
        $first_number = $_GET['first-number'] ?? 0;
        $second_number = $_GET['second-number'] ?? 0;
    ?>
    <main>
        <div class="main-title">
            <h2>Calculadora Prática</h2>
            <p>Digite dois números e clique em <strong>Calcular</strong> para obter o resultado</p>
        </div>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="get">
            <label for="first-number">Digite o primeiro número: </label>
            <input type="number" name="first-number" id="first-number" step="1" value="<?= $first_number ?>">

            <label for="second-number">Digite o segundo número: </label>
            <input type="number" name="second-number" id="second-number" step="1" value="<?= $second_number ?>">

            <button type="submit">Calcular</button>
        </form>
    </main>
    <section id="resultado">
        <h2>Resultado da Soma</h2>
        <?php 
            $soma = $first_number + $second_number;
            echo "<p>A soma dos valores $first_number e $second_number é $soma!</p>";
        ?>
    </section>

</body>
</html>