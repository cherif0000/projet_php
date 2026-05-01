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
								<th>Organisateur</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="f-w-600 text-inverse">1</td>
								<td>1</td>
								<td>Lac Rose</td>
								<td>Retba, Dakar</td>
								<td>2024-02-10 08:00</td>
								<td>25 000 FCFA</td>
								<td>Mamadou Diallo</td>
								<td>
									<a href="#" class="btn btn-xs btn-primary mr-1"><i class="fa fa-edit"></i></a>
									<a href="#" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
							<tr>
								<td class="f-w-600 text-inverse">2</td>
								<td>2</td>
								<td>Île de Gorée</td>
								<td>Gorée, Dakar</td>
								<td>2024-02-15 09:00</td>
								<td>15 000 FCFA</td>
								<td>Fatou Ndiaye</td>
								<td>
									<a href="#" class="btn btn-xs btn-primary mr-1"><i class="fa fa-edit"></i></a>
									<a href="#" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
							<tr>
								<td class="f-w-600 text-inverse">3</td>
								<td>3</td>
								<td>Sine-Saloum</td>
								<td>Delta du Saloum</td>
								<td>2024-03-01 07:00</td>
								<td>80 000 FCFA</td>
								<td>Mamadou Diallo</td>
								<td>
									<a href="#" class="btn btn-xs btn-primary mr-1"><i class="fa fa-edit"></i></a>
									<a href="#" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
							<tr>
								<td class="f-w-600 text-inverse">4</td>
								<td>4</td>
								<td>Casamance</td>
								<td>Ziguinchor, Casamance</td>
								<td>2024-03-10 06:00</td>
								<td>150 000 FCFA</td>
								<td>Aissatou Ba</td>
								<td>
									<a href="#" class="btn btn-xs btn-primary mr-1"><i class="fa fa-edit"></i></a>
									<a href="#" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
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

	<!-- MODAL — Ajouter une excursion -->
	<div class="modal fade" id="modal-add-excursion">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><i class="fa fa-map-marked-alt mr-2"></i>Ajouter une excursion</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<form id="form-add-excursion">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Nom</label>
									<input type="text" name="nom" class="form-control" placeholder="Ex: Lac Rose" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Prix (FCFA)</label>
									<input type="number" name="prix" class="form-control" placeholder="25000" required>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Adresse / Lieu</label>
							<input type="text" name="adresse" class="form-control" placeholder="Lieu de départ ou destination" required>
						</div>
						<div class="form-group">
							<label>Description</label>
							<textarea name="description" class="form-control" rows="3" placeholder="Description de l'excursion..." required></textarea>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Date et heure</label>
									<input type="datetime-local" name="date" class="form-control" required>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Image</label>
							<input type="file" name="image" class="form-control" accept="image/*">
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Annuler</a>
					<button type="submit" form="form-add-excursion" class="btn btn-success"><i class="fa fa-check mr-1"></i>Enregistrer</button>
				</div>
			</div>
		</div>
	</div>

	<!-- section Script -->
	<?php require_once("../../../sections/admin/script.php"); ?>
</body>
</html>