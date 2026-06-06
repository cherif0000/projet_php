<?php
session_start();
if (!isset($_SESSION['id'])) { header("Location: login"); exit; }

require_once("../../../model/ExcursionDB.php");
$db  = new ExcursionDB();
$id  = (int)($_GET['id'] ?? 0);
$exc = $id ? $db->getExcursionById($id) : null;
if (!$exc) { header("Location: dashboard"); exit; }
$defaultImg = "https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=800&h=500&fit=crop&q=80";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title><?= htmlspecialchars($exc['nom']) ?> — DakarStay</title>
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
    .detail-card { background:#fff; border-radius:12px; padding:36px; box-shadow:0 4px 24px rgba(0,0,0,.07); }
    .detail-price { font-size:28px; font-weight:700; color:var(--accent); font-family:'Raleway',sans-serif; }
    .info-row { display:flex; align-items:center; gap:8px; color:#666; font-size:14px; margin-bottom:8px; }
    .info-row i { color:var(--accent); font-size:16px; }
    .form-label { font-weight:600; font-size:13px; color:#444; }
    .btn-reserver { background:var(--accent); color:#fff; border:none; padding:12px 36px; border-radius:6px; font-family:'Raleway',sans-serif; font-weight:700; font-size:15px; letter-spacing:.04em; text-transform:uppercase; transition:.25s; width:100%; }
    .btn-reserver:hover { background:#c96a28; color:#fff; }
    .section-title-sm { font-family:'Raleway',sans-serif; font-size:18px; font-weight:700; color:#2d2d2d; border-left:4px solid var(--accent); padding-left:12px; margin-bottom:18px; }
    .total-box { background:#fff3ec; border:2px solid var(--accent); border-radius:8px; padding:14px 20px; text-align:center; margin-bottom:20px; }
    .total-box .total-label { font-size:12px; color:#888; font-weight:600; text-transform:uppercase; }
    .total-box .total-amount { font-size:24px; font-weight:700; color:var(--accent); font-family:'Raleway',sans-serif; }
  </style>
</head>
<body>
<div class="topbar">
  <a class="site-logo" href="dashboard">Dakar<span>Stay</span></a>
  <a class="btn-back" href="dashboard"><i class="bi bi-arrow-left me-1"></i>Retour</a>
</div>

<div class="container py-5">
  <div class="row g-5">

    <!-- Colonne gauche : image + infos -->
    <div class="col-lg-7">
      <img src="<?= htmlspecialchars($exc['image'] ?? $defaultImg) ?>" class="hero-img" onerror="this.src='https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=600&h=400&fit=crop&q=80'" alt="<?= htmlspecialchars($exc['nom']) ?>">

      <div class="mt-4">
        <h1 class="fw-bold" style="font-family:'Raleway',sans-serif;font-size:28px"><?= htmlspecialchars($exc['nom']) ?></h1>
        <div class="info-row mt-2"><i class="bi bi-geo-alt-fill"></i><?= htmlspecialchars($exc['adresse']) ?></div>
        <div class="info-row"><i class="bi bi-calendar-event"></i>Date : <?= htmlspecialchars($exc['date']) ?></div>

        <?php if (!empty($exc['description'])): ?>
        <div class="mt-4">
          <div class="section-title-sm">À propos de cette excursion</div>
          <p style="font-size:14.5px;color:#555;line-height:1.8"><?= nl2br(htmlspecialchars($exc['description'])) ?></p>
        </div>
        <?php endif; ?>
      </div>
    </div>

    <!-- Colonne droite : prix + formulaire -->
    <div class="col-lg-5">
      <div class="detail-card">
        <div class="detail-price mb-1"><?= number_format($exc['prix'], 0, ',', ' ') ?> FCFA <small style="font-size:14px;color:#888;font-weight:400">/ personne</small></div>
        <hr class="my-4">

        <div class="section-title-sm">Réserver cette excursion</div>
        <form action="clientController?action=reserverExcursion" method="POST" id="formExc">
          <input type="hidden" name="excursion_id" value="<?= $exc['id'] ?>">
          <input type="hidden" name="prix_unitaire" value="<?= $exc['prix'] ?>">

          <div class="mb-3">
            <label class="form-label">Date souhaitée</label>
            <input type="date" name="date_reservation" class="form-control" min="<?= date('Y-m-d') ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Nombre de personnes</label>
            <input type="number" name="nombre_personne" id="nbPersonnes" class="form-control" min="1" max="20" value="1"
                   oninput="updateTotal(this.value)" required>
          </div>

          <div class="total-box mb-4">
            <div class="total-label">Total estimé</div>
            <div class="total-amount" id="totalPrice"><?= number_format($exc['prix'], 0, ',', ' ') ?> FCFA</div>
          </div>

          <button type="submit" class="btn-reserver"><i class="bi bi-compass me-2"></i>Réserver l'excursion</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
const prixUnit = <?= (float)$exc['prix'] ?>;
function updateTotal(n) {
  const total = (parseInt(n) || 1) * prixUnit;
  document.getElementById('totalPrice').textContent = total.toLocaleString('fr-FR') + ' FCFA';
}
</script>

<?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
<script>Swal.fire({ icon:'error', title:'Erreur', text:'<?= htmlspecialchars(urldecode($_GET['message'] ?? ''), ENT_QUOTES) ?>' });</script>
<?php endif; ?>
<?php if (isset($_GET['Success']) && $_GET['Success'] == 1): ?>
<script>Swal.fire({ icon:'success', title:'<?= htmlspecialchars(urldecode($_GET['title'] ?? ''), ENT_QUOTES) ?>', text:'<?= htmlspecialchars(urldecode($_GET['message'] ?? ''), ENT_QUOTES) ?>', timer:3000, timerProgressBar:true, showConfirmButton:false });</script>
<?php endif; ?>
</body>
</html>
