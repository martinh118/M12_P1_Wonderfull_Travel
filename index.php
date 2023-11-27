<?php
include_once("./controlador/reserves.php");
// aquest fitxer s'encarrega de mostrar la web a l'usuari
// en cas de ser una sol·licitut GET, mostrem la web
// en cas contrari redireccionem a l'arrel

// comprovem si la sol·licitut es GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    ControladorReserves::mostrarReserves();
    die();
}

// si no es GET, mostrem la web normal
header("Location: /");
