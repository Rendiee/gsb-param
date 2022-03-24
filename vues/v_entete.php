<!doctype html>
<html lang="fr">
<head>
    <title>Gsb Param</title>
    <meta charset="utf-8">
    <link href="assets/cssGeneral.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body >
    <div class="container">
      <header>
        <nav id="main_nav" class="navbar navbar-expand-lg navbar-light border-bottom">
          <a href="index.php?uc=accueil" class="d-flex align-items-center mb-2 mb-md-0 text-dark text-decoration-none">
            <img src="images/logo.jpg" id="img-size-header"	alt="GsbLogo" title="GsbLogo"/>
          </a> 
          <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-toggler-success" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="align-self-center collapse navbar-collapse justify-content-end align-items-center" id="navbar-toggler-success">
            <div class="justify-content-center">
              <ul class="nav mb-2 flex-lg-row flex-column d-flex justify-content-center align-items-center mb-md-0">
                <li><a href="index.php?uc=accueil" class="nav-link rounded-pill px-3 mx-1 fw-bold">Accueil</a></li>
                 <li><a href="index.php?uc=voirProduits&action=nosProduits" class="nav-link rounded-pill px-3 mx-1 fw-bold link-dark">Nos produits</a></li>
                 <li><a href="index.php?uc=voirProduits&categorie=CH&action=voirProduits" class="nav-link rounded-pill px-3 mx-1 fw-bold link-dark">Produits par catégorie</a></li>
                 <li><a href="index.php?uc=gererPanier&action=voirPanier" class="nav-link rounded-pill px-3 mx-1 fw-bold link-dark">Voir son panier</a></li>
               </ul>
            </div>
            <div class="text-end d-flex flex-row fit m-lg-0 m-auto">
              <button type="button" class="btn btn-outline-primary me-2 ">Se connecter</button>
              <button type="button" class="btn btn-primary">S'inscrire</button>
            </div>
          </div>
        </nav>
      </header>