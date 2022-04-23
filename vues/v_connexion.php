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
                <form action="index.php?uc=connexion&action=connexion" method="POST" id="formConnexion">
                    <div class="form-outline form-white mb-4">
                        <label class="form-label" for="email">Email</label>
                        <input required type="email" id="email" name="email" class="form-control form-control-lg" placeholder="exemple@exemple.com" <?php if (isset($userInfos)) {
                                                                                                                                                        echo 'value="' . $userInfos . '"';
                                                                                                                                                    } else {
                                                                                                                                                        echo 'autofocus';
                                                                                                                                                    } ?> />
                    </div>
                    <div class="form-outline form-white mb-4">
                        <label class="form-label" for="password">Mot de passe</label>
                        <input required type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Mot de passe" />
                    </div>
                    <div class="button-form-center">
                        <input class="btn btn-success px-5" type="submit" value="Connexion" name="connexion" id="connexion">
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
<script type="text/javascript">
    $("#formConnexion").on("submit", function(event) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        $("#emtpyValues").remove();
        if (
            $("input[name='email']").val() == "" ||
            $("input[name='password']").val() == ""
        ) {
            $("#formConnexion").before(
                '<div id="emtpyValues" class="alert alert-danger mx-auto fit shakeDiv">Veuillez saisir tout les champs</div>'
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
                $(this).parent().append('<small class="text-danger emptyValue" id="emptyValue">Veuillez saisir votre mot de passe</small>');
            } else {
                $(this).parent().append('<small class="text-danger emptyValue" id="emptyValue">Veuillez saisir votre email</small>');
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