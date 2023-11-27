<?php
include_once("./model/oferta.php");
include_once("./model/reserva.php");

class ControladorReserves
{


    public static function inserirReserva()
    {
        // comprovem si hi ha error amb algun camp introduit        
        if (empty($_POST["oferta-id"]) || $_POST["oferta-id"] == "-1") {
            $alertMessage = "S'ha produit un error, torna-ho a intentar. Si l'error persisteix, contacta amb un administrador.";
        };
        $dadesReserva["oferta-id"] = $_POST["oferta-id"];


        if (empty($_POST["data-viatge"])) {
            $alertMessage = "Has d'introduir una data d'inici.";
        };
        $dadesReserva["dataInici"] = $_POST["data-viatge"];

        if (empty($_POST["nom-client"])) {
            $alertMessage = "Has d'introduir un nom.";
        };
        $dadesReserva["nom"] = $_POST["nom-client"];

        if (empty($_POST["telefon-client"])) {
            $alertMessage = "Has d'introduir un telefon.";
        };
        $dadesReserva["telefon"] = $_POST["telefon-client"];

        if (empty($_POST["persones-client"])) {
            $alertMessage = "Has d'introduir una quantitat de persones.";
        };
        $dadesReserva["quantitat_persones"] = $_POST["persones-client"];

        if (empty($_POST["descompte"])) {
            $dadesReserva["descompte"] = false;
        } else {
            $dadesReserva["descompte"] = true;
        };

        // TODO: COMPROVAR SI LES DADES INTRODUIDES SON CORRECTES

        // si hi ha error, mostrem l'alerta i sortim de la funcio
        if (isset($alertMessage)) {
            // guardem el missatge d'alerta i les dades introduides en la sessio
            $_SESSION["dadesReserva"] = $dadesReserva;
            $_SESSION["alertMessage"] = $alertMessage;

            // redirigim a la vista
            ControladorReserves::mostrarReserves();

            // una vegada mostrat el missatge, l'esborrem de la sessio
            unset($_SESSION["alertMessage"]);
            // esborrem tambe les dades introduides de la sessio
            unset($_SESSION["dadesReserva"]);
            return;
        }

        $oferta = Oferta::fromId($dadesReserva["oferta-id"]);
        if ($oferta == null) {
            $alertMessage = "S'ha produit un error, torna-ho a intentar. Si l'error persisteix, contacta amb un administrador.";
            return;
        }
        $reserva = new Reserva($oferta, $dadesReserva["nom"], $dadesReserva["telefon"], $dadesReserva["quantitat_persones"], $dadesReserva["dataInici"], $dadesReserva["descompte"]);
        $reserva->storeReserva();
        return;
    }

    public static function eliminarReserva()
    {
        if (empty($_POST["submit"])) {
            return;
        }

        $id = $_POST["submit"];
        Reserva::deleteReserva($id);
    }

    public static function mostrarReserves()
    {
        $reserves = Reserva::getReserves();
        include_once("./vista/vista.php");
    }
}
