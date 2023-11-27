<!DOCTYPE html>

<head>

    <link rel="stylesheet" href="estil/estil.css" type="text/css">
    <meta charset="UTF-8" />
    <title>Wonderfull Land</title>
    <!--BOOTSTRAP-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="bootstrap/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" media="screen">
    <script src="bootstrap/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <script defer type="module" src="controlador/index.js"></script>

</head>

<body>
    <div class="container ">
        <div class="row justify-content-center mt-5">
            <h3>Wonderfull Land</h3>
        </div>
        <div class="row justify-content-center mt-2">
            <div id="data"></div>
        </div>
        <div class="row justify-content-center mt-2">
            <img id="imagen" src='source/optimizadas/asia/china/china_peq.webp' alt="">
        </div>
        <form action="insert" method="post" class="mt-4">
            <input type="hidden" name="oferta-id" id="oferta-id" value="-1">
            <div class="row">
                <div class="col d-flex">
                    <label class="mr-auto w-50" for="data-viatge">Data:</label>
                    <input class="rounded form-control w-100" type="date" name="data-viatge" id="data-viatge" value="<?= isset($_SESSION["dadesReserva"]["dataInici"]) ? $_SESSION["dadesReserva"]["dataInici"] : "" ?>">
                </div>
                <div class="col d-flex">
                    <label class="mr-auto w-50" for="nom-client">Nom:</label>
                    <input class="rounded form-control w-100" type="text" name="nom-client" id="nom-client" value="<?= isset($_SESSION["dadesReserva"]["nom"]) ? $_SESSION["dadesReserva"]["nom"] : "" ?>">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col d-flex form-group m-0">
                    <label class="mr-auto w-50" for="lang">Continent: </label>
                    <select class="roudned w-100 form-control" name="continent" id="continent">
                        <option>Asia</option>
                        <option>Europa</option>
                        <option>Africa</option>
                        <option>America del Norte</option>
                        <option>America del Sur</option>
                        <option>Oceanía</option>
                    </select>
                </div>
                <div class="col d-flex">
                    <label class="mr-auto w-50" for="telefon">Telefon: </label>
                    <input class="rounded form-control w-100" type="text" name="telefon-client" id="telefon-client" value="<?= isset($_SESSION["dadesReserva"]["telefon"]) ? $_SESSION["dadesReserva"]["telefon"] : "" ?>">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col d-flex  form-group m-0">
                    <label class="mr-auto w-50" for="lang">Pais: </label>
                    <select class="roudned w-100 form-control" name="pais" id="pais">
                        <option>China</option>
                        <option>Rusia</option>
                        <option>India</option>
                    </select>
                </div>
                <div class="col d-flex">
                    <label class="mr-auto w-50" for="persones-client">Persones</label>
                    <input class="rounded form-control w-100" type="number" name="persones-client" id="persones-client" min="1" max="50" value="<?= isset($_SESSION["dadesReserva"]["quantitat_persones"]) ? $_SESSION["dadesReserva"]["quantitat_persones"] : "1" ?>">
                </div>
            </div>
            <div class="row mt-4 align-items-center">
                <div class="col offset-4">
                    <label class="mr-auto w-5" for="lang">Descompte 20% </label>
                    <input type="checkbox" class="" id="descompte" name="descompte" value="descompte" <?= isset($_SESSION["descompte"]) ? ($_SESSION["dadesReserva"]["descompte"] ?: "checked") : "" ?>>
                </div>
                <div class="col">
                    <div type="text" id="precioOferta" value="0,00€" size="5"> </div>
                </div>
            </div>
            <?php if (isset($_SESSION["alertMessage"])) { ?>
                <div class="alert alert-danger mt-3" role="alert">
                    <?= $_SESSION["alertMessage"] ?>
                </div>
            <?php } ?>
            <button type="submit" class="btn btn-primary btn-block mt-3">Submit</button>
        </form>

        <div class="container pt-5"><!--  contenidor de reserves -->
            <form action="delete" method="post" class="row">
                <?php
                foreach ($reserves as $reserva) {
                    // guardem el nom del pais
                    $pais = $reserva->getOferta()->getPais();
                    // preparem la url de la imatge
                    $pathImatge = strtolower($reserva->getOferta()->getContinent()) . "/" . strtolower($pais) . "/" . strtolower($pais) . "_peq.webp"
                    // mostrem la targeta amb les dades de la reserva i inserim la imatge fent servir el path 
                ?>
                    <div class="col-sm mb-5">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body position-relative pb-0">
                                <ul class="list-unstyled">
                                    <li><?= $reserva->getDataIniciFormatada() ?> - <?= $reserva->getDataFiFormatada() ?></li>
                                    <li><?= $reserva->getOferta()->getPais() ?></li>
                                    <li><?= $reserva->getTelefon() ?></li>
                                    <li><?= $reserva->getQuantitatPersones() ?></li>
                                    <li><?= $reserva->getOferta()->getPreu() * $reserva->getQuantitatPersones() * ($reserva->getDescompteBit() ? .8 : 1) . " €" . ($reserva->getDescompteBit() ? " (-20%)" : "") ?></li>
                                </ul>
                                <button type="submit" name="submit" value="<?= $reserva->getId() ?>" class="btn btn-primary position-absolute" style="top:1.25rem; right:1.25rem;">🗑</button>
                            </div>
                            <img class="card-img-top pb-3" src="<?= $reserva->getOferta()->getPathImatges(); ?>" style="padding-left:1.25rem; padding-right:1.25rem" alt="Card image cap">
                        </div>
                    </div>
                <?php }; ?>
            </form>
        </div>
    </div>


    <?php
    include_once("model/oferta.php");
    $ofertes = Oferta::getOfertes();

    ?>

    <script type="text/javascript">
        let ofertas = '<?php echo json_encode($ofertes); ?>';
        ofertas = JSON.parse(ofertas);
        let arrayOfertas = [];
        for (let d in ofertas) {
            arrayOfertas.push(ofertas[d]);
        }

        function aplicarPrecio() {
            let precioInput = document.getElementById("precioOferta");
            let descuento = document.getElementById("descompte");

            let numPersonas = document.getElementById("persones-client").value;
            let pais_usuario = document.getElementById("pais").value;

            let oferta = getValue("pais", pais_usuario, arrayOfertas);

            let precioOfer = oferta.preu;
            let newPrecio = 0;

            document.getElementById("oferta-id").value = oferta.id;
            console.log(oferta.id)

            numPersonas = parseFloat(numPersonas);

            if (numPersonas != "") {
                newPrecio = (parseFloat(precioOfer) * numPersonas);
            } else if (numPersonas != 0) {
                newPrecio = (parseFloat(precioOfer) * numPersonas);
            } else newPrecio = precioOfer;


            if (descuento.checked) {
                newPrecio = parseFloat(newPrecio) - ((parseFloat(newPrecio) * 20) / 100);
            }

            newPrecio = formatoPrecio().format(newPrecio);
            console.log(newPrecio);
            precioInput.innerHTML = newPrecio;



        }

        function getValue(key, valor, array) {
            for (let p of array) {
                if (p[key] == valor) {
                    return p;
                }
            }
        }

        function formatoPrecio() {
            let estil = {
                style: "currency",
                currency: "EUR"
            };
            return new Intl.NumberFormat('es-ES', estil);
        }

        document.getElementById("descompte").addEventListener("change", aplicarPrecio);
        document.getElementById("persones-client").addEventListener("change", aplicarPrecio);
        document.getElementById("pais").addEventListener("change", aplicarPrecio);
        document.getElementById("continent").addEventListener("change", aplicarPrecio);

        aplicarPrecio();
    </script>
</body>

</html>