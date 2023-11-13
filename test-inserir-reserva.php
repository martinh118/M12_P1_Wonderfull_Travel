<?php

// comprovem si la sol·licitut es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once("../controlador/reserves.php");
    inserirReserva();

    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="/tests/test-inserir-reserva.php" method="post">
        <input type="number" name="oferta-id" id="oferta-id" value="5">
        <input type="text" name="nom" id="nom" value="pepe">
        <input type=" text" name="telefon" id="telefon" value="123456789">
        <input type="number" name="quantitat_persones" id="quantitat_persones" value=1>
        <input type="checkbox" name="descompte" id="descompte">
        <button type="submit">Enviar</button>
    </form>
</body>

</html>