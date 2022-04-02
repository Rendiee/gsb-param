<div class="col-10 col-md-8 col-lg-6 col-xl-5 m-auto">
    <div class="card" style="border-radius: 1rem;">
        <div class="card-body p-4">
            <div class="mt-md-2 pb-3">
                <h2 class="fw-bold mb-4 text-center">Connexion</h2>
                <?php if (isset($userEmpty)) { ?>
                    <p class="alert alert-danger text-center w-100">
                        <?php echo $userEmpty; ?>
                    </p>
                <?php } ?>
                <form action="index.php?uc=connexion&action=connexion" method="POST">
                    <div class="form-outline form-white mb-4">
                        <label class="form-label" for="email">Email</label>
                        <input required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" type="email" id="email" name="email" class="form-control form-control-lg" />
                    </div>
                    <div class="form-outline form-white mb-4">
                        <label class="form-label" for="password">Mot de passe</label>
                        <input required type="password" id="password" name="password" class="form-control form-control-lg" />
                    </div>
                    <div class="button-form-center">
                        <input class="btn btn-success px-5" type="submit" value="Connexion" name="connexion">
                    </div>
                </form>
            </div>
            <div>
                <p class="mb-0 text-center">Pas de compte ? <a href="index.php?uc=connexion&action=inscription" class="text-success">S'inscrire</a>
                </p>
            </div>

        </div>
    </div>
</div>