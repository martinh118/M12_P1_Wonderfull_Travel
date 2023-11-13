<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ofertes</title>
</head>

<body>
    <h1>Ofertes</h1>
    <ul>
        <?php
        include_once("./model/model.php");
        $ofertes = obtenerObjetoOfertas();
        foreach ($ofertes as $oferta) {
            echo "<li>
                <ul>
                    <li>Continent: " . $oferta->getContinent() . "</li>
                    <li>Pais: " . $oferta->getPais() . "</li>
                    <li>Preu: " . $oferta->getPreu() . "€</li>
                    <li>Ruta Imatges: " . $oferta->getPathImatges() . "</li>
                    <li>Durada (dies): " . $oferta->getDuradaDies() . "</li>
                </ul>
            </li>";
        }
        ?>
    </ul>
</body>

</html>