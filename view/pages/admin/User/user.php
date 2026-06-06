<?php
session_start();
if (!isset($_SESSION['id'])) { header("Location: login"); exit; }
// Récupération des vrais utilisateurs depuis la base de données
require_once("../../../../model/UserDB.php");
$userDB = new UserDB();
$users  = $userDB->getAllUsers();
?>
<!DOCTYPE html>
<html lang="fr">
<body>

	<!-- section Head -->
	<?php require_once("../../../sections/admin/head.php"); ?>

	<div id="page-loader" class="fade show"><span class="spinner"></span></div>

	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">

		<!-- section Menu Haut -->
		<?php require_once("../../../sections/admin/menuHaut.php"); ?>

		<!-- section menu Gauche -->
		<?php require_once("../../../sections/admin/menuGauche.php"); ?>

		<!-- section Content -->
		<div id="content" class="content">

			<h1 class="page-header">Liste des utilisateurs</h1>

			<div class="panel panel-inverse">
				<div class="panel-heading">
					<h4 class="panel-title">Tous les utilisateurs</h4>
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
								<th>Rôle</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php if (empty($users)): ?>
								<tr>
									<td colspan="6" class="text-center text-muted">Aucun utilisateur trouvé.</td>
								</tr>
							<?php else: ?>
								<?php foreach ($users as $index => $user): ?>
									<?php
										// Couleur du badge selon le rôle
										$badgeClass = 'badge-success'; // client par défaut
										if ($user['role'] === 'admin')         $badgeClass = 'badge-danger';
										elseif ($user['role'] === 'proprietaire') $badgeClass = 'badge-warning';
									?>
									<tr>
										<td class="f-w-600 text-inverse"><?= $index + 1 ?></td>
										<td><?= htmlspecialchars($user['id']) ?></td>
										<td><?= htmlspecialchars($user['nom']) ?></td>
										<td><?= htmlspecialchars($user['email']) ?></td>
										<td>
											<span class="badge <?= $badgeClass ?>">
												<?= htmlspecialchars($user['role']) ?>
											</span>
										</td>
										<td>
											<a href="#modal-delete-user-<?= $user['id'] ?>"
											   class="btn btn-xs btn-danger"
											   data-toggle="modal">
												<i class="fa fa-trash"></i>
											</a>
										</td>
									</tr>

									<!-- MODAL SUPPRIMER pour cet utilisateur -->
									<div class="modal fade" id="modal-delete-user-<?= $user['id'] ?>">
										<div class="modal-dialog modal-sm">
											<div class="modal-content">
												<div class="modal-header bg-danger text-white">
													<h4 class="modal-title"><i class="fa fa-times mr-2"></i>Supprimer l'utilisateur</h4>
													<button type="button" class="close text-white" data-dismiss="modal">×</button>
												</div>
												<div class="modal-body">
													<p>Confirmer la suppression de <strong><?= htmlspecialchars($user['nom']) ?></strong> ?</p>
												</div>
												<div class="modal-footer">
													<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Non</a>
													<a href="userController?action=supprimer&id=<?= $user['id'] ?>"
													   class="btn btn-danger">Oui, supprimer</a>
												</div>
											</div>
										</div>
									</div>
									<!-- FIN MODAL -->

								<?php endforeach; ?>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
			</div>

		</div>

		<!-- section config -->
		<?php require_once("../../../sections/admin/config.php"); ?>

		<!-- section scroll top -->
		<?php require_once("../../../sections/admin/scroll.php"); ?>
	</div>

	<!-- section Script -->
	<?php require_once("../../../sections/admin/script.php"); ?>

	<!-- Notifications SweetAlert -->
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
