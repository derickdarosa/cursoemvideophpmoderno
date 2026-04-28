<?php 
    if ($_SERVER["REQUEST_METHOD"] == "GET"){
        //  Obtém o valor do formulário de forma segura
        $nome = $_GET["nome"] ?? "";
        $idade = $_GET["idade"] ?? "";

        // Remove espaços em branco extras
        $nome = trim($nome);
        $idade = trim($idade);
        if(!empty($nome) && !empty($idade) && filter_var($idade, FILTER_VALIDATE_INT) !== false && $idade > 0){
            // Converte para maiúsculas preservando acentos
            $nome = mb_strtoupper($nome, "UTF-8");

            // Sanitiza para evitar XSS
            $nomeSeguro = htmlspecialchars($nome, ENT_QUOTES, "UTF-8");
            $idadeSegura = htmlspecialchars($idade, ENT_QUOTES, "UTF-8");

            // Exibe o resultado
            echo "<p>Olá, {$nomeSeguro}!</p>";
            echo "<p>Você tem {$idadeSegura} anos.</p>";
        } else{
            echo "<p style='color:red;'>Por favor, informe um nome e uma idade válida.</p>";
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="get">
        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome" required>

        <label for="idade">Idade</label>
        <input type="text" name="idade" min="1" id="nome" required>

        <button type="submit">Enviar</button>
    </form>
</body>
</html>