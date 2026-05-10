<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Exemplo de PHP</h1>
    <?= "Teste do echo" ?>
    <?php
        /*if (extension_loaded('intl')) {
            echo 'Extensão intl está carregada!';
        } else {
            echo 'Erro: Extensão intl NÃO está carregada.';
        };*/
        $date = new DateTime('2026-04-10');
        $formatter = new IntlDateFormatter('pt_BR', IntlDateFormatter::FULL, IntlDateFormatter::NONE, 'America/Sao_Paulo', IntlDateFormatter::GREGORIAN, 'dd MMMM yyyy');
        echo $formatter->format($date) . '<br>';
        date_default_timezone_set("America/Sao_Paulo");
        echo "Hoje é dia " . date("d/m/y") . "<br>";
        echo "Hoje é dia " . date("D/M/Y") . "<br>";
        echo "E a hora atual é: " . date("G:i:s") . "<br>";
        echo "E a hora atual é: " . date("g:i:s");
    ?>
</body>
</html>