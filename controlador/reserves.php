<?php
include_once("./model/oferta.php");
include_once("./model/reserva.php");

function inserirReserva()
{
    // comprovem si hi ha error amb algun camp introduit

    if (empty($_POST["oferta-id"])) {
        $alertMessage = "S'ha produit un error, torna-ho a intentar. Si l'error persisteix, contacta amb un administrador.";
    };
    $dadesReserva["oferta-id"] = $_POST["oferta-id"];

    if (empty($_POST["nom"])) {
        $alertMessage = "Has d'introduir un nom.";
    };
    $dadesReserva["nom"] = $_POST["nom"];

    if (empty($_POST["telefon"])) {
        $alertMessage = "Has d'introduir un telefon.";
    };
    $dadesReserva["telefon"] = $_POST["telefon"];

    if (empty($_POST["quantitat_persones"])) {
        $alertMessage = "Has d'introduir una quantitat de persones.";
    };
    $dadesReserva["quantitat_persones"] = $_POST["quantitat_persones"];

    if (empty($_POST["descompte"])) {
        $dadesReserva["descompte"] = false;
    } else {
        $dadesReserva["descompte"] = true;
    };

    // echo ($dadesReserva["descompte"] . " - " . $_POST["descompte"] . "<br>");
    // die();



    // TODO: aconseguir oferta en base al continent i el pais (limit 1? + where valid = 1?)
    // $oferta = new Oferta()
    $oferta = Oferta::fromId($dadesReserva["oferta-id"]);

    // vvvv requereix de la oferta per poder inserir una reserva ^^^^
    // $reserva = new Reserva()
    $reserva = new Reserva($oferta, $dadesReserva["nom"], $dadesReserva["telefon"], $dadesReserva["quantitat_persones"], $dadesReserva["descompte"]);
    $reserva->storeReserva();

    // echo ("oferta: " . $oferta->getPais() . "<br>");
    // echo ("ok");
}
