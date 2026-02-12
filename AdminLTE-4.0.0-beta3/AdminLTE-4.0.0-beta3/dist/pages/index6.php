<?php
// Connexion à la base
$pdo = require_once __DIR__ . '/../../../../models/connect.php';

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "UPDATE contact SET titre = ?, description = ?, nom = ?, email = ?, sujet = ?, message = ?, bouton = ? WHERE ID = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['titre'] ?? '',
        $_POST['description'] ?? '',
        $_POST['nom'] ?? '',
        $_POST['email'] ?? '',
        $_POST['sujet'] ?? '',
        $_POST['message'] ?? '',
        $_POST['bouton'] ?? ''
    ]);

    echo "<div class='alert alert-success'>✅ Section Contact mise à jour avec succès !</div>";
}

// Récupération des données
$stmt = $pdo->query("SELECT * FROM contact WHERE ID = 1");
$data = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$data) die("⚠️ Aucune donnée trouvée.");
?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <title>Admin - Modifier Contact</title>
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
          <li class="nav-item"><a href="./index6.php" class="nav-link active"><i class="nav-icon bi bi-circle"></i><p>Contact</p></a></li>
          <li class="nav-item"><a href="./modif_sous_projet.php" class="nav-link"><i class="nav-icon bi bi-circle"></i><p>modif projet</p></a></li>
          <li class="nav-item"><a href="./modif_sous_realisations.php" class="nav-link"><i class="nav-icon bi bi-circle"></i><p>modif realisation</p></a></li>
        </ul>
      </nav>
    </div>
  </aside>

  <!-- Main -->
  <main class="app-main flex-grow-1 p-4">
    <div class="container-fluid">
      <h1 class="mb-4">Modifier la section Contact</h1>

      <form method="POST" class="bg-light p-4 rounded shadow-sm">
        <div class="mb-3">
          <label class="form-label">Titre</label>
          <input type="text" name="titre" class="form-control" value="<?= htmlspecialchars($data['titre']) ?>">
        </div>

        <div class="mb-3">
          <label class="form-label">Description</label>
          <textarea name="description" class="form-control" rows="4"><?= htmlspecialchars($data['description']) ?></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label">Nom (placeholder)</label>
          <input type="text" name="nom" class="form-control" value="<?= htmlspecialchars($data['nom']) ?>">
        </div>

        <div class="mb-3">
          <label class="form-label">Email (placeholder)</label>
          <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($data['email']) ?>">
        </div>

        <div class="mb-3">
          <label class="form-label">Sujet (placeholder)</label>
          <input type="text" name="sujet" class="form-control" value="<?= htmlspecialchars($data['sujet']) ?>">
        </div>

        <div class="mb-3">
          <label class="form-label">Message (placeholder)</label>
          <input type="text" name="message" class="form-control" value="<?= htmlspecialchars($data['message']) ?>">
        </div>

        <div class="mb-3">
          <label class="form-label">Texte du bouton</label>
          <input type="text" name="bouton" class="form-control" value="<?= htmlspecialchars($data['bouton']) ?>">
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
      </form>
    </div>
  </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
