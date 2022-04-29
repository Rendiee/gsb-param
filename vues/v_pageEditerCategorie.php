<div class="col-10 col-md-8 col-lg-6 col-xl-5 m-auto bg-white px-5 py-4 rounded shadow">
    <div class="mt-md-2 pb-3">
        <h2 class="fw-bold mb-4 text-center">Éditer une catégorie</h2>
        <form action="index.php?uc=administrer&action=editerProduit" method="POST" id="formEditProduct">
            <div class="fs-4 mb-3 text-center">
                <span>Catégorie : </span>
                <span class="text-decoration-underline"><?php echo $lesInfos['ca_libelle'] ?></span>
            </div>
            <div class="d-flex flex-column justify-content-around"> 
                <div class="w-100 mb-4">
                    <label class="form-label" for="nomproduit">Acronyme de la catégorie</label>
                    <input type="text" id="nomproduit" name="nomproduit" class="form-control" value="<?php echo $lesInfos['ca_acronyme']?>"/>
                </div>
                <div class="w-100 mb-4">
                    <label class="form-label" for="nomproduit">Nom de la catégorie</label>
                    <input type="text" id="nomproduit" name="nomproduit" class="form-control" value="<?php echo $lesInfos['ca_libelle']?>"/>
                </div>
            </div>
            <div class="button-form-center mt-3">
                <input class="btn btn-success px-5" type="submit" value="Modifier cette catégorie" name="modif-categorie" id="modif-categorie">
            </div>
            <div class="button-form-center mt-3">
                <input class="btn btn-success px-5" type="submit" value="Retour" name="modif-categorie-retour" id="modif-categorie-retour">
            </div>
        </form>
    </div>
</div>