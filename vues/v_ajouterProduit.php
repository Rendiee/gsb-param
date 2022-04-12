<div class="col-10 col-md-8 col-lg-6 col-xl-5 m-auto">
    <div class="card" style="border-radius: 1rem;">
        <div class="card-body p-4">
            <div class="mt-md-2 pb-3">
                <h2 class="fw-bold mb-4 text-center">Ajouter un produit</h2>
                <p class="alert alert-danger">A FAIRE : Gérer la contenance du produit à ajouter</p>
                <?php if (isset($errorProduct)) { ?>
                    <p class="alert alert-danger text-center w-100">
                        <?php echo $errorProduct; ?>
                    </p>
                <?php } ?>
                <form action="" method="POST">
                    <div class="form-outline form-white mb-4">
                        <label class="form-label" for="email">Numéro du produit</label>
                        <input type="number" id="numproduit" name="numproduit" class="form-control form-control-lg" value="<?php echo $maxId['maxId'] + 1 ?>" disabled />
                    </div>
                    <div class="form-outline form-white mb-4">
                        <label class="form-label" for="nomproduit">Nom du produit</label>
                        <input required type="text" id="nomproduit" name="nomproduit" class="form-control form-control-lg" />
                    </div>
                    <div class="form-outline form-white mb-4">
                        <label class="form-label" for="descproduit">Description du produit</label>
                        <input required type="text" id="descproduit" name="descproduit" class="form-control form-control-lg" />
                    </div>
                    <div class="form-outline form-white mb-4">
                        <label class="form-label" for="imgproduit">Image du produit</label>
                        <input required type="file" id="imgproduit" name="imgproduit" class="form-control form-control-lg" />
                    </div>
                    <div class="form-outline form-white mb-4">
                        <label class="form-label" for="marqueproduit">Marque du produit</label>
                        <input required type="text" id="marqueproduit" name="marqueproduit" class="form-control form-control-lg" />
                    </div>
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
                    <div class="button-form-center">
                        <input class="btn btn-success px-5" type="submit" value="Ajouter le produit" name="ajouterproduit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>