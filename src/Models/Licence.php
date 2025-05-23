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
    protected ?string $email;

    public function __construct(?int $id, ?string $description, ?int $availability, ?float $price, ?string $type, ?string $commissioning_date, ?string $city, ?int $id_user ,?string $email)
    {
        $this->id = $id;
        $this->description = $description;
        $this->availability = ($availability === 1) ? 1 : 0; // Assurer que la valeur est bien 0 ou 1
        $this->price = $price;
        $this->type = $type;
        $this->commissioning_date = $commissioning_date;
        $this->city = $city;
        $this->id_user = $id_user;
        $this->email = $email;
    }
    //User Model
public function addLicence(): bool
{
    $pdo = DataBase::getConnection();
    $sql = "INSERT INTO `licence`(`description`, `availability`, `price`, `type`, `commissioning_date`, `city`, `id_user`)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $statement = $pdo->prepare($sql);
    
    return $statement->execute([
        $this->description,
        $this->availability,
        $this->price,
        $this->type,
        $this->commissioning_date,
        $this->city,
        $this->id_user
    ]);
}


    public static function getAllLicence(): array
    {
        // On récupère une connexion à la base de données via une méthode statique du fichier Database
        $pdo = Database::getConnection();

        // On écrit une requête SQL pour sélectionner toutes les colonnes de la table 'licence'
        $sql = "SELECT * FROM licence";

        // On prépare la requête SQL avec PDO pour éviter les injections SQL
        $statement = $pdo->prepare($sql);

        // On exécute la requête préparée
        $statement->execute();

        // On récupère tous les résultats sous forme de tableau associatif
        $all = $statement->fetchAll(PDO::FETCH_ASSOC);
        // On crée un tableau vide pour stocker les objets Licence
        $licences = [];
        // On parcourt chaque ligne du résultat de la requête
        foreach ($all as $row) {
            // Pour chaque ligne, on crée un objet Licence avec les données récupérées
            $licences[] = new Licence(
                $row['id'],
                $row['description'],
                $row['availability'],
                $row['price'],
                $row['type'],
                $row['commissioning_date'],
                $row['city'],
                $row['id_user'],
                null
            );
        }
        // On retourne le tableau contenant tous les objets Licence créés
        return $licences;
    }//NEW

    public function getLicenceById()
{
    // Connexion à la base de données via une méthode statique de la classe DataBase
    $pdo = DataBase::getConnection();

    $sql = "SELECT 
                `licence`.`id`, 
                `licence`.`description`, 
                `licence`.`availability`, 
                `licence`.`price`, 
                `licence`.`type`, 
                `licence`.`commissioning_date`, 
                `licence`.`city`, 
                `licence`.`id_user`,
                `user`.`email` -- Récupération de l'email de l'utilisateur
            FROM `licence` 
            LEFT JOIN `user` ON `licence`.`id_user` = `user`.`id` 
            WHERE `licence`.`id` = ?";

    // Préparation de la requête SQL
    $statement = $pdo->prepare($sql);

    // Exécution de la requête avec l'identifiant de la licence
    $statement->execute([$this->id]);

    // Récupération de la ligne de résultat sous forme de tableau associatif
    $row = $statement->fetch(PDO::FETCH_ASSOC);

    // Si une ligne est trouvée
    if ($row) {
        // // Ici tu peux utiliser $row['email'] si tu en as besoin
        // $email = $row['email'];

        // Création d'un objet Licence, tu peux aussi décider de lui passer l'email si le constructeur l'accepte
        return new Licence(
            $row['id'],
            $row['description'],
            $row['availability'],
            $row['price'],
            $row['type'],
            $row['commissioning_date'],
            $row['city'],
            $row['id_user'],
            $row['email']
        );
    } else {
        // Si aucune licence trouvée, retourne null
        return null;
    }
}//NEW



    public function updateLicenceUser()
    {
        $pdo = DataBase::getConnection();
        $sql = "UPDATE `licence` 
        SET `description` = ?, `availability` = ?, `price` = ?, `type` = ?, `commissioning_date` = ?, `city`=?
        WHERE `licence`.`id` = ?";
        $statement = $pdo->prepare($sql);
        return $statement->execute([$this->description, $this->availability, $this->price, $this->type, $this->commissioning_date,$this->city, $this->id]);
    } 



    public function deleteLicence(): bool
    {
        $pdo = DataBase::getConnection();
        $sql = "DELETE FROM `licence` WHERE `id` = ?";
        $statement = $pdo->prepare($sql);
        return $statement->execute([$this->id]);
    }



    //Admin Model








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



    public function setType(?string $type): static
    {
        $this->type = $type;
        return $this;
    }
    public function getCommissioning_date(): ?string
    {
        return $this->commissioning_date;
    }

    public function setCommissioningdate(?string $commissioning_date): static
    {
        $this->commissioning_date = $commissioning_date;
        return $this;
    }
    public function getCity():?string
    {
        return $this->city;
    }

    public function setCity(?string $city): static
    {
        $this->city = $city;
        return $this;
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
     public function getEmail(): ?string  
            { return $this->email; }
}
