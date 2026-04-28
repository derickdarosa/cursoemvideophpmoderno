<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        
        $nome = "Derick";
        $sobrenome = "Rosa";
        $idade = 31;
        $peso = 74.45;
        $casado = false;
        
        const PAIS = "Brasil";
        /*
        echo nl2br(
            "Muito prazer, $nome $sobrenome!\n" . 
            "Você mora no " . PAIS . "!\n" .
            "Voce tem $idade anos!\n" . 
            "Seu peso é de $peso kg\n" .
            "Você é " . ($casado ? "Casado!" : "Solteiro!")
        );
        */

        # forma mais profissional de fazer esse mesmo código é separar a lógica da apresentação, conforme abaixo:
        $statusCivil = $casado ? "Casado" : "Solteiro"; #operador ternário equivalente a if...Else
        $mensagem = "Muito prazer, $nome $sobrenome!\n";
        $mensagem .= "Você mora no " . PAIS . "!\n";
        $mensagem .= "Você tem $idade anos!\n";
        $mensagem .= "Seu peso é de $peso kg\n";
        $mensagem .= "Você é $statusCivil!";

        echo nl2br($mensagem);
    ?>
</body>
</html>