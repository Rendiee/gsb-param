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
                header('Location: index.php?uc=connexion&action=profil');
            }
        }
    }

?>

<div class="container py-2">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card" style="border-radius: 1rem;">
            <div class="card-body p-4 text-center">

            <div class="mb-md-5 mt-md-2 pb-3">
                <h2 class="fw-bold mb-2 text-uppercase">Connexion</h2>
                <?php if (isset($userEmpty)){echo '<p class="alert alert-danger text-center w-100">'.$userEmpty.'</p>';} ?>
                <div class="form-outline form-white mb-4">
                <label class="form-label" for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control form-control-lg" />
                </div>

                <div class="form-outline form-white mb-4">
                <label class="form-label" for="password">Mot de passe</label>
                <input type="password" id="password" name="password" class="form-control form-control-lg" />
                </div>

                <input class="btn btn-success px-5" type="submit" value="Connexion" name="connexion"> 

            </div>
            <div>
                <p class="mb-0">Pas de compte ? <a href="#!" class="text-success fw-bold">S'inscrire</a>
                </p>
            </div>

            </div>
        </div>
        </div>
    </div>
</div>