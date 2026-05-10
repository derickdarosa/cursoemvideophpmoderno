<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafio 07</title>
    <link rel="stylesheet" href="derick.css?v=<?= time() ?>">
</head>

<body>
    <main>
        <?php
        $erros = [];
        $salarioMinimo = 1621;
        $salario = "";
        $sobras = "";
        $quantidadeSalarios = "";
        $formEnviado = "";

        $formEnviado = isset($_GET["salario"]);

        if ($formEnviado) {
            $salario = trim($_GET['salario']);

            if ($salario === "") {
                $erros[] = "Digite o valor do salário.";
            }

            if (empty($erros)) {
                $salario = (float)$salario;

                $quantidadeSalarios = intdiv($salario, $salarioMinimo);
                $sobras = ($quantidadeSalarios * $salarioMinimo) - $salario;
            }
        }
        ?>
        <header>
            <h1>Informe seu Salário</h1>
        </header>
        <form action="" method="get">
            <label for="salario">Salário (R$)</label>
            <input type="number" name="salario" id="salario" step="0.01">
            <p>Considerando o salário mínimo de <strong>R$1.621,00</strong></p>
            <button type="submit">Calcular</button>
        </form>
    </main>

    <?php if(!empty($erros)): ?>
        <section>
            <?php foreach($erros as $erro): ?>
                <h1 class="aviso"><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></h1>
            <h1></h1>
            <?php endforeach;?>
        </section>
    <?php endif;?>

    <?php if($formEnviado): ?>
        <section>
            <h2>Resultado Final</h2>
            <?= "Quem recebe um salário de R$" .
            htmlspecialchars(number_format(str_replace(",",".",$salario), 2, ",", "."), ENT_QUOTES, 'UTF-8') .
            " ganha <strong>" . 
            htmlspecialchars($quantidadeSalarios, ENT_QUOTES, 'UTF-8') .
            " salários mínimos</strong> + R$" . htmlspecialchars(number_format(abs((float) str_replace(",", ".", $sobras)), 2, ",", "."), ENT_QUOTES, 'UTF-8') ?>
        </section>
    <?php endif; ?>
</body>
</html>