<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Números Aleatórios</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <main>
        <h1>Trabalhando com números aleatórios</h1>
        <?php
            // function gerarOutro(){
            //     $verificador = $_GET['gerar'] ?? "";
            //     if ($verificador == true) {
            //         return random_int(0, 100);
            //     }
            // };
            // $numeroAleatorio = gerarOutro();
            $numeroAleatorio = "";
            function gerarNumero(): int {
                return mt_rand(0, 100);
            }

            if (isset($_GET['gerar'])){
                $numeroAleatorio = gerarNumero();
            }

            echo "Gerando um número aleatório entre 0 e 100...<br>";
            echo "O valor gerado foi <strong>$numeroAleatorio</strong>";
        ?>
        <form method="get">
            <input type="submit" value="Gerar outro" name="gerar">
        </form>
    </main>
</body>
</html>