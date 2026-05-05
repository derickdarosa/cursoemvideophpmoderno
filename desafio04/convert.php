<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor de Moedas v2.0</title>
    <link rel="stylesheet" href="styles.css?v=<?= time()?>">
</head>

<body>
    <main>
        <h1>Conversor de Moedas v2.0</h1>
        <?php
            $url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarPeriodo(dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@dataInicial=\'05-04-2026\'&@dataFinalCotacao=\'05-04-2026\'&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,dataHoraCotacao';

            $dados = json_decode(file_get_contents($url), true);

            // var_dump($dados);

            $cotacao = $dados["value"][0]["cotacaoCompra"];

            $real = $_POST['dinheiro'] ?? "0";
            $real = str_replace(",", ".", $real);
            $real = (float) $real;

            $dolar = $real / (float)$cotacao;

            

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