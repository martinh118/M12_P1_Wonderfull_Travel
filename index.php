<?php
// aquest fitxer s'encarrega de mostrar la web a l'usuari
// en cas de ser una sol·licitut POST, vol dir que l'usuari vol crear una reserva
// en cas contrari, mostrem la web normal.



// comprovem si la sol·licitut es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once("../controlador/reserves.php");
    inserirReserva();

    die();
}

// si no es POST, mostrem la web normal
include_once("./vista/index.php");
