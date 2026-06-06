<?php
session_start();
if (!isset($_SESSION['id'])) { header("Location: login"); exit; }
require_once("../../../../model/ExcursionDB.php");
$excursionDB   = new ExcursionDB();
$excursions    = $excursionDB->getAllExcursions();
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
			<ol class="breadcrumb float-xl-right">
				<li class="breadcrumb-item">
					<a href="#modal-add-excursion" class="btn btn-sm btn-success text-white" data-toggle="modal">
						<i class="fa fa-plus mr-1"></i> Ajouter une excursion
					</a>
				</li>
			</ol>
			<h1 class="page-header">Liste des excursions</h1>

			<div class="panel panel-inverse">
				<div class="panel-heading">
					<h4 class="panel-title">Toutes les excursions</h4>
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
								<th>Adresse</th>
								<th>Date</th>
								<th>Prix</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php if (empty($excursions)): ?>
								<tr><td colspan="7" class="text-center text-muted">Aucune excursion.</td></tr>
							<?php else: ?>
								<?php foreach ($excursions as $i => $e): ?>
									<tr>
										<td class="f-w-600 text-inverse"><?= $i + 1 ?></td>
										<td><?= $e['id'] ?></td>
										<td><?= htmlspecialchars($e['nom']) ?></td>
										<td><?= htmlspecialchars($e['adresse']) ?></td>
										<td><?= htmlspecialchars($e['date']) ?></td>
										<td><?= number_format($e['prix'], 0, ',', ' ') ?> FCFA</td>
										<td>
											<a href="#modal-delete-exc-<?= $e['id'] ?>"
											   class="btn btn-xs btn-danger" data-toggle="modal">
												<i class="fa fa-trash"></i>
											</a>
										</td>
									</tr>
									<!-- MODAL SUPPRIMER -->
									<div class="modal fade" id="modal-delete-exc-<?= $e['id'] ?>">
										<div class="modal-dialog modal-sm">
											<div class="modal-content">
												<div class="modal-header bg-danger text-white">
													<h4 class="modal-title"><i class="fa fa-times mr-2"></i>Supprimer</h4>
													<button type="button" class="close text-white" data-dismiss="modal">×</button>
												</div>
												<div class="modal-body">
													<p>Supprimer <strong><?= htmlspecialchars($e['nom']) ?></strong> ?</p>
												</div>
												<div class="modal-footer">
													<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Non</a>
													<a href="excursionController?action=supprimer&id=<?= $e['id'] ?>" class="btn btn-danger">Oui</a>
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

	<!-- MODAL AJOUTER -->
	<div class="modal fade" id="modal-add-excursion">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><i class="fa fa-map-marked-alt mr-2"></i>Ajouter une excursion</h4>
					<button type="button" class="close" data-dismiss="modal">×</button>
				</div>
				<form action="excursionController" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="action" value="ajouter">
					<div class="modal-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Nom <span class="text-danger">*</span></label>
									<input type="text" name="nom" class="form-control" placeholder="Ex: Lac Rose" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Prix (FCFA) <span class="text-danger">*</span></label>
									<input type="number" name="prix" class="form-control" placeholder="25000" min="1" required>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Adresse / Lieu <span class="text-danger">*</span></label>
							<input type="text" name="adresse" class="form-control" placeholder="Lieu de départ ou destination" required>
						</div>
						<div class="form-group">
							<label>Description <span class="text-danger">*</span></label>
							<textarea name="description" class="form-control" rows="3" required></textarea>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Date et heure <span class="text-danger">*</span></label>
									<input type="datetime-local" name="date" class="form-control" required>
								</div>
							</div>

						</div>
						<div class="form-group">
							<label>Image <small class="text-muted">(optionnel)</small></label>
							<input type="file" name="image" class="form-control" accept="image/jpeg,image/png,image/webp">
						</div>
					</div>
					<div class="modal-footer">
						<a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Annuler</a>
						<button type="submit" class="btn btn-success"><i class="fa fa-check mr-1"></i>Enregistrer</button>
					</div>
				</form>
			</div>
		</div>
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
