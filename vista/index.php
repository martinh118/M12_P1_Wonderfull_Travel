<!DOCTYPE html>
<html>

<head>

    <link rel="stylesheet" href="../estil/estil.css" type="text/css">
    <meta charset="UTF-8" />
    <title>Wonderfull Land</title>
    <!--BOOTSTRAP-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../bootstrap/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" media="screen">
    <script src="../bootstrap/popper.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>

    <script defer type="module" src="../controlador/index.js"></script>

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
            <img id="imagen" src='../source/optimizadas/asia/china/china_peq.webp' alt="">
        </div>

        <form action="#" class="mt-4">
            <div class="row">
                <div class="col d-flex">
                    <label class="mr-auto w-50" for="data-viatge">Data:</label>
                    <input class="rounded form-control w-100" type="date" name="data-viatge" id="data-viatge">
                </div>
                <div class="col d-flex">
                    <label class="mr-auto w-50" for="nom-client">Nom:</label>
                    <input class="rounded form-control w-100" type="text" name="nom-client" id="nom-client">
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
                    <input class="rounded form-control w-100" type="text" name="telefon-client" id="telefon-client">
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
                    <input class="rounded form-control w-100" type="number" name="persones-client" id="persones-client">
                </div>
            </div>
            <div class="row mt-4 align-items-center">
                <div class="col offset-4">
                    <label class="mr-auto w-5" for="lang">Descompte 20% </label>
                    <input type="checkbox" class="">
                </div>
                <div class="col">
                    <input type="text" value="0,00€" size="5" disabled />
                </div>
            </div>
        </form>
        
    </div>
</body>
</html>