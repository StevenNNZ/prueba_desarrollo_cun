<?php
$invalidTamanio = false;
$adivinaNumSecreto = false;
$fija = 0;
$pica = 0;

if (isset($_GET["secret_num"]) && isset($_GET["numEnviado"]) && $_GET["secret_num"] != '') {
    $numSecreto = base64_decode($_GET["secret_num"]);
    $numEnviado = $_GET["numEnviado"];

    $adivinaNumSecreto = $adivinaNumSecreto && false;

    // echo $numEnviado;
    $arrNumEnviado = str_split($numEnviado, 1);

    $lenghtArray = sizeof($arrNumEnviado);
    if ($lenghtArray < 4 || $lenghtArray > 4) {
        $invalidTamanio = true;
    } else {

        if ($numSecreto == $numEnviado) {
            $adivinaNumSecreto = true;
            $numSecreto = loadSecretNum();
        } else {
            for ($i = 0; $i < 4; $i++) {

                if ($arrNumEnviado[$i] == $numSecreto[$i]) {
                    $fija++;
                } else {
                    for ($j = 0; $j < 4; $j++) {
                        if ($arrNumEnviado[$i] == $numSecreto[$j]) {
                            $pica++;
                        }
                    }
                }
            }
        }
    }
} else {
    $numSecreto = loadSecretNum();
}

function loadSecretNum()
{
    $num1 = rand(0, 9);
    $num2 = rand(0, 9);
    $num3 = rand(0, 9);
    $num4 = rand(0, 9);

    return "$num1" . "$num2" . "$num3" . "$num4";
}


?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba</title>


</head>

<body>

    <?php if ($adivinaNumSecreto) : ?>

        <h1>¡Felicidades, ha adivinado el número!</h1>
        <span>Se ha reestablecido el número secreto.</span>
    <?php endif; ?>

    <?php if ($invalidTamanio) : ?>
        <h1>¡El número debe tener 4 dígitos!</h1>
    <?php endif; ?>

    <p>
        <span>Pica: <?= $pica ?></span>
        <span>Fija: <?= $fija ?></span>
    </p>

    <p>
        <span>numEnviado: <?= $numEnviado ?></span>
        <span>numSecreto: <?= $numSecreto ?></span>
    </p>
    <hr>



    <form action="">
        <h1>Picas y fijas</h1>
        <input type="number" name="numEnviado" minlength="4" maxlength="4" placeholder="Indique el número">
        <input type="hidden" name="secret_num" value="<?= base64_encode($numSecreto) ?>">
        <button type="submit">Adivinar número</button>
    </form>

</body>

</html>