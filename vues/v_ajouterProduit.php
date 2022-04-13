<p class="alert alert-danger">A FAIRE : Gérer l'insert contenance / produit / prix</p>
<?php if (isset($_SESSION['messageErrorProduit'])) { ?>
    <div class="alert alert-danger text-center fit">
        <?php echo $_SESSION['messageErrorProduit']; ?>
    </div>
<?php } elseif (isset($_SESSION['messageSuccessProduit'])) { ?>
    <div class="alert alert-success text-center fit">
        <?php echo $_SESSION['messageSuccessProduit']; ?>
    </div>
<?php } ?>
<div class="col-10 col-md-9 col-lg-7 col-xl-9 m-auto bg-white px-5 py-4 rounded shadow">
    <h2 class="fw-bold mb-4 text-center">Ajouter un produit</h2>
    <form action="" method="POST">
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
                <div>
                    <label class="form-label" for="prixproduit">Prix du produit (€)</label>
                    <input required type="number" step="0.01" min="0" id="prixproduit" name="prixproduit" class="form-control" />
                </div>
                <div class="row">
                    <div class="col-6">
                        <div>
                            <label class="form-label" for="unitecontenance">Unité</label>
                            <select class="form-select border-success" id="list-unite-contenance" name="list-unite-contenance">
                                <option disabled selected value="default">- Unité -</option>
                                <?php
                                foreach ($lesUnites as $unite) {
                                ?>
                                    <option value="<?php echo $unite['un_id'] ?>"><?php echo $unite['un_id'] . ' - ' . $unite['un_libelle'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div>
                            <label class="form-label" for="contenance">Contenance</label>
                            <input type="number" id="contenance" name="contenance" class="form-control" value="0" />
                        </div>
                    </div>
                    <div class="text-muted mt-2"><small>Aucune contenance ? </small><small><a class="text-success" href="index.php?uc=administrer&action=ajouterContenance">Ajouter une contenance</a></small></div>
                </div>
            </div>
        </div>
        <div class="button-form-center mt-3">
            <input class="btn btn-success px-5" type="submit" value="Ajouter le produit" name="ajouterproduit">
        </div>
    </form>
</div>