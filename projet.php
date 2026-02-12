<?php
$pdo = require 'models/connect.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

/* Projet principal */
$stmt = $pdo->prepare("SELECT * FROM projet WHERE id = ?");
$stmt->execute([$id]);
$projet = $stmt->fetch();

if (!$projet) {
  echo "Projet introuvable";
  exit;
}

/* Sous-projets */
$stmt = $pdo->prepare("SELECT * FROM sous_projet WHERE id_projet = ?");
$stmt->execute([$id]);
$sous_projets = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($projet['titre']) ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- ⚠️ TON CSS EXISTANT -->
  <link rel="stylesheet" href="projet.css">
</head>

<body>

<!-- =========================
     CONTENEUR PRINCIPAL
========================= -->
<main class="projet-container">

  <h1><?= htmlspecialchars($projet['titre']) ?></h1>

  <?php if (!empty($projet['description'])): ?>
    <p><?= nl2br(htmlspecialchars($projet['description'])) ?></p>
  <?php endif; ?>

  <!-- =========================
       SOUS-PROJETS
  ========================= -->
  <section class="sous-projets-grid">

    <?php foreach ($sous_projets as $sous): ?>
      <article class="sous-projet">

        <!-- ⬅️ COLONNE GAUCHE : IMAGE -->
        <div class="sous-projet-image">
          <img
            src="/Robin_Bouguetaia_portfolio-main-copie/photo/<?= htmlspecialchars($sous['image']) ?>"
            alt="<?= htmlspecialchars($sous['titre']) ?>"
          >
        </div>

        <!-- ➡️ COLONNE DROITE : TEXTE -->
        <div class="sous-projet-content">
          <h3><?= htmlspecialchars($sous['titre']) ?></h3>
          <p><?= nl2br(htmlspecialchars($sous['description'])) ?></p>
        </div>

      </article>
    <?php endforeach; ?>

  </section>

  <!-- =========================
       BOUTON RETOUR
  ========================= -->
  <a href="index.php" class="bouton-retour">← Retour à l’accueil</a>

</main>

</body>
</html>