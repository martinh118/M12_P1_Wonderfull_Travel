<?php
include_once("./model/oferta.php");
include_once("./model/reserva.php");

class ControladorReserves
{


    public static function inserirReserva()
    {
        // comprovem si hi ha error amb algun camp introduit

        // comprovacio id oferta
        if (empty($_POST["oferta-id"]) || $_POST["oferta-id"] == "-1") {
            $alertMessage = "S'ha produit un error, torna-ho a intentar. Si l'error persisteix, contacta amb un administrador.";
        };
        $dadesReserva["oferta-id"] = $_POST["oferta-id"];

        // comprovacio data inici
        if (empty($_POST["data-viatge"]) || strtotime($_POST["data-viatge"]) === false) {
            $alertMessage = "Has d'introduir una data d'inici vàlida.";
        } else {
            $dataIntroduida = strtotime($_POST["data-viatge"]);
            $dataActual = strtotime(date('Y-m-d'));

            if ($dataIntroduida <= $dataActual) {
                $alertMessage = "La data d'inici ha de ser una data futura.";
            } else {
                $dadesReserva["dataInici"] = date('Y-m-d', $dataIntroduida);
            }
        }

        // comprovacio nom
        if (empty($_POST["nom-client"])) {
            $alertMessage = "Has d'introduir un nom.";
        };
        $dadesReserva["nom"] = $_POST["nom-client"];

        // comprovacio telefon
        if (empty($_POST["telefon-client"]) || !preg_match('/^[0-9]{9}$/', $_POST["telefon-client"])) {
            $alertMessage = "Has d'introduir un telèfon vàlid de 9 dígits.";
        }
        $dadesReserva["telefon"] = $_POST["telefon-client"];

        // comprovacio quantitat persones
        if (
            empty($_POST["persones-client"]) || !ctype_digit($_POST["persones-client"]) || $_POST["persones-client"] <= 0
        ) {
            $alertMessage = "Has d'introduir una quantitat de persones vàlida.";
        }
        $dadesReserva["quantitat_persones"] = $_POST["persones-client"];

        // comprovacio descompte
        $dadesReserva["descompte"] = !empty($_POST["descompte"]) ? true : false;


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
