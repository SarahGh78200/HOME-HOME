<?php

namespace App\Models;

use Config\DataBase;
use DateTime;
use PDO;

class Licence
{
    protected ?int $id;
    protected ?string $description;
    protected ?int $availability; // Stocké sous forme d'entier (0 ou 1)
    protected ?float $price;
    protected ?string  $type;
    protected ?string $commissioning_date;
    protected ?string $city;
    protected ?int $id_user;

    public function __construct(?int $id, ?string $description, ?int $availability, ?float $price, ?string $type, ?string $commissioning_date, ?string $city, ?int $id_user)
    {
        $this->id = $id;

        $this->description = $description;
        $this->availability = ($availability === 1) ? 1 : 0; // Assurer que la valeur est bien 0 ou 1
        $this->price = $price;
      
        $this->type = $type;
        $this->commissioning_date = $commissioning_date;
        $this->city = $city;
          $this->id_user = $id_user;
    }

    public function addLicence(): bool
    {
        $pdo = DataBase::getConnection();
        $sql = "INSERT INTO `licence` (`title`, `description`, `availability`, `price`,`type`,`commissioning_date`,`city` ,`id_user`) 
                VALUES (?, ?, ?, ?, ?, ?)";

        $statement = $pdo->prepare($sql);
        return $statement->execute([
            $this->description,
            $this->availability,
            $this->price,
            $this->type,
            $this->commissioning_date,
            $this->city,
            $this->id_user,
        ]);
    }

    public function getLicenceById(): ?Licence
    {
        $pdo = DataBase::getConnection();
        $sql = "SELECT * FROM `licence` WHERE `id` = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data ? new Licence(
            $data['id'],
            $data['description'],
            $data['availability'],
            $data['price'],
            $data['type'],
            $data['commissioning_date'],
            $data['city'],
            $data['id_user']
        ) : null;
    }
    public function readLicence()
    {
        $pdo = DataBase::getConnection();
        $sql = "SELECT * FROM `licence`WHERE id = ?";
     $statement = $pdo->prepare($sql);
    $statement->execute(this->);

    return $statement->fetchAll(PDO::FETCH_ASSOC); 
    }
 public function getProductById()
    {
        $pdo = DataBase::getConnection();
        // Sélectionne les données d’un produit en fonction de son identifiant $this->id.
        $sql = "SELECT * FROM `products` WHERE id = ?";
        // Prépare la requête SQL
        $statement = $pdo->prepare($sql);
        // Exécute la requête
        $statement->execute([$this->id]);
        // Si un produit est trouvé, crée et retourne un nouvel objet Product avec les données récupérées.Sinon, retourne null.
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Product($row['id'], $row['category'], $row['name'], $row['description'], $row['price'], $row['created_at'], $row['updated_at'], $row['image'], null, null, null, null, null, null, null, null, null);
        } else {
            return null;
        }
    }

    public function updateLicence()
    {
        $db = Database::getConnection();
        $query = $db->prepare("UPDATE licence SET title = ?, description = ?, availability = ?, price = ? WHERE id = ?");
        return $query->execute([ $this->description, $this->availability, $this->price, $this->id, $this->type, $this->commissioning_date, $this->city,]);
    }


    public function deleteLicence(): bool
    {
        $pdo = DataBase::getConnection();
        $sql = "DELETE FROM `licence` WHERE `id` = ?";
        $statement = $pdo->prepare($sql);
        return $statement->execute([$this->id]);
    }

    public static function getAllLicence(): array
    {
        $pdo = DataBase::getConnection();
        $sql = "SELECT * FROM `licence`";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $licencesData = $statement->fetchAll(PDO::FETCH_ASSOC);

        $licences = [];
        foreach ($licencesData as $data) {
            $licences[] = new Licence(
                $data['id'],
                $data['description'],
                (int) $data['availability'], // Convertir en entier
                $data['price'],
                $data['type'],
                $data['commissioning_date'],
                $data['city'],
                $data['id_user'],
            );
        }
        return $licences;
    }


    public static function findById(int $id): ?self
    {
        $pdo = DataBase::getConnection(); // Utilisez getConnection() au lieu de getPDO()
        $stmt = $pdo->prepare("SELECT * FROM licence WHERE id = ?"); // Table "licence" au singulier
        $stmt->execute([$id]); // Paramètre positionnel plus simple
        $licenceData = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$licenceData) {
            return null;
        }

        return new Licence(
            $licenceData['id'],
            $licenceData['description'],
            $licenceData['availability'],
            $licenceData['price'],
            $licenceData['type'],
            $licenceData['commissioning_date'],
            $licenceData['city'],
            $licenceData['id_user'],
        );
    }
    public static function findAll(): array
    {
        $pdo = DataBase::getConnection(); // Récupération de la connexion PDO
        $stmt = $pdo->query("SELECT * FROM licence"); // Exécution de la requête pour récupérer toutes les licences
        $licencesData = $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupération des données sous forme de tableau associatif

        $licences = [];
        foreach ($licencesData as $data) {
            $licences[] = new Licence(
                $data['id'],
                $data['description'],
                $data['availability'],
                $data['price'],
               
                $data['type'],
                $data['commissioning_date'],
                $data['city'],
                 $data['id_user'],


            );
        }

        return $licences; // Retourne un tableau d'objets Licence
    }


    // Getters et Setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): static
    {
        $this->id = $id;
        return $this;
    }



    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;
        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): static
    {
        $this->price = $price;
        return $this;
    }

    public function getAvailability(): ?int
    {
        return $this->availability;
    }

    public function setAvailability(?int $availability): static
    {
        $this->availability = ($availability === 1) ? 1 : 0; // Assurer 0 ou 1
        return $this;
    }

    public function getIdUser(): ?int
    {
        return $this->id_user;
    }

    public function setIdUser(?int $id_user): static
    {
        $this->id_user = $id_user;
        return $this;
    }
    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;
        return $this;
    }
    public function getCommissioning_date(): ?string
    {
        return $this->commissioning_date;
    }

    public function setCommissioning_date(?string $commissioning_date): static
    {
        $this->commissioning_date = $commissioning_date;
        return $this;
    }
    public function getCity(): ?int
    {
        return $this->city;
    }

    public function setCity(?string $city): static
    {
        $this->city = $city;
        return $this;
    }
}
