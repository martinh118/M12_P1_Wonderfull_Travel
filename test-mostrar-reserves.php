<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserves</title>
</head>

<body>
    <h1>Reserves</h1>
    <ul>
        <?php
        include_once("./model/model.php");
        $reserves = obtenerObjetoReservas();
        foreach ($reserves as $reserva) {
            echo '<pre>';
            print_r($reserva);
            echo '</pre>';
        }
        ?>
    </ul>
</body>

</html>