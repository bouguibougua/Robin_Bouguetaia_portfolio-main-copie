<?php
// Connexion à la base
$pdo = require_once __DIR__ . '/../../../../models/connect.php';

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = (int) $_POST['id'];
    $grandtitre = $_POST['grandtitre'] ?? '';
    $titre = $_POST['titre'] ?? '';
    $description = $_POST['description'] ?? '';
    $image = $_POST['image'] ?? '';
    $bouton = $_POST['bouton'] ?? '';

    $sql = "UPDATE works SET grandtitre = ?, titre = ?, description = ?, image = ?, bouton = ? WHERE ID = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$grandtitre, $titre, $description, $image, $bouton, $id]);

    echo "<div class='alert alert-success'>✅ Réalisation ID $id mise à jour avec succès !</div>";
}

// Récupération des réalisations
$stmt = $pdo->query("SELECT * FROM works");
$realisations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <title>Admin - Modifier Mes Réalisations</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../../dist/css/adminlte.css" />
</head>
<body>
<div class="app-wrapper d-flex">

  <!-- Sidebar -->
  <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
      <a href="./index.php" class="brand-link">
        <img src="../../dist/assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image opacity-75 shadow" />
        <span class="brand-text fw-light">AdminLTE 4</span>
      </a>
    </div>
    <div class="sidebar-wrapper">
      <nav class="mt-2">
        <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
          <li class="nav-item"><a href="./index.php" class="nav-link"><i class="nav-icon bi bi-circle"></i><p>Accueil</p></a></li>
          <li class="nav-item"><a href="./index2.php" class="nav-link"><i class="nav-icon bi bi-circle"></i><p>Navbar</p></a></li>
          <li class="nav-item"><a href="./index3.php" class="nav-link"><i class="nav-icon bi bi-circle"></i><p>Projet</p></a></li>
          <li class="nav-item"><a href="./index4.php" class="nav-link"><i class="nav-icon bi bi-circle"></i><p>À propos</p></a></li>
          <li class="nav-item"><a href="./index5.php" class="nav-link active"><i class="nav-icon bi bi-circle"></i><p>Mes réalisation</p></a></li>
          <li class="nav-item"><a href="./index6.php" class="nav-link"><i class="nav-icon bi bi-circle"></i><p>Contact</p></a></li>
          <li class="nav-item"><a href="./modif_sous_projet.php" class="nav-link"><i class="nav-icon bi bi-circle"></i><p>modif projet</p></a></li>
          <li class="nav-item"><a href="./modif_sous_realisations.php" class="nav-link"><i class="nav-icon bi bi-circle"></i><p>modif realisation</p></a></li>
        </ul>
      </nav>
    </div>
  </aside>

  <!-- Main Content -->
  <main class="app-main flex-grow-1 p-4">
    <div class="container-fluid">
      <h1 class="mb-4">Modifier les Réalisations</h1>

      <?php foreach ($realisations as $item): ?>
      <form method="POST" class="border p-3 mb-4 shadow-sm bg-light rounded">
        <input type="hidden" name="id" value="<?= htmlspecialchars($item['ID']) ?>">

        <h5>Réalisation ID #<?= htmlspecialchars($item['ID']) ?></h5>

        <div class="mb-3">
          <label class="form-label">Grand titre</label>
          <input type="text" name="grandtitre" class="form-control" value="<?= htmlspecialchars($item['grandtitre']) ?>">
        </div>

        <div class="mb-3">
          <label class="form-label">Titre</label>
          <input type="text" name="titre" class="form-control" value="<?= htmlspecialchars($item['titre']) ?>">
        </div>

        <div class="mb-3">
          <label class="form-label">Description</label>
          <textarea name="description" class="form-control"><?= htmlspecialchars($item['description']) ?></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label">Image (nom de fichier)</label>
          <input type="text" name="image" class="form-control" value="<?= htmlspecialchars($item['image']) ?>">
        </div>

        <div class="mb-3">
          <label class="form-label">Texte du bouton</label>
          <input type="text" name="bouton" class="form-control" value="<?= htmlspecialchars($item['bouton']) ?>">
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
      </form>
      <?php endforeach; ?>
    </div>
  </main>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
