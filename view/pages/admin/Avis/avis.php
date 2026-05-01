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

            <ol class="breadcrumb float-xl-right">
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item active">Avis</li>
            </ol>

            <h1 class="page-header">Avis clients <small>modération des commentaires</small></h1>

            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Liste des avis</h4>
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
                                <th>Commentaire</th>
                                <th>Note</th>
                                <th>Date</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="f-w-600 text-inverse">1</td>
                                <td>Fatou Diallo</td>
                                <td>Appartement Plateau</td>
                                <td>Très bel appartement, propre et bien situé.</td>
                                <td>
                                    <span class="text-warning">
                                        <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                    </span> 5/5
                                </td>
                                <td>2024-01-20</td>
                                
                            </tr>
                            <tr>
                                <td class="f-w-600 text-inverse">2</td>
                                <td>Moussa Ndiaye</td>
                                <td>Villa Almadies</td>
                                <td>Magnifique villa, piscine impeccable. Je recommande.</td>
                                <td>
                                    <span class="text-warning">
                                        <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="far fa-star"></i>
                                    </span> 4/5
                                </td>
                                <td>2024-01-22</td>
                                
                            </tr>
                            <tr>
                                <td class="f-w-600 text-inverse">3</td>
                                <td>Sophie Martin</td>
                                <td>Studio Mermoz</td>
                                <td>Studio fonctionnel, quartier calme.</td>
                                <td>
                                    <span class="text-warning">
                                        <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
                                    </span> 3/5
                                </td>
                                <td>2024-01-25</td>
                                
                            </tr>
                            <tr>
                                <td class="f-w-600 text-inverse">4</td>
                                <td>Omar Faye</td>
                                <td>Maison Yoff</td>
                                <td>Excellente maison, spacieuse et accueillante.</td>
                                <td>
                                    <span class="text-warning">
                                        <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                    </span> 5/5
                                </td>
                                <td>2024-01-28</td>
                                
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- section config -->
        <?php require_once("../../../sections/admin/config.php"); ?>

        <!-- section Scroll top -->
        <?php require_once("../../../sections/admin/scroll.php"); ?>
    </div>

    
         <!-- section Script -->
    <?php require_once("../../../sections/admin/script.php"); ?>
</body>
</html>