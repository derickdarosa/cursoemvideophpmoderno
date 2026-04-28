<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado do Processamento</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Resultado do Processamento</h1>
    </header>
    <main>
        <?php 
            $nome = $_GET['nome'] ?? "";
            $sobrenome = $_GET['sobrenome'] ?? "";
            $nomeCompleto = htmlspecialchars(mb_strtoupper($nome . ' ' . $sobrenome), ENT_QUOTES, 'UTF-8'); 

            echo "<p>É um prazer te conhecer, $nomeCompleto! Este é o meu site!</p>";
        ?>
        <p>
            <a href="javascript:history.go(-1)">Voltar para a página anterior</a>
        </p>
    </main>
</body>
</html>

