<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor de Moedas v1.0</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <main>
        <h1>Conversor de Moedas v1.0</h1>
        <?php
            $cotacao = 5.02;

            $real = $_POST['dinheiro'] ?? "";
            $dolar = $real / $cotacao;

            // echo "Seus R\$" 
            //     . number_format($real, 2, "," , ".") 
            //     . " equivalem a U$\$" 
            //     . number_format($dolar, 2, "," , ".");

            // Formatação de moedas com internalização!
            $padrao = numfmt_create("pt_BR", NumberFormatter::CURRENCY);

            echo "Seus " . numfmt_format_currency($padrao, $real, "BRL") . " equivalem a " . numfmt_format_currency($padrao,$dolar, "USD");




            //Código criado por mim
            
            // $saldoCarteira = $_POST['dinheiro'] ?? "";
            // $valorConvertido = $saldoCarteira / 5.22;
            // echo "Seus R$$saldoCarteira equivalem a <strong>US$" . number_format($valorConvertido, 2, ",", ".") . "</strong><br>";
            // echo "<strong>*Cotação fixa de R$5,22</strong> informada diretamente no código.";
        ?>
        <a href="index.php" class="btn-voltar">Voltar</a>
    </main>
</body>

</html>