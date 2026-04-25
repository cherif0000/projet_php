<?php
$pageTitle = 'DakarStay — Découvrez le Sénégal Authentique';
$pageDesc = 'Logements d\'exception et excursions inoubliables au Sénégal.';
$activeNav = 'home';

ob_start();
?>

<!-- ══════════════════════ HERO SECTION ══════════════════════ -->
<section class="hero animate-fade-in">
  <div class="hero-grid">
    <!-- Left side - Image -->
    <div class="hero-image animate-scale-in">
      <img src="https://images.unsplash.com/photo-1497032628192-86f99bcd76bc?w=1920&q=80" alt="Découvrez le Sénégal"
        loading="eager">
    </div>

    <!-- Right side - Content -->
    <div class="hero-content">
      <div>
        <h1 class="hero-title animate-slide-down">
          Voyagez au cœur du Sénégal
        </h1>
        <p class="hero-subtitle animate-slide-up stagger-1">
          Bienvenue sur DakarStay : Un Univers de Réflexion, d'Inspiration et de Découverte.
          Où les mots illuminent les chemins du sens et les pensées révèlent les mystères du voyage.
        </p>
      </div>

      <div class="hero-actions animate-slide-up stagger-2">
        <a href="inscription.php" class="btn btn-primary btn-lg">
          Rejoindre maintenant
        </a>

        <div class="social-links">
          <a href="#" class="social-link" aria-label="Instagram">
            <i class="fab fa-instagram"></i>
          </a>
          <a href="#" class="social-link" aria-label="Facebook">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="#" class="social-link" aria-label="WhatsApp">
            <i class="fab fa-whatsapp"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════════ INTRO SECTION ══════════════════════ -->
<section class="intro animate-fade-in">
  <h2 class="animate-slide-up">
    DakarStay est un espace pour explorer des idées, trouver l'inspiration et découvrir de nouvelles façons de voir le
    Sénégal.
  </h2>
  <p class="animate-slide-up stagger-1">
    Des logements authentiques aux expériences de voyage mémorables, en passant par les découvertes culturelles,
    nous partageons des perspectives qui enrichissent votre séjour. Rejoignez-nous pour explorer des sujets
    qui inspirent la curiosité et créent des conversations significatives.
  </p>
</section>

<!-- ══════════════════════ FEATURED LOGEMENTS ══════════════════════ -->
<section id="logements" class="py-12">
  <div class="section-header animate-slide-up">
    <h2 class="section-title">Logements coup de cœur</h2>
    <a href="login.php" class="section-link">
      Voir tout →
    </a>
  </div>

  <div class="cards-grid">
    <?php
    // Sample data - replace with your database data
    $logements = [
      [
        'id' => '001',
        'titre' => 'Villa Baobab — Vue sur l\'Atlantique',
        'categorie' => 'Villa',
        'adresse' => 'Dakar, Plateau',
        'prix' => 75000,
        'chambres' => 3,
        'bains' => 2,
        'note' => 4.9,
        'avis' => 32,
        'image' => 'https://images.unsplash.com/photo-1582268611958-ebfd161ef9cf?w=1920&q=80',
        'date' => '16 Oct, 2024'
      ],
      [
        'id' => '002',
        'titre' => 'Maison Coloniale face au fleuve',
        'categorie' => 'Appartement',
        'adresse' => 'Saint-Louis',
        'prix' => 45000,
        'chambres' => 2,
        'bains' => 1,
        'note' => 4.7,
        'avis' => 18,
        'image' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1920&q=80',
        'date' => '23 Oct, 2024'
      ],
      [
        'id' => '003',
        'titre' => 'Écolodge en pleine mangrove',
        'categorie' => 'Nature',
        'adresse' => 'Ziguinchor, Casamance',
        'prix' => 55000,
        'chambres' => 1,
        'bains' => 1,
        'note' => 5.0,
        'avis' => 7,
        'image' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=1920&q=80',
        'date' => '4 Dec, 2024'
      ],
      [
        'id' => '004',
        'titre' => 'Suite Luxe au bord de l\'océan',
        'categorie' => 'Villa',
        'adresse' => 'Saly, Mbour',
        'prix' => 95000,
        'chambres' => 4,
        'bains' => 3,
        'note' => 4.8,
        'avis' => 24,
        'image' => 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=1920&q=80',
        'date' => '19 Mar, 2025'
      ],
      [
        'id' => '005',
        'titre' => 'Appartement moderne centre-ville',
        'categorie' => 'Appartement',
        'adresse' => 'Dakar, Almadies',
        'prix' => 65000,
        'chambres' => 2,
        'bains' => 2,
        'note' => 4.6,
        'avis' => 15,
        'image' => 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=1920&q=80',
        'date' => '15 Mar, 2025'
      ],
      [
        'id' => '006',
        'titre' => 'Maison traditionnelle rénovée',
        'categorie' => 'Culture',
        'adresse' => 'Gorée, Dakar',
        'prix' => 85000,
        'chambres' => 3,
        'bains' => 2,
        'note' => 4.9,
        'avis' => 41,
        'image' => 'https://images.unsplash.com/photo-1613553507747-5f8d62ad5904?w=1920&q=80',
        'date' => '10 Mar, 2025'
      ]
    ];

    foreach ($logements as $index => $l):
      $tagClass = 'tag-' . strtolower($l['categorie']);
      ?>
      <a href="login.php" class="card animate-slide-up stagger-<?= min($index + 1, 6) ?>">
        <div class="card-image">
          <img src="<?= htmlspecialchars($l['image']) ?>" alt="<?= htmlspecialchars($l['titre']) ?>" loading="lazy">
          <div class="card-overlay"></div>
          <div class="card-content">
            <div class="card-top">
              <span class="card-tag <?= $tagClass ?>"><?= htmlspecialchars($l['categorie']) ?></span>
              <span class="card-date"><?= htmlspecialchars($l['date']) ?></span>
            </div>
            <div class="card-bottom">
              <span class="card-id"><?= htmlspecialchars($l['id']) ?></span>
              <h3 class="card-title"><?= htmlspecialchars($l['titre']) ?></h3>
            </div>
          </div>
          <div class="card-arrow">
            <i class="fas fa-arrow-up-right"></i>
          </div>
        </div>
      </a>
    <?php endforeach; ?>
  </div>
</section>

<!-- ══════════════════════ NEWSLETTER / CTA SECTION ══════════════════════ -->
<section class="newsletter animate-scale-in">
  <div class="max-w-2xl mx-auto">
    <h2>Restez inspiré.</h2>
    <p>
      Inscrivez-vous pour recevoir nos dernières offres et découvertes directement dans votre boîte mail.
    </p>
    <form class="newsletter-form" action="#" method="POST">
      <input type="email" name="email" class="newsletter-input" placeholder="Votre email" required>
      <button type="submit" class="btn btn-primary">S'abonner</button>
    </form>
  </div>
</section>

<!-- ══════════════════════ EXCURSIONS SECTION ══════════════════════ -->
<section id="excursions" class="py-12">
  <div class="section-header animate-slide-up">
    <h2 class="section-title">Excursions mémorables</h2>
    <a href="login.php" class="section-link">
      Voir tout →
    </a>
  </div>

  <div class="cards-grid">
    <?php
    $excursions = [
      [
        'id' => 'E001',
        'nom' => 'Île de Gorée — Histoire et culture',
        'categorie' => 'Culture',
        'adresse' => 'Dakar',
        'prix' => 25000,
        'duree' => 'Demi-journée',
        'note' => 4.8,
        'image' => 'public/images/ileGoree.jpg',
        'date' => 'Demi-journée'
      ],
      [
        'id' => 'E002',
        'nom' => 'Île de Ngor — Plage et sérénité',
        'categorie' => 'Nature',
        'adresse' => 'Dakar, Ngor',
        'prix' => 15000,
        'duree' => '1 jour',
        'note' => 4.7,
        'image' => 'public/images/ileNgor.jpg',
        'date' => '1 jour'
      ],
      [
        'id' => 'E003',
        'nom' => 'Lac Rose — Merveille naturelle du Sénégal',
        'categorie' => 'Nature',
        'adresse' => 'Retba, Dakar',
        'prix' => 30000,
        'duree' => '1 jour',
        'note' => 4.9,
        'image' => 'public/images/lacRose.jpg',
        'date' => '1 jour'
      ]
    ];

    foreach ($excursions as $index => $e):
      $tagClass = 'tag-' . strtolower($e['categorie']);
      ?>
      <a href="login.php" class="card animate-slide-up stagger-<?= min($index + 1, 6) ?>">
        <div class="card-image">
          <img src="<?= htmlspecialchars($e['image']) ?>" alt="<?= htmlspecialchars($e['nom']) ?>" loading="lazy">
          <div class="card-overlay"></div>
          <div class="card-content">
            <div class="card-top">
              <span class="card-tag <?= $tagClass ?>"><?= htmlspecialchars($e['categorie']) ?></span>
              <span class="card-date"><?= htmlspecialchars($e['duree']) ?></span>
            </div>
            <div class="card-bottom">
              <span class="card-id"><?= htmlspecialchars($e['id']) ?></span>
              <h3 class="card-title"><?= htmlspecialchars($e['nom']) ?></h3>
            </div>
          </div>
          <div class="card-arrow">
            <i class="fas fa-arrow-up-right"></i>
          </div>
        </div>
      </a>
    <?php endforeach; ?>
  </div>
</section>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/layout.php';
?>