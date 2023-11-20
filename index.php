<?php
include_once("./controlador/reserves.php");
// aquest fitxer s'encarrega de mostrar la web a l'usuari
// en cas de ser una sol·licitut POST, vol dir que l'usuari vol crear una reserva
// en cas contrari, mostrem la web normal.

// comprovem si la sol·licitut es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // comprovem si la ruta de la peticio es /delete
    // acabada la accio, redireccionem a l'arrel
    if ($_SERVER["REQUEST_URI"] == "/delete") {
        ControladorReserves::eliminarReserva();
        header("Location: /");
    }

    // comprovem si la ruta de la peticio es /insert
    // acabada la accio, redireccionem a l'arrel
    if ($_SERVER["REQUEST_URI"] == "/insert") {
        ControladorReserves::inserirReserva();
        header("Location: /");
    }
}

// si no es POST, mostrem la web normal
ControladorReserves::mostrarReserves();
