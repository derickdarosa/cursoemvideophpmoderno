<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forms On PHP</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Apresente-se para nós!</h1>
    </header>
    <section>
        <form method="get" action="cad.php">
            <fieldset>
                <label for="nome">Nome: </label>
                <input type="text" name="nome" id="idnome">

                <label for="sobrenome">Sobrenome: </label>
                <input type="text" name="sobrenome" id="idsobrenome">

                <input type="submit" value="Enviar">
            </fieldset>
        </form>
    </section>
</body>
</html>