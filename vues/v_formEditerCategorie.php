<?php if (isset($_SESSION['messageCategorie'])) {
    echo $_SESSION['messageCategorie'];
    unset($_SESSION['messageCategorie']);
} ?>

<div class="col-10 col-md-8 col-lg-6 col-xl-5 m-auto bg-white px-5 py-4 rounded shadow">
    <div class="mt-md-2 pb-3">
        <h2 class="fw-bold mb-4 text-center">Editer une catégorie</h2>
        <form action="index.php?uc=administrer&action=editerCategorie" method="POST">
            <div>
                <label class="form-label" for="list-edit-categorie">Liste des catégories</label>
                <select class="form-select" id="list-edit-categorie" name="list-edit-categorie" required>
                    <option selected disabled value="">- Choisissez une catégorie -</option>
                    <?php
                    foreach ($lesCategories as $uneCategorie) {
                    ?>
                        <option value="<?php echo $uneCategorie['ca_id'] ?>"><?php echo $uneCategorie['ca_id'] . ' - ' . $uneCategorie['ca_libelle'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="button-form-center mt-3">
                <input class="btn btn-success px-5" type="submit" value="Éditer cette catégorie" name="edit-categorie" id="edit-categorie">
            </div>
            <div class="button-form-center mt-3">
                <input class="btn btn-outline-danger px-5" type="submit" value="Supprimer cette catégorie" name="supp-categorie" id="supp-categorie" onclick="return confirm('Voulez-vous vraiment supprimer la catégorie')">
            </div>
        </form>
    </div>
</div>