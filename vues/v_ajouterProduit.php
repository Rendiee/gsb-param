<div class="col-10 col-md-9 col-lg-7 col-xl-9 m-auto bg-white px-5 py-4 rounded shadow">
    <h2 class="fw-bold mb-4 text-center">Ajouter un produit</h2>
    <p class="alert alert-danger">A FAIRE : Gérer l'insert contenance / produit</p>
    <?php if (isset($errorProduct)) { ?>
        <div class="alert alert-danger text-center w-100">
            <?php echo $errorProduct; ?>
        </div>
    <?php } elseif (isset($successProduct)) { ?>
        <div class="alert alert-success text-center w-100">
            <?php echo $successProduct; ?>
        </div>
    <?php } ?>
    <form action="" method="POST">
        <div class="d-flex align-items-center justify-content-between">
            <div class="col-5">
                <div class="form-outline form-white mb-4">
                    <label class="form-label" for="numproduit">Numéro du produit</label>
                    <input type="number" id="numproduit" name="numproduit" class="form-control" value="<?php echo $maxId['maxId'] + 1 ?>" disabled />
                </div>
                <div class="form-outline form-white mb-4">
                    <label class="form-label" for="nomproduit">Nom du produit</label>
                    <input required type="text" id="nomproduit" name="nomproduit" class="form-control" />
                </div>
                <div class="form-outline form-white mb-4">
                    <label class="form-label" for="descproduit">Description du produit</label>
                    <input required type="text" id="descproduit" name="descproduit" class="form-control" />
                </div>
                <div class="form-outline form-white mb-4">
                    <label class="form-label" for="imgproduit">Image du produit</label>
                    <input required type="file" id="imgproduit" name="imgproduit" class="form-control" />
                </div>
            </div>
            <div class="vr m-1"></div>
            <div class="col-5">
                <div class="form-outline form-white mb-4">
                    <label class="form-label" for="marqueproduit">Marque du produit</label>
                    <input required type="text" id="marqueproduit" name="marqueproduit" class="form-control" />
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-outline form-white mb-4">
                            <label class="form-label" for="unitecontenance">Unité</label>
                            <select class="form-select border-success" id="list-marque-produit" name="list-marque-produit">
                                <option disabled selected value="default">- Unité -</option>
                                    <?php
                                    foreach ($lesUnites as $unite) {
                                    ?>
                                        <option value="<?php echo $unite['un_id'] ?>"><?php echo $unite['un_id'] .' - '. $unite['un_libelle'] ?></option>
                                    <?php
                                    }
                                    ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-outline form-white mb-4">
                            <label class="form-label" for="contenance">Contenance</label>
                            <input type="number" id="contenance" name="contenance" class="form-control" />
                        </div>
                    </div>
                </div>
                <p class="text-muted"><small>Aucune contenance ? <a class="text-success" href="index.php?uc=administrer&action=ajouterContenance">Ajouter une contenance</a></small></p>
                <div class="form-outline form-white mb-4">
                    <label class="form-label" for="list-marque-produit">Catégorie du produit</label>
                    <select class="form-select border-success" id="list-marque-produit" name="list-marque-produit">
                        <option value="default">- Choisissez une catégorie -</option>
                        <?php
                        foreach ($lesCategories as $uneCategorie) {
                        ?>
                            <option value="<?php echo $uneCategorie['ca_id'] ?>"><?php echo $uneCategorie['ca_libelle'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="button-form-center">
            <input class="btn btn-success px-5" type="submit" value="Ajouter le produit" name="ajouterproduit">
        </div>
    </form>
</div>