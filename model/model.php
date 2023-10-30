<?php


class oferta
{
    private $continent;     // nom del continent
    private $pais;          // nom del pais (en el nostre cas es el pais)
    private $preu;          // preu de l'oferta
    private $pathImatges;   // ruta de les imatges de l'oferta en el sistema de fitxers del servidor
    private $durada_dies;   // durada de dies de l'oferta

    public function __construct($continent, $pais, $preu, $pathImatges, $durada_dies)
    {
        $this->continent = $continent;
        $this->pais = $pais;
        $this->preu = $preu;
        $this->pathImatges = $pathImatges;
        $this->durada_dies = $durada_dies;
    }

    public function getContinent()
    {
        return $this->continent;
    }

    public function getPais()
    {
        return $this->pais;
    }

    public function getPreu()
    {
        return $this->preu;
    }

    public function getPathImatges()
    {
        return $this->pathImatges;
    }

    public function getDuradaDies()
    {
        return $this->durada_dies;
    }
}


function conect()
{

    try {
        $connexio = new PDO('mysql:host=localhost;dbname=wonderfull_travel', 'root', '');
        //echo "Connexio correcta!!" . "<br />";
        return $connexio;
    } catch (PDOException $e) { //
        // mostrarem els errors
        echo "Error: " . $e->getMessage();
    }
}


function obtenerReservas()
{

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

function añadirReserva($oferta_id, $descompte, $client_nom, $client_telefon, $quantitat_persones)
{

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


function eliminarReserva($id)
{
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

function obtenerPrecioPais($id)
{
    $conect = conect();

    try {

        $statement = $conect->prepare('SELECT preu FROM ofertes WHERE pais_id = :id');
        $statement->execute(
            array(
                ':id' => $id
            )
        );
        $statement->fetchAll();
        return $statement;
    } catch (PDOException $e) {
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


function obtenerObjetoOfertas(): array
{
    $connect = conect();
    try {
        $sql = 'SELECT c.nom AS "Continent", p.nom AS "Pais", o.preu AS "Preu", o.imatges AS "Ruta Imatges", o.durada_dies AS "Durada"
                FROM wonderfull_travel.pais p
                RIGHT JOIN wonderfull_travel.continent c ON p.continent_id  = c.id
                INNER JOIN wonderfull_travel.ofertes o ON p.id = o.pais_id;';
        $statement = $connect->prepare($sql);
        $statement->execute();

        while ($fila = $statement->fetch()) {
            $ofertas[] = new oferta($fila['Continent'], $fila['Pais'], $fila['Preu'], $fila['Ruta Imatges'], $fila['Durada']);
        }
        return $ofertas;
        // $statement->fetchAll();
        // // creem una llista d'objectes oferta fent servir cada fila de la consulta
        // $ofertas = array();
        // foreach ($statement as $row) {
        //     $ofertas[] = new oferta($row['Pais'], $row['Preu'], $row['Ruta Imatges'], $row['Durada']);
        // }
        // return $ofertas;
    } catch (PDOEXception $e) {
        echo "Error: " . $e->getMessage();
    }
}
