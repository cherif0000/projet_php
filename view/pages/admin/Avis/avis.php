<?php
session_start();
if (!isset($_SESSION['id'])) { header("Location: login"); exit; }
require_once("../../../../model/AvisDB.php");
$avisDB = new AvisDB();
$avis   = $avisDB->getAllAvis();
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
			<h1 class="page-header">Avis clients <small>modération des commentaires</small></h1>
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<h4 class="panel-title">Liste des avis</h4>
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
								<th>Client</th>
								<th>Logement</th>
								<th>Commentaire</th>
								<th>Note</th>
								<th>Date</th>
								<th width="8%">Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php if (empty($avis)): ?>
								<tr><td colspan="7" class="text-center text-muted">Aucun avis.</td></tr>
							<?php else: ?>
								<?php foreach ($avis as $i => $a): ?>
									<tr>
										<td class="f-w-600 text-inverse"><?= $i + 1 ?></td>
										<td><?= htmlspecialchars($a['client']) ?></td>
										<td><?= htmlspecialchars($a['logement']) ?></td>
										<td><?= htmlspecialchars($a['commentaire']) ?></td>
										<td>
											<span class="text-warning">
												<?php for ($s = 1; $s <= 5; $s++): ?>
													<i class="<?= $s <= $a['note'] ? 'fa' : 'far' ?> fa-star"></i>
												<?php endfor; ?>
											</span>
											<small><?= $a['note'] ?>/5</small>
										</td>
										<td><?= htmlspecialchars($a['date']) ?></td>
										<td>
											<a href="#modal-delete-avis-<?= $a['id'] ?>"
											   class="btn btn-xs btn-danger" data-toggle="modal" title="Supprimer">
												<i class="fa fa-trash"></i>
											</a>
										</td>
									</tr>

									<!-- MODAL SUPPRIMER AVIS -->
									<div class="modal fade" id="modal-delete-avis-<?= $a['id'] ?>">
										<div class="modal-dialog modal-sm">
											<div class="modal-content">
												<div class="modal-header bg-danger text-white">
													<h4 class="modal-title"><i class="fa fa-times mr-2"></i>Supprimer l'avis</h4>
													<button type="button" class="close text-white" data-dismiss="modal">×</button>
												</div>
												<div class="modal-body">
													<p>Supprimer l'avis de <strong><?= htmlspecialchars($a['client']) ?></strong> ?</p>
												</div>
												<div class="modal-footer">
													<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Non</a>
													<a href="avisController?action=supprimer&id=<?= $a['id'] ?>" class="btn btn-danger">Oui</a>
												</div>
											</div>
										</div>
									</div>
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
</body>
</html>
