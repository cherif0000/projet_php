<!DOCTYPE html>
<html lang="fr">
<body>

	<!-- section Head -->
	<?php require_once("../../../sections/admin/head.php"); ?>

	<div id="page-loader" class="fade show"><span class="spinner"></span></div>

	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<!-- section Menu Haut -->
		<?php require_once("../../../sections/admin/menuHaut.php"); ?>

		<!-- section Menu Gauche -->
		<?php require_once("../../../sections/admin/menuGauche.php"); ?>

		<!-- section Content -->
		<div id="content" class="content">

			

			<h1 class="page-header">Liste des demandes propriétaire</h1>

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
								<th>Statut</th>
								<th>Date</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="f-w-600 text-inverse">1</td>
								<td>1</td>
								<td>Mamadou Diallo</td>
								<td>mamadou@gmail.com</td>
								<td>Je possède 2 appartements à Plateau</td>
								<td><span class="badge badge-warning">En attente</span></td>
								<td>2024-01-10</td>
								<td>
									<a href="#" class="btn btn-xs btn-success mr-1"><i class="fa fa-check"></i> Approuver</a>
									<a href="#" class="btn btn-xs btn-danger"><i class="fa fa-times"></i> Refuser</a>
								</td>
							</tr>
							<tr>
								<td class="f-w-600 text-inverse">2</td>
								<td>2</td>
								<td>Fatou Ndiaye</td>
								<td>fatou@gmail.com</td>
								<td>Villa aux Almadies disponible toute l'année</td>
								<td><span class="badge badge-success">Approuvée</span></td>
								<td>2024-01-12</td>
								<td>
									<a href="#" class="btn btn-xs btn-success mr-1"><i class="fa fa-check"></i> Approuver</a>
									<a href="#" class="btn btn-xs btn-danger"><i class="fa fa-times"></i> Refuser</a>
								</td>
							</tr>
							<tr>
								<td class="f-w-600 text-inverse">3</td>
								<td>3</td>
								<td>Ibrahima Sow</td>
								<td>ibrahima@gmail.com</td>
								<td>Studio à Mermoz bien équipé</td>
								<td><span class="badge badge-danger">Refusée</span></td>
								<td>2024-01-15</td>
								<td>
									<a href="#" class="btn btn-xs btn-success mr-1"><i class="fa fa-check"></i> Approuver</a>
									<a href="#" class="btn btn-xs btn-danger"><i class="fa fa-times"></i> Refuser</a>
								</td>
							</tr>
							<tr>
								<td class="f-w-600 text-inverse">4</td>
								<td>4</td>
								<td>Aissatou Ba</td>
								<td>aissatou@gmail.com</td>
								<td>Maison familiale à Yoff</td>
								<td><span class="badge badge-warning">En attente</span></td>
								<td>2024-01-18</td>
								<td>
									<a href="#" class="btn btn-xs btn-success mr-1"><i class="fa fa-check"></i> Approuver</a>
									<a href="#" class="btn btn-xs btn-danger"><i class="fa fa-times"></i> Refuser</a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

		</div>

		<!-- section config -->
		<?php require_once("../../../sections/admin/config.php"); ?>
		<?php require_once("../../../sections/admin/scroll.php"); ?>
	</div>

	<!-- section Script -->
	<?php require_once("../../../sections/admin/script.php"); ?>
</body>
</html>