<?php
// Connexion à la base
$pdo = require 'C:/xampp/htdocs/Robin_Bouguetaia_portfolio-main-copie/models/connect.php';

// Traitement de la mise à jour
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = (int) $_POST['id'];
    $titre = $_POST['titre'] ?? '';
    $description = $_POST['description'] ?? '';
    $bouton = $_POST['bouton'] ?? '';
    $image = $_POST['image'] ?? '';

    $sql = "UPDATE projet SET titre = ?, description = ?, bouton = ?, image = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$titre, $description, $bouton, $image, $id]);

    echo "<div class='alert alert-success'>✅ Projet ID $id mis à jour avec succès !</div>";
}

// Récupération selon si id passé en GET
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM projet WHERE id = ?");
    $stmt->execute([$id]);
    $projets = [$stmt->fetch(PDO::FETCH_ASSOC)];
} else {
    $stmt = $pdo->query("SELECT * FROM projet");
    $projets = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <title>Admin - Modifier les Projets</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../../dist/css/adminlte.css" />
</head>
<body>
<div class="app-wrapper d-flex">
  <!-- Sidebar -->
  <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!-- ... ton code sidebar ... -->
  </aside>

  <!-- Main Content -->
  <main class="app-main flex-grow-1 p-4">
    <div class="container-fluid">
      <h1 class="mb-4">Modifier les projets</h1>

      <?php if (isset($id)): ?>
          <a href="index3.php" class="btn btn-secondary mb-3">← Voir tous les projets</a>
      <?php endif; ?>

      <?php foreach ($projets as $data): ?>
          <?php if ($data): ?>
          <form method="POST" class="border p-3 mb-4 shadow-sm bg-light rounded">
              <input type="hidden" name="id" value="<?= htmlspecialchars($data['id']) ?>">

              <h5>Projet ID #<?= htmlspecialchars($data['id']) ?></h5>

              <div class="mb-3">
                  <label class="form-label">Titre</label>
                  <input type="text" name="titre" class="form-control" value="<?= htmlspecialchars($data['titre']) ?>">
              </div>
              <div class="mb-3">
                  <label class="form-label">Description</label>
                  <textarea name="description" class="form-control"><?= htmlspecialchars($data['description']) ?></textarea>
              </div>
              <div class="mb-3">
                  <label class="form-label">Bouton</label>
                  <input type="text" name="bouton" class="form-control" value="<?= htmlspecialchars($data['bouton']) ?>">
              </div>
              <div class="mb-3">
                  <label class="form-label">Image (nom de fichier)</label>
                  <input type="text" name="image" class="form-control" value="<?= htmlspecialchars($data['image']) ?>">
              </div>
              <button type="submit" class="btn btn-primary">Mettre à jour</button>
          </form>
          <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
