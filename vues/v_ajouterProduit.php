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
    if ($_SESSION['countProduit']) {
        unset($_SESSION['messageSuccessProduit']);
    }
} ?>
<div class="col-12 col-lg-11 col-xl-9 m-auto bg-white px-5 py-4 rounded shadow" id="divAjout">
    <small class="text-muted"><span class="text-danger">*</span> Champs obligatoires</small>
    <h2 class="fw-bold mb-4 text-center">Ajouter un produit</h2>
    <form action="" method="POST" id="formAjout">
        <div class="fs-4 mb-3 text-center">
            <span>Produit</span>
            <span class="text-decoration-underline">N°<?php echo $maxId['maxId'] + 1 ?></span>
        </div>
        <div class="d-flex align-items-center justify-content-between height350px">
            <div class="d-flex flex-column justify-content-between h-100 col-5">
                <div>
                    <label class="form-label" for="nomproduit">Nom du produit</label><span class="text-danger"> *</span>
                    <input required type="text" id="nomproduit" name="nomproduit" class="form-control" />
                </div>
                <div>
                    <label class="form-label" for="descproduit">Description du produit</label><span class="text-danger"> *</span>
                    <input required type="text" id="descproduit" name="descproduit" class="form-control" />
                </div>
                <div>
                    <label class="form-label" for="imgproduit">Image du produit</label><span class="text-danger"> *</span>
                    <input required type="file" id="imgproduit" name="imgproduit" class="form-control" />
                </div>
                <div>
                    <label class="form-label" for="marqueproduit">Marque du produit</label><span class="text-danger"> *</span>
                    <input required type="text" id="marqueproduit" name="marqueproduit" class="form-control" />
                </div>
            </div>
            <div class="vr"></div>
            <div class="d-flex flex-column justify-content-between h-100 col-5">
                <div>
                    <label class="form-label" for="list-marque-produit">Catégorie du produit</label><span class="text-danger"> *</span>
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
                        <label class="form-label" for="prixproduit">Prix du produit (€)</label><span class="text-danger"> *</span>
                        <input required type="number" step="0.01" min="0" id="prixproduit" name="prixproduit" class="form-control" value="0" />
                    </div>
                    <div class="col-6">
                        <div>
                            <label class="form-label" for="quantite">Quantité</label>
                            <input required type="number" id="quantite" name="quantite" class="form-control" value="0" min="0" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label class="form-label" for="unitecontenance">Unité</label><span class="text-danger"> *</span>
                        <select required class="form-select border-success" id="list-unite-contenance" name="list-unite-contenance">
                            <option disabled selected value="">- Unité -</option>
                            <?php
                            foreach ($lesUnites as $unite) {
                            ?>
                                <option value="<?php echo $unite['un_id'] ?>"><?php echo $unite['un_libelle'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-6">
                        <div>
                            <label class="form-label" for="contenance">Contenance</label><span class="text-danger"> *</span>
                            <input required type="number" id="contenance" name="contenance" class="form-control" value="0" min="0" />
                        </div>
                    </div>
                    <div class="text-muted mt-2"><small>Aucune contenance ? </small><small><a class="text-success" href="index.php?uc=administrer&action=ajouterContenance">Ajouter une contenance</a></small></div>
                </div>
            </div>
        </div>
        <div class="button-form-center mt-3">
            <input class="btn btn-success px-5" type="submit" value="Ajouter le produit" name="ajouterproduit" id="ajouterproduit">
        </div>
    </form>
</div>

<script type="text/javascript">
    $("#formAjout").on("submit", function(event) {
        $("#emtpyValues").remove();
        if (
            $("input[name='nomproduit']").val() == "" ||
            $("input[name='descproduit']").val() == "" ||
            $("input[name='imgproduit']").val() == "" ||
            $("input[name='marqueproduit']").val() == "" ||
            $("select[name='list-marque-produit']").val() == "" ||
            $("input[name='prixproduit']").val() <= "0" ||
            $("select[name='list-unite-contenance']").val() == "" ||
            $("input[name='contenance']").val() <= "0"
        ) {
            $("#divAjout").before(
                '<div id="emtpyValues" class="alert alert-danger mx-auto fit shakeDiv">Veuillez saisir tout les champs ci dessous</div>'
            );
            event.preventDefault();
        }
    });
    $("input").on("blur", function() {
        var child = $(this).parent()[0].lastChild.id;
        if (($(this).val() == "" || $(this).val() <= "0") && $(this).attr('id') != "quantite" && $(this).attr('id') != "ajouterproduit") {
            if ($(this).parent()[0].lastChild.id == "emptyValue") {
                $(this).parent()[0].lastChild.remove();
            }
            $(this).removeClass("border-danger");
            $(this).parent().append('<small class="text-danger emptyValue" id="emptyValue">Champ incorrect</small>');
            $(this).addClass("border-danger");
        } else if ($(this).parent()[0].lastChild.id == "emptyValue") {
            $(this).parent()[0].lastChild.remove();
            $(this).removeClass("border-danger");
        }
    });
</script>