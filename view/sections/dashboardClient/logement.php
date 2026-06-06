<?php
require_once("model/LogementDB.php");
require_once("model/DemandeProprietaireDB.php");
$logementDB = new LogementDB();
$logements  = $logementDB->getAllLogementsWithImage();
$defaultImg = "https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?auto=format&fit=crop&w=800&q=80";

// Statut demande propriétaire
$demandeDB      = new DemandeProprietaireDB();
$demandeExist   = $demandeDB->getDemandeByUser($_SESSION['id']);
$roleUser       = $_SESSION['role'] ?? 'client';
?>
<section id="panel-logements" class="panel active portfolio section">

  <div class="container section-title">
    <h2>Logements</h2>
    <div><span>Découvrez nos</span> <span class="description-title">Logements</span></div>
  </div>

  <div class="container">
    <?php if (empty($logements)): ?>
      <div class="text-center py-5 text-muted">
        <i class="bi bi-house-slash" style="font-size:48px;opacity:.3"></i>
        <p class="mt-3">Aucun logement disponible pour le moment.</p>
      </div>
    <?php else: ?>
    <div class="row gy-4" id="logements-grid">
      <?php foreach ($logements as $log):
        $img = !empty($log['image']) ? htmlspecialchars($log['image']) : $defaultImg;
      ?>
      <div class="col-lg-4 col-md-6 portfolio-item">
        <div class="portfolio-content h-100">
          <a href="logementDetail?id=<?= $log['id'] ?>">
            <img src="<?= $img ?>" class="img-fluid logement-img" onerror="this.src='https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?auto=format&fit=crop&w=800&q=80'" alt="<?= htmlspecialchars($log['titre']) ?>">
          </a>
          <div class="portfolio-info">
            <h4><a href="logementDetail?id=<?= $log['id'] ?>"><?= htmlspecialchars($log['titre']) ?></a></h4>
            <p>
              <i class="bi bi-geo-alt-fill text-warning me-1"></i><?= htmlspecialchars($log['adresse']) ?>
              &nbsp;·&nbsp; <strong><?= number_format($log['prix'], 0, ',', ' ') ?> FCFA</strong> / nuit
            </p>
            <div class="d-flex align-items-center justify-content-between mt-2">
              <span class="badge-statut-sm <?= $log['statut'] === 'disponible' ? 'dispo' : 'occupe' ?>">
                <?= ucfirst(htmlspecialchars($log['statut'])) ?>
              </span>
              <a href="logementDetail?id=<?= $log['id'] ?>" class="btn-voir">Voir détails <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </div>

  <!-- ═══════════════════════════════════════════════════
       BOUTON DEVENEZ PROPRIÉTAIRE
  ═══════════════════════════════════════════════════ -->
  <div class="container text-center mt-5 mb-2">

    <?php if ($roleUser === 'proprietaire' || $roleUser === 'admin'): ?>
      <div class="proprietaire-badge">
        <i class="bi bi-patch-check-fill"></i> Vous êtes déjà propriétaire
      </div>

    <?php elseif ($demandeExist && $demandeExist['statut'] === 'en_attente'): ?>
      <div class="demande-pending">
        <i class="bi bi-hourglass-split"></i>
        <strong>Demande en cours d'examen</strong>
        <p>Votre demande pour devenir propriétaire a été envoyée le <strong><?= htmlspecialchars($demandeExist['date']) ?></strong>. L'équipe vous répondra bientôt.</p>
      </div>

    <?php elseif ($demandeExist && $demandeExist['statut'] === 'refusee'): ?>
      <div class="demande-refused">
        <i class="bi bi-x-circle-fill"></i>
        <strong>Demande refusée</strong>
        <p>Votre précédente demande a été refusée. Vous pouvez en soumettre une nouvelle.</p>
      </div>
      <button class="btn-proprietaire" data-bs-toggle="modal" data-bs-target="#modalDemandeProprietaire">
        <i class="bi bi-house-add me-2"></i>Soumettre une nouvelle demande
      </button>

    <?php else: ?>
      <p class="proprietaire-subtitle">Vous avez un bien à louer ? Rejoignez notre réseau de propriétaires et commencez à générer des revenus.</p>
      <button class="btn-proprietaire" data-bs-toggle="modal" data-bs-target="#modalDemandeProprietaire">
        <i class="bi bi-house-add me-2"></i>Devenez Propriétaire
      </button>
    <?php endif; ?>
  </div>

  <!-- MODAL DEMANDE SIMPLE -->
  <div class="modal fade" id="modalDemandeProprietaire" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content" style="border-radius:12px;overflow:hidden;border:none;">

        <div style="background:#e07b39;padding:20px 24px;display:flex;align-items:center;justify-content:space-between;">
          <h5 style="color:#fff;margin:0;font-family:'Raleway',sans-serif;font-weight:700;font-size:18px;">
            <i class="bi bi-house-add me-2"></i>Devenez Propriétaire
          </h5>
          <button type="button" data-bs-dismiss="modal"
                  style="background:rgba(255,255,255,.2);border:none;color:#fff;width:30px;height:30px;border-radius:50%;cursor:pointer;font-size:16px;display:flex;align-items:center;justify-content:center;">
            <i class="bi bi-x-lg"></i>
          </button>
        </div>

        <form action="demandeClientController" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="action" value="soumettre">
          <div style="padding:24px;">

            <div class="mb-3">
              <label style="font-weight:600;font-size:13px;color:#444;display:block;margin-bottom:6px;">
                Description du bien <span class="text-danger">*</span>
              </label>
              <textarea name="description" class="form-control" rows="4" required
                style="border-radius:8px;font-size:14px;"
                placeholder="Ex: J'ai un appartement à Dakar Plateau, 3 pièces, que je souhaite louer..."></textarea>
            </div>

            <div class="mb-3">
              <label style="font-weight:600;font-size:13px;color:#444;display:block;margin-bottom:6px;">
                Photo du bien (preuve) <span class="text-danger">*</span>
              </label>
              <input type="file" name="preuve" accept="image/*" required
                class="form-control" style="border-radius:8px;font-size:14px;">
              <small class="text-muted">JPG, PNG ou WEBP — max 5MB</small>
            </div>

          </div>

          <div style="padding:16px 24px 20px;border-top:1px solid #f0f0f0;display:flex;justify-content:flex-end;gap:10px;">
            <button type="button" data-bs-dismiss="modal"
                    style="background:none;border:1.5px solid #ddd;color:#888;padding:9px 22px;border-radius:7px;font-weight:600;cursor:pointer;">
              Annuler
            </button>
            <button type="submit"
                    style="background:#e07b39;color:#fff;border:none;padding:10px 28px;border-radius:7px;font-family:'Raleway',sans-serif;font-weight:700;cursor:pointer;display:inline-flex;align-items:center;gap:8px;">
              <i class="bi bi-send"></i> Envoyer
            </button>
          </div>
        </form>

      </div>
    </div>
  </div>

  <!-- STYLES spécifiques -->
  <style>
    .btn-proprietaire {
      background: linear-gradient(135deg, #e07b39, #c96a28);
      color: #fff; border: none; padding: 16px 44px;
      border-radius: 50px; font-family: 'Raleway', sans-serif;
      font-weight: 700; font-size: 16px; letter-spacing: .05em;
      text-transform: uppercase; cursor: pointer;
      box-shadow: 0 8px 30px rgba(224,123,57,.35);
      transition: all .3s; display: inline-flex; align-items: center; gap: 8px;
    }
    .btn-proprietaire:hover { transform: translateY(-3px); box-shadow: 0 12px 40px rgba(224,123,57,.5); }
    .proprietaire-subtitle { color: #666; font-size: 15px; margin-bottom: 20px; max-width: 520px; margin-inline: auto; }
    .proprietaire-badge { display:inline-flex; align-items:center; gap:10px; background:#d4edda; color:#155724; padding:14px 28px; border-radius:50px; font-weight:600; font-size:15px; }
    .proprietaire-badge i { font-size:22px; }
    .demande-pending { background: #fff3cd; border:2px solid #ffc107; border-radius:12px; padding:20px 30px; display:inline-block; text-align:left; max-width:480px; }
    .demande-pending i { color:#ffc107; font-size:24px; margin-right:8px; }
    .demande-pending p { margin:6px 0 0; color:#666; font-size:14px; }
    .demande-refused { background:#f8d7da; border:2px solid #f5c6cb; border-radius:12px; padding:16px 24px; display:inline-block; max-width:480px; margin-bottom:16px; }
    .demande-refused i { color:#dc3545; font-size:20px; margin-right:8px; }

    /* Modal */
    .modal-demande { border-radius:16px; overflow:hidden; border:none; }
    .modal-demande-header { background:linear-gradient(135deg,#e07b39,#c96a28); color:#fff; padding:36px 40px 28px; text-align:center; position:relative; }
    .modal-demande-icon { width:64px; height:64px; background:rgba(255,255,255,.2); border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 16px; font-size:30px; }
    .modal-demande-header h3 { font-family:'Raleway',sans-serif; font-size:26px; font-weight:700; margin:0 0 6px; }
    .modal-demande-header p { opacity:.85; font-size:14px; margin:0; }
    .modal-close-btn { position:absolute; top:16px; right:20px; background:rgba(255,255,255,.2); border:none; color:#fff; width:34px; height:34px; border-radius:50%; font-size:14px; cursor:pointer; display:flex; align-items:center; justify-content:center; transition:.2s; }
    .modal-close-btn:hover { background:rgba(255,255,255,.35); }
    .modal-demande-body { padding:32px 40px 16px; background:#fff; }
    .modal-demande-footer { padding:20px 40px 28px; background:#fff; display:flex; justify-content:flex-end; gap:12px; border-top:1px solid #f0f0f0; }

    /* Steps */
    .steps-bar { display:flex; align-items:center; justify-content:center; gap:0; margin-bottom:28px; font-size:12px; font-weight:600; }
    .step { display:flex; align-items:center; gap:6px; color:#bbb; white-space:nowrap; }
    .step.active { color:#e07b39; }
    .step span { width:24px; height:24px; border-radius:50%; border:2px solid currentColor; display:flex; align-items:center; justify-content:center; font-size:11px; }
    .step-line { width:30px; height:2px; background:#eee; margin:0 6px; }

    /* Info box */
    .info-box { display:flex; align-items:center; gap:14px; background:#f8f8f8; border-radius:10px; padding:14px 18px; font-size:14px; }
    .info-box i { font-size:32px; color:#e07b39; flex-shrink:0; }

    /* Avantages */
    .avantages-grid { display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-top:20px; }
    .avantage-item { display:flex; align-items:center; gap:10px; background:#fff8f3; border-radius:8px; padding:12px 16px; font-size:13px; font-weight:500; color:#555; }
    .avantage-item i { color:#e07b39; font-size:20px; flex-shrink:0; }

    /* Boutons footer modal */
    .btn-annuler { background:none; border:2px solid #ddd; color:#888; padding:10px 26px; border-radius:8px; font-weight:600; cursor:pointer; transition:.2s; }
    .btn-annuler:hover { border-color:#aaa; color:#555; }
    .btn-soumettre { background:linear-gradient(135deg,#e07b39,#c96a28); color:#fff; border:none; padding:12px 32px; border-radius:8px; font-family:'Raleway',sans-serif; font-weight:700; font-size:15px; cursor:pointer; transition:.3s; display:inline-flex; align-items:center; }
    .btn-soumettre:hover { transform:translateY(-2px); box-shadow:0 6px 20px rgba(224,123,57,.4); }
  </style>

</section>
