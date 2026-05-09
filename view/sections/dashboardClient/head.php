<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DakarStay - Logements & Excursions au Sénégal</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Poppins:wght@300;400;500;600;700&family=Raleway:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    :root {
      --accent: #e07b39;
    }

    body {
      font-family: 'Open Sans', sans-serif;
      background: #fff;
    }

    /* ── HEADER ── */
    .site-header {
      background: #fff;
      border-bottom: 1px solid #eee;
      padding: 0 0;
      position: sticky;
      top: 0;
      z-index: 100;
      box-shadow: 0 2px 12px rgba(0,0,0,0.05);
    }

    .header-inner {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 14px 40px;
    }

    .site-logo {
      font-family: 'Raleway', sans-serif;
      font-size: 26px;
      font-weight: 700;
      color: #2d2d2d;
      text-decoration: none;
      letter-spacing: 0.01em;
    }

    .site-logo span { color: var(--accent); }

    .header-nav {
      display: flex;
      gap: 6px;
    }

    .nav-btn {
      font-family: 'Raleway', sans-serif;
      font-size: 14px;
      font-weight: 600;
      letter-spacing: 0.04em;
      text-transform: uppercase;
      padding: 9px 28px;
      border-radius: 4px;
      border: 2px solid transparent;
      cursor: pointer;
      transition: all 0.25s;
      background: none;
      color: #555;
    }

    .nav-btn:hover { color: var(--accent); }

    .nav-btn.active {
      background: var(--accent);
      color: #fff;
      border-color: var(--accent);
    }

    /* ── SECTION TITLE ── */
    .section-title {
      text-align: center;
      padding-bottom: 20px;
    }

    .section-title h2 {
      font-size: 13px;
      letter-spacing: 1px;
      font-weight: 400;
      padding: 0;
      line-height: 1px;
      margin: 0 0 60px 0;
      padding-top: 60px;
      color: #888;
      text-transform: uppercase;
      position: relative;
    }

    .section-title h2::after {
      content: '';
      width: 120px;
      height: 1px;
      display: inline-block;
      background: var(--accent);
      margin: 4px 10px;
    }

    .section-title div {
      margin: 0;
      font-size: 32px;
      font-weight: 700;
      font-family: 'Raleway', sans-serif;
      text-transform: uppercase;
      color: #2d2d2d;
    }

    .section-title .description-title { color: var(--accent); }

    /* ── FILTERS ── */
    .portfolio-filters {
      list-style: none;
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      justify-content: center;
      padding: 0;
      margin-bottom: 30px;
    }

    .portfolio-filters li {
      cursor: pointer;
      padding: 8px 22px;
      font-size: 13px;
      font-weight: 600;
      font-family: 'Raleway', sans-serif;
      letter-spacing: 0.05em;
      text-transform: uppercase;
      border-radius: 4px;
      border: 2px solid #e0e0e0;
      color: #555;
      transition: all 0.25s;
      user-select: none;
    }

    .portfolio-filters li:hover { border-color: var(--accent); color: var(--accent); }

    .portfolio-filters li.filter-active {
      background: var(--accent);
      border-color: var(--accent);
      color: #fff;
    }

    /* ── CARDS ── */
    .portfolio-content {
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(0,0,0,0.08);
      transition: transform 0.3s, box-shadow 0.3s;
      background: #fff;
    }

    .portfolio-content:hover {
      transform: translateY(-6px);
      box-shadow: 0 12px 32px rgba(0,0,0,0.14);
    }

    .portfolio-content a { display: block; overflow: hidden; }

    .logement-img {
      height: 250px;
      object-fit: cover;
      width: 100%;
      transition: transform 0.4s;
    }

    .portfolio-content:hover .logement-img {
      transform: scale(1.06);
    }

    .portfolio-info {
      padding: 18px 20px 20px;
      border-top: 3px solid var(--accent);
    }

    .portfolio-info h4 {
      font-size: 17px;
      font-weight: 700;
      font-family: 'Raleway', sans-serif;
      margin: 0 0 6px;
    }

    .portfolio-info h4 a {
      color: #2d2d2d;
      text-decoration: none;
      transition: color 0.2s;
    }

    .portfolio-info h4 a:hover { color: var(--accent); }

    .portfolio-info p {
      margin: 0;
      font-size: 13.5px;
      color: #777;
    }

    /* ── EXCURSION CARDS ── */
    .exc-badge {
      display: inline-block;
      background: var(--accent);
      color: #fff;
      font-size: 11px;
      font-weight: 600;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      padding: 3px 10px;
      border-radius: 3px;
      margin-bottom: 6px;
    }

    /* ── PANELS ── */
    .panel { display: none; }
    .panel.active { display: block; }

    /* ── FOOTER ── */
    .site-footer {
      background: #2d2d2d;
      color: #aaa;
      text-align: center;
      padding: 28px 20px;
      font-size: 13px;
      margin-top: 60px;
    }

    .site-footer span { color: var(--accent); font-weight: 600; }

    /* hidden cards */
    .portfolio-item.hidden { display: none; }
  </style>
</head>