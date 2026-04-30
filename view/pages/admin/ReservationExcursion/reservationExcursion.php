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
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item active">Réservations Excursion</li>
            </ol>

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
                                <th class="text-center" width="10%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="f-w-600 text-inverse">1</td>
                                <td>Fatou Diallo</td>
                                <td>Lac Rose</td>
                                <td>2024-01-30</td>
                                <td>3 personnes</td>
                                <td>75 000 FCFA</td>
                                <td class="text-center">
                                    <a href="#modal-delete-re" class="btn btn-xs btn-danger" data-toggle="modal" title="Annuler"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="f-w-600 text-inverse">2</td>
                                <td>Moussa Ndiaye</td>
                                <td>Île de Gorée</td>
                                <td>2024-02-01</td>
                                <td>2 personnes</td>
                                <td>30 000 FCFA</td>
                                <td class="text-center">
                                    <a href="#modal-delete-re" class="btn btn-xs btn-danger" data-toggle="modal" title="Annuler"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="f-w-600 text-inverse">3</td>
                                <td>Sophie Martin</td>
                                <td>Sine-Saloum</td>
                                <td>2024-02-05</td>
                                <td>4 personnes</td>
                                <td>320 000 FCFA</td>
                                <td class="text-center">
                                    <a href="#modal-delete-re" class="btn btn-xs btn-danger" data-toggle="modal" title="Annuler"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="f-w-600 text-inverse">4</td>
                                <td>Omar Faye</td>
                                <td>Casamance</td>
                                <td>2024-02-10</td>
                                <td>2 personnes</td>
                                <td>300 000 FCFA</td>
                                <td class="text-center">
                                    <a href="#modal-delete-re" class="btn btn-xs btn-danger" data-toggle="modal" title="Annuler"><i class="fa fa-times"></i></a>
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

    <!-- MODAL ANNULER -->
    <div class="modal fade" id="modal-delete-re">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h4 class="modal-title"><i class="fa fa-times mr-2"></i>Annuler la réservation</h4>
                    <button type="button" class="close text-white" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body">
                    <p>Confirmer l'annulation de cette réservation d'excursion ?</p>
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Non</a>
                    <a href="../../../../controller/ReservationExcursionController.php?action=annuler&id=1" class="btn btn-danger">Oui, annuler</a>
                </div>
            </div>
        </div>
    </div>

    <?php require_once("../../../sections/admin/script.php"); ?>
</body>
</html>