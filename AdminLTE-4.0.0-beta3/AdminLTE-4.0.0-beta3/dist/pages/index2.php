<?php
//navbar
// Connexion à la base
$pdo = require_once __DIR__ . '/../../../../models/connect.php';

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $grandtitre = $_POST['grandtitre'] ?? '';
    $lien1 = $_POST['lien1'] ?? '';
    $lien2 = $_POST['lien2'] ?? '';
    $lien3 = $_POST['lien3'] ?? '';
    $lien4 = $_POST['lien4'] ?? '';
    $lien5 = $_POST['lien5'] ?? '';

    // Mise à jour SQL
    $sql = "UPDATE navbar SET grandtitre = ?, lien1 = ?, lien2 = ?, lien3 = ?, lien4 = ?, lien5 = ? WHERE `id.nav_bar` = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$grandtitre, $lien1, $lien2, $lien3, $lien4, $lien5]);

    echo "✅ Barre de navigation mise à jour avec succès !";
}

// Récupération des données actuelles
$stmt = $pdo->query("SELECT * FROM navbar WHERE `id.nav_bar` = 1");
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$data) {
    die("⚠️ Aucune ligne trouvée dans la table 'navbar' avec id = 1.");
}
?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <title>Admin - Modifier la Navbar</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../../dist/css/adminlte.css" />
</head>
<body>
<div class="app-wrapper">
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
            <li class="nav-item menu-open">
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="./index.php" class="nav-link">
                    <i class="nav-icon bi bi-circle"></i>
                    <p>Accueil</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./index2.php" class="nav-link">
                    <i class="nav-icon bi bi-circle"></i>
                    <p>Navbar</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./index3.php" class="nav-link">
                    <i class="nav-icon bi bi-circle"></i>
                    <p>Projet</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./index4.php" class="nav-link">
                    <i class="nav-icon bi bi-circle"></i>
                    <p>À propos</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./index5.php" class="nav-link">
                    <i class="nav-icon bi bi-circle"></i>
                    <p>Mes réalisation</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./index6.php" class="nav-link">
                    <i class="nav-icon bi bi-circle"></i>
                    <p>Contact</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./modif_sous_projet.php" class="nav-link">
                    <i class="nav-icon bi bi-circle"></i>
                    <p>modif projet</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./modif_sous_realisations.php" class="nav-link">
                    <i class="nav-icon bi bi-circle"></i>
                    <p>modif realisation</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="app-main">
      <div class="container-fluid">
        <h1>Modifier la barre de navigation</h1>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Grand titre</label>
                <input type="text" name="grandtitre" class="form-control" value="<?= htmlspecialchars($data['grandtitre']) ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Lien 1</label>
                <input type="text" name="lien1" class="form-control" value="<?= htmlspecialchars($data['lien1']) ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Lien 2</label>
                <input type="text" name="lien2" class="form-control" value="<?= htmlspecialchars($data['lien2']) ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Lien 3</label>
                <input type="text" name="lien3" class="form-control" value="<?= htmlspecialchars($data['lien3']) ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Lien 4</label>
                <input type="text" name="lien4" class="form-control" value="<?= htmlspecialchars($data['lien4']) ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Lien 5</label>
                <input type="text" name="lien5" class="form-control" value="<?= htmlspecialchars($data['lien5']) ?>">
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
      </div>
    </main>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
