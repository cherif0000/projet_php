<?php
session_start();
if (!isset($_SESSION['id'])) { header("Location: login"); exit; }
require_once("../../../../model/DemandeProprietaireDB.php");
$demandeDB = new DemandeProprietaireDB();
$demandes  = $demandeDB->getAllDemandes();
?>
<!DOCTYPE html>
<html lang="fr">
<body>
	<?php require_once("../../../sections/admin/head.php"); ?>
	<div id="page-loader" class="fade show"><span class="spinner"></span></div>
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<?php require_once("../../../sections/admin/menuHaut.php"); ?>
		<?php require_once("../../../sections/admin/menuGauche.php"); ?>

		<div id="content" class="content">
			<h1 class="page-header">Demandes propriétaire</h1>
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<h4 class="panel-title">Liste des demandes</h4>
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
				</div>
				<div class="panel-body">
					<table id="data-table-default" class="table table-striped table-bordered table-td-valign-middle">
						<thead>
							<tr>
								<th width="1%">#</th>
								<th>ID</th>
								<th>Nom</th>
								<th>Email</th>
								<th>Description</th>
								<th>Preuve</th>
								<th>Statut</th>
								<th>Date</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php if (empty($demandes)): ?>
								<tr><td colspan="8" class="text-center text-muted">Aucune demande.</td></tr>
							<?php else: ?>
								<?php foreach ($demandes as $i => $d): ?>
									<?php
										switch ($d['statut']) {
											case 'acceptee':   $bc = 'badge-success'; $lb = 'Approuvée';  break;
											case 'refusee':    $bc = 'badge-danger';  $lb = 'Refusée';    break;
											default:           $bc = 'badge-warning'; $lb = 'En attente';
										}
									?>
									<tr>
										<td class="f-w-600 text-inverse"><?= $i + 1 ?></td>
										<td><?= $d['id'] ?></td>
										<td><?= htmlspecialchars($d['nom']) ?></td>
										<td><?= htmlspecialchars($d['email']) ?></td>
										<td><?= htmlspecialchars($d['description']) ?></td>
										<td>
											<?php if (!empty($d['preuve'])): ?>
												<img src="<?= htmlspecialchars($d['preuve']) ?>"
												     style="width:60px;height:45px;object-fit:cover;border-radius:4px;cursor:pointer;border:2px solid #5ac8fa;"
												     title="Cliquer pour agrandir"
												     onclick="ouvrirPreuve('<?= htmlspecialchars($d['preuve'], ENT_QUOTES) ?>')">
											<?php else: ?>
												<span class="text-muted" style="font-size:12px;">Aucune</span>
											<?php endif; ?>
										</td>
										<td><span class="badge <?= $bc ?>"><?= $lb ?></span></td>
										<td><?= htmlspecialchars($d['date']) ?></td>
										<td>
											<?php if ($d['statut'] !== 'acceptee'): ?>
											<a href="demandeController?action=approuver&id=<?= $d['id'] ?>"
											   class="btn btn-xs btn-success mr-1"
											   onclick="return confirm('Approuver cette demande ?')">
												<i class="fa fa-check"></i> Approuver
											</a>
											<?php endif; ?>
											<?php if ($d['statut'] !== 'refusee'): ?>
											<a href="demandeController?action=refuser&id=<?= $d['id'] ?>"
											   class="btn btn-xs btn-danger"
											   onclick="return confirm('Refuser cette demande ?')">
												<i class="fa fa-times"></i> Refuser
											</a>
											<?php endif; ?>
										</td>
									</tr>
								<?php endforeach; ?>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<?php require_once("../../../sections/admin/config.php"); ?>
		<?php require_once("../../../sections/admin/scroll.php"); ?>
	</div>

	<?php require_once("../../../sections/admin/script.php"); ?>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<?php if (isset($_GET['error']) && isset($_GET['message'])): ?>
		<script>Swal.fire({icon:'error',title:'<?= htmlspecialchars(urldecode($_GET['title']??''), ENT_QUOTES) ?>',text:'<?= htmlspecialchars(urldecode($_GET['message']), ENT_QUOTES) ?>'});</script>
	<?php endif; ?>
	<?php if (isset($_GET['Success']) && isset($_GET['message'])): ?>
		<script>Swal.fire({icon:'success',title:'<?= htmlspecialchars(urldecode($_GET['title']??''), ENT_QUOTES) ?>',text:'<?= htmlspecialchars(urldecode($_GET['message']), ENT_QUOTES) ?>',timer:1500,timerProgressBar:true,showConfirmButton:false});</script>
	<?php endif; ?>

	<!-- Modal Lightbox Preuve -->
	<div id="modalPreuve" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.85);z-index:9999;align-items:center;justify-content:center;" onclick="fermerPreuve()">
		<div style="position:relative;max-width:90%;max-height:90%;" onclick="event.stopPropagation()">
			<img id="imgPreuve" src="" style="max-width:100%;max-height:85vh;border-radius:8px;box-shadow:0 0 30px rgba(0,0,0,0.8);">
			<button onclick="fermerPreuve()" style="position:absolute;top:-15px;right:-15px;background:#e74c3c;color:#fff;border:none;border-radius:50%;width:36px;height:36px;font-size:20px;cursor:pointer;line-height:1;">&times;</button>
			<a id="lienPreuve" href="" target="_blank" style="display:block;text-align:center;margin-top:10px;color:#fff;font-size:13px;text-decoration:underline;">Ouvrir en plein écran</a>
		</div>
	</div>

	<script>
	function ouvrirPreuve(src) {
		document.getElementById('imgPreuve').src = src;
		document.getElementById('lienPreuve').href = src;
		var modal = document.getElementById('modalPreuve');
		modal.style.display = 'flex';
	}
	function fermerPreuve() {
		document.getElementById('modalPreuve').style.display = 'none';
		document.getElementById('imgPreuve').src = '';
	}
	document.addEventListener('keydown', function(e) {
		if (e.key === 'Escape') fermerPreuve();
	});
	</script>
</body>
</html>
