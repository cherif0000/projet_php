<?php
session_start();
if (!isset($_SESSION['id'])) { header("Location: login"); exit; }
require_once("../../../../model/LogementDB.php");
require_once("../../../../model/UserDB.php");
 
$logementDB   = new LogementDB();
$userDB       = new UserDB();
 
// Chargement selon le rôle
if ($_SESSION['role'] === 'proprietaire') {
    $logements = $logementDB->getLogementsByProprietaire($_SESSION['id']);
} else {
    $logements = $logementDB->getAllLogements();
}
 
$proprietaires = $userDB->getProprietaires();
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
					<a href="#modal-add-logement" class="btn btn-sm btn-success text-white" data-toggle="modal">
						<i class="fa fa-plus mr-1"></i> Ajouter un logement
					</a>
				</li>
			</ol>
 
			<h1 class="page-header">Liste des logements</h1>
 
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<h4 class="panel-title">
						<?= $_SESSION['role'] === 'proprietaire' ? 'Mes logements' : 'Tous les logements' ?>
					</h4>
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
								<th>Titre</th>
								<th>Adresse</th>
								<th>Prix / nuit</th>
								<th>Statut</th>
								<th>Propriétaire</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php if (empty($logements)): ?>
								<tr>
									<td colspan="8" class="text-center text-muted">Aucun logement trouvé.</td>
								</tr>
							<?php else: ?>
								<?php foreach ($logements as $index => $logement): ?>
									<?php
										switch ($logement['statut']) {
											case 'disponible':  $badgeClass = 'badge-success'; $label = 'Disponible';   break;
											case 'reserve':     $badgeClass = 'badge-warning'; $label = 'Réservé';       break;
											default:            $badgeClass = 'badge-danger';  $label = 'Indisponible';
										}
										$prix = number_format($logement['prix'], 0, ',', ' ') . ' FCFA';
									?>
									<tr>
										<td class="f-w-600 text-inverse"><?= $index + 1 ?></td>
										<td><?= htmlspecialchars($logement['id']) ?></td>
										<td><?= htmlspecialchars($logement['titre']) ?></td>
										<td><?= htmlspecialchars($logement['adresse']) ?></td>
										<td><?= $prix ?></td>
										<td><span class="badge <?= $badgeClass ?>"><?= $label ?></span></td>
										<td><?= htmlspecialchars($logement['proprietaire']) ?></td>
										<td class="d-flex gap-1">
											<a href="#modal-edit-logement-<?= $logement['id'] ?>"
											   class="btn btn-xs btn-warning" data-toggle="modal" title="Modifier">
												<i class="fa fa-edit"></i>
											</a>
											<?php if ($_SESSION['role'] !== 'proprietaire'): ?>
											<a href="#modal-delete-logement-<?= $logement['id'] ?>"
											   class="btn btn-xs btn-danger" data-toggle="modal" title="Supprimer">
												<i class="fa fa-trash"></i>
											</a>
											<?php endif; ?>
										</td>
									</tr>
 
 
									<!-- MODAL MODIFIER -->
									<div class="modal fade" id="modal-edit-logement-<?= $logement['id'] ?>">
										<div class="modal-dialog modal-lg">
											<div class="modal-content">
												<div class="modal-header bg-warning">
													<h4 class="modal-title"><i class="fa fa-edit mr-2"></i>Modifier le logement</h4>
													<button type="button" class="close" data-dismiss="modal">×</button>
												</div>
												<form action="logementController" method="POST">
													<div class="modal-body">
														<input type="hidden" name="action" value="modifier">
														<input type="hidden" name="id" value="<?= $logement['id'] ?>">
														<div class="row">
															<div class="col-md-6 form-group mb-3">
																<label class="fw-bold">Titre <span class="text-danger">*</span></label>
																<input type="text" name="titre" class="form-control"
																       value="<?= htmlspecialchars($logement['titre']) ?>" required>
															</div>
															<div class="col-md-6 form-group mb-3">
																<label class="fw-bold">Adresse <span class="text-danger">*</span></label>
																<input type="text" name="adresse" class="form-control"
																       value="<?= htmlspecialchars($logement['adresse']) ?>" required>
															</div>
															<div class="col-md-6 form-group mb-3">
																<label class="fw-bold">Prix (FCFA) <span class="text-danger">*</span></label>
																<input type="number" name="prix" class="form-control" min="0"
																       value="<?= $logement['prix'] ?>" required>
															</div>
															<div class="col-md-6 form-group mb-3">
																<label class="fw-bold">Statut</label>
																<select name="statut" class="form-control">
																	<option value="disponible"  <?= $logement['statut']==='disponible'  ? 'selected':'' ?>>Disponible</option>
																	<option value="reserve"     <?= $logement['statut']==='reserve'     ? 'selected':'' ?>>Réservé</option>
																	<option value="indisponible"<?= $logement['statut']==='indisponible' ? 'selected':'' ?>>Indisponible</option>
																</select>
															</div>
															<div class="col-12 form-group mb-3">
																<label class="fw-bold">Description</label>
																<textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($logement['description']) ?></textarea>
															</div>
														</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-white" data-dismiss="modal">Annuler</button>
														<button type="submit" class="btn btn-warning"><i class="fa fa-save mr-1"></i>Enregistrer</button>
													</div>
												</form>
											</div>
										</div>
									</div>
 
									<?php if ($_SESSION['role'] !== 'proprietaire'): ?>
									<!-- MODAL SUPPRIMER -->
									<div class="modal fade" id="modal-delete-logement-<?= $logement['id'] ?>">
										<div class="modal-dialog modal-sm">
											<div class="modal-content">
												<div class="modal-header bg-danger text-white">
													<h4 class="modal-title"><i class="fa fa-times mr-2"></i>Supprimer le logement</h4>
													<button type="button" class="close text-white" data-dismiss="modal">×</button>
												</div>
												<div class="modal-body">
													<p>Confirmer la suppression de <strong><?= htmlspecialchars($logement['titre']) ?></strong> ?</p>
												</div>
												<div class="modal-footer">
													<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Non</a>
													<a href="logementController?action=supprimer&id=<?= $logement['id'] ?>"
													   class="btn btn-danger">Oui, supprimer</a>
												</div>
											</div>
										</div>
									</div>
									<?php endif; ?>
 
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
 
	<!-- MODAL — Ajouter un logement (visible par tous) -->
	<div class="modal fade" id="modal-add-logement">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><i class="fa fa-home mr-2"></i>Ajouter un logement</h4>
					<button type="button" class="close" data-dismiss="modal">×</button>
				</div>
				<form id="form-add-logement"
				      action="logementController"
				      method="POST"
				      enctype="multipart/form-data">
					<input type="hidden" name="action" value="ajouter">
 
					<?php if (($_SESSION['role'] ?? '') === 'proprietaire'): ?>
						<!-- Propriétaire : user_id = son propre ID automatiquement -->
						<input type="hidden" name="user_id" value="<?= $_SESSION['id'] ?>">
					<?php endif; ?>
 
					<div class="modal-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Titre <span class="text-danger">*</span></label>
									<input type="text" name="titre" class="form-control"
									       placeholder="Ex: Appartement Plateau" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Prix / nuit (FCFA) <span class="text-danger">*</span></label>
									<input type="number" name="prix" class="form-control"
									       placeholder="75000" min="1" required>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Adresse <span class="text-danger">*</span></label>
							<input type="text" name="adresse" class="form-control"
							       placeholder="Rue, Quartier, Dakar" required>
						</div>
						<div class="form-group">
							<label>Description <span class="text-danger">*</span></label>
							<textarea name="description" class="form-control" rows="3"
							          placeholder="Description du logement..." required></textarea>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Statut</label>
									<select name="statut" class="form-control">
										<option value="disponible">Disponible</option>
										<option value="reserve">Réservé</option>
										<option value="indisponible">Indisponible</option>
									</select>
								</div>
							</div>
							<?php if (($_SESSION['role'] ?? '') !== 'proprietaire'): ?>
							<div class="col-md-6">
								<div class="form-group">
									<label>Propriétaire <span class="text-danger">*</span></label>
									<select name="user_id" class="form-control" required>
										<option value="">-- Sélectionner un propriétaire --</option>
										<?php foreach ($proprietaires as $p): ?>
											<option value="<?= $p['id'] ?>">
												<?= htmlspecialchars($p['nom']) ?>
											</option>
										<?php endforeach; ?>
										<?php if (empty($proprietaires)): ?>
											<option disabled>Aucun propriétaire enregistré</option>
										<?php endif; ?>
									</select>
								</div>
							</div>
							<?php endif; ?>
						</div>
						<div class="form-group">
							<label>Images <small class="text-muted">(optionnel, plusieurs fichiers acceptés)</small></label>
							<input type="file" name="images[]" class="form-control"
							       multiple accept="image/jpeg,image/png,image/webp,image/gif">
						</div>
					</div>
					<div class="modal-footer">
						<a href="javascript:;" class="btn btn-white" data-dismiss="modal">
							<i class="fa fa-times mr-1"></i>Annuler
						</a>
						<button type="submit" class="btn btn-success">
							<i class="fa fa-check mr-1"></i>Enregistrer
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
 
	<?php require_once("../../../sections/admin/script.php"); ?>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 
	<?php if (isset($_GET['error']) && $_GET['error'] == 1 && isset($_GET['message'])): ?>
		<script>
			Swal.fire({
				icon: 'error',
				title: '<?= htmlspecialchars(urldecode($_GET['title'] ?? 'Erreur'), ENT_QUOTES, 'UTF-8') ?>',
				text:  '<?= htmlspecialchars(urldecode($_GET['message']), ENT_QUOTES, 'UTF-8') ?>'
			});
		</script>
	<?php endif; ?>
 
	<?php if (isset($_GET['Success']) && $_GET['Success'] == 1 && isset($_GET['message'])): ?>
		<script>
			Swal.fire({
				icon: 'success',
				title: '<?= htmlspecialchars(urldecode($_GET['title'] ?? 'Succès'), ENT_QUOTES, 'UTF-8') ?>',
				text:  '<?= htmlspecialchars(urldecode($_GET['message']), ENT_QUOTES, 'UTF-8') ?>',
				timer: 1500,
				timerProgressBar: true,
				showConfirmButton: false
			});
		</script>
	<?php endif; ?>
 
</body>
</html>