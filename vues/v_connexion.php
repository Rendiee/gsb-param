<?php
    if(isset($_POST['connexion'])){
        if(empty($_POST['email'])){
            $userEmpty = "Veuillez saisir votre email !";
        }else if(empty($_POST['password'])){
            $userEmpty = "Veuillez saisir un mot de passe !";
        }else{
            $arr = checkConnexion($_POST['email'], $_POST['password']);
            if(empty($arr)){
                $userEmpty = "Informations incorrectes !";
            }else{
                $_SESSION['u_hab'] = $arr['u_hab'];
                $_SESSION['u_id'] = $arr['u_id'];
                $_SESSION['u_email'] = $arr['u_email'];
                header('Location: index.php?uc=connexion&action=profil');
            }
        }
    }

?>

<div class="container py-2">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card" style="border-radius: 1rem;">
            <div class="card-body p-4">
            <div class="mt-md-2 pb-3">
                <h2 class="fw-bold mb-4 text-center">Connexion</h2>
                <?php if (isset($userEmpty)){echo '<p class="alert alert-danger text-center w-100">'.$userEmpty.'</p>';} ?>
                <form action="index.php?uc=connexion&action=connexion" method="POST">
                    <div class="form-outline form-white mb-4">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control form-control-lg" />
                    </div>
                    <div class="form-outline form-white mb-4">
                        <label class="form-label" for="password">Mot de passe</label>
                        <input type="password" id="password" name="password" class="form-control form-control-lg" />
                    </div>
                    <div class="button-form-center">
                        <input class="btn btn-success px-5" type="submit" value="Connexion" name="connexion">
                    </div>
                </form>
            </div>
            <div>
                <p class="mb-0 text-center">Pas de compte ? <a href="index.php?uc=connexion&action=inscription" class="text-success fw-bold">S'inscrire</a>
                </p>
            </div>

            </div>
        </div>
        </div>
    </div>
</div>