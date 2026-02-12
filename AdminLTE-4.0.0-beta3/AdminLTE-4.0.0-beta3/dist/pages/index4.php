<?php
// Connexion à la base
$pdo = require_once __DIR__ . '/../../../../models/connect.php';

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "UPDATE about SET grandtitre=?, description=?, titre=?, 
            texte1=?, gauge1=?, texte2=?, gauge2=?, 
            texte3=?, gauge3=?, texte4=?, gauge4=?, 
            texte5=?, gauge5=? WHERE id = 1";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['grandtitre'], $_POST['description'], $_POST['titre'],
        $_POST['texte1'], $_POST['gauge1'], $_POST['texte2'], $_POST['gauge2'],
        $_POST['texte3'], $_POST['gauge3'], $_POST['texte4'], $_POST['gauge4'],
        $_POST['texte5'], $_POST['gauge5']
    ]);

    echo "<div class='alert alert-success'>✅ Section À propos mise à jour avec succès !</div>";
}

$stmt = $pdo->query("SELECT * FROM about WHERE id = 1");
$data = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$data) die("⚠️ Aucune donnée trouvée.");
?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <title>Admin - Modifier À propos</title>
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
            <li class="nav-item">
              <a href="./index.php" class="nav-link"><i class="nav-icon bi bi-circle"></i><p>Accueil</p></a>
            </li>
            <li class="nav-item">
              <a href="./index2.php" class="nav-link"><i class="nav-icon bi bi-circle"></i><p>Navbar</p></a>
            </li>
            <li class="nav-item">
              <a href="./index3.php" class="nav-link"><i class="nav-icon bi bi-circle"></i><p>Projet</p></a>
            </li>
            <li class="nav-item">
              <a href="./index4.php" class="nav-link active"><i class="nav-icon bi bi-circle"></i><p>À propos</p></a>
            </li>
            <li class="nav-item">
              <a href="./index5.php" class="nav-link"><i class="nav-icon bi bi-circle"></i><p>Mes réalisation</p></a>
            </li>
            <li class="nav-item">
              <a href="./index6.php" class="nav-link"><i class="nav-icon bi bi-circle"></i><p>Contact</p></a>
            </li>
            <li class="nav-item">
              <a href="./modif_sous_projet.php" class="nav-link"><i class="nav-icon bi bi-circle"></i><p>modif projet</p></a>
            </li>
            <li class="nav-item">
              <a href="./modif_sous_realisations.php" class="nav-link"><i class="nav-icon bi bi-circle"></i><p>modif realisation</p></a>
            </li>
          </ul>
        </nav>
      </div>
    </aside>

    <!-- Main -->
    <main class="app-main flex-grow-1 p-4">
      <div class="container-fluid">
        <h1 class="mb-4">Modifier la section À propos</h1>

        <form method="POST" class="bg-light p-4 rounded shadow-sm">
            <div class="mb-3">
                <label class="form-label">Grand titre</label>
                <input type="text" name="grandtitre" class="form-control" value="<?= htmlspecialchars($data['grandtitre']) ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="4"><?= htmlspecialchars($data['description']) ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Titre de la section compétences</label>
                <input type="text" name="titre" class="form-control" value="<?= htmlspecialchars($data['titre']) ?>">
            </div>

            <?php for ($i = 1; $i <= 5; $i++): ?>
              <div class="row mb-3">
                <div class="col-md-6">
                  <label class="form-label">Texte compétence <?= $i ?></label>
                  <input type="text" name="texte<?= $i ?>" class="form-control" value="<?= htmlspecialchars($data['texte'.$i]) ?>">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Gauge compétence <?= $i ?> (ex : 70%)</label>
                  <input type="text" name="gauge<?= $i ?>" class="form-control" value="<?= htmlspecialchars($data['gauge'.$i]) ?>">
                </div>
              </div>
            <?php endfor; ?>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
      </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
