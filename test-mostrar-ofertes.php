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
        include_once("./model/oferta.php");
        $ofertes = Oferta::getOfertes();
        foreach ($ofertes as $oferta) {
            break;
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

    <div>
        <?php
        echo (json_encode($ofertes));
        // for ($i = 1; $i < count($ofertes); $i++) {
        // echo (json_encode($ofertes[$i]) . "<br>");
        // var_dump($ofertes[$i]);
        // }

        // var_dump($ofertes);
        ?>
    </div>
</body>

</html>