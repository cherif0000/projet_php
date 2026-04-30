<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inscription — DakarStay</title>

    <!-- Admin template CSS -->
    <link href="public/templates/templateAdmin/assets/css/app.min.css" rel="stylesheet">
    <link href="public/templates/templateAdmin/assets/css/style.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: #1a2035 url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1600&q=80') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
        }
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background: rgba(20, 28, 48, 0.82);
            z-index: 0;
        }
        .register-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 520px;
        }
        .register-card {
            background: #1d2537;
            border-radius: 12px;
            padding: 40px 36px 32px;
            box-shadow: 0 20px 60px rgba(0,0,0,.5);
            border: 1px solid rgba(255,255,255,.07);
        }
        .register-logo {
            text-align: center;
            margin-bottom: 28px;
        }
        .register-logo .brand-icon {
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
        .register-logo h4 {
            color: #fff;
            font-size: 22px;
            font-weight: 700;
            margin: 0 0 4px;
        }
        .register-logo p {
            color: rgba(255,255,255,.45);
            font-size: 13px;
            margin: 0;
        }
        .register-card .form-group {
            margin-bottom: 16px;
        }
        .register-card label {
            color: rgba(255,255,255,.65);
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 7px;
            display: block;
        }
        .register-card .input-group-text {
            background: #252d42;
            border: 1px solid rgba(255,255,255,.1);
            border-right: none;
            color: rgba(255,255,255,.4);
        }
        .register-card .form-control,
        .register-card .form-select {
            background: #252d42;
            border: 1px solid rgba(255,255,255,.1);
            color: #fff;
            font-size: 14px;
            padding: 10px 14px;
        }
        .register-card .form-control:not(.with-icon) {
            border-left: 1px solid rgba(255,255,255,.1);
        }
        .register-card .input-group .form-control {
            border-left: none;
        }
        .register-card .form-control::placeholder {
            color: rgba(255,255,255,.25);
        }
        .register-card .form-control:focus,
        .register-card .form-select:focus {
            background: #2c3654;
            border-color: #348fe2;
            box-shadow: none;
            color: #fff;
        }
        .register-card .form-select option {
            background: #252d42;
            color: #fff;
        }
        .register-card .input-group:focus-within .input-group-text {
            border-color: #348fe2;
        }
        .section-title {
            color: rgba(255,255,255,.3);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin: 22px 0 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .section-title::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(255,255,255,.07);
        }
        .btn-register {
            background: linear-gradient(135deg, #348fe2, #00acac);
            border: none;
            color: #fff;
            font-weight: 600;
            font-size: 14px;
            padding: 12px;
            border-radius: 8px;
            width: 100%;
            letter-spacing: .3px;
            margin-top: 6px;
            transition: opacity .2s;
        }
        .btn-register:hover { opacity: .88; color: #fff; }
        .divider { border-color: rgba(255,255,255,.08); margin: 22px 0; }
        .footer-link {
            text-align: center;
            font-size: 13px;
            color: rgba(255,255,255,.4);
            margin: 0;
        }
        .footer-link a {
            color: #348fe2;
            font-weight: 600;
            text-decoration: none;
        }
        .footer-link a:hover { text-decoration: underline; }
        .form-check-label {
            color: rgba(255,255,255,.45);
            font-size: 13px;
        }
        .form-check-label a { color: #348fe2; text-decoration: none; }
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
        .strength-bar {
            height: 4px;
            border-radius: 4px;
            margin-top: 6px;
            background: rgba(255,255,255,.1);
            overflow: hidden;
        }
        .strength-fill {
            height: 100%;
            width: 0;
            border-radius: 4px;
            transition: width .3s, background .3s;
        }
    </style>
</head>

<body>
    <div class="register-wrapper">
        <div class="register-card">

            <!-- Logo -->
            <div class="register-logo">
                <div class="brand-icon">
                    <i class="fa fa-house-chimney"></i>
                </div>
                <h4>DakarStay</h4>
                <p>Créez votre compte gratuitement</p>
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
            <form method="POST" action="controller/UserController.php" id="registerForm">

                <!-- ── Identité ── -->
                <div class="section-title">Identité</div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Prénom</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                <input type="text" name="prenom" class="form-control" placeholder="Votre prénom" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nom</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                <input type="text" name="nom" class="form-control" placeholder="Votre nom" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ── Contact ── -->
                <div class="section-title">Contact</div>

                <div class="form-group">
                    <label>Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control" placeholder="exemple@email.com" required>
                    </div>
                </div>

                

                <!-- ── Sécurité ── -->
                <div class="section-title">Sécurité</div>

                <div class="form-group">
                    <label>Mot de passe</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Minimum 6 caractères" minlength="6" required oninput="checkStrength(this.value)">
                        <span class="input-group-text" style="border-left:none;cursor:pointer;" onclick="togglePwd('password','eye1')">
                            <i class="fa fa-eye" id="eye1"></i>
                        </span>
                    </div>
                    <div class="strength-bar"><div class="strength-fill" id="strength-fill"></div></div>
                    <small id="strength-label" style="color:rgba(255,255,255,.3);font-size:11px;"></small>
                </div>

                <div class="form-group">
                    <label>Confirmer le mot de passe</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Retapez votre mot de passe" minlength="6" required>
                        <span class="input-group-text" style="border-left:none;cursor:pointer;" onclick="togglePwd('confirm_password','eye2')">
                            <i class="fa fa-eye" id="eye2"></i>
                        </span>
                    </div>
                    <small id="match-label" style="font-size:11px;"></small>
                </div>

                <!-- CGU -->
                <div class="form-check mt-2 mb-3">
                    <input class="form-check-input" type="checkbox" name="conditions" id="conditions" required>
                    <label class="form-check-label" for="conditions">
                        J'accepte les <a href="#">conditions d'utilisation</a> de DakarStay
                    </label>
                </div>

                <button type="submit" name="btnRegister" class="btn-register">
                    <i class="fa fa-user-plus me-2"></i>Créer mon compte
                </button>

            </form>

            <hr class="divider">

            <p class="footer-link">
                Déjà un compte ? <a href="login.php">Se connecter</a>
            </p>

        </div>

        <div class="back-home">
            <a href="index.php"><i class="fa fa-arrow-left me-1"></i>Retour à l'accueil</a>
        </div>
    </div>

    <!-- Admin template JS -->
    <script src="public/templates/templateAdmin/assets/js/app.min.js"></script>

    <script>
        function togglePwd(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon  = document.getElementById(iconId);
            input.type = input.type === 'password' ? 'text' : 'password';
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        }

        function checkStrength(val) {
            const fill  = document.getElementById('strength-fill');
            const label = document.getElementById('strength-label');
            let score = 0;
            if (val.length >= 6)  score++;
            if (val.length >= 10) score++;
            if (/[A-Z]/.test(val)) score++;
            if (/[0-9]/.test(val)) score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;
            const levels = [
                { w:'0%',   c:'transparent', t:'' },
                { w:'25%',  c:'#ff5b57',     t:'Très faible' },
                { w:'45%',  c:'#f59c1a',     t:'Faible' },
                { w:'65%',  c:'#49b6d6',     t:'Moyen' },
                { w:'85%',  c:'#00acac',     t:'Fort' },
                { w:'100%', c:'#348fe2',     t:'Très fort' },
            ];
            const l = levels[score] || levels[0];
            fill.style.width      = l.w;
            fill.style.background = l.c;
            label.textContent     = l.t;
            label.style.color     = l.c;
        }

        document.getElementById('confirm_password').addEventListener('input', function() {
            const pwd   = document.getElementById('password').value;
            const label = document.getElementById('match-label');
            if (this.value === '') { label.textContent = ''; return; }
            if (this.value === pwd) {
                label.textContent = '✓ Les mots de passe correspondent';
                label.style.color = '#00acac';
            } else {
                label.textContent = '✗ Les mots de passe ne correspondent pas';
                label.style.color = '#ff5b57';
            }
        });
    </script>
</body>
</html>