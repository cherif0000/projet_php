<!DOCTYPE html>
<html lang="fr">
<body>
	<?php require_once("../../../sections/admin/head.php"); ?>

	<div id="page-loader" class="fade show"><span class="spinner"></span></div>

	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">

		<?php require_once("../../../sections/admin/menuHaut.php"); ?>
		<?php require_once("../../../sections/admin/menuGauche.php"); ?>

		<!-- MODAL liste des logement  -->
		<div id="content" class="content">

			<ol class="breadcrumb float-xl-right">
				<li class="breadcrumb-item">
					<a href="#modal-add-logement" class="btn btn-sm btn-success text-white" data-toggle="modal">
						<i class="fa fa-plus mr-1"></i> Ajouter un logement
					</a>
				</li>
				<li class="breadcrumb-item active">Logements</li>
			</ol>

			<h1 class="page-header">Liste des logements</h1>

			<div class="panel panel-inverse">
				<div class="panel-heading">
					<h4 class="panel-title">Tous les logements</h4>
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
							<tr>
								<td class="f-w-600 text-inverse">1</td>
								<td>1</td>
								<td>Appartement Plateau</td>
								<td>Rue de Thiong, Plateau, Dakar</td>
								<td>75 000 FCFA</td>
								<td><span class="badge badge-success">Disponible</span></td>
								<td>Mamadou Diallo</td>
								<td>
									<a href="#" class="btn btn-xs btn-primary mr-1"><i class="fa fa-edit"></i></a>
									<a href="#" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
							<tr>
								<td class="f-w-600 text-inverse">2</td>
								<td>2</td>
								<td>Villa Almadies</td>
								<td>Route des Almadies, Dakar</td>
								<td>150 000 FCFA</td>
								<td><span class="badge badge-warning">Occupé</span></td>
								<td>Fatou Ndiaye</td>
								<td>
									<a href="#" class="btn btn-xs btn-primary mr-1"><i class="fa fa-edit"></i></a>
									<a href="#" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
							<tr>
								<td class="f-w-600 text-inverse">3</td>
								<td>3</td>
								<td>Studio Mermoz</td>
								<td>Mermoz Pyrotechnie, Dakar</td>
								<td>40 000 FCFA</td>
								<td><span class="badge badge-success">Disponible</span></td>
								<td>Aissatou Ba</td>
								<td>
									<a href="#" class="btn btn-xs btn-primary mr-1"><i class="fa fa-edit"></i></a>
									<a href="#" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
							<tr>
								<td class="f-w-600 text-inverse">4</td>
								<td>4</td>
								<td>Maison Yoff</td>
								<td>Yoff Virage, Dakar</td>
								<td>90 000 FCFA</td>
								<td><span class="badge badge-danger">Indisponible</span></td>
								<td>Mamadou Diallo</td>
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

		<?php require_once("../../../sections/admin/config.php"); ?>
		<?php require_once("../../../sections/admin/scroll.php"); ?>
	</div>

	<!-- MODAL — Ajouter un logement -->
	<div class="modal fade" id="modal-add-logement">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><i class="fa fa-home mr-2"></i>Ajouter un logement</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<form id="form-add-logement">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Titre</label>
									<input type="text" name="titre" class="form-control" placeholder="Ex: Appartement Plateau" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Prix / nuit (FCFA)</label>
									<input type="number" name="prix" class="form-control" placeholder="75000" required>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Adresse</label>
							<input type="text" name="adresse" class="form-control" placeholder="Rue, Quartier, Dakar" required>
						</div>
						<div class="form-group">
							<label>Description</label>
							<textarea name="description" class="form-control" rows="3" placeholder="Description du logement..." required></textarea>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Statut</label>
									<select name="statut" class="form-control">
										<option value="disponible">Disponible</option>
										<option value="occupe">Occupé</option>
										<option value="indisponible">Indisponible</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Propriétaire (ID user)</label>
									<input type="number" name="id_user" class="form-control" placeholder="ID du propriétaire" required>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Images</label>
							<input type="file" name="images[]" class="form-control" multiple accept="image/*">
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Annuler</a>
					<button type="submit" form="form-add-logement" class="btn btn-success"><i class="fa fa-check mr-1"></i>Enregistrer</button>
				</div>
			</div>
		</div>
	</div>

	<?php require_once("../../../sections/admin/script.php"); ?>
</body>
</html>