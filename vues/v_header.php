<!doctype html>
<html lang="fr">

<head>
  <title>Gsb Param</title>
  <meta charset="utf-8">
  <link href="assets/css/cssGeneral.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
  <header>
    <nav id="main_nav" class="navbar navbar-expand-lg navbar-light border-bottom border-3 col-11 m-auto">
      <div class="container">
        <a href="index.php?uc=accueil" class="d-flex align-items-center mb-2 mb-md-0 text-dark text-decoration-none">
          <img src="assets/images/logo-gsb.png" id="img-size-header" alt="GsbLogo" title="GsbLogo" />
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-toggler-success" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="align-self-center collapse navbar-collapse justify-content-end align-items-center" id="navbar-toggler-success">
          <div class="d-flex justify-content-center mx-auto mx-xl-0">
            <ul class="nav mb-2 flex-lg-row flex-column d-flex justify-content-center align-items-center mb-md-0">
              <li><a href="index.php?uc=accueil" class="nav-link link-success rounded-pill px-3 mx-1 fw-bold">Accueil</a></li>
              <li><a href="index.php?uc=voirProduits&action=nosProduits" class="nav-link rounded-pill px-3 mx-1 fw-bold link-dark">Nos produits</a></li>
              <li><a href="index.php?uc=voirProduits&categorie=CH&action=voirProduits" class="nav-link rounded-pill px-3 mx-1 fw-bold link-dark">Produits par catégorie</a></li>
              <li><a href="index.php?uc=gererPanier&action=voirPanier" class="nav-link rounded-pill px-3 mx-1 fw-bold link-dark">Mon panier</a></li>
              <?php if(isset($_SESSION['u_hab'])){ echo '<li><a href="index.php?uc=connexion&action=profil" class="nav-link rounded-pill px-3 mx-1 fw-bold link-dark">Mon profil</a></li>';} ?>
            </ul>
          </div>
          <div class="text-end d-flex flex-row fit m-lg-0 ms-lg-1 mt-lg-0 mt-3 m-auto">
            <?php
              if(isset($_SESSION['u_hab'])){
                ?>
                  <a class="text-decoration-none text-reset" href="index.php?uc=connexion&action=deconnexion"><button type="button" class="btn btn-outline-success" onclick="return confirm('Voulez-vous vraiment vous déconnectez ?')">Déconnexion</button></a>
                <?php
              }else{
                ?>
                  <a class="text-decoration-none text-reset" href="index.php?uc=connexion&action=connexion"><button type="button" class="btn btn-outline-success me-1">Se connecter</button></a>
                  <a class="text-decoration-none text-reset" href="index.php?uc=connexion&action=inscription"><button type="button" class="btn btn-success">S'inscrire</button></a>
              <?php
              }
            ?>
          </div>
        </div>
      </div>
    </nav>
  </header>