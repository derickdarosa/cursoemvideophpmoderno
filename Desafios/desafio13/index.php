<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafio 13</title>
    <link rel="stylesheet" href="derick.css?v=<?= time() ?>">
</head>

<body>
    <main>
      <?php
        $erros = [];
        $valorSaque = null;
        $notasCem = null;
        $notasCinquenta = null;
        $notasDez = null;
        $notasCinco = null;
        $resto = null;

        $formEnviado = "";

        $formEnviado = isset($_GET["saque"]);

        if ($formEnviado) {
            $valorSaque = trim($_GET['saque']);
    

            if ($valorSaque === "") {
                $erros[] = "Digite um valor para saque.";
            } elseif($valorSaque % 5 !== 0){
                $erros[] = "Valor não disponível para saque.";
            }

            if (empty($erros)) {
                $notasCem = intdiv($valorSaque, 100);
                $resto = $valorSaque % 100;

                $notasCinquenta = intdiv($resto, 50);
                $resto = $resto % 50;

                $notasDez = intdiv($resto, 10);
                $resto = $resto % 10;

                $notasCinco = intdiv($resto, 5);
            }
        }
        ?>
        <header>
            <h1>Caixa Eletrônico</h1>
        </header>
        <form action="" method="get">
            <label for="saque">Qual valor você deseja sacar? (R$)*</label>
            <input type="number" name="saque" id="saque" step="0.01" value="<?= htmlspecialchars($valorSaque, ENT_QUOTES, 'UTF-8') ?>">
            <p id="obs-notas">*Notas disponíveis: R$100, R$50, R$10 e R$5</p>

            <button type="submit">Sacar</button>
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
            <h2>Saque de R$<?= $valorSaque ?> realizado!</h2>
            <p id="res-notas">O caixa eletrônico vai te entregar as seguintes notas: </p>
            <div class="container-box">
                <div id="row-a">
                    <img src="./100reais.png" alt="" class="img-notas col-a">
                    <span class="col-b">➡</span>
                    <p class="col-c"> <?= htmlspecialchars($notasCem, ENT_QUOTES, 'UTF-8') ?></p>
                </div>
                <div id="row-b">
                    <img src="./50reais.png" alt="" class="img-notas col-a">
                    <span class="col-b">➡</span>
                    <p class="col-c"> <?= htmlspecialchars($notasCinquenta, ENT_QUOTES, 'UTF-8') ?></p>
                </div>
                <div id="row-c">
                    <img src="./10reais.png" alt="" class="img-notas col-a">
                    <span class="col-b">➡</span>
                    <p class="col-c"> <?= htmlspecialchars($notasDez, ENT_QUOTES, 'UTF-8') ?></p>
                </div>
                <div id="row-d">
                    <img src="./5reais.png" alt="" class="img-notas col-a">
                    <span class="col-b">➡</span>
                    <p class="col-c"> <?= htmlspecialchars($notasCinco, ENT_QUOTES, 'UTF-8') ?></p>
                </div>
            </div>
            
        </section>
    <?php endif; ?>
</body>

</html>