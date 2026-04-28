<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipos primitivos em PHP</title>
</head>
<body>
    <h1>Teste de tipos primitivos</h1>
    <?php
        // 0x é hexadecimal 0b = binário 0 = Octal
        // $num = 010;
        // echo "O valor da variável é $num."

        // $v = 300;
        // var_dump($v);

        // $num = 3e2; // 3x10(2)
        // echo "O valor é $num";

        // $teste = (int) 7e9; // coerção
        // echo "O valor é $teste";
        // var_dump($teste);

        // $vet = [6, "2", 82.5, false, 5];
        // var_dump($vet);

        class Pessoa{
            private string $nome;
        }
        $p = new Pessoa;
        var_dump($p);
    ?>
</body>
</html>