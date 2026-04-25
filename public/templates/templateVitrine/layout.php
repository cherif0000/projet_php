<!DOCTYPE html>
<html lang="fr" class="<?= isset($_COOKIE['theme']) && $_COOKIE['theme'] === 'dark' ? 'dark' : '' ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'DakarStay') ?></title>
    <meta name="description"
        content="<?= htmlspecialchars($pageDesc ?? 'Logements d\'exception et excursions inoubliables au Sénégal.') ?>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=DM+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body class="animate-fade-in">

    <!-- Header -->
    <header class="header">
        <div class="header-inner">
            <div class="pill-nav">
                <!-- Logo -->
                <a href="index.php" class="logo">
                    <div class="logo-icon">D</div>
                    <span class="logo-text">DakarStay</span>
                </a>

                <!-- Desktop Navigation -->
                <nav>
                    <ul class="nav-links">
                        <li><a href="index.php" class="<?= ($activeNav ?? '') === 'home' ? 'active' : '' ?>">Accueil</a>
                        </li>
                        <li><a href="index.php#logements"
                                class="<?= ($activeNav ?? '') === 'logements' ? 'active' : '' ?>">Logements</a></li>
                        <li><a href="index.php#excursions"
                                class="<?= ($activeNav ?? '') === 'excursions' ? 'active' : '' ?>">Excursions</a></li>
                        <li><a href="index.php#contact">Contact</a></li>
                    </ul>
                </nav>

                <!-- Actions -->
                <div class="nav-actions">
                    <button class="theme-toggle" id="themeToggle" aria-label="Changer le thème">
                        <svg class="sun-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="4"></circle>
                            <path d="M12 2v2"></path>
                            <path d="M12 20v2"></path>
                            <path d="m4.93 4.93 1.41 1.41"></path>
                            <path d="m17.66 17.66 1.41 1.41"></path>
                            <path d="M2 12h2"></path>
                            <path d="M20 12h2"></path>
                            <path d="m6.34 17.66-1.41 1.41"></path>
                            <path d="m19.07 4.93-1.41 1.41"></path>
                        </svg>
                    </button>

                    <a href="inscription.php" class="btn btn-primary hide-mobile">S'inscrire</a>

                    <!-- Mobile Menu Button -->
                    <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Menu">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="4" x2="20" y1="12" y2="12"></line>
                            <line x1="4" x2="20" y1="6" y2="6"></line>
                            <line x1="4" x2="20" y1="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div class="mobile-menu" id="mobileMenu">
                <nav>
                    <a href="index.php">Accueil</a>
                    <a href="index.php#logements">Logements</a>
                    <a href="index.php#excursions">Excursions</a>
                    <a href="index.php#contact">Contact</a>
                    <a href="login.php">Se connecter</a>
                    <a href="inscription.php" class="btn btn-primary w-full">S'inscrire</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container">
        <?= $content ?? '' ?>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <h3 class="footer-title">Explorer</h3>
                    <ul class="footer-links">
                        <li><a href="index.php#logements">Logements</a></li>
                        <li><a href="index.php#excursions">Excursions</a></li>
                        <li><a href="#">Destinations</a></li>
                        <li><a href="#">Guides locaux</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="footer-title">À propos</h3>
                    <ul class="footer-links">
                        <li><a href="#">Notre histoire</a></li>
                        <li><a href="#">Équipe</a></li>
                        <li><a href="index.php#contact">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="footer-title">Ressources</h3>
                    <ul class="footer-links">
                        <li><a href="#">Guide de voyage</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="footer-title">Légal</h3>
                    <ul class="footer-links">
                        <li><a href="#">Politique de confidentialité</a></li>
                        <li><a href="#">Conditions d'utilisation</a></li>
                        <li><a href="#">CGV</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?= date('Y') ?> DakarStay. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <!-- Message PHP (alerts/notifications) -->
    <?php if (file_exists("public/js/message.php"))
        include("public/js/message.php"); ?>

    <!-- Scripts -->
    <script>
        // Mobile Menu Toggle
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const mobileMenu = document.getElementById('mobileMenu');

        if (mobileMenuToggle && mobileMenu) {
            mobileMenuToggle.addEventListener('click', () => {
                mobileMenu.classList.toggle('active');
            });
        }

        // Theme Toggle
        const themeToggle = document.getElementById('themeToggle');

        if (themeToggle) {
            themeToggle.addEventListener('click', () => {
                document.documentElement.classList.toggle('dark');
                const isDark = document.documentElement.classList.contains('dark');
                document.cookie = `theme=${isDark ? 'dark' : 'light'}; path=/; max-age=31536000`;
            });
        }

        // Animate elements on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -40px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.card, .animate-on-scroll').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(24px)';
            el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            observer.observe(el);
        });
    </script>
</body>

</html>