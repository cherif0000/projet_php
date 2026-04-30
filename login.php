?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion — DakarStay</title>

    <!-- Admin template CSS -->
    <link href="public/templates/templateAdmin/assets/css/app.min.css" rel="stylesheet">
    <link href="public/templates/templateAdmin/assets/css/style.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: #1a2035 url('https://images.unsplash.com/photo-1580060839134-75a5edca2e99?auto=format&fit=crop&w=1600&q=80') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background: rgba(20, 28, 48, 0.82);
            z-index: 0;
        }
        .login-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 420px;
            padding: 16px;
        }
        .login-card {
            background: #1d2537;
            border-radius: 12px;
            padding: 40px 36px 32px;
            box-shadow: 0 20px 60px rgba(0,0,0,.5);
            border: 1px solid rgba(255,255,255,.07);
        }
        .login-logo {
            text-align: center;
            margin-bottom: 28px;
        }
        .login-logo .brand-icon {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, #348fe2, #00acac);
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: #fff;
            margin-bottom: 14px;
            box-shadow: 0 8px 24px rgba(52,143,226,.35);
        }
        .login-logo h4 {
            color: #fff;
            font-size: 22px;
            font-weight: 700;
            margin: 0 0 4px;
            letter-spacing: .3px;
        }
        .login-logo p {
            color: rgba(255,255,255,.45);
            font-size: 13px;
            margin: 0;
        }
        .login-card .form-group {
            margin-bottom: 18px;
        }
        .login-card label {
            color: rgba(255,255,255,.65);
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 7px;
            display: block;
        }
        .login-card .input-group-text {
            background: #252d42;
            border: 1px solid rgba(255,255,255,.1);
            border-right: none;
            color: rgba(255,255,255,.4);
        }
        .login-card .form-control {
            background: #252d42;
            border: 1px solid rgba(255,255,255,.1);
            border-left: none;
            color: #fff;
            font-size: 14px;
            padding: 10px 14px;
        }
        .login-card .form-control::placeholder {
            color: rgba(255,255,255,.25);
        }
        .login-card .form-control:focus {
            background: #2c3654;
            border-color: #348fe2;
            box-shadow: none;
            color: #fff;
        }
        .login-card .form-control:focus + .input-group-text,
        .login-card .input-group:focus-within .input-group-text {
            border-color: #348fe2;
        }
        .btn-login {
            background: linear-gradient(135deg, #348fe2, #00acac);
            border: none;
            color: #fff;
            font-weight: 600;
            font-size: 14px;
            padding: 12px;
            border-radius: 8px;
            width: 100%;
            letter-spacing: .3px;
            transition: opacity .2s;
        }
        .btn-login:hover {
            opacity: .88;
            color: #fff;
        }
        .login-divider {
            border-color: rgba(255,255,255,.08);
            margin: 22px 0;
        }
        .login-footer-link {
            text-align: center;
            font-size: 13px;
            color: rgba(255,255,255,.4);
            margin: 0;
        }
        .login-footer-link a {
            color: #348fe2;
            font-weight: 600;
            text-decoration: none;
        }
        .login-footer-link a:hover { text-decoration: underline; }
        .remember-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 22px;
        }
        .remember-row label {
            color: rgba(255,255,255,.45);
            font-size: 13px;
            margin: 0;
            cursor: pointer;
        }
        .remember-row a {
            color: rgba(255,255,255,.45);
            font-size: 13px;
            text-decoration: none;
        }
        .remember-row a:hover { color: #348fe2; }

        /* Flash message */
        .flash-msg {
            border-radius: 8px;
            font-size: 13px;
            padding: 10px 14px;
            margin-bottom: 18px;
        }
        .back-home {
            text-align: center;
            margin-top: 20px;
        }
        .back-home a {
            color: rgba(255,255,255,.3);
            font-size: 12px;
            text-decoration: none;
        }
        .back-home a:hover { color: rgba(255,255,255,.6); }
    </style>
</head>

<body>
    <div class="login-wrapper">
        <div class="login-card">

            <!-- Logo -->
            <div class="login-logo">
                <div class="brand-icon">
                    <i class="fa fa-house-chimney"></i>
                </div>
                <h4>DakarStay</h4>
                <p>Connectez-vous à votre espace</p>
            </div>

            <!-- Flash message -->
            <?php if (isset($_SESSION['message'])): ?>
                <?php
                    $type = $_SESSION['message_type'] ?? 'info';
                    $cls  = ['success'=>'success','error'=>'danger','warning'=>'warning'][$type] ?? 'info';
                ?>
                <div class="alert alert-<?= $cls ?> flash-msg">
                    <i class="fa fa-circle-info me-1"></i>
                    <?= htmlspecialchars($_SESSION['message']) ?>
                </div>
                <?php unset($_SESSION['message'], $_SESSION['message_type']); ?>
            <?php endif; ?>

            <!-- Formulaire -->
            <form method="POST" action="controller/UserController.php">

                <div class="form-group">
                    <label>Adresse email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control" placeholder="exemple@email.com" required autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label>Mot de passe</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Votre mot de passe" required>
                        <span class="input-group-text" style="border-left:none;cursor:pointer;" onclick="togglePwd()">
                            <i class="fa fa-eye" id="eye-icon"></i>
                        </span>
                    </div>
                </div>

                <div class="remember-row">
                    <div class="form-check m-0">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember">Se souvenir de moi</label>
                    </div>
                    <a href="#">Mot de passe oublié ?</a>
                </div>

                <button type="submit" name="btnLogin" class="btn-login">
                    <i class="fa fa-right-to-bracket me-2"></i>Se connecter
                </button>

            </form>

            <hr class="login-divider">

            <p class="login-footer-link">
                Pas encore de compte ? <a href="inscription.php">Créer un compte</a>
            </p>

        </div>

        <div class="back-home">
            <a href="index.php"><i class="fa fa-arrow-left me-1"></i>Retour à l'accueil</a>
        </div>
    </div>

    <!-- Admin template JS -->
    <script src="public/templates/templateAdmin/assets/js/app.min.js"></script>

    <script>
        function togglePwd() {
            const input = document.getElementById('password');
            const icon  = document.getElementById('eye-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
</body>
</html>