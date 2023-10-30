<?php


function conect(){

    try {
        $connexio = new PDO('mysql:host=localhost;dbname=wonderfull_travel', 'root', '');
        //echo "Connexio correcta!!" . "<br />";
        return $connexio;
    } catch (PDOException $e) { //
        // mostrarem els errors
        echo "Error: " . $e->getMessage();
    }

}


function obtenerReservas(){

    $conect = conect();
    try {
        $statement = $conect->prepare('SELECT * FROM reserva ');
        $statement->execute();
        $statement->fetchAll();
        return $statement;
    } catch (PDOException $e) { //
        // mostrarem els errors
        echo "Error: " . $e->getMessage();
    }

}

function añadirReserva($oferta_id, $descompte, $client_nom, $client_telefon, $quantitat_persones){

    $conect = conect();
    try {
        $statement = $conect->prepare('INSERT INTO reserva (oferta_id, descompte, client_nom, client_telefon, quantitat_persones) VALUES ( :oferId, :descomp, :client_nom, :client_telefon, :quantPersones)');
        $statement->execute(
            array(
                ':oferId' => $oferta_id, 
                ':descomp' => $descompte, 
                ':client_nom' => $client_nom, 
                ':client_telefon' => $client_telefon, 
                ':quantPersones' => $quantitat_persones
            )
        );
        echo "Reserva correctamente aplicada";
    } catch (PDOException $e) { //
        // mostrarem els errors
        echo "Error: " . $e->getMessage();
    }

}


function eliminarReserva($id){
    $conect = conect();
    try {
        $statement = $conect->prepare('DELETE FROM reserva WHERE oferta_id = :id');
        $statement->execute(
            array(
                ':id' => $id
            )
        );
        echo "Reserva correctamente eliminada";
    } catch (PDOException $e) { //
        // mostrarem els errors
        echo "Error: " . $e->getMessage();
    }
}

function obtenerPrecioPais($id){
    $conect = conect();

    try{
        
        $statement = $conect->prepare('SELECT preu FROM ofertes WHERE pais_id = :id');
        $statement-> execute(
            array(
                ':id' => $id
            )
        );
        $statement->fetchAll();
        return $statement;
    }catch (PDOException $e){
        echo "Error: " . $e->getMessage();
    }
    

}


function obtenerOfertas()
{

    $conect = conect();
    try {
        $sql = 'SELECT c.nom AS "Continent", p.nom AS "Pais", o.preu AS "Preu", o.imatges AS "Ruta Imatges", o.durada_dies AS "Durada", o.valida AS "Activa"
                FROM wonderfull_travel.pais p
                RIGHT JOIN wonderfull_travel.continent c ON p.continent_id  = c.id
                INNER JOIN wonderfull_travel.ofertes o ON p.id = o.pais_id;';
        $statement = $conect->prepare($sql);
        $statement->execute();
        $statement->fetchAll();
        return $statement;
    } catch (PDOException $e) { //
        // mostrarem els errors
        echo "Error: " . $e->getMessage();
    }
}


?>