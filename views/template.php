<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>House Of Beauty</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.2.3/litera/bootstrap.min.css">
  <link rel="stylesheet" href="/public/style.css">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light fixed-top bg-white border-bottom">
  <div class="container">
    <div class="d-flex align-items-center">
      <a class="navbar-brand order-first" href="<?= URL ?>accueil">
        <img src="/public/images/LogoHouseOfBeauty.png" alt="Logo" width="80" class="d-inline-block align-text-top">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-dark" href="<?= URL ?>accueil">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="<?= URL ?>prestations">Prestations</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="<?= URL ?>formation">Formation</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="<?= URL ?>avis">Avis</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="<?= URL ?>contact">Contact</a>
        </li>
      </ul>
      <?php if (isset($_SESSION['Pseudo'])): ?>
        <?php if ($_SESSION['Role'] == 8): ?>
          <a class="text-dark text-decoration-none me-3" href="<?= URL ?>admin">Admin</a>
        <?php endif; ?>
        <div class="btn-group dropdown-end me-3">
          <button type="button" class="btn btn-outline-light text-dark rounded dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            COMPTE
            <img src="https://mdbootstrap.com/img/Photos/Avatars/img (31).jpg" class="rounded-circle ms-2" height="22" alt="" loading="lazy">
          </button>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start bg-light">
            <li><a class="btn btn-light text-dark rounded d-flex justify-content-center" href="">Paramètres</a></li>
            <li><a class="btn btn-light text-dark rounded d-flex justify-content-center" href="<?= URL ?>logout">Déconnexion</a></li>
          </ul>
        </div>
      <?php else: ?>
        <a class="btn btn-outline-light text-dark rounded ms-3" type="button" href="<?= URL ?>connexion">Connexion</a>
      <?php endif; ?>
      <a class="btn btn-outline-light text-dark rounded" type="button" href="houseofbeauty82.booksy.com">RDV en ligne</a>
    </div>
  </div>
</nav>

  <div class="container-fluide">
    <?= $content ?>
  </div>

  <footer class="text-center text-lg-start text-dark pt-5 mt-5" style="bottom: 0;">
    <div class="container p-5 pb-0 ">
      <section class="mb-4">
        <div class="row justify-content-around">
          <div class="col-lg-3 col-md-6 mb-4 mb-md-0 text-center">
            <img class="mb-3" style="height: 80px;" src="/public/images/LogoHouseOfBeauty.png" alt="logo">
            <p>Bienvenue dans notre salon d'esthétique proposant les services d'extensions de cils, d'épilation au fil et d'onglerie dans le dunkerquois.</p>
          </div>

          <div class="col-lg-3 col-md-6 mb-4 mb-md-0 text-center">
            <h6 class="text-uppercase mb-4 font-weight-bold">MENU</h6>
            <ul class="list-unstyled mb-0">
              <li class="nav-item">
          <a class="text-dark text-decoration-none" href="<?= URL ?>accueil">Accueil</a>
          </li>
          <li class="nav-item">
          <a class="text-dark text-decoration-none" href="<?= URL ?>prestations">Prestations</a>
          </li>
          <li class="nav-item">
          <a class="text-dark text-decoration-none" href="<?= URL ?>formation">Formation</a>
          </li>
          <li class="nav-item">
          <a class="text-dark text-decoration-none" href="<?= URL ?>avis">Avis</a>
          </li>
          <li class="nav-item">
          <a class="text-dark text-decoration-none" href="<?= URL ?>contact">Contact</a>
          </li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 mb-4 mb-md-0 text-center">
            <h6 class="text-uppercase mb-4 font-weight-bold">Contact</h6>
            <p></i> Dunkerque, France</p>
            <p><a href="https://twitter.com/TAIIZERR" class="text-dark text-decoration-none">Facebook</a></p>
            <p><a href="https://www.instagram.com/houseeofbeauty_/" class="text-dark text-decoration-none">Instagram</a></p>
            <p></i> +33 6 01 07 52 54</p>
          </div>
        </div>
      </section>

      <hr class="my-3">

      <section class="p-3 pt-0">
        <div class="p-3 text-center text-uppercase">
          © 2022 Tyffaine MAISON - Tous droits réservés
        </div>
      </section>
    </div>
  </footer>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
  <script>
    AOS.init();
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <script src="/public/script.js"></script>
</body>

</html>