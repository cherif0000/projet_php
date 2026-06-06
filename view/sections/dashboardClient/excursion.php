<?php
require_once("model/ExcursionDB.php");
$excursionDB = new ExcursionDB();
$excursions  = $excursionDB->getAllExcursions();
$defaultImg  = "https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=600&h=400&fit=crop&q=80";
?>
<section id="panel-excursions" class="panel portfolio section">

  <div class="container section-title">
    <h2>Excursions</h2>
    <div><span>Découvrez nos</span> <span class="description-title">Excursions</span></div>
  </div>

  <div class="container">
    <?php if (empty($excursions)): ?>
      <div class="text-center py-5 text-muted">
        <i class="bi bi-compass" style="font-size:48px;opacity:.3"></i>
        <p class="mt-3">Aucune excursion disponible pour le moment.</p>
      </div>
    <?php else: ?>
    <div class="row gy-4">
      <?php foreach ($excursions as $exc):
        $img = !empty($exc['image']) ? htmlspecialchars($exc['image']) : $defaultImg;
      ?>
      <div class="col-lg-4 col-md-6">
        <div class="portfolio-content h-100">
          <a href="excursionDetail?id=<?= $exc['id'] ?>">
            <img src="<?= $img ?>" class="img-fluid logement-img" onerror="this.src='https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=600&h=400&fit=crop&q=80'" alt="<?= htmlspecialchars($exc['nom']) ?>">
          </a>
          <div class="portfolio-info">
            <div class="exc-badge"><i class="bi bi-calendar-event me-1"></i><?= htmlspecialchars($exc['date']) ?></div>
            <h4><a href="excursionDetail?id=<?= $exc['id'] ?>"><?= htmlspecialchars($exc['nom']) ?></a></h4>
            <p>
              <i class="bi bi-geo-alt-fill text-warning me-1"></i><?= htmlspecialchars($exc['adresse']) ?>
              &nbsp;·&nbsp; <strong><?= number_format($exc['prix'], 0, ',', ' ') ?> FCFA</strong> / personne
            </p>
            <div class="d-flex justify-content-end mt-2">
              <a href="excursionDetail?id=<?= $exc['id'] ?>" class="btn-voir">Voir détails <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </div>
</section>
