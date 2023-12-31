<!DOCTYPE html>

<head>

    <link rel="stylesheet" href="estil/estil.css" type="text/css">
    <meta charset="UTF-8" />
    <title>Wonderfull Land</title>
    <!--BOOTSTRAP-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="./bootstrap/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css" media="screen">
    <script src="./bootstrap/popper.min.js"></script>
    <script src="./bootstrap/js/bootstrap.min.js"></script>

    <script defer type="module" src="./controlador/index.js"></script>

</head>

<body>
    <?php
    include_once("./model/oferta.php");
    $ofertes = Oferta::getOfertes();

    ?>

    <script type="text/javascript">
        let ofertas = '<?php echo json_encode($ofertes); ?>';
        ofertas = JSON.parse(ofertas);
        let arrayOfertas = [];
        for (let d in ofertas) {
            arrayOfertas.push(ofertas[d]);
        }
    </script>


    <div class="container ">
        <div class="row justify-content-center mt-5">
            <h3>Wonderfull Land</h3>
        </div>
        <!-- RELOJ -->
        <div class="clock">
            <svg class="circle" viewBox="0 0 120 120" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <circle cx="60" cy="60" r="60" class="outer-circle" />
                <circle cx="60" cy="60" r="57" />
                <line x1="60" y1="20" x2="60" y2="60" class="hours" />
                <line x1="60" y1="2" x2="60" y2="60" class="minutes" />
                <line x1="60" y1="0" x2="60" y2="60" class="seconds" />
                <circle cx="60" cy="60" r="3" class="center-circle" />
                <line x1="60" y1="5" x2="60" y2="10" class="line" />
                <line x1="60" y1="5" x2="60" y2="10" class="line" />
                <line x1="60" y1="5" x2="60" y2="10" class="line" />
                <line x1="60" y1="5" x2="60" y2="10" class="line" />
                <line x1="60" y1="5" x2="60" y2="10" class="line" />
                <line x1="60" y1="5" x2="60" y2="10" class="line" />
                <line x1="60" y1="5" x2="60" y2="10" class="line" />
                <line x1="60" y1="5" x2="60" y2="10" class="line" />
                <line x1="60" y1="5" x2="60" y2="10" class="line" />
                <line x1="60" y1="5" x2="60" y2="10" class="line" />
                <line x1="60" y1="5" x2="60" y2="10" class="line" />
                <line x1="60" y1="5" x2="60" y2="10" class="line" />
            </svg>
        </div>
        <!-- RELOJ -->
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
                    <label class="mr-auto w-50" for="data-viatge">Fecha inicial:</label>
                    <input class="rounded form-control w-100" type="date" name="data-viatge" id="data-viatge" value="<?= isset($_SESSION["dadesReserva"]["dataInici"]) ? $_SESSION["dadesReserva"]["dataInici"] : "" ?>">
                </div>
                <div class="col d-flex">
                    <label class="mr-auto w-50" for="nom-client">Nombre:</label>
                    <input class="rounded form-control w-100" type="text" name="nom-client" id="nom-client" value="<?= isset($_SESSION["dadesReserva"]["nom"]) ? $_SESSION["dadesReserva"]["nom"] : "" ?>">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col d-flex form-group m-0">
                    <label class="mr-auto w-50" for="lang">Continente: </label>
                    <select class="rounded w-100 form-control" name="continent" id="continent">
                        <option>Asia</option>
                        <option>Europa</option>
                        <option>Africa</option>
                        <option>America del Norte</option>
                        <option>America del Sur</option>
                        <option>Oceanía</option>
                    </select>
                </div>
                <div class="col d-flex">
                    <label class="mr-auto w-50" for="telefon">Teléfono: </label>
                    <input class="rounded form-control w-100" type="text" name="telefon-client" id="telefon-client" value="<?= isset($_SESSION["dadesReserva"]["telefon"]) ? $_SESSION["dadesReserva"]["telefon"] : "" ?>">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col d-flex  form-group m-0">
                    <label class="mr-auto w-50" for="lang">País: </label>
                    <select class="rounded w-100 form-control" name="pais" id="pais">
                        <option>China</option>
                        <option>Rusia</option>
                        <option>India</option>
                    </select>
                </div>
                <div class="col d-flex">
                    <label class="mr-auto w-50" for="persones-client">Personas</label>
                    <input class="rounded form-control w-100" type="number" name="persones-client" id="persones-client" min="1" max="50" value="<?= isset($_SESSION["dadesReserva"]["quantitat_persones"]) ? $_SESSION["dadesReserva"]["quantitat_persones"] : "1" ?>">
                </div>
            </div>
            <div class="row mt-4 ">
                <div class="col">
                    <div type="text" id="duradaDies" size="5"> Duración: <?php ?> días</div>
                </div>
            </div>

            <div class="row mt-4 align-items-center">
                <div class="col offset-4">
                    <label class="mr-auto w-5" for="lang">Descuento (20%) </label>
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
            <button type="submit" class="btn btn-primary btn-block mt-3">Reservar</button>
        </form>
        <br>
        <h3>Reservas</h3>

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
                                    <li>Entrada: <?= $reserva->getDataIniciFormatada() ?></li>
                                    <li>Salida: <?= $reserva->getDataFiFormatada() ?></li>
                                    <li>Destino: <?= $reserva->getOferta()->getPais() ?></li>
                                    <li>Nombre: <?= $reserva->getNom() ?></li>
                                    <li>Teléfono: <?= $reserva->getTelefon() ?></li>
                                    <li>Personas: <?= $reserva->getQuantitatPersones() ?> </li>
                                    <li>Coste: <?= $reserva->getOferta()->getPreu() * $reserva->getQuantitatPersones() * ($reserva->getDescompteBit() ? .8 : 1) . " €" . ($reserva->getDescompteBit() ? " (-20%)" : "") ?></li>
                                </ul>
                                <button type="submit" name="submit" value="<?= $reserva->getId() ?>" class="btn btn-primary position-absolute" style="top:1.25rem; right:1.25rem;">🗑</button>
                            </div>
                            <img class="card-img-top pb-3" src="<?= $reserva->getOferta()->getPathImatges(); ?>" style="padding-left:1.25rem; padding-right:1.25rem" alt="Card image cap">
                        </div>
                    </div>
                <?php }; ?>
                <?php if ($reserves == null) { ?>
                    <div class="col-sm mb-5">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <p class="card-text">No hi ha reserves</p>
                            </div>
                        </div>
                    </div>
                <?php }; ?>
            </form>
        </div>
    </div>




    <script type="text/javascript">
        function cambiarDias() {
            let inputDias = document.getElementById("duradaDies");
            let pais_usuario = document.getElementById("pais").value;

            let oferta = getValue("pais", pais_usuario, arrayOfertas);

            inputDias.innerHTML = "Duración: " + oferta.duradaDies + " días";
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
        document.getElementById("pais").addEventListener("change", function() {
            aplicarPrecio();
            cambiarDias();
        });
        document.getElementById("continent").addEventListener("change", function() {
            aplicarPrecio();
            cambiarDias();
        });

        cambiarDias();
        aplicarPrecio();
    </script>
</body>

</html>