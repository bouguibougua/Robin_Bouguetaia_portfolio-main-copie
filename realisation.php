<?php
$pdo = require 'models/connect.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) { die("ID invalide"); }

/* Parent : works */
$stmt = $pdo->prepare("SELECT * FROM works WHERE ID = ?");
$stmt->execute([$id]);
$work = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$work) { die("Réalisation introuvable"); }

/* Enfants : sous_realisations */
$stmt = $pdo->prepare("SELECT * FROM sous_realisations WHERE realisation_id = ? ORDER BY id DESC");
$stmt->execute([$id]);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

$titre = $work['titre'] ?? 'Réalisation';
$desc  = $work['description'] ?? '';
$img   = $work['image'] ?? '';

/* Chemin images (adapte si tes images ne sont pas dans /photo/) */
function img_url(string $filename): string {
  // si ton DB stocke déjà un chemin, on le laisse
  if (preg_match('~^https?://~i', $filename)) return $filename;
  if (str_starts_with($filename, '/')) return $filename;
  return "/Robin_Bouguetaia_portfolio-main-copie/photo/" . $filename;
}

/* fallback si besoin */
$heroImg = !empty($img) ? img_url($img) : "";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= htmlspecialchars($titre) ?></title>
  <link rel="stylesheet" href="realisation.css" />
</head>

<body>

<header class="hero">
  <?php if (!empty($heroImg)) : ?>
    <div class="hero-media" aria-hidden="true">
      <img src="<?= htmlspecialchars($heroImg) ?>" alt="">
    </div>
  <?php endif; ?>

  
</header>

<main class="wrap">

  <?php if (!empty($items)) : ?>
    <section class="grid">
      <?php foreach ($items as $sous) : ?>
        <?php
          $st = $sous['titre'] ?? 'Sous-réalisation';
          $sd = $sous['description'] ?? '';
          $si = $sous['image'] ?? '';
          $cardImg = !empty($si) ? img_url($si) : "";
        ?>

        <article class="card">

          <?php if (!empty($cardImg)) : ?>
            <div class="card-media">
              <img src="<?= htmlspecialchars($cardImg) ?>" alt="<?= htmlspecialchars($st) ?>">
            </div>
          <?php endif; ?>

          <div class="card-body">
            <h3><?= htmlspecialchars($st) ?></h3>

            <?php if (!empty($sd)) : ?>
              <p><?= nl2br(htmlspecialchars($sd)) ?></p>
            <?php else : ?>
              <p class="muted">Description indisponible.</p>
            <?php endif; ?>

            <div class="card-bar"></div>
          </div>

        </article>
      <?php endforeach; ?>
    </section>
  <?php else: ?>
    <section class="empty">
      <h2>Aucune sous-réalisation</h2>
      <p>Tu peux en ajouter depuis ton interface admin.</p>
      <a class="btn" href="index.php">Retour à l’accueil</a>
    </section>
  <?php endif; ?>

  <div class="bottom">
    <a class="btn" href="index.php">← Retour à l’accueil</a>
  </div>

</main>

</body>
</html>