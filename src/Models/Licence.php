<?php

namespace App\Models;

use Config\DataBase;
use PDO;

class Licence
{
    protected ?int $id;
    protected ?string $title;
    protected ?string $description;
    protected ?int $availability; // Stocké sous forme d'entier (0 ou 1)
    protected ?string $picture;
    protected ?float $price;
    protected ?int $id_user;

    public function __construct(?int $id, ?string $title, ?string $description, ?int $availability, ?string $picture, ?float $price, ?int $id_user)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->availability = ($availability === 1) ? 1 : 0; // Assurer que la valeur est bien 0 ou 1
        $this->picture = $picture;
        $this->price = $price;
        $this->id_user = $id_user;
    }

    public function addLicence(): bool 
    {
        $pdo = DataBase::getConnection();
        $sql = "INSERT INTO `licence` (`title`, `description`, `availability`, `picture`, `price`, `id_user`) 
                VALUES (?, ?, 1, ?, ?, ?)"; // `availability` est toujours 1
    
        $statement = $pdo->prepare($sql);
        return $statement->execute([
            $this->title, 
            $this->description, 
            $this->picture, 
            $this->price, 
            $this->id_user
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
            $data['id'], $data['title'], $data['description'], 
            $data['availability'], $data['picture'], $data['price'], $data['id_user']
        ) : null;
    }

    public function updateLicence()
    {
        $db = Database::getConnection();
        $query = $db->prepare("UPDATE licence SET title = ?, description = ?, availability = ?, picture = ?, price = ? WHERE id = ?");
        return $query->execute([$this->title, $this->description, $this->availability, $this->picture, $this->price, $this->id]);
    }
    
    
    public function deleteLicence(): bool
    {
        $pdo = DataBase::getConnection();
        $sql = "DELETE FROM `licence` WHERE `id` = ?";
        $statement = $pdo->prepare($sql);
        return $statement->execute([$this->id]);
    }

    public static function readLicence(): array
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
                $data['title'],
                $data['description'],
                (int) $data['availability'], // Convertir en entier
                $data['picture'],
                $data['price'],
                $data['id_user']
            );
        }
        return $licences;
    }

    public function getPicturePath(): string
    {
        $picturePath = __DIR__ . '/../../public/imgUpload/' . $this->picture;
        if (file_exists($picturePath)) {
            return '/public/imgUpload/' . $this->picture;
        }
        return '/public/imgUpload/default.jpg'; // Image par défaut si le fichier n'existe pas
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
            $licenceData['title'],
            $licenceData['description'],
            $licenceData['availability'],
            $licenceData['picture'],
            $licenceData['price'],
            $licenceData['id_user']
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
                $data['title'],
                $data['description'],
                $data['availability'],
                $data['picture'],
                $data['price'],
                $data['id_user']
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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;
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

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): static
    {
        $this->picture = $picture;
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
    
}
