<?php

/**
 * Clase que representa una oferta de viatge
 */
class Oferta
{
    private $id;            // id de l'oferta
    private $continent;     // nom del continent
    private $pais;          // nom del pais (en el nostre cas es el pais)
    private $preu;          // preu de l'oferta
    private $pathImatges;   // ruta de les imatges de l'oferta en el sistema de fitxers del servidor. TODO: comprovar si s'ha de fer servir aquesta variable o no
    private $durada_dies;   // durada de dies de l'oferta

    public function __construct(int $id, string $continent, string $pais, float $preu, string $pathImatges, int $durada_dies)
    {
        $this->id = $id;
        $this->continent = $continent;
        $this->pais = $pais;
        $this->preu = $preu;
        $this->pathImatges = $pathImatges;
        $this->durada_dies = $durada_dies;
    }

    public function getContinent(): string
    {
        return $this->continent;
    }

    public function getPais(): string
    {
        return $this->pais;
    }

    public function getPreu(): float
    {
        return $this->preu;
    }

    public function getPathImatges(): string
    {
        return $this->pathImatges;
    }

    public function getDuradaDies(): int
    {
        return $this->durada_dies;
    }

    public function getId(): int
    {
        return $this->id;
    }
}

/**
 * Clase que representa una reserva de viatge, la qual conte una oferta
 */
class Reserva
{
    private $oferta;                // oferta a la que es fa la reserva. 
    private $nom;                   // nom del client
    private $telefon;               // telefon dle client
    private $quantitat_persones;    // quantitat de persones de la reserva
    private $descompte;             // la reserva te un desompte aplicat o no

    public function __construct(Oferta $oferta, string $nom, string $telefon, int $quantitat_persones, bool $descompte)
    {
        $this->oferta = $oferta;
        $this->nom = $nom;
        $this->telefon = $telefon;
        $this->quantitat_persones = $quantitat_persones;
        $this->descompte = $descompte;
    }

    public function getOferta(): Oferta
    {
        return $this->oferta;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getTelefon(): string
    {
        return $this->telefon;
    }

    public function getQuantitatPersones(): int
    {
        return $this->quantitat_persones;
    }

    public function getDescompte(): bool
    {
        return $this->descompte;
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

/**
 * Funció que retorna un array d'objectes oferta. En cas de no tenir ofertes retorna un array buit.
 * @return array
 * @throws PDOException
 */
function obtenerObjetoOfertas(): array
{
    $connect = conect();
    try {
        $sql = 'SELECT o.id, c.nom AS "Continent", p.nom AS "Pais", o.preu AS "Preu", o.imatges AS "Ruta Imatges", o.durada_dies AS "Durada"
                FROM wonderfull_travel.pais p
                RIGHT JOIN wonderfull_travel.continent c ON p.continent_id  = c.id
                INNER JOIN wonderfull_travel.ofertes o ON p.id = o.pais_id;';
        $statement = $connect->prepare($sql);
        $statement->execute();

        // en cas de no tenir ofertes retornem un array buid
        if ($statement->rowCount() < 1) {
            return array();
        }

        while ($fila = $statement->fetch()) {
            $ofertaId = $fila['id'];
            $ofertas[$ofertaId] = new Oferta($ofertaId, $fila['Continent'], $fila['Pais'], $fila['Preu'], $fila['Ruta Imatges'], $fila['Durada']);
        }

        return $ofertas;
    } catch (PDOEXception $e) {
        echo "Error: " . $e->getMessage();
    }
}

/**
 * Funció que retorna un array d'objectes reserva. En cas de no tenir reserves retorna un array buit.
 * @return array
 * @throws PDOException
 */
function obtenerObjetoReservas(): array
{
    $connect = conect();
    try {
        // llegim les reserves, i en cas de tenir-ne, llegirem les ofertes i les asociarem des-del codi ja que si ho fem des de la consulta
        // creariem una consulta massa gran i dificil de llegir degut a les relacions amb els paisos i la forma de mostrar les dades
        $sql = 'SELECT r.client_nom AS "Nom", r.client_telefon AS "Telefon", r.quantitat_persones AS "Persones", r.descompte AS "Descompte", r.oferta_id AS "Oferta"
                FROM wonderfull_travel.reserva r;';
        $statement = $connect->prepare($sql);
        $statement->execute();

        // en cas de no tenir reserves retornem un array buid
        if ($statement->rowCount() < 1) {
            return array();
        }

        // llegim les ofertes (ja que les reserves son de ofertes)
        $ofertes = obtenerObjetoOfertas();

        // llegim els resultats de les reserves i creem un array de reserves
        while ($fila = $statement->fetch()) {
            $oferta = $ofertes[$fila['Oferta']];
            $reservas[] = new Reserva($oferta, $fila['Nom'], $fila['Telefon'], $fila['Persones'], $fila['Descompte']);
        }

        return $reservas;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
