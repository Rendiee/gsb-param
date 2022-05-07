<?php if (isset($_SESSION['messageErrorEditProduit'])) { ?>
    <div class="alert alert-danger text-center fit mx-auto message">
        <?php echo $_SESSION['messageErrorEditProduit'];
        // unset($_SESSION['messageErrorEditProduit']); 
        ?>
    </div>
<?php } ?>

<div class="col-10 col-md-8 col-lg-6 col-xl-5 m-auto bg-white px-5 py-4 rounded shadow">
    <div class="mt-md-2 pb-3">
        <h2 class="fw-bold mb-4 text-center">Choisir une contenance</h2>
        <form action="index.php?uc=administrer&action=editerProduit" method="POST" id="formEditProduct">
            <div>
                <label class="form-label" for="list-edit-produit-contenance">Liste des contenances</label>
                <select class="form-select" id="list-edit-produit-contenance" name="list-edit-produit-contenance" required>
                    <option disabled selected value>- Choisissez une contenance -</option>
                    <?php
                    foreach ($produitsContenance as $prodCont) {
                    ?>
                        <option value="<?php echo $prodCont['id'] . '|' . $prodCont['volume'] . '|' . $prodCont['unId'] ?>"><?php echo $prodCont['id'] . ' - ' . $prodCont['nom'] . ' : ' . $prodCont['volume'] . ' ' . $prodCont['unite'] . ', ' . $prodCont['prix'] . '€' ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="button-form-center mt-3">
                <input class="btn btn-success px-5" type="submit" value="Éditer le produit" name="editproduit" id="editproduit">
            </div>
            <div class="button-form-center mt-3">
                <input class="btn btn-outline-danger px-3 me-1" type="submit" value="Supprimer la contenance" name="suppContenance" id="suppContenance" onclick="return confirm('Voulez-vous vraiment supprimer la contenance ?');">
            </div>
        </form>
    </div>
</div>