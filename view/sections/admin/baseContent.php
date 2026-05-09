<?php
// permet de formater un montant en FCFA
function formatCFA($montant) {
    return number_format($montant, 0, ',', ' ') . ' FCFA';
}
?>

<div id="content" class="content">
	<!-- begin breadcrumb -->
	<ol class="breadcrumb float-xl-right">
		<li class="breadcrumb-item"><a href="logement">Logements</a></li>
		<li class="breadcrumb-item"><a href="excursion">Excursions</a></li>
		<li class="breadcrumb-item active"><a href="avis">Avis</a></li>
	</ol>
	<!-- end breadcrumb -->

	<!-- begin page-header -->
	<h1 class="page-header mb-3">Tableau de bord</h1>
	<!-- end page-header -->

	<!-- ============================================================ -->
	<!-- LIGNE 1 : REVENUS TOTAUX + TAUX D'OCCUPATION + RÉSERVATIONS  -->
	<!-- ============================================================ -->
	<div class="row align-items-stretch">

		<!-- begin col-6 : REVENUS TOTAUX -->
		<div class="col-xl-6 d-flex">
			<div class="card border-0 mb-3 overflow-hidden bg-dark text-white w-100">
				<div class="card-body">
					<div class="row h-100">
						<!-- begin col-7 -->
						<div class="col-xl-7 col-lg-8 d-flex flex-column justify-content-between">
							<!-- begin title -->
							<div class="mb-3 text-grey">
								<b>REVENUS TOTAUX</b>
								<span class="ml-2">
									<i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover"
									   data-title="Revenus totaux"
									   data-placement="top"
									   data-content="Somme des montants de toutes les réservations confirmées (logements + excursions)."></i>
								</span>
							</div>
							<!-- end title -->
							<!-- begin total revenus -->
							<div class="d-flex mb-1">
								<h2 class="mb-0">
									<span data-animation="number" data-value="<?php echo $statsAdmin['revenus_totaux'] ?? 0; ?>">0</span>
									&nbsp;FCFA
								</h2>
								<div class="ml-auto mt-n1 mb-n1">
									<div id="total-sales-sparkline"></div>
								</div>
							</div>
							<!-- end total revenus -->
							<div class="mb-3 text-grey">
								<i class="fa fa-calendar"></i> Ce mois-ci
							</div>
							<hr class="bg-white-transparent-2" />
							<!-- begin row -->
							<div class="row text-truncate">
								<!-- begin col-6 -->
								<div class="col-6">
									<div class="f-s-12 text-grey">Revenus logements</div>
									<div class="f-s-18 m-b-5 f-w-600 p-b-1">
										<span data-animation="number" data-value="<?php echo $statsAdmin['revenus_logement'] ?? 0; ?>">0</span>
									</div>
									<div class="progress progress-xs rounded-lg bg-dark-darker m-b-5">
										<div class="progress-bar progress-bar-striped rounded-right bg-teal"
											 data-animation="width"
											 data-value="<?php echo $statsAdmin['pct_revenus_logement'] ?? 60; ?>%"
											 style="width: 0%"></div>
									</div>
								</div>
								<!-- end col-6 -->
								<!-- begin col-6 -->
								<div class="col-6">
									<div class="f-s-12 text-grey">Revenus excursions</div>
									<div class="f-s-18 m-b-5 f-w-600 p-b-1">
										<span data-animation="number" data-value="<?php echo $statsAdmin['revenus_excursion'] ?? 0; ?>">0</span>
									</div>
									<div class="progress progress-xs rounded-lg bg-dark-darker m-b-5">
										<div class="progress-bar progress-bar-striped rounded-right"
											 data-animation="width"
											 data-value="<?php echo $statsAdmin['pct_revenus_excursion'] ?? 40; ?>%"
											 style="width: 0%"></div>
									</div>
								</div>
								<!-- end col-6 -->
							</div>
							<!-- end row -->
						</div>
						<!-- end col-7 -->
						<!-- begin col-5 -->
						<div class="col-xl-5 col-lg-4 align-items-center d-flex justify-content-center">
							<img src="public/templates/templateAdmin/assets/img/svg/img-1.svg" height="150px" class="d-none d-lg-block" />
						</div>
						<!-- end col-5 -->
					</div>
				</div>
			</div>
		</div>
		<!-- end col-6 -->

		<!-- begin col-6 -->
		<div class="col-xl-6">
			<div class="row h-100">

				<!-- begin col-6 : TAUX D'OCCUPATION -->
				<div class="col-sm-6 d-flex">
					<div class="card border-0 mb-3 bg-dark text-white w-100">
						<div class="card-body d-flex flex-column justify-content-between">
							<!-- begin title -->
							<div class="mb-3 text-grey">
								<b class="mb-3">TAUX D'OCCUPATION</b>
								<span class="ml-2">
									<i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover"
									   data-title="Taux d'occupation"
									   data-placement="top"
									   data-content="Pourcentage de logements actuellement réservés par rapport au total disponible."></i>
								</span>
							</div>
							<!-- end title -->
							<div class="d-flex align-items-center mb-1">
								<h2 class="text-white mb-0">
									<span data-animation="number" data-value="<?php echo $statsAdmin['taux_occupation'] ?? 0; ?>">0</span>%
								</h2>
								<div class="ml-auto">
									<div id="conversion-rate-sparkline"></div>
								</div>
							</div>
							<div class="mb-4 text-grey">
								<i class="fa fa-home"></i> Sur <?php echo $statsAdmin['total_logements'] ?? 0; ?> logements
							</div>
							<div>
								<!-- begin info-row -->
								<div class="d-flex mb-2">
									<div class="d-flex align-items-center">
										<i class="fa fa-circle text-teal f-s-8 mr-2"></i>
										Confirmées
									</div>
									<div class="d-flex align-items-center ml-auto">
										<div class="width-50 text-right pl-2 f-w-600">
											<span data-animation="number" data-value="<?php echo $statsAdmin['res_confirmees'] ?? 0; ?>">0</span>
										</div>
									</div>
								</div>
								<!-- end info-row -->
								<!-- begin info-row -->
								<div class="d-flex mb-2">
									<div class="d-flex align-items-center">
										<i class="fa fa-circle text-warning f-s-8 mr-2"></i>
										En attente
									</div>
									<div class="d-flex align-items-center ml-auto">
										<div class="width-50 text-right pl-2 f-w-600">
											<span data-animation="number" data-value="<?php echo $statsAdmin['res_en_attente'] ?? 0; ?>">0</span>
										</div>
									</div>
								</div>
								<!-- end info-row -->
								<!-- begin info-row -->
								<div class="d-flex">
									<div class="d-flex align-items-center">
										<i class="fa fa-circle text-red f-s-8 mr-2"></i>
										Annulées
									</div>
									<div class="d-flex align-items-center ml-auto">
										<div class="width-50 text-right pl-2 f-w-600">
											<span data-animation="number" data-value="<?php echo $statsAdmin['res_annulees'] ?? 0; ?>">0</span>
										</div>
									</div>
								</div>
								<!-- end info-row -->
							</div>
						</div>
					</div>
				</div>
				<!-- end col-6 -->

				<!-- begin col-6 : RÉSERVATIONS DU MOIS -->
				<div class="col-sm-6 d-flex">
					<div class="card border-0 mb-3 bg-dark text-white w-100">
						<div class="card-body d-flex flex-column justify-content-between">
							<!-- begin title -->
							<div class="mb-3 text-grey">
								<b class="mb-3">RÉSERVATIONS DU MOIS</b>
								<span class="ml-2">
									<i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover"
									   data-title="Réservations du mois"
									   data-placement="top"
									   data-content="Nombre total de réservations (logements + excursions) pour le mois en cours."></i>
								</span>
							</div>
							<!-- end title -->
							<div class="d-flex align-items-center mb-1">
								<h2 class="text-white mb-0">
									<span data-animation="number" data-value="<?php echo $statsAdmin['reservations_mois'] ?? 0; ?>">0</span>
								</h2>
								<div class="ml-auto">
									<div id="store-session-sparkline"></div>
								</div>
							</div>
							<div class="mb-4 text-grey">
								<i class="fa fa-calendar"></i> Ce mois-ci
							</div>
							<div>
								<!-- begin info-row -->
								<div class="d-flex mb-2">
									<div class="d-flex align-items-center">
										<i class="fa fa-circle text-teal f-s-8 mr-2"></i>
										Logements
									</div>
									<div class="d-flex align-items-center ml-auto">
										<div class="width-50 text-right pl-2 f-w-600">
											<span data-animation="number" data-value="<?php echo $statsAdmin['reservations_logement_mois'] ?? 0; ?>">0</span>
										</div>
									</div>
								</div>
								<!-- end info-row -->
								<!-- begin info-row -->
								<div class="d-flex mb-2">
									<div class="d-flex align-items-center">
										<i class="fa fa-circle text-blue f-s-8 mr-2"></i>
										Excursions
									</div>
									<div class="d-flex align-items-center ml-auto">
										<div class="width-50 text-right pl-2 f-w-600">
											<span data-animation="number" data-value="<?php echo $statsAdmin['reservations_excursion_mois'] ?? 0; ?>">0</span>
										</div>
									</div>
								</div>
								<!-- end info-row -->
								<!-- begin info-row -->
								<div class="d-flex">
									<div class="d-flex align-items-center">
										<i class="fa fa-circle text-aqua f-s-8 mr-2"></i>
										Clients inscrits
									</div>
									<div class="d-flex align-items-center ml-auto">
										<div class="width-50 text-right pl-2 f-w-600">
											<span data-animation="number" data-value="<?php echo $statsAdmin['nouveaux_clients_mois'] ?? 0; ?>">0</span>
										</div>
									</div>
								</div>
								<!-- end info-row -->
							</div>
						</div>
					</div>
				</div>
				<!-- end col-6 -->

			</div>
		</div>
		<!-- end col-6 -->

	</div>
	<!-- end row -->

	<!-- ============================================================ -->
	<!-- LIGNE 2 : STATISTIQUES PLATEFORME + REVENUS PAR TYPE         -->
	<!-- ============================================================ -->
	<div class="row align-items-stretch">

		<!-- begin col-8 : STATISTIQUES PLATEFORME -->
		<div class="col-xl-8 col-lg-6 d-flex">
			<div class="card border-0 mb-3 bg-dark text-white w-100 d-flex flex-column">
				<div class="card-body">
					<div class="mb-3 text-grey">
						<b>STATISTIQUES DE LA PLATEFORME</b>
						<span class="ml-2">
							<i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover"
							   data-title="Statistiques plateforme"
							   data-placement="top"
							   data-content="Vue globale des données de la plateforme DakarStay."></i>
						</span>
					</div>
					<div class="row">
						<div class="col-xl-3 col-4">
							<h3 class="mb-1">
								<span data-animation="number" data-value="<?php echo $statsAdmin['total_utilisateurs'] ?? 0; ?>">0</span>
							</h3>
							<div>Utilisateurs</div>
							<div class="text-grey f-s-11 text-truncate">
								<i class="fa fa-caret-up"></i>
								<span data-animation="number" data-value="<?php echo $statsAdmin['nouveaux_clients_mois'] ?? 0; ?>">0</span> ce mois
							</div>
						</div>
						<div class="col-xl-3 col-4">
							<h3 class="mb-1">
								<span data-animation="number" data-value="<?php echo $statsAdmin['total_logements'] ?? 0; ?>">0</span>
							</h3>
							<div>Logements</div>
							<div class="text-grey f-s-11 text-truncate">
								<i class="fa fa-home"></i> Publiés sur la plateforme
							</div>
						</div>
						<div class="col-xl-3 col-4">
							<h3 class="mb-1">
								<span data-animation="number" data-value="<?php echo $statsAdmin['total_excursions'] ?? 0; ?>">0</span>
							</h3>
							<div>Excursions</div>
							<div class="text-grey f-s-11 text-truncate">
								<i class="fa fa-map-marker"></i> Disponibles
							</div>
						</div>
					</div>
				</div>
				<div class="card-body p-0 flex-grow-1">
					<div style="height: 269px">
						<div id="visitors-line-chart" class="widget-chart-full-width nvd3-inverse-mode" style="height: 254px"></div>
					</div>
				</div>
			</div>
		</div>
		<!-- end col-8 -->

		<!-- begin col-4 : REVENUS PAR TYPE -->
		<div class="col-xl-4 col-lg-6 d-flex">
			<div class="card border-0 mb-3 bg-dark-darker text-white w-100 d-flex flex-column">
				<!-- begin card-body -->
				<div class="card-body" style="background: no-repeat bottom right; background-image: url(public/templates/templateAdmin/assets/img/svg/img-4.svg); background-size: auto 60%;">
					<div class="mb-3 text-grey">
						<b>REVENUS PAR TYPE</b>
						<span class="text-grey ml-2">
							<i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover"
							   data-title="Revenus par type"
							   data-placement="top"
							   data-content="Détail des revenus générés par les logements et les excursions."></i>
						</span>
					</div>
					<h3 class="m-b-10">
						<span data-animation="number" data-value="<?php echo $statsAdmin['revenus_totaux'] ?? 0; ?>">0</span>
						&nbsp;FCFA
					</h3>
					<div class="text-grey m-b-1">
						<i class="fa fa-calendar"></i> Total cumulé
					</div>
				</div>
				<!-- end card-body -->
				<!-- begin widget-list -->
				<div class="widget-list widget-list-rounded inverse-mode flex-grow-1">
					<a href="logement" class="widget-list-item rounded-0 p-t-3">
						<div class="widget-list-media icon">
							<i class="fa fa-home bg-teal text-white"></i>
						</div>
						<div class="widget-list-content">
							<div class="widget-list-title">Logements</div>
						</div>
						<div class="widget-list-action text-nowrap text-grey">
							<span data-animation="number" data-value="<?php echo $statsAdmin['revenus_logement'] ?? 0; ?>">0</span> FCFA
						</div>
					</a>
					<a href="excursion" class="widget-list-item">
						<div class="widget-list-media icon">
							<i class="fa fa-map-marker bg-blue text-white"></i>
						</div>
						<div class="widget-list-content">
							<div class="widget-list-title">Excursions</div>
						</div>
						<div class="widget-list-action text-nowrap text-grey">
							<span data-animation="number" data-value="<?php echo $statsAdmin['revenus_excursion'] ?? 0; ?>">0</span> FCFA
						</div>
					</a>
					<a href="reservationLogement" class="widget-list-item">
						<div class="widget-list-media icon">
							<i class="fa fa-calendar-check bg-aqua text-white"></i>
						</div>
						<div class="widget-list-content">
							<div class="widget-list-title">Rés. logements (total)</div>
						</div>
						<div class="widget-list-action text-nowrap text-grey">
							<span data-animation="number" data-value="<?php echo $statsAdmin['total_reservations_logement'] ?? 0; ?>">0</span>
						</div>
					</a>
					<a href="reservationExcursion" class="widget-list-item">
						<div class="widget-list-media icon">
							<i class="fa fa-ticket-alt bg-orange text-white"></i>
						</div>
						<div class="widget-list-content">
							<div class="widget-list-title">Rés. excursions (total)</div>
						</div>
						<div class="widget-list-action text-nowrap text-grey">
							<span data-animation="number" data-value="<?php echo $statsAdmin['total_reservations_excursion'] ?? 0; ?>">0</span>
						</div>
					</a>
					<a href="avis" class="widget-list-item p-b-3">
						<div class="widget-list-media icon">
							<i class="fa fa-star bg-yellow text-white"></i>
						</div>
						<div class="widget-list-content">
							<div class="widget-list-title">Avis clients (total)</div>
						</div>
						<div class="widget-list-action text-nowrap text-grey">
							<span data-animation="number" data-value="<?php echo $statsAdmin['total_avis'] ?? 0; ?>">0</span>
						</div>
					</a>
				</div>
				<!-- end widget-list -->
			</div>
		</div>
		<!-- end col-4 -->

	</div>
	<!-- end row -->

	<!-- ============================================================ -->
	<!-- LIGNE 3 : RÉPARTITION + LOGEMENTS TOP + DEMANDES EN ATTENTE  -->
	<!-- ============================================================ -->
	<div class="row align-items-stretch">

		<!-- begin col-4 : RÉPARTITION DES RÉSERVATIONS -->
		<div class="col-xl-4 col-lg-6 d-flex">
			<div class="card border-0 mb-3 bg-dark text-white w-100">
				<div class="card-body d-flex flex-column">
					<div class="mb-2 text-grey">
						<b>RÉPARTITION DES RÉSERVATIONS</b>
						<span class="ml-2">
							<i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover"
							   data-title="Répartition des réservations"
							   data-placement="top"
							   data-content="Détail des réservations par statut sur l'ensemble de la plateforme."></i>
						</span>
					</div>
					<div class="mt-3 flex-grow-1 d-flex flex-column justify-content-between">
						<!-- Confirmées -->
						<div class="d-flex align-items-center text-white mb-3">
							<div class="widget-list-media icon mr-3">
								<i class="fa fa-check-circle bg-teal text-white" style="border-radius:4px; padding:8px;"></i>
							</div>
							<div class="d-flex w-100">
								<div>Réservations confirmées</div>
								<div class="ml-auto text-grey f-w-600">
									<span data-animation="number" data-value="<?php echo $statsAdmin['res_confirmees'] ?? 0; ?>">0</span>
								</div>
							</div>
						</div>
						<!-- En attente -->
						<div class="d-flex align-items-center text-white mb-3">
							<div class="widget-list-media icon mr-3">
								<i class="fa fa-clock bg-warning text-white" style="border-radius:4px; padding:8px;"></i>
							</div>
							<div class="d-flex w-100">
								<div>En attente de confirmation</div>
								<div class="ml-auto text-grey f-w-600">
									<span data-animation="number" data-value="<?php echo $statsAdmin['res_en_attente'] ?? 0; ?>">0</span>
								</div>
							</div>
						</div>
						<!-- Annulées -->
						<div class="d-flex align-items-center text-white mb-3">
							<div class="widget-list-media icon mr-3">
								<i class="fa fa-times-circle bg-red text-white" style="border-radius:4px; padding:8px;"></i>
							</div>
							<div class="d-flex w-100">
								<div>Réservations annulées</div>
								<div class="ml-auto text-grey f-w-600">
									<span data-animation="number" data-value="<?php echo $statsAdmin['res_annulees'] ?? 0; ?>">0</span>
								</div>
							</div>
						</div>
						<!-- Avis déposés -->
						<div class="d-flex align-items-center text-white mb-3">
							<div class="widget-list-media icon mr-3">
								<i class="fa fa-star bg-orange text-white" style="border-radius:4px; padding:8px;"></i>
							</div>
							<div class="d-flex w-100">
								<div>Avis déposés</div>
								<div class="ml-auto text-grey f-w-600">
									<span data-animation="number" data-value="<?php echo $statsAdmin['total_avis'] ?? 0; ?>">0</span>
								</div>
							</div>
						</div>
						<!-- Demandes propriétaires -->
						<div class="d-flex align-items-center text-white mb-0">
							<div class="widget-list-media icon mr-3">
								<i class="fa fa-user-plus bg-indigo text-white" style="border-radius:4px; padding:8px;"></i>
							</div>
							<div class="d-flex w-100">
								<div>Demandes propriétaires</div>
								<div class="ml-auto text-grey f-w-600">
									<span data-animation="number" data-value="<?php echo $statsAdmin['demandes_proprietaire'] ?? 0; ?>">0</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end col-4 -->

		<!-- begin col-4 : LOGEMENTS LES PLUS RÉSERVÉS -->
		<div class="col-xl-4 col-lg-6 d-flex">
			<div class="card border-0 mb-3 bg-dark text-white w-100">
				<div class="card-body d-flex flex-column">
					<div class="mb-3 text-grey">
						<b>LOGEMENTS LES PLUS RÉSERVÉS</b>
						<span class="ml-2">
							<i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover"
							   data-title="Top logements"
							   data-placement="top"
							   data-content="Les 5 logements ayant reçu le plus de réservations."></i>
						</span>
					</div>
					<div class="flex-grow-1 d-flex flex-column justify-content-between">
						<?php if (!empty($statsAdmin['top_logements'])): ?>
							<?php foreach ($statsAdmin['top_logements'] as $index => $logement): ?>
								<div class="d-flex align-items-center <?php echo $index < count($statsAdmin['top_logements']) - 1 ? 'm-b-15' : ''; ?>">
									<div class="widget-img rounded-lg m-r-10 bg-teal d-flex align-items-center justify-content-center" style="width:40px; height:40px; min-width:40px;">
										<i class="fa fa-home text-white"></i>
									</div>
									<div class="text-truncate">
										<div><?php echo htmlspecialchars($logement['titre'], ENT_QUOTES, 'UTF-8'); ?></div>
										<div class="text-grey"><?php echo number_format($logement['prix'], 0, ',', ' '); ?> FCFA / nuit</div>
									</div>
									<div class="ml-auto text-center">
										<div class="f-s-13"><?php echo $logement['nb_reservations']; ?></div>
										<div class="text-grey f-s-10">rés.</div>
									</div>
								</div>
							<?php endforeach; ?>
						<?php else: ?>
							<div class="text-grey text-center p-t-20 m-auto">
								<i class="fa fa-home fa-2x mb-2"></i>
								<p>Aucune réservation pour le moment.</p>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<!-- end col-4 -->

		<!-- begin col-4 : DEMANDES EN ATTENTE -->
		<div class="col-xl-4 col-lg-6 d-flex">
			<div class="card border-0 mb-3 bg-dark text-white w-100">
				<div class="card-body d-flex flex-column justify-content-between">
					<div class="mb-3 text-grey">
						<b>DEMANDES EN ATTENTE</b>
						<span class="ml-2">
							<i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover"
							   data-title="Demandes en attente"
							   data-placement="top"
							   data-content="Demandes de statut propriétaire en attente de traitement."></i>
						</span>
					</div>

					<!-- begin row : demandes propriétaires -->
					<div class="row align-items-center p-b-1">
						<div class="col-4">
							<div class="height-100 d-flex align-items-center justify-content-center">
								<img src="public/templates/templateAdmin/assets/img/svg/img-2.svg" class="mw-100 mh-100" />
							</div>
						</div>
						<div class="col-8">
							<div class="m-b-2 text-truncate">Demandes propriétaires</div>
							<div class="m-b-2 text-grey f-s-11">À traiter</div>
							<div class="d-flex align-items-center m-b-2">
								<div class="flex-grow-1">
									<div class="progress progress-xs rounded-corner bg-white-transparent-1">
										<div class="progress-bar progress-bar-striped bg-indigo"
											 data-animation="width"
											 data-value="<?php echo min(100, ($statsAdmin['demandes_proprietaire'] ?? 0) * 10); ?>%"
											 style="width: 0%"></div>
									</div>
								</div>
								<div class="ml-2 f-s-11 width-30 text-center">
									<span data-animation="number" data-value="<?php echo $statsAdmin['demandes_proprietaire'] ?? 0; ?>">0</span>
								</div>
							</div>
							<div class="text-grey f-s-11 m-b-15 text-truncate">
								demande(s) en attente
							</div>
							<a href="demande" class="btn btn-xs btn-indigo f-s-10 pl-2 pr-2">Traiter les demandes</a>
						</div>
					</div>
					<!-- end row -->

					<hr class="bg-white-transparent-2 m-t-20 m-b-20" />

					<!-- begin row : utilisateurs ce mois -->
					<div class="row align-items-center">
						<div class="col-4">
							<div class="height-100 d-flex align-items-center justify-content-center">
								<img src="public/templates/templateAdmin/assets/img/svg/img-3.svg" class="mw-100 mh-100" />
							</div>
						</div>
						<div class="col-8">
							<div class="m-b-2 text-truncate">Nouveaux utilisateurs</div>
							<div class="m-b-2 text-grey f-s-11">Ce mois-ci</div>
							<div class="d-flex align-items-center m-b-2">
								<div class="flex-grow-1">
									<div class="progress progress-xs rounded-corner bg-white-transparent-1">
										<div class="progress-bar progress-bar-striped bg-warning"
											 data-animation="width"
											 data-value="<?php echo min(100, ($statsAdmin['nouveaux_clients_mois'] ?? 0) * 5); ?>%"
											 style="width: 0%"></div>
									</div>
								</div>
								<div class="ml-2 f-s-11 width-30 text-center">
									<span data-animation="number" data-value="<?php echo $statsAdmin['nouveaux_clients_mois'] ?? 0; ?>">0</span>
								</div>
							</div>
							<div class="text-grey f-s-11 m-b-15 text-truncate">
								nouveau(x) client(s) inscrit(s)
							</div>
							<a href="utilisateur" class="btn btn-xs btn-warning f-s-10 pl-2 pr-2">Voir les utilisateurs</a>
						</div>
					</div>
					<!-- end row -->

				</div>
			</div>
		</div>
		<!-- end col-4 -->

	</div>
	<!-- end row -->

</div>