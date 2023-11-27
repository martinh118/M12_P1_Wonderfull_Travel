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
        return;
    }

    // comprovem si la ruta de la peticio es /insert
    // acabada la accio, redireccionem a l'arrel
    if ($_SERVER["REQUEST_URI"] == "/insert") {
        ControladorReserves::inserirReserva();
        header("Location: /");
        return;
    }
}

// si no es POST, comprovem si es GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // comprovem si la ruta es /
    // en cas afirmatiu, mostrem la web
    if ($_SERVER["REQUEST_URI"] == "/") {
        ControladorReserves::mostrarReserves();
        return;
    }
}
// si no es cap dels dos, mostrem un error 404
http_response_code(404);
