<?php
// accueil
// Connexion à la base
$pdo = require_once __DIR__ . '/../../../../models/connect.php';

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $subtitle1 = $_POST['subtitle1'] ?? '';
    $subtitle2 = $_POST['subtitle2'] ?? '';
    $subtitle3 = $_POST['subtitle3'] ?? '';
    $bouton = $_POST['bouton'] ?? '';
    $image = null;

    // Si une image est uploadée
    if (!empty($_FILES['photo']['name'])) {
        $photo_name = basename($_FILES['photo']['name']);
        $target_path = '../assets/img/' . $photo_name;

        if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_path)) {
            $image = $photo_name; // on enregistre uniquement le nom
        }
    } elseif (!empty($_POST['image_url'])) {
        $image = $_POST['image_url']; // ou lien externe
    }

    // Préparation de la requête SQL
    $sql = "UPDATE home SET title = ?, subtitle1 = ?, subtitle2 = ?, subtitle3 = ?, bouton = ?";
    $params = [$title, $subtitle1, $subtitle2, $subtitle3, $bouton];

    if ($image !== null) {
        $sql .= ", image = ?";
        $params[] = $image;
    }

    $sql .= " WHERE id = 1"; // Modifier l'id si nécessaire
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    echo "✅ Contenu mis à jour avec succès !";
}

// Récupération des données actuelles
$stmt = $pdo->query("SELECT * FROM home WHERE id = 1");
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$data) {
    die("⚠️ Aucune ligne trouvée dans la table 'home' avec id = 1.");
}

$imageURL = htmlspecialchars($data['image'] ?? '');
?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <title>Admin - Modifier l'accueil</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../../dist/css/adminlte.css" />
</head>
<body>
<div class="app-wrapper">
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
        <h1>Modifier la page d’accueil</h1>
        <form method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label class="form-label">Titre</label>
            <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($data['title'] ?? '') ?>">
          </div>

          <div class="mb-3">
            <label class="form-label">Sous-titre 1</label>
            <textarea name="subtitle1" class="form-control" rows="2"><?= htmlspecialchars($data['subtitle1'] ?? '') ?></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Sous-titre 2</label>
            <textarea name="subtitle2" class="form-control" rows="2"><?= htmlspecialchars($data['subtitle2'] ?? '') ?></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Sous-titre 3</label>
            <textarea name="subtitle3" class="form-control" rows="2"><?= htmlspecialchars($data['subtitle3'] ?? '') ?></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Texte du bouton</label>
            <input type="text" name="bouton" class="form-control" value="<?= htmlspecialchars($data['bouton'] ?? '') ?>">
          </div>

          <div class="mb-3">
            <label class="form-label">Image actuelle :</label><br>
            <?php if (!empty($imageURL)): ?>
                <img id="imgPreview" src="../assets/img/<?= $imageURL ?>" alt="Image actuelle" width="200">
            <?php else: ?>
                <img id="imgPreview" src="" alt="Aperçu image" width="200" style="display: none;">
            <?php endif; ?>
          </div>

          <div class="mb-3">
            <label class="form-label">Uploader une nouvelle image :</label>
            <input type="file" name="photo" class="form-control">
          </div>

          <div class="mb-3">
            <label for="image_url" class="form-label">Ou coller un lien d’image :</label>
            <input type="text" name="image_url" id="image_url" class="form-control"
                   placeholder="https://exemple.com/image.jpg" value="<?= $imageURL ?>">
          </div>

          <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
      </div>
    </main>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
  <script>
    const input = document.getElementById('image_url');
    const preview = document.getElementById('imgPreview');

    input.addEventListener('input', () => {
        const url = input.value.trim();
        if (url.match(/\.(jpeg|jpg|png|gif|webp)$/i)) {
            preview.src = url;
            preview.style.display = 'block';
        } else {
            preview.style.display = 'none';
        }
    });
  </script>
</body>
</html>
