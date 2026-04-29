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
					<a href="#modal-add-demande" class="btn btn-sm btn-success text-white" data-toggle="modal">
						<i class="fa fa-plus mr-1"></i> Ajouter un propriétaire
					</a>
				</li>
				<li class="breadcrumb-item active">Demandes Propriétaire</li>
			</ol>

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
								<th width="1%"></th>
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
								<td><img src="../../../../public/templates/templateAdmin/assets/img/user/user-1.jpg" class="img-rounded height-30" /></td>
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
								<td><img src="../../../../public/templates/templateAdmin/assets/img/user/user-2.jpg" class="img-rounded height-30" /></td>
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
								<td><img src="../../../../public/templates/templateAdmin/assets/img/user/user-3.jpg" class="img-rounded height-30" /></td>
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
								<td><img src="../../../../public/templates/templateAdmin/assets/img/user/user-4.jpg" class="img-rounded height-30" /></td>
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

		<?php require_once("../../../sections/admin/config.php"); ?>
		<?php require_once("../../../sections/admin/scroll.php"); ?>
	</div>

	<!-- MODAL — Ajouter un propriétaire manuellement -->
	<div class="modal fade" id="modal-add-demande">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><i class="fa fa-user-plus mr-2"></i>Ajouter un propriétaire</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<form >
						<div class="form-group">
							<label>Utilisateur (email)</label>
							<input type="email" name="email" class="form-control" placeholder="email@exemple.com" required>
						</div>
						<div class="form-group">
							<label>Description</label>
							<textarea name="description" class="form-control" rows="3" placeholder="Description du bien ou de la demande..." required></textarea>
						</div>
						<div class="form-group">
							<label>Statut</label>
							<select name="statut" class="form-control">
								<option value="en_attente">En attente</option>
								<option value="approuvee">Approuvée</option>
								<option value="refusee">Refusée</option>
							</select>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Annuler</a>
					<button type="submit" form="form-add-demande" class="btn btn-success"><i class="fa fa-check mr-1"></i>Enregistrer</button>
				</div>
			</div>
		</div>
	</div>

	<?php require_once("../../../sections/admin/script.php"); ?>
</body>
</html>