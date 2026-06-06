<?php
session_start();
if (!isset($_SESSION['id'])) { header("Location: login"); exit; }
require_once("../../../../model/ReservationLogementDB.php");
 
$reservationDB = new ReservationLogementDB();
 
// Chargement selon le rôle
if ($_SESSION['role'] === 'proprietaire') {
    $reservations = $reservationDB->getReservationsByProprietaire($_SESSION['id']);
} else {
    $reservations = $reservationDB->getAllReservations();
}
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
			<h1 class="page-header">
				<?= $_SESSION['role'] === 'proprietaire' ? 'Mes réservations' : 'Réservations Logement' ?>
				<small>suivi des réservations</small>
			</h1>
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<h4 class="panel-title">Liste des réservations</h4>
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
								<th>Date début</th>
								<th>Date fin</th>
								<th>Statut</th>
								<th class="text-center" width="10%">Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php if (empty($reservations)): ?>
								<tr><td colspan="7" class="text-center text-muted">Aucune réservation.</td></tr>
							<?php else: ?>
								<?php foreach ($reservations as $i => $r): ?>
									<?php
										switch ($r['statut']) {
											case 'confirmee':  $bc = 'badge-success'; $lb = 'Confirmée';  break;
											case 'annulee':    $bc = 'badge-danger';  $lb = 'Annulée';    break;
											default:           $bc = 'badge-warning'; $lb = 'En attente';
										}
									?>
									<tr>
										<td class="f-w-600 text-inverse"><?= $i + 1 ?></td>
										<td><?= htmlspecialchars($r['client']) ?></td>
										<td><?= htmlspecialchars($r['logement']) ?></td>
										<td><?= htmlspecialchars($r['date_debut']) ?></td>
										<td><?= htmlspecialchars($r['date_fin']) ?></td>
										<td><span class="badge <?= $bc ?>"><?= $lb ?></span></td>
										<td class="text-center">
											<a href="#modal-edit-rl-<?= $r['id'] ?>"
											   class="btn btn-xs btn-warning" data-toggle="modal" title="Modifier statut">
												<i class="fa fa-edit"></i>
											</a>
										</td>
									</tr>
 
									<!-- MODAL MODIFIER STATUT -->
									<div class="modal fade" id="modal-edit-rl-<?= $r['id'] ?>">
										<div class="modal-dialog modal-sm">
											<div class="modal-content">
												<div class="modal-header bg-warning text-white">
													<h4 class="modal-title"><i class="fa fa-edit mr-2"></i>Modifier le statut</h4>
													<button type="button" class="close text-white" data-dismiss="modal">×</button>
												</div>
												<form action="reservationLogementController" method="POST">
													<div class="modal-body">
														<input type="hidden" name="id" value="<?= $r['id'] ?>">
														<div class="form-group">
															<label>Statut</label>
															<select name="statut" class="form-control" required>
																<option value="en_attente"  <?= $r['statut']==='en_attente' ?'selected':'' ?>>En attente</option>
																<option value="confirmee"   <?= $r['statut']==='confirmee'  ?'selected':'' ?>>Confirmée</option>
																<option value="annulee"     <?= $r['statut']==='annulee'    ?'selected':'' ?>>Annulée</option>
															</select>
														</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-white" data-dismiss="modal">Annuler</button>
														<button type="submit" name="btnEditRL" class="btn btn-warning">
															<i class="fa fa-save mr-1"></i>Enregistrer
														</button>
													</div>
												</form>
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