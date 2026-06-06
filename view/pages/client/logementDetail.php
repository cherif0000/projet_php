<?php
session_start();
if (!isset($_SESSION['id'])) { header("Location: login"); exit; }

require_once("../../../model/LogementDB.php");
$db  = new LogementDB();
$id  = (int)($_GET['id'] ?? 0);
$log = $id ? $db->getLogementById($id) : null;
if (!$log) { header("Location: dashboard"); exit; }
$images = $db->getImagesLogement($id);
$defaultImg = "https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?auto=format&fit=crop&w=800&q=80";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title><?= htmlspecialchars($log['titre']) ?> — DakarStay</title>
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;600;700&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    :root { --accent:#e07b39; }
    body  { font-family:'Poppins',sans-serif; background:#f8f8f8; }
    .topbar { background:#fff; border-bottom:1px solid #eee; padding:14px 40px; display:flex; align-items:center; justify-content:space-between; position:sticky; top:0; z-index:100; box-shadow:0 2px 12px rgba(0,0,0,.05); }
    .site-logo { font-family:'Raleway',sans-serif; font-size:24px; font-weight:700; color:#2d2d2d; text-decoration:none; }
    .site-logo span { color:var(--accent); }
    .btn-back { font-family:'Raleway',sans-serif; font-size:13px; font-weight:600; letter-spacing:.04em; text-transform:uppercase; border:2px solid var(--accent); color:var(--accent); background:none; padding:8px 22px; border-radius:4px; text-decoration:none; transition:.2s; }
    .btn-back:hover { background:var(--accent); color:#fff; }
    .hero-img { width:100%; height:420px; object-fit:cover; border-radius:12px; }
    .thumb-strip { display:flex; gap:10px; margin-top:12px; flex-wrap:wrap; }
    .thumb-strip img { width:90px; height:70px; object-fit:cover; border-radius:6px; cursor:pointer; border:2px solid transparent; transition:.2s; }
    .thumb-strip img:hover, .thumb-strip img.active { border-color:var(--accent); }
    .detail-card { background:#fff; border-radius:12px; padding:36px; box-shadow:0 4px 24px rgba(0,0,0,.07); }
    .detail-price { font-size:28px; font-weight:700; color:var(--accent); font-family:'Raleway',sans-serif; }
    .badge-statut { display:inline-block; padding:4px 14px; border-radius:20px; font-size:12px; font-weight:600; }
    .badge-statut.disponible { background:#d4edda; color:#155724; }
    .badge-statut.occupe { background:#f8d7da; color:#721c24; }
    .info-row { display:flex; align-items:center; gap:8px; color:#666; font-size:14px; margin-bottom:8px; }
    .info-row i { color:var(--accent); font-size:16px; }
    .form-label { font-weight:600; font-size:13px; color:#444; }
    .btn-reserver { background:var(--accent); color:#fff; border:none; padding:12px 36px; border-radius:6px; font-family:'Raleway',sans-serif; font-weight:700; font-size:15px; letter-spacing:.04em; text-transform:uppercase; transition:.25s; width:100%; }
    .btn-reserver:hover { background:#c96a28; color:#fff; }
    .section-title-sm { font-family:'Raleway',sans-serif; font-size:18px; font-weight:700; color:#2d2d2d; border-left:4px solid var(--accent); padding-left:12px; margin-bottom:18px; }
  </style>
</head>
<body>
<div class="topbar">
  <a class="site-logo" href="dashboard">Dakar<span>Stay</span></a>
  <a class="btn-back" href="dashboard"><i class="bi bi-arrow-left me-1"></i>Retour</a>
</div>

<div class="container py-5">
  <div class="row g-5">

    <!-- Colonne gauche : images -->
    <div class="col-lg-7">
      <img id="hero" src="<?= htmlspecialchars($images[0] ?? $defaultImg) ?>" class="hero-img" onerror="this.src='https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?auto=format&fit=crop&w=800&q=80'" alt="<?= htmlspecialchars($log['titre']) ?>">
      <?php if (count($images) > 1): ?>
      <div class="thumb-strip">
        <?php foreach ($images as $i => $img): ?>
          <img src="<?= htmlspecialchars($img) ?>" class="<?= $i === 0 ? 'active' : '' ?>"
               onclick="document.getElementById('hero').src=this.src; document.querySelectorAll('.thumb-strip img').forEach(t=>t.classList.remove('active')); this.classList.add('active')">
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </div>

    <!-- Colonne droite : détails + formulaire -->
    <div class="col-lg-5">
      <div class="detail-card">
        <h1 class="fw-bold mb-1" style="font-family:'Raleway',sans-serif;font-size:26px"><?= htmlspecialchars($log['titre']) ?></h1>
        <span class="badge-statut <?= $log['statut'] === 'disponible' ? 'disponible' : 'occupe' ?> mb-3 d-inline-block">
          <?= ucfirst(htmlspecialchars($log['statut'])) ?>
        </span>

        <div class="detail-price mb-3"><?= number_format($log['prix'], 0, ',', ' ') ?> FCFA <small style="font-size:14px;color:#888;font-weight:400">/ nuit</small></div>

        <div class="info-row"><i class="bi bi-geo-alt-fill"></i><?= htmlspecialchars($log['adresse']) ?></div>
        <div class="info-row"><i class="bi bi-person-fill"></i>Propriétaire : <?= htmlspecialchars($log['proprietaire']) ?></div>

        <?php if (!empty($log['description'])): ?>
        <p class="mt-3" style="font-size:14px;color:#555;line-height:1.7"><?= nl2br(htmlspecialchars($log['description'])) ?></p>
        <?php endif; ?>

        <hr class="my-4">

        <?php if ($log['statut'] === 'disponible'): ?>
        <div class="section-title-sm">Réserver ce logement</div>
        <form action="clientController?action=reserverLogement" method="POST">
          <input type="hidden" name="logement_id" value="<?= $log['id'] ?>">
          <div class="mb-3">
            <label class="form-label">Date d'arrivée</label>
            <input type="date" name="date_debut" class="form-control" min="<?= date('Y-m-d') ?>" required>
          </div>
          <div class="mb-4">
            <label class="form-label">Date de départ</label>
            <input type="date" name="date_fin" class="form-control" min="<?= date('Y-m-d', strtotime('+1 day')) ?>" required>
          </div>
          <button type="submit" class="btn-reserver"><i class="bi bi-calendar-check me-2"></i>Confirmer la réservation</button>
        </form>
        <?php else: ?>
        <div class="alert alert-warning text-center">Ce logement n'est pas disponible actuellement.</div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
<script>Swal.fire({ icon:'error', title:'Erreur', text:'<?= htmlspecialchars(urldecode($_GET['message'] ?? ''), ENT_QUOTES) ?>' });</script>
<?php endif; ?>
<?php if (isset($_GET['Success']) && $_GET['Success'] == 1): ?>
<script>Swal.fire({ icon:'success', title:'<?= htmlspecialchars(urldecode($_GET['title'] ?? ''), ENT_QUOTES) ?>', text:'<?= htmlspecialchars(urldecode($_GET['message'] ?? ''), ENT_QUOTES) ?>', timer:3000, timerProgressBar:true, showConfirmButton:false });</script>
<?php endif; ?>
</body>
</html>
