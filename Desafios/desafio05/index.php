<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analisador de número real</title>
    <link rel="stylesheet" href="styles.css?v=<?= time()?>">
</head>

<body>
    <main>
        <h1>Analisador de Número Real</h1>
            <form action="analise.php" method="post">
                <label for="n">Número Real: </label>
                <input type="number" name="n" id="n" step="0.001">

                <input type="submit" value="Analisar">
            </form>
    </main>
</body>

</html>