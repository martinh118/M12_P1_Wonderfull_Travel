<?php
include_once("./controlador/reserves.php");
// aquest fitxer s'encarrega de mostrar esborrar una reserva
// en cas de ser una sol·licitut POST, vol dir que l'usuari vol esborrar una reserva
// en cas contrari, mostrem la web normal.

// comprovem si la sol·licitut es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "hola desde index.php <br />";
    // comprovem si la ruta de la peticio es /delete
    // acabada la accio, redireccionem a l'arrel

    ControladorReserves::eliminarReserva();
}

// si no es POST, mostrem la web normal
header("Location: /");
