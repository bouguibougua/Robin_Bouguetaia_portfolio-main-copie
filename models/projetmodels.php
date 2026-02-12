<?php

class ProjetModel {

    private PDO $pdo;

    // Constructeur
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // ✅ Récupérer tous les projets
    public function getAll() {
        $sql = 'SELECT * FROM projet ORDER BY id DESC';
        $statement = $this->pdo->query($sql);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    // ✅ Récupérer un projet par ID
    public function getById(int $id): ?array {
        $sql = 'SELECT * FROM projet WHERE id = ?';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([$id]);
        $projet = $statement->fetch(PDO::FETCH_ASSOC);
        return $projet ?: null;
    }

    // ✅ Ajouter un projet
    public function add(string $grandtitre, string $titre, string $image, string $description, string $bouton): bool {
        $sql = 'INSERT INTO projet (grandtitre, titre, image, description, bouton) VALUES (?, ?, ?, ?, ?)';
        $statement = $this->pdo->prepare($sql);
        return $statement->execute([$grandtitre, $titre, $image, $description, $bouton]);
    }

    // ✅ Modifier un projet
    public function update(int $id, string $grandtitre, string $titre, string $image, string $description, string $bouton): bool {
        $sql = 'UPDATE projet SET grandtitre = ?, titre = ?, image = ?, description = ?, bouton = ? WHERE id = ?';
        $statement = $this->pdo->prepare($sql);
        return $statement->execute([$grandtitre, $titre, $image, $description, $bouton, $id]);
    }

    // ✅ Supprimer un projet
    public function delete(int $id): bool {
        $sql = 'DELETE FROM projet WHERE id = ?';
        $statement = $this->pdo->prepare($sql);
        return $statement->execute([$id]);
    }
}
?>
