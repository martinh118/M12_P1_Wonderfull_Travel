<?php
require_once("sql.php");
/**
 * Clase que representa una reserva de viatge, la qual conte una oferta
 */
class Reserva implements JsonSerializable
{
    private $oferta; // oferta a la que es fa la reserva.
    private $nom; // nom del client
    private $telefon; // telefon dle client
    private $quantitat_persones; // quantitat de persones de la reserva
    private $descompte; // la reserva te un desompte aplicat o no

    public function __construct(Oferta $oferta, string $nom, string $telefon, int $quantitat_persones, bool $descompte)
    {
        $this->oferta = $oferta;
        $this->nom = $nom;
        $this->telefon = $telefon;
        $this->quantitat_persones = $quantitat_persones;
        $this->descompte = $descompte;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'oferta' => $this->oferta,
            'nom' => $this->nom,
            'telefon' => $this->telefon,
            'quantitat_persones' => $this->quantitat_persones,
            'descompte' => $this->descompte,
        ];
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

    public function getDescompteBit(): int
    {
        if ($this->descompte) {
            return 1;
        } else {
            return 0;
        }
    }

    public static function getReserves(): array
    {
        $connect = connect();
        $sql = 'SELECT r.client_nom AS "Nom",
                    r.client_telefon AS "Telefon",
                    r.quantitat_persones AS "Persones",
                    r.descompte AS "Descompte",
                    r.oferta_id AS "Oferta"
                FROM wonderfull_travel.reserva r;';
        $statement = $connect->prepare($sql);
        $statement->execute();

        // en cas de no tenir ofertes retornem un array buid
        if ($statement->rowCount() < 1) {
            return array();
        }

        $reserves = $statement->fetchAll(PDO::FETCH_ASSOC);
        $reservesInstancies = array();
        foreach ($reserves as $reserva) {
            $oferta = Oferta::fromId($reserva["Oferta"]);
            $reservesInstancies[] = new Reserva($oferta, $reserva["Nom"], $reserva["Telefon"], $reserva["Persones"], $reserva["Descompte"]);
        }
        return $reservesInstancies;
    }

    // Funcions que interactuen amb la base de dades
    public function storeReserva(): bool
    {

        $descompte = $this->getDescompteBit();
        $nomClient = $this->getNom();
        $telefonClient = $this->getTelefon();
        $quantitatPersones = $this->getQuantitatPersones();
        $ofertaId = $this->oferta->getId();

        $connect = connect();
        try {
            $statement = $connect->prepare(" INSERT INTO `wonderfull_travel`.`reserva` (`oferta_id`, `descompte`, `client_nom`, `client_telefon`, `quantitat_persones`) 
                                                VALUES (:ofertaId, :descompte, :nomClient, :telefonClient, :quantitatPersones);");

            $statement->bindParam(':ofertaId', $ofertaId);
            $statement->bindParam(':nomClient', $nomClient);
            $statement->bindParam(':telefonClient', $telefonClient);
            $statement->bindParam(':quantitatPersones', $quantitatPersones);
            // tipus de parametre INT (perque es binary)
            $statement->bindParam(':descompte', $descompte, PDO::PARAM_INT);

            $statement->execute();
        } catch (PDOException $e) {
            // mostrarem els errors
            echo "Error: " . $e->getMessage();
            return false;
        }
        return true;
    }
}
