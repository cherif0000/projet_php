<div id="sidebar" class="sidebar">
		<!-- begin sidebar scrollbar -->
		<div data-scrollbar="true" data-height="100%">
			<!-- begin sidebar user -->
			<ul class="nav">
				<li class="nav-profile">
					<a href="javascript:;" data-toggle="nav-profile">
						<div class="cover with-shadow"></div>
						<div class="image">
							<img src="public/templates/templateAdmin/assets/img/user/user-13.jpg" alt="" />
						</div>
					</a>
				</li>
			</ul>
			<!-- end sidebar user -->
 
			<!-- begin sidebar nav -->
			<ul class="nav">
				<li class="nav-header">Navigation</li>
 
				<!-- Dashboard (visible par tous) -->
				<li class="has-sub active">
					<a href="admin">
						<i class="fa fa-th-large"></i>
						<span>Dashboard</span>
					</a>
				</li>
 
				<?php if (($_SESSION['role'] ?? '') !== 'proprietaire'): ?>
				<!-- Demande propriétaire (admin seulement) -->
				<li class="has-sub">
					<a href="demande">
						<i class="fa fa-envelope"></i>
						<span>Demande propriétaire</span>
					</a>
				</li>
				<?php endif; ?>
 
				<!-- Logement (visible par tous) -->
				<li class="has-sub">
					<a href="logement">
						<i class="fa fa-hdd"></i>
						<span>Logement</span>
					</a>
				</li>
 
				<!-- Réservations Logement (visible par tous) -->
				<li class="has-sub">
					<a href="reservationLogement">
						<i class="fa fa-envelope"></i>
						<span>Réservations Logement</span>
					</a>
				</li>
 
				<?php if (($_SESSION['role'] ?? '') !== 'proprietaire'): ?>
				<!-- Excursions (admin seulement) -->
				<li class="has-sub">
					<a href="excursion">
						<i class="fa fa-hdd"></i>
						<span>Excursions</span>
					</a>
				</li>
 
				<!-- Réservations Excursions (admin seulement) -->
				<li class="has-sub">
					<a href="reservationExcursion">
						<i class="fa fa-envelope"></i>
						<span>Réservations Excursions</span>
					</a>
				</li>
 
				<!-- Avis Excursions (admin seulement) -->
				<li class="has-sub">
					<a href="avis">
						<i class="fa fa-envelope-open"></i>
						<span>Avis Excursions</span>
					</a>
				</li>
 
				<!-- Utilisateurs (admin seulement) -->
				<li class="has-sub">
					<a href="utilisateur">
						<i class="fa fa-users"></i>
						<span>Utilisateurs</span>
					</a>
				</li>
				<?php endif; ?>
 
				<!-- Déconnexion (visible par tous) -->
				<li class="has-sub">
					<a href="userController?logout=1">
						<i class="fa fa-sign-out-alt"></i>
						<span>Déconnexion</span>
					</a>
				</li>
 
				<!-- begin sidebar minify button -->
				<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
				<!-- end sidebar minify button -->
			</ul>
			<!-- end sidebar nav -->
		</div>
		<!-- end sidebar scrollbar -->
	</div>
	<div class="sidebar-bg"></div>