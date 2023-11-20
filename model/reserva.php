<?php

use function PHPSTORM_META\type;

require_once("sql.php");
/**
 * Clase que representa una reserva de viatge, la qual conte una oferta
 */
class Reserva implements JsonSerializable
{
    private $id;                     // id de la reserva
    private $oferta;                // oferta a la que es fa la reserva.
    private $nom;                   // nom del client
    private $telefon;               // telefon dle client
    private $quantitat_persones;    // quantitat de persones de la reserva
    private $descompte;             // la reserva te un desompte aplicat o no
    private $dataInici;            // data d'inici de la reserva

    public function __construct(int $id, Oferta $oferta, string $nom, string $telefon, int $quantitat_persones, string $dataInici, bool $descompte)
    {
        $this->id = $id;
        $this->oferta = $oferta;
        $this->nom = $nom;
        $this->telefon = $telefon;
        $this->quantitat_persones = $quantitat_persones;
        $this->dataInici = $dataInici;
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

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Retorna un string de la data amb el format "YYYY-MM-DD"
     */
    public function getDataInici(): string
    {
        return $this->dataInici;
    }

    /**
     * retorna un string de la data amb el format "DD/MM/YYYY"
     */
    public function getDataIniciFormatada(): string
    {
        return date("d/m/Y", strtotime($this->dataInici));
    }

    public static function getReserves(): array
    {
        $connect = connect();
        $sql = 'SELECT
                    r.id AS "id",
                    r.client_nom AS "Nom",
                    r.client_telefon AS "Telefon",
                    r.quantitat_persones AS "Persones",
                    r.descompte AS "Descompte",
                    r.oferta_id AS "Oferta",
                    r.data_inici AS "Data Inici"
                FROM wonderfull_travel.reserva r;';
        $statement = $connect->prepare($sql);
        $statement->execute();

        // en cas de no tenir ofertes retornem un array buit
        if ($statement->rowCount() < 1) {
            return array();
        }

        $reserves = $statement->fetchAll(PDO::FETCH_ASSOC);
        $reservesInstancies = array();
        foreach ($reserves as $reserva) {
            $oferta = Oferta::fromId($reserva["Oferta"]);
            echo ($reserva["Data Inici"]);

            $reservesInstancies[] = new Reserva($reserva["id"], $oferta, $reserva["Nom"], $reserva["Telefon"], $reserva["Persones"], $reserva["Data Inici"], $reserva["Descompte"]);
        }
        return $reservesInstancies;
    }

    // Funcions que interactuen amb la base de dades
    public function storeReserva(): bool
    {

        $ofertaId = $this->oferta->getId();
        $nomClient = $this->getNom();
        $telefonClient = $this->getTelefon();
        $descompte = $this->getDescompteBit();
        $quantitatPersones = $this->getQuantitatPersones();
        $dataInici = $this->getDataInici();

        $connect = connect();
        try {
            $statement = $connect->prepare(" INSERT INTO `wonderfull_travel`.`reserva` (`oferta_id`, `descompte`, `client_nom`, `client_telefon`, `quantitat_persones`, `data_inici`) 
                                                VALUES (:ofertaId, :descompte, :nomClient, :telefonClient, :quantitatPersones, :dataInici);");

            $statement->bindParam(':ofertaId', $ofertaId);
            $statement->bindParam(':nomClient', $nomClient);
            $statement->bindParam(':telefonClient', $telefonClient);
            $statement->bindParam(':quantitatPersones', $quantitatPersones);
            $statement->bindParam(':dataInici', $dataInici);
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

    public static function deleteReserva(int $id): bool
    {
        $reservaId = $id;
        $connect = connect();

        try {
            $statement = $connect->prepare("DELETE FROM `wonderfull_travel`.`reserva` WHERE (`id` = :reservaId);");
            $statement->bindParam(':reservaId', $reservaId);
            $statement->execute();

            if ($statement->rowCount() < 1) {
                return false;
            };
            return true;
        } catch (PDOException $e) {
            // mostrarem els errors
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
