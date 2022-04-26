<div class="container py-2">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card rounded">
            <div class="card-body p-4">
            <div class="mt-md-2 pb-3">
                <h2 class="fw-bold mb-4 text-center">Inscription</h2>
                <?php if (isset($userEmpty)){echo '<p class="alert alert-danger text-center w-100">'.$userEmpty.'</p>';} ?>
                <form action="index.php?uc=connexion&action=inscription" method="POST" id="formInscription">
                    <div class="form-outline form-white mb-4">
                        <label class="form-label" for="email">Email</label>
                        <input required type="email" id="email" name="email" class="form-control form-control-lg" placeholder="exemple@exemple.com" />
                    </div>
                    <div class="form-outline form-white mb-4">
                        <label class="form-label" for="password">Mot de passe</label>
                        <input required type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Mot de passe" />
                    </div>
                    <div class="button-form-center">
                        <input class="btn btn-success px-5" type="submit" value="S'inscrire" name="inscription">
                    </div>
                </form>
            </div>
            <div>
                <p class="mb-0 text-center">Déjà un compte ? <a href="index.php?uc=connexion&action=connexion" class="text-success fw-bold">Se connecter</a>
                </p>
            </div>

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
            $("input[name='email']").val() == "" ||
            $("input[name='password']").val() == ""
        ) {
            $("#formInscription").before(
                '<div id="emtpyValues" class="alert alert-danger mx-auto fit shakeDiv">Veuillez renseigner tout les champs</div>'
            );
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
            if ($(this).attr("id") == "password") {
                $(this).parent().append('<small class="text-danger emptyValue" id="emptyValue">Veuillez renseigner un mot de passe</small>');
            } else {
                $(this).parent().append('<small class="text-danger emptyValue" id="emptyValue">Veuillez renseigner un email</small>');
            }
            $(this).addClass("border-danger").removeClass('border-success');
        } else if ($(this).attr("id") == 'email' && !regex.test($(this).val())) {
            $(this).parent().append('<small class="text-danger emptyValue shakeDiv" id="emptyValue">Email non valide</small>');
            $(this).addClass('border-danger');
        } else {
            $(this).addClass("border-success").removeClass('border-danger');
        }
    });
</script>