<?php

namespace App\Models;

use PDO;
use Config\DataBase;

class User
{
    // Déclaration des propriétés privées/protégées correspondant aux colonnes de la table `user`
    protected ?int $id;
    protected ?string $name;
    protected ?string $surname;
    protected ?string $birth_date;
    protected ?string $password;
    protected ?string $register_date;
    protected ?int $id_role;
    protected ?string $email;

    // Constructeur de la classe User qui initialise toutes les propriétés
    public function __construct(
        ?int $id,
        ?string $name,
        ?string $surname,
        ?string $birth_date,
        ?string $password,
        ?string $register_date,
        ?int $id_role,
        ?string $email
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->birth_date = $birth_date;
        $this->password = $password;
        $this->register_date = $register_date;
        $this->id_role = $id_role;
        $this->email = $email;
    }

    // Méthode pour enregistrer un utilisateur en base de données
    public function save(): bool
    {
        $pdo = DataBase::getConnection();
        $sql = "INSERT INTO user (name, surname, birth_date, password, register_date, id_role, email)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $statement = $pdo->prepare($sql);

        // Exécute la requête SQL avec les propriétés de l'objet
        return $statement->execute([
            $this->name,
            $this->surname,
            $this->birth_date,
            $this->password,
            $this->register_date,
            $this->id_role,
            $this->email
        ]);
    }

    // NEW

    // Méthode statique pour retrouver un utilisateur via son email
    public static function findByEmail(string $email): ?User
    {
        $pdo = DataBase::getConnection();
        $sql = "SELECT * FROM user WHERE email = ?";
        $statement = $pdo->prepare($sql);
        $statement->execute([$email]);
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        // Si l'utilisateur est trouvé, retourne un objet User
        if ($row) {
            return new User(
                $row['id'],
                $row['name'],
                $row['surname'],
                $row['birth_date'],
                $row['password'],
                $row['register_date'],
                $row['id_role'],
                $row['email']
            );
        }

        return null; // Aucun utilisateur trouvé
    }

    // Méthode pour récupérer un utilisateur (pour un login)
    public function login(string $email): ?User
    {
        $pdo = DataBase::getConnection();
        $sql = "SELECT * FROM user WHERE email = ?";
        $statement = $pdo->prepare($sql);
        $statement->execute([$email]);
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        // Retourne un objet User si trouvé
        if ($row) {
            return new User(
                $row['id'],
                $row['name'],
                $row['surname'],
                $row['birth_date'],
                $row['password'],
                $row['register_date'],
                $row['id_role'],
                $row['email']
            );
        }

        return null;
    }

    // LICENCE  PROFIL UTILISATEUR

    // Récupère toutes les licences liées à l'utilisateur (via id_user)
    public function getLicences(): array
    {
        $pdo = DataBase::getConnection();
        $sql = "SELECT * FROM licence WHERE id_user = ?";
        $statement = $pdo->prepare($sql);
        $statement->execute([$this->id]);
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

        $licences = [];

        // Parcourt chaque ligne et crée un objet Licence
        foreach ($rows as $row) {
            $licences[] = new Licence(
                $row['id'],
                $row['description'],
                (int) $row['availability'],
                (float) $row['price'],
                $row['type'],
                $row['commissioning_date'],
                $row['city'],
                $row['id_user'],
                $row['email'] ?? null 
                
            );
        }

        return $licences;
    }

    // Met à jour un utilisateur existant dans la base
    public function updateUser($id, $surname, $name, $birthDate, $email, $password, $idRole): bool
    {
        $db = DataBase::getConnection();
        $sql = "UPDATE user SET surname = ?, name = ?, birth_date = ?, email = ?, password = ?, id_role = ? WHERE id = ?";
        $stmt = $db->prepare($sql);

        return $stmt->execute([$surname, $name, $birthDate, $email, $password, $idRole, $id]);
    }

    // TROUVER TOUT LES UTILISATEURS

    // Récupère tous les utilisateurs de la table `user`
    public static function getAllUsers(): array
    {
        $pdo = DataBase::getConnection();
        $sql = "SELECT * FROM user";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

        $users = [];

        // Crée un tableau d'objets User
        foreach ($rows as $row) {
            $users[] = new User(
                $row['id'],
                $row['surname'], 
                $row['name'],
                $row['birth_date'],
                $row['password'],
                null, 
                $row['id_role'],
                $row['email']
            );
        }

        return $users;
    }

    // ADMIN

    // Supprime un utilisateur de la base
    public function deleteUser(): bool
    {
        $pdo = DataBase::getConnection();
        $sql = "DELETE FROM user WHERE id = ?";
        $statement = $pdo->prepare($sql);
        return $statement->execute([$this->id]);
    }

    // Getters (accesseurs) pour récupérer les valeurs des propriétés

    public function getId(): ?int { return $this->id; }
    public function getName(): ?string { return $this->name; }
    public function getSurname(): ?string { return $this->surname; }
    public function getBirthDate(): ?string { return $this->birth_date; }
    public function getPassword(): ?string { return $this->password; }
    public function getRegisterDate(): ?string { return $this->register_date; }
    public function getIdRole(): ?int { return $this->id_role; }
    public function getEmail(): ?string { return $this->email; }
}
