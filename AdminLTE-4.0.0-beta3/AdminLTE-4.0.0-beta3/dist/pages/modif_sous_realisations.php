<?php
$pdo = require_once __DIR__ . '/../../../../models/connect.php';

// Ajout
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $id_realisation = (int)$_POST['id_realisation'];
    $titre = trim($_POST['titre']);
    $description = trim($_POST['description']);
    $image = trim($_POST['image']);

    if (!empty($titre) && $id_realisation > 0) {
        $stmt = $pdo->prepare("INSERT INTO sous_realisations (realisation_id, titre, description, image) VALUES (?, ?, ?, ?)");
        $stmt->execute([$id_realisation, $titre, $description, $image]);
        header("Location: modif_sous_realisations.php");
        exit;
    }
}

// Suppression
if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM sous_realisations WHERE id = ?");
    $stmt->execute([(int)$_GET['delete']]);
    header("Location: modif_sous_realisations.php");
    exit;
}

// Données
$realisations = $pdo->query("SELECT ID, titre FROM works")->fetchAll(PDO::FETCH_ASSOC);
$stmt = $pdo->query("SELECT sr.*, w.titre AS realisation_titre FROM sous_realisations sr JOIN works w ON sr.realisation_id = w.ID");
$sous_realisations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <title>Admin - Gérer les Sous-Réalisations</title>
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
          <li class="nav-item"><a href="./index5.php" class="nav-link"><i class="nav-icon bi bi-circle"></i><p>Mes réalisation</p></a></li>
          <li class="nav-item"><a href="./index6.php" class="nav-link"><i class="nav-icon bi bi-circle"></i><p>Contact</p></a></li>
          <li class="nav-item"><a href="./modif_sous_projet.php" class="nav-link"><i class="nav-icon bi bi-circle"></i><p>modif projet</p></a></li>
          <li class="nav-item"><a href="./modif_sous_realisations.php" class="nav-link active"><i class="nav-icon bi bi-circle"></i><p>modif realisation</p></a></li>
        </ul>
      </nav>
    </div>
  </aside>

  <!-- Main -->
  <main class="app-main flex-grow-1 p-4">
    <div class="container-fluid">
      <h1 class="mb-4">Gérer toutes les sous-réalisations</h1>

      <!-- Formulaire ajout -->
      <div class="card mb-4">
        <div class="card-header bg-primary text-white">Ajouter une sous-réalisation</div>
        <div class="card-body">
          <form method="POST">
            <div class="mb-3">
              <label class="form-label">Réalisation concernée</label>
              <select name="id_realisation" class="form-control" required>
                <?php foreach ($realisations as $real): ?>
                  <option value="<?= $real['ID'] ?>">#<?= $real['ID'] ?> - <?= htmlspecialchars($real['titre']) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Titre</label>
              <input type="text" name="titre" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Description</label>
              <textarea name="description" class="form-control" rows="3"></textarea>
            </div>
            <div class="mb-3">
              <label class="form-label">Image (nom du fichier)</label>
              <input type="text" name="image" class="form-control">
            </div>
            <button type="submit" name="add" class="btn btn-success">➕ Ajouter</button>
          </form>
        </div>
      </div>

      <!-- Liste -->
      <div class="card">
        <div class="card-header bg-dark text-white">Toutes les sous-réalisations existantes</div>
        <div class="card-body table-responsive">
          <table class="table table-bordered table-hover bg-white text-dark">
            <thead>
              <tr>
                <th>ID</th>
                <th>Réalisation</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Image</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($sous_realisations as $sous): ?>
              <tr>
                <td><?= $sous['id'] ?></td>
                <td>#<?= $sous['realisation_id'] ?> - <?= htmlspecialchars($sous['realisation_titre']) ?></td>
                <td><?= htmlspecialchars($sous['titre']) ?></td>
                <td><?= htmlspecialchars($sous['description']) ?></td>
                <td><?= htmlspecialchars($sous['image']) ?></td>
                <td>
                  <a href="?delete=<?= $sous['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cette sous-réalisation ?')">🗑 Supprimer</a>
                </td>
              </tr>
              <?php endforeach; ?>
              <?php if (empty($sous_realisations)): ?>
              <tr><td colspan="6" class="text-center">Aucune sous-réalisation trouvée.</td></tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
