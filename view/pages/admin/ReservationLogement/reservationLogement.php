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
            
            <h1 class="page-header">Réservations Logement <small>suivi des réservations</small></h1>

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
                                <th class="text-center" width="15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="f-w-600 text-inverse">1</td>
                                <td>Fatou Diallo</td>
                                <td>Appartement Plateau</td>
                                <td>2024-02-01</td>
                                <td>2024-02-07</td>
                                <td><span class="badge badge-success">confirmée</span></td>
                                <td class="text-center">
                                    <a href="#modal-edit-rl" class="btn btn-xs btn-warning" data-toggle="modal" title="Modifier statut"><i class="fa fa-edit"></i></a>
                                  
                                </td>
                            </tr>
                            <tr>
                                <td class="f-w-600 text-inverse">2</td>
                                <td>Sophie Martin</td>
                                <td>Villa Almadies</td>
                                <td>2024-02-10</td>
                                <td>2024-02-15</td>
                                <td><span class="badge badge-warning">en attente</span></td>
                                <td class="text-center">
                                    <a href="#modal-edit-rl" class="btn btn-xs btn-warning" data-toggle="modal" title="Modifier statut"><i class="fa fa-edit"></i></a>
                                  
                                </td>
                            </tr>
                            <tr>
                                <td class="f-w-600 text-inverse">3</td>
                                <td>Moussa Ndiaye</td>
                                <td>Studio Mermoz</td>
                                <td>2024-02-20</td>
                                <td>2024-02-25</td>
                                <td><span class="badge badge-danger">annulée</span></td>
                                <td class="text-center">
                                    <a href="#modal-edit-rl" class="btn btn-xs btn-warning" data-toggle="modal" title="Modifier statut"><i class="fa fa-edit"></i></a>
                                  
                                </td>
                            </tr>
                            <tr>
                                <td class="f-w-600 text-inverse">4</td>
                                <td>Omar Faye</td>
                                <td>Villa Ouakam</td>
                                <td>2024-03-01</td>
                                <td>2024-03-05</td>
                                <td><span class="badge badge-success">confirmée</span></td>
                                <td class="text-center">
                                    <a href="#modal-edit-rl" class="btn btn-xs btn-warning" data-toggle="modal" title="Modifier statut"><i class="fa fa-edit"></i></a>
                                  
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

    <!-- MODAL MODIFIER STATUT -->
    <div class="modal fade" id="modal-edit-rl">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h4 class="modal-title"><i class="fa fa-edit mr-2"></i>Modifier le statut</h4>
                    <button type="button" class="close text-white" data-dismiss="modal">×</button>
                </div>
                <form action="../../../../controller/ReservationLogementController.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id" value="1">
                        <div class="form-group">
                            <label>Statut</label>
                            <select name="status" class="form-control" required>
                                <option value="en_attente">En attente</option>
                                <option value="confirmee" selected>Confirmée</option>
                                <option value="annulee">Annulée</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Annuler</button>
                        <button type="submit" name="btnEditRL" class="btn btn-warning"><i class="fa fa-save mr-1"></i>Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    

    <?php require_once("../../../sections/admin/script.php"); ?>
</body>
</html>