<?php
include_once("./controlador/reserves.php");
// aquest fitxer s'encarrega de inserir una nova reserva la web
// en cas de ser una sol·licitut POST, vol dir que l'usuari vol crear una reserva
// en cas contrari, mostrem la web normal.

// comprovem si la sol·licitut es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // comprovem si la ruta de la peticio es /insert
    // acabada la accio, redireccionem a l'arrel
    ControladorReserves::inserirReserva();
}

// si no es POST, mostrem la web normal
// header("Location: /");
