<div class="login login-v2" data-pageload-addclass="animated fadeIn">
		
	<!-- Header -->
	<div class="login-header">
		<div class="brand">
			<span class="logo"></span> 
			<b>Dakar</b>Stay
			<small>Créez votre compte</small>
		</div>
		<div class="icon">
			<i class="fa fa-user-plus"></i>
		</div>
	</div>

	<!-- Form -->
	<div class="login-content">
		<form action="userController" id="registerForm" method="POST" class="margin-bottom-0">
			
			<div class="form-group m-b-20">
				<input type="text" id="nom" name="nom" class="form-control form-control-lg" placeholder="Nom complet" required />
				<p id="error-nom"></p>
			</div>

			<div class="form-group m-b-20">
				<input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Adresse email" required />
				<p id="error-email"></p>
			</div>
			
			<div class="form-group m-b-20">
				<input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Mot de passe" required />
				<p id="error-password"></p>
			</div>

			<div class="form-group m-b-20">
				<input type="password" id="confirmPassword" name="confirmPassword" class="form-control form-control-lg" placeholder="Confirmer le mot de passe" required />
				<p id="error-confirmPassword"></p>
			</div>

			<div class="checkbox checkbox-css m-b-20">
				<input type="checkbox" id="terms_checkbox" required /> 
				<label for="terms_checkbox">
					J'accepte les <a href="#">conditions d'utilisation</a>
				</label>
			</div>

			<div class="login-buttons">
				<button type="submit" id="btnSubmit" class="btn btn-success btn-block btn-lg" name="frmRegister">
					S'inscrire
				</button>
			</div>

			<div class="m-t-20 text-center">
				Déjà un compte ? 
				<a href="login"><b>Se connecter</b></a>
			</div>

		</form>
	</div>
</div>