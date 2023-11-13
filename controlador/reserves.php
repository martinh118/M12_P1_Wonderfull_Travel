<?php
include_once("./model/oferta.php");
include_once("./model/reserva.php");

class ControladorReserves
{


    public static function inserirReserva()
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

        $oferta = Oferta::fromId($dadesReserva["oferta-id"]);

        $reserva = new Reserva($oferta, $dadesReserva["nom"], $dadesReserva["telefon"], $dadesReserva["quantitat_persones"], $dadesReserva["descompte"]);
        $reserva->storeReserva();
    }

    public static function mostrarReserves()
    {
        $reserves = Reserva::getReserves();
        include_once("./vista/index.php");
    }
}
