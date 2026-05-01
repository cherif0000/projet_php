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
								<th width="1%"></th>
								<th>ID</th>
								<th>Nom</th>
								<th>Email</th>
								<th>Rôle</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="f-w-600 text-inverse">1</td>
								<td><img src="../../../../public/templates/templateAdmin/assets/img/user/user-1.jpg" class="img-rounded height-30" /></td>
								<td>1</td>
								<td>Admin DakarStay</td>
								<td>admin@dakarstay.sn</td>
								<td><span class="badge badge-danger">admin</span></td>
								<td>
									
									<a href="#" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
							<tr>
								<td class="f-w-600 text-inverse">2</td>
								<td><img src="../../../../public/templates/templateAdmin/assets/img/user/user-2.jpg" class="img-rounded height-30" /></td>
								<td>2</td>
								<td>Mamadou Diallo</td>
								<td>mamadou@gmail.com</td>
								<td><span class="badge badge-warning">propriétaire</span></td>
								<td>
									
									<a href="#" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
							<tr>
								<td class="f-w-600 text-inverse">3</td>
								<td><img src="../../../../public/templates/templateAdmin/assets/img/user/user-3.jpg" class="img-rounded height-30" /></td>
								<td>3</td>
								<td>Fatou Ndiaye</td>
								<td>fatou@gmail.com</td>
								<td><span class="badge badge-success">client</span></td>
								<td>
									
									<a href="#modal-delete-user" class="btn btn-xs btn-danger" data-toggle="modal"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
							<tr>
								<td class="f-w-600 text-inverse">4</td>
								<td><img src="../../../../public/templates/templateAdmin/assets/img/user/user-4.jpg" class="img-rounded height-30" /></td>
								<td>4</td>
								<td>Ibrahima Sow</td>
								<td>ibrahima@gmail.com</td>
								<td><span class="badge badge-success">client</span></td>
								<td>
									
									<a href="#modal-delete-user" class="btn btn-xs btn-danger" data-toggle="modal"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
							<tr>
								<td class="f-w-600 text-inverse">5</td>
								<td><img src="../../../../public/templates/templateAdmin/assets/img/user/user-5.jpg" class="img-rounded height-30" /></td>
								<td>5</td>
								<td>Aissatou Ba</td>
								<td>aissatou@gmail.com</td>
								<td><span class="badge badge-warning">propriétaire</span></td>
								<td>
									
									<a href="#modal-delete-user" class="btn btn-xs btn-danger" data-toggle="modal"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

		</div>

		<!-- MODAL SUPPRIMER -->
    <div class="modal fade" id="modal-delete-user">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h4 class="modal-title"><i class="fa fa-times mr-2"></i>supprimer l'utilisateur</h4>
                    <button type="button" class="close text-white" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body">
                    <p>Confirmer la suppression de cet utilisateur ?</p>
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Non</a>
                    <a href="../../../../controller/UserController.php?action=supprimer&id=1" class="btn btn-danger">Oui, supprimer</a>
                </div>
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
</body>
</html>