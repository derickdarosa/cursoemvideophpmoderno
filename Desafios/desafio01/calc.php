<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css?v=2">
</head>
<body>
    <main>
        <h1>Resultado final</h1>
        <?php 
            $numeroEscolhido = $_GET['number'] ?? "";
            $antecessor = $numeroEscolhido - 1;
            $sucessor = $numeroEscolhido + 1;

            echo "O número escolhido foi <strong>$numeroEscolhido</strong><br>";
            echo "O seu <i>antecessor</i> é $antecessor<br>";
            echo "O seu <i>sucessor</i> é $sucessor";
        ?>
        <a href="index.php" class="btn-voltar">Voltar</a>
    </main>
</body>
</html>