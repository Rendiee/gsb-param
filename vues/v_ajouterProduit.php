<?php if (isset($_SESSION['messageErrorProduit'])) { ?>
    <div class="alert alert-danger text-center fit mx-auto">
        <?php echo $_SESSION['messageErrorProduit'];
        unset($_SESSION['messageErrorProduit']); ?>
    </div>
<?php
} ?>
<?php if (isset($_SESSION['messageSuccessProduit']) && $_SESSION['countProduit'] < 2) { ?>
    <div class="alert alert-success text-center fit mx-auto">
        <?php echo $_SESSION['messageSuccessProduit']; ?>
    </div>
<?php
    $_SESSION['countProduit']++;
    if ($_SESSION['countProduit'] == 2) {
        unset($_SESSION['messageSuccessProduit']);
    }
} ?>
<div class="col-12 col-lg-11 col-xl-9 m-auto bg-white px-5 py-4 rounded shadow" id="divAjout">
    <small class="text-muted"><span class="text-danger">*</span> Champ(s) facultatif(s)</small>
    <h2 class="fw-bold mb-4 text-center">Ajouter un produit</h2>
    <form action="" method="POST" id="formAjout">
        <div class="fs-4 mb-3 text-center">
            <span>Produit</span>
            <span class="text-decoration-underline">N°<?php echo $maxId['maxId'] + 1 ?></span>
        </div>
        <div class="d-flex align-items-center justify-content-between height350px">
            <div class="d-flex flex-column justify-content-between h-100 col-5">
                <div>
                    <label class="form-label" for="nomproduit">Nom du produit</label>
                    <input required type="text" id="nomproduit" name="nomproduit" class="form-control" />
                </div>
                <div>
                    <label class="form-label" for="descproduit">Description du produit</label>
                    <input required type="text" id="descproduit" name="descproduit" class="form-control" />
                </div>
                <div>
                    <label class="form-label" for="imgproduit">Image du produit</label>
                    <input required type="file" id="imgproduit" name="imgproduit" class="form-control" />
                </div>
                <div>
                    <label class="form-label" for="marqueproduit">Marque du produit</label>
                    <input required type="text" id="marqueproduit" name="marqueproduit" class="form-control" />
                </div>
            </div>
            <div class="vr"></div>
            <div class="d-flex flex-column justify-content-between h-100 col-5">
                <div>
                    <label class="form-label" for="list-marque-produit">Catégorie du produit</label>
                    <select required class="form-select border-success" id="list-marque-produit" name="list-marque-produit">
                        <option disabled selected value="">- Choisissez une catégorie -</option>
                        <?php
                        foreach ($lesCategories as $uneCategorie) {
                        ?>
                            <option value="<?php echo $uneCategorie['ca_id'] ?>"><?php echo $uneCategorie['ca_libelle'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label class="form-label" for="prixproduit">Prix du produit</label>
                        <div class="input-group">
                            <input required type="number" step="0.01" min="0" id="prixproduit" name="prixproduit" class="form-control" value="0" />
                            <span class="input-group-text"><i class="bi bi-currency-euro"></i></span>
                        </div>
                    </div>
                    <div class="col-6">
                        <label class="form-label" for="quantite">Quantité</label><span class="text-danger"> *</span>
                        <input required type="number" id="quantite" name="quantite" class="form-control" value="0" min="0" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label class="form-label" for="list-unite">Unité</label>
                        <select required class="form-select border-success" id="list-unite" name="list-unite">
                            <option disabled selected value="">- Unité -</option>
                            <?php
                            foreach ($lesUnites as $unite) {
                            ?>
                                <option value="<?php echo $unite['un_id'] ?>"><?php echo $unite['un_libelle'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <div id="newUnite" class="link-success text-decoration-underline pointer fit mx-auto">Autre unité</div>
                    </div>
                    <div class="col-6">
                        <label class="form-label" for="list-contenance">Contenance</label>
                        <select required class="form-select border-success" id="list-contenance" name="list-contenance">
                            <option disabled selected value="">- Contenance -</option>
                            <?php
                            foreach ($lesContenances as $contenance) {
                            ?>
                                <option value="<?php echo $contenance['co_contenance'] ?>"><?php echo $contenance['co_contenance'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <div id="newContenance" class="link-success text-decoration-underline pointer fit mx-auto">Autre contenance</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="button-form-center mt-3">
            <input class="btn btn-success px-5" type="submit" value="Ajouter le produit" name="ajouterproduit" id="ajouterproduit">
        </div>
    </form>
</div>

<script type="text/javascript">
    const listeContenance = $("#list-contenance");
    $("#formAjout").on("submit", function(event) {
        $("#emtpyValues").remove();
        if (
            $("input[name='nomproduit']").val() == "" ||
            $("input[name='descproduit']").val() == "" ||
            $("input[name='imgproduit']").val() == "" ||
            $("input[name='marqueproduit']").val() == "" ||
            $("select[name='list-marque-produit']").val() == "" ||
            $("input[name='prixproduit']").val() <= "0" ||
            $("select[name='list-unite']").val() == "" ||
            $("input[name='list-contenance']").val() == ""
        ) {
            $("#divAjout").before(
                '<div id="emtpyValues" class="alert alert-danger mx-auto fit shakeDiv">Veuillez saisir tout les champs ci dessous</div>'
            );
            event.preventDefault();
        }
    });

    $("div").on("blur", "input", function() {
        var element = $(this).attr('class') + "";
        if ($(this).attr('id') == "list-contenance" && $(this).val() <= "0") {
            $(this).addClass("border-danger").removeClass('border-success');
        } else if (($(this).val() == "" || $(this).val() <= "0") && $(this).attr('id') != "quantite" && $(this).attr('id') != "ajouterproduit") {
            if ($(this).parent()[0].lastChild.id == "emptyValue") {
                $(this).parent()[0].lastChild.remove();
            }
            $(this).parent().append('<small class="text-danger emptyValue" id="emptyValue">Champ incorrect</small>');
            $(this).addClass("border-danger").removeClass('border-success');
        } else if ($(this).parent()[0].lastChild.id == "emptyValue" || element.indexOf("border-success") == -1) {
            if ($(this).parent()[0].lastChild.id == "emptyValue") {
                $(this).parent()[0].lastChild.remove();
            }
            $(this).addClass("border-success").removeClass('border-danger');
        }
    });

    $('#newUnite').on("click", function() {
        if ($('#newUnite').text() == "Annuler") {
            $('.new').remove();
            $('#list-unite').attr("disabled", false).attr("required", true);
            $('#list-contenance').attr("disabled", false).attr("required", true)
            $('#newUnite').text("Autre unité").addClass("link-success").removeClass("link-danger");
            $('#newContenance').removeClass("d-none");
        } else {
            $('.new').remove();
            $('#newUnite').parent().parent().append('<div class="col-6 new mt-1"><input required class="form-control border-success" type="text" placeholder="Nom de l\'unité" id="nomUnite" name="nomUnite"></div>');
            $('#newUnite').parent().parent().append('<div class="col-6 new mt-1"><input required class="form-control border-success" type="number" placeholder="Contenance" id="nbContenance" name="nbContenance" min="0"></div>');
            $('#list-unite').prop("selectedIndex", 0).attr("disabled", true).attr("required", false);
            $('#list-contenance').prop("selectedIndex", 0).attr("disabled", true).attr("required", false).removeClass("border-danger");
            $('#newUnite').text("Annuler").addClass("link-danger").removeClass("link-success");
            $('#newContenance').addClass("d-none");
            $('#nomUnite').select();
        }
    });
    $('#newContenance').on("click", function() {
        if ($(this).text() == "Annuler") {
            $("#list-contenance").replaceWith(listeContenance);
            $(this).text('Autre contenance').addClass("link-success").removeClass("link-danger");
        } else {
            $("#list-contenance").replaceWith('<input required type="number" placeholder="Contenance" class="form-control border-success" id="list-contenance" name="list-contenance" min="0">');
            $("#list-contenance").select();
            $(this).text("Annuler").addClass("link-danger").removeClass("link-success");
        }
    });
</script>