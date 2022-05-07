<?php if (isset($_SESSION['messageErrorEditProduit'])) { ?>
    <div class="alert alert-danger text-center fit mx-auto message">
        <?php echo $_SESSION['messageErrorEditProduit'];
        // unset($_SESSION['messageErrorEditProduit']); 
        ?>
    </div>
<?php } ?>

<div class="col-10 col-md-8 col-lg-6 col-xl-5 m-auto bg-white px-5 py-4 rounded shadow">
    <div class="mt-md-2 pb-3">
        <h2 class="fw-bold mb-4 text-center">Éditer un produit</h2>
        <form action="index.php?uc=administrer&action=editerProduit" method="POST" id="formEditProduct">
            <div>
                <label class="form-label" for="list-edit-produit">Liste des produits</label>
                <select class="form-select" id="list-edit-produit" name="list-edit-produit" required>
                    <option selected disabled value>- Choisissez un produit -</option>
                    <?php
                    foreach ($lesProduits as $unProduit) {
                    ?>
                        <option value="<?php echo $unProduit['id'] ?>"><?php echo $unProduit['id'] . ' - ' . $unProduit['nom'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="button-form-center mt-3">
                <input class="btn btn-success px-5" type="submit" value="Choisir ce produit" name="chooseproduct" id="chooseproduct">
            </div>
            <div class="button-form-center mt-3">
                <input onclick="return confirm('Êtes vous sûr de vouloir supprimer le produit et toutes ses contenances ?');" class="btn btn-outline-danger px-3" type="submit" value="Supprimer ce produit et ses contenances" name="suppProduit" id="suppProduit">
            </div>
        </form>
    </div>
</div>