<?php if (isset($_SESSION['erreurInscription'])) { ?>
    <div class="alert alert-danger text-center fit mx-auto">
        <?php echo $_SESSION['erreurInscription']; ?>
    </div>
<?php
    $_SESSION['countInscription']++;
} ?>
<?php if (isset($_SESSION['successInscription'])) { ?>
    <div class="alert alert-success text-center fit mx-auto">
        <?php echo $_SESSION['successInscription']; ?>
    </div>

<?php
    $_SESSION['countInscription']++;
}
if (isset($_SESSION['countInscription']) && $_SESSION['countInscription'] >= 2) {
    unset($_SESSION['successInscription']);
    unset($_SESSION['erreurInscription']);
    unset($_SESSION['countInscription']);
} ?>
<div class="col-10 col-md-8 col-lg-6 col-xl-5 m-auto">
    <div class="card rounded">
        <div class="card-body p-4">
            <div class="mt-md-2 pb-3">
                <h2 class="fw-bold mb-4 text-center">Inscription</h2>
                <form action="index.php?uc=connexion&action=inscription" method="POST" id="formInscription">
                    <div class="form-outline form-white mb-4">
                        <label class="form-label" for="nom">Nom</label>
                        <input required type="text" id="nom" name="nom" class="form-control form-control-lg" placeholder="Nom" />
                    </div>
                    <div class="form-outline form-white mb-4">
                        <label class="form-label" for="prenom">Prénom</label>
                        <input required type="text" id="prenom" name="prenom" class="form-control form-control-lg" placeholder="Prénom" />
                    </div>
                    <div class="form-outline form-white mb-4">
                        <label class="form-label" for="email">Email</label>
                        <input required type="email" id="email" name="email" class="form-control form-control-lg" placeholder="exemple@exemple.com" />
                    </div>
                    <div class="form-outline form-white mb-4">
                        <label class="form-label" for="adresse">Adresse</label>
                        <input required type="text" id="adresse" name="adresse" class="form-control form-control-lg" placeholder="Adresse" />
                    </div>
                    <div class="form-outline form-white mb-4">
                        <label class="form-label" for="cp">Code Postal</label>
                        <input required type="text" id="cp" name="cp" class="form-control form-control-lg" placeholder="Code Postal" />
                    </div>
                    <div class="form-outline form-white mb-4">
                        <label class="form-label" for="ville">Ville</label>
                        <input required type="text" id="ville" name="ville" class="form-control form-control-lg" placeholder="Ville" />
                    </div>
                    <div class="form-outline form-white mb-4">
                        <label class="form-label" for="password">Mot de passe</label>
                        <input required type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Mot de passe" />
                    </div>
                    <div class="button-form-center">
                        <input required class="btn btn-success px-5" type="submit" value="S'inscrire" name="inscription">
                    </div>
                </form>
            </div>
            <div>
                <p class="mb-0 text-center">Déjà un compte ? <a href="index.php?uc=connexion&action=connexion" class="text-success">Se connecter</a></p>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    $("#formInscription").on("submit", function(event) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        $("#emtpyValues").remove();
        if (
            $("input").attr("name") != "email" &&
            $("input").val() == ""
        ) {
            $("#formInscription").before(
                '<div id="emtpyValues" class="alert alert-danger mx-auto fit shakeDiv">Veuillez renseigner tout les champs</div>'
            );
            $('html,body').animate({
                scrollTop: 0
            }, 0);
            event.preventDefault();
        } else if (!regex.test($("input[name='email']").val())) {
            $("input[name='email']").parent()[0].lastChild.remove();
            $("input[name='email']").parent().append('<small class="text-danger emptyValue shakeDiv" id="emptyValue">Email non valide</small>');
            $("input[name='email']").addClass('border-danger');
            event.preventDefault();
        }
    });
    $("input").on("blur", function() {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if ($(this).parent()[0].lastChild.id == "emptyValue") {
            $(this).parent()[0].lastChild.remove();
        }
        if ($(this).val() == "") {
            $(this).parent().append('<small class="text-danger emptyValue" id="emptyValue">Veuillez renseigner ce champ correctement</small>');
            $(this).addClass("border-danger").removeClass('border-success');
        } else if ($(this).attr("id") == 'email' && !regex.test($(this).val())) {
            if ($(this).parent()[0].lastChild.id == "emptyValue") {
                $(this).parent()[0].lastChild.remove();
            }
            $(this).parent().append('<small class="text-danger emptyValue shakeDiv" id="emptyValue">Email non valide</small>');
            $(this).addClass('border-danger');
        } else {
            $(this).addClass("border-success").removeClass('border-danger');
            if ($(this).parent()[0].lastChild.id == "emptyValue") {
                $(this).parent()[0].lastChild.remove();
            }
        }
    });
    $("input").on("input", function() {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if ($(this).parent()[0].lastChild.id == "emptyValue") {
            $(this).parent()[0].lastChild.remove();
        }
        if ($(this).val() == "") {
            $(this).parent().append('<small class="text-danger emptyValue" id="emptyValue">Veuillez renseigner ce champ correctement</small>');
            $(this).addClass("border-danger").removeClass('border-success');
        } else if ($(this).attr("id") == 'email' && !regex.test($(this).val())) {
            if ($(this).parent()[0].lastChild.id == "emptyValue") {
                $(this).parent()[0].lastChild.remove();
            }
            $(this).parent().append('<small class="text-danger emptyValue shakeDiv" id="emptyValue">Email non valide</small>');
            $(this).addClass('border-danger');
        } else {
            $(this).addClass("border-success").removeClass('border-danger');
            if ($(this).parent()[0].lastChild.id == "emptyValue") {
                $(this).parent()[0].lastChild.remove();
            }
        }
    });
</script>