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
    private $duradaDies;   // durada de dies de l'oferta

    public function __construct(int $id, string $continent, string $pais, float $preu, string $pathImatges, int $duradaDies)
    {
        $this->id = $id;
        $this->continent = $continent;
        $this->pais = $pais;
        $this->preu = $preu;
        $this->pathImatges = $pathImatges;
        $this->duradaDies = $duradaDies;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'continent' => $this->continent,
            'pais' => $this->pais,
            'preu' => $this->preu,
            'pathImatges' => $this->pathImatges,
            'duradaDies' => $this->duradaDies,
        ];
    }

    public static function fromId(int $id): Oferta | null
    {
        $connect = connect();
        try {
            $statement = $connect->prepare('SELECT c.nom AS "Continent",
                                                p.nom AS "Pais",
                                                o.preu AS "Preu",
                                                o.imatges AS "Ruta Imatges",
                                                o.durada_dies AS "Durada",
                                                o.valida AS "Activa"
                                            FROM pais p
                                                RIGHT JOIN continent c ON p.continent_id = c.id
                                                INNER JOIN ofertes o ON p.id = o.pais_id
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
        return $this->duradaDies;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public static function getOfertes(): array
    {
        $connect = connect();
        try {
            $sql = 'SELECT o.id, c.nom AS "Continent", p.nom AS "Pais", o.preu AS "Preu", o.imatges AS "Ruta Imatges", o.durada_dies AS "Durada"
                FROM pais p
                RIGHT JOIN continent c ON p.continent_id  = c.id
                INNER JOIN ofertes o ON p.id = o.pais_id;';
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
