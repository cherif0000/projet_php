<?php
session_start();
if (!isset($_SESSION['id'])) { header("Location: login"); exit; }
require_once("../../../../model/ReservationExcursionDB.php");
$reservationDB = new ReservationExcursionDB();
$reservations  = $reservationDB->getAllReservations();
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
			<h1 class="page-header">Réservations Excursion <small>suivi des réservations</small></h1>
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
								<th>Excursion</th>
								<th>Date réservation</th>
								<th>Nb personnes</th>
								<th>Montant</th>
							</tr>
						</thead>
						<tbody>
							<?php if (empty($reservations)): ?>
								<tr><td colspan="6" class="text-center text-muted">Aucune réservation.</td></tr>
							<?php else: ?>
								<?php foreach ($reservations as $i => $r): ?>
									<tr>
										<td class="f-w-600 text-inverse"><?= $i + 1 ?></td>
										<td><?= htmlspecialchars($r['client']) ?></td>
										<td><?= htmlspecialchars($r['excursion']) ?></td>
										<td><?= htmlspecialchars($r['date_reservation']) ?></td>
										<td><?= htmlspecialchars($r['nombre_personne']) ?> personne<?= $r['nombre_personne'] > 1 ? 's' : '' ?></td>
										<td><?= number_format($r['montant'], 0, ',', ' ') ?> FCFA</td>
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
</body>
</html>
