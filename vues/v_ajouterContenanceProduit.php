<div class="fit mx-auto bg-white rounded p-5 border shadow">
    <h3 class="text-center mb-5">Ajouter une contenance au produit<br />"<?php echo $produitsContenance[0][1] ?>"</h3>
    <form action="index.php?uc=administrer&action=editerProduit&produit=<?= $id?>&unite=<?= $unité['un_id'] ?>" method="POST">
        <div class="d-flex align-items-center">
            <div class="w-50 me-1">
                <label for="unite">Unité :</label>
                <input disabled class="form-control" name="unite" id="unite" value="<?= $unité['un_libelle'] ?>">
            </div>
            <div class="w-50 ms-1">
                <label for="volume">Volume :</label>
                <input type="text" placeholder="Volume" class="form-control mx-auto" name="volume" id="volume">
            </div>
        </div>
        <div class="d-flex align-items-center mt-2">
            <div class="w-50 me-1">
                <label for="prix">Prix :</label>
                <div class="input-group">
                    <input type="number" name="prix" id="prix" value="0" min="0" step="0.01" class="form-control">
                    <span class="input-group-text"><i class="bi bi-currency-euro"></i></span>
                </div>
            </div>
            <div class="w-50 ms-1">
                <label for="stock">Stock :</label>
                <input type="number" name="stock" id="stock" value="0" min="0" class="form-control">
            </div>
        </div>
        <div class="button-form-center mt-3">
            <input class="btn btn-success px-5" type="submit" value="Ajouter la contenance" name="ajoutContenance" id="ajoutContenance">
        </div>
    </form>
</div>