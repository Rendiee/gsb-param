<div class="col-12 col-lg-11 col-xl-9 m-auto bg-white px-5 py-4 rounded shadow" id="divAjout">
    <small class="text-muted"><span class="text-danger">*</span> Champ(s) facultatif(s)</small>
    <h2 class="fw-bold mb-4 text-center">Éditer un produit</h2>
    <form action="index.php?uc=administrer&action=editerProduit" method="POST" id="formAjout">
        <div class="fs-4 mb-3 text-center">
            <span>Produit</span>
            <span class="text-decoration-underline">N°<?php echo $idProduit ?></span>
        </div>
        <div class="d-flex justify-content-center">
            <img class="mx-auto img-product" src="assets/<?php echo $leProduit['img'] ?>" alt="image product">
        </div>
        <div class="d-flex align-items-center justify-content-between height350px">
            <div class="d-flex flex-column justify-content-around h-100 col-5">
                <div>
                    <label class="form-label" for="nomproduit">Nom du produit</label>
                    <input type="text" id="nomproduit" name="nomproduit" class="form-control" value="<?php echo $leProduit['nom'] ?>" />
                </div>
                <div>
                    <label class="form-label" for="descproduit">Description du produit</label>
                    <input type="text" id="descproduit" name="descproduit" class="form-control" value="<?php echo $leProduit['descr'] ?>" />
                </div>
                <div>
                    <label class="form-label" for="marqueproduit">Marque du produit</label>
                    <input type="text" id="marqueproduit" name="marqueproduit" class="form-control" value="<?php echo $leProduit['marque'] ?>" />
                </div>
            </div>
            <div class="vr"></div>
            <div class="d-flex flex-column justify-content-around h-100 col-5">
                <div>
                    <label class="form-label" for="list-cat-produit">Catégorie du produit</label>
                    <select class="form-select" id="list-cat-produit" name="list-cat-produit">
                        <option disabled value="">- Choisissez une catégorie -</option>
                        <?php
                        foreach ($lesCategories as $uneCategorie) {

                            if ($uneCategorie['ca_id'] == $leProduit['catId']) {
                        ?>
                                <option value="<?php echo $uneCategorie['ca_id'] ?>" selected><?php echo $uneCategorie['ca_libelle'] ?></option>
                            <?php
                            } else {
                            ?>
                                <option value="<?php echo $uneCategorie['ca_id'] ?>"><?php echo $uneCategorie['ca_libelle'] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label class="form-label" for="prixproduit">Prix du produit</label>
                        <div class="input-group">
                            <input type="number" step="0.01" min="0" id="prixproduit" name="prixproduit" class="form-control col-9" value="<?php echo $leProduit['prix'] ?>" />
                            <span class="input-group-text"><i class="bi bi-currency-euro"></i></span>
                        </div>
                    </div>
                    <div class="col-6">
                        <label class="form-label" for="quantite">Stock</label><span class="text-danger"> *</span>
                        <input type="number" id="quantite" name="quantite" class="form-control" value="<?php echo $leProduit['stock'] ?>" min="0" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label class="form-label" for="list-unite">Unité</label>
                        <select class="form-select" id="list-unite" name="list-unite">
                            <option disabled selected value="">- Unité -</option>
                            <?php
                            foreach ($lesUnites as $unite) {

                                if ($unite['un_id'] == $leProduit['unite']) {
                            ?>
                                    <option value="<?php echo $unite['un_id'] ?>" selected><?php echo $unite['un_libelle'] ?></option>
                                <?php
                                } else {
                                ?>
                                    <option value="<?php echo $unite['un_id'] ?>"><?php echo $unite['un_libelle'] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="form-label" for="list-contenance">Contenance</label>
                        <input type="number" placeholder="Contenance" class="form-control" id="list-contenance" name="list-contenance" min="0" value="<?php echo $leProduit['volume'] ?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="button-form-center mt-3">
            <input class="btn btn-success px-3 w-25 ms-1" type="submit" value="Modifier contenance" name="modif-product" id="modif-product">
        </div>
        <div class="button-form-center mt-3">
            <input class="btn btn-success px-5" type="submit" value="Retour" name="modif-product-retour" id="modif-product-retour">
        </div>
    </form>
</div>