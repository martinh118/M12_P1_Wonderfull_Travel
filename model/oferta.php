<?php
require_once("sql.php");

/**
 * Clase que representa una oferta de viatge
 */
class Oferta implements JsonSerializable
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

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'continent' => $this->continent,
            'pais' => $this->pais,
            'preu' => $this->preu,
            'pathImatges' => $this->pathImatges,
            'durada_dies' => $this->durada_dies,
        ];
    }

    public static function fromId(int $id)
    {
        $inst = self::getOfertaFromID($id);
        return $inst;
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

    private static function getOfertaFromID(int $id)
    {
        $connect = connect();
        try {
            $statement = $connect->prepare('SELECT c.nom AS "Continent",
                                                p.nom AS "Pais",
                                                o.preu AS "Preu",
                                                o.imatges AS "Ruta Imatges",
                                                o.durada_dies AS "Durada",
                                                o.valida AS "Activa"
                                            FROM wonderfull_travel.pais p
                                                RIGHT JOIN wonderfull_travel.continent c ON p.continent_id = c.id
                                                INNER JOIN wonderfull_travel.ofertes o ON p.id = o.pais_id
                                                WHERE o.id = :id;');
            $statement->execute(
                array(
                    ':id' => $id,
                )
            );

            // en cas de no tenir ofertes retornem un array buid
            if ($statement->rowCount() < 1) {
                return null;
            }

            $fila = $statement->fetch();
            $oferta = new Oferta($id, $fila['Continent'], $fila['Pais'], $fila['Preu'], $fila['Ruta Imatges'], $fila['Durada']);

            return $oferta;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
        return null;
    }

    public static function getOfertes(): array
    {
        $connect = connect();
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
        return array();
    }
}
