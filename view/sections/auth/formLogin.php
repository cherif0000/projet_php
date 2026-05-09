<div class="login login-v2" data-pageload-addclass="animated fadeIn">
		
		<!-- Header -->
		<div class="login-header">
			<div class="brand">
				<span class="logo"></span> 
				<b>Dakar</b>Stay
				<small>Réservez logements & excursions au Sénégal</small>
			</div>
			<div class="icon">
				<i class="fa fa-user"></i>
			</div>
		</div>

		<!-- Form -->
		<div class="login-content">
			<form action="userController" id="loginForm" method="POST" class="margin-bottom-0">
				
				<div class="form-group m-b-20">
					<input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Adresse email" required />
					<p id="error-email"></p>
				</div>
				
				<div class="form-group m-b-20">
					<input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Mot de passe" required />
					<p id="error-password"></p>
				</div>

				<div class="checkbox checkbox-css m-b-20">
					<input type="checkbox" id="remember_checkbox" name="remember" /> 
					<label for="remember_checkbox">
						Se souvenir de moi
					</label>
				</div>

				<div class="login-buttons">
					<button type="submit" id="btnSubmit" class="btn btn-success btn-block btn-lg" name ="frmLogin">
						Se connecter
					</button>
				</div>

				

				<div class="m-t-10 text-center">
					Pas encore de compte ? 
					<a href="inscription.php"><b>Inscrivez-vous</b></a>
				</div>

			</form>
		</div>
	</div>