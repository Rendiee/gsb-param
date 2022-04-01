<div class="container py-2">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card" style="border-radius: 1rem;">
            <div class="card-body p-4">
            <div class="mt-md-2 pb-3">
                <h2 class="fw-bold mb-4 text-center">Inscription</h2>
                <div class="text-black-50 mb-3">Champs obligatoire <span class="text-danger">*</span></div>
                <?php if (isset($userEmpty)){echo '<p class="alert alert-danger text-center w-100">'.$userEmpty.'</p>';} ?>
                <form action="index.php?uc=connexion&action=connexion" method="POST">
                    <div class="form-outline form-white mb-4">
                        <label class="form-label" for="nom">Nom</label>
                        <input type="nom" id="nom" name="nom" class="form-control form-control-lg" />
                    </div>
                    <div class="form-outline form-white mb-4">
                        <label class="form-label" for="prenom">Prénom</label>
                        <input type="prenom" id="prenom" name="prenom" class="form-control form-control-lg" />
                    </div>
                    <div class="form-outline form-white mb-4">
                        <label class="form-label" for="adresse">Adresse</label>
                        <input type="adresse" id="adresse" name="adresse" class="form-control form-control-lg" />
                    </div>
                    <div class="button-form-center">
                        <input class="btn btn-success px-5" type="submit" value="Connexion" name="connexion">
                    </div>
                </form>
            </div>
            <div>
                <p class="mb-0 text-center">Pas de compte ? <a href="#!" class="text-success fw-bold">S'inscrire</a>
                </p>
            </div>

            </div>
        </div>
        </div>
    </div>
</div>