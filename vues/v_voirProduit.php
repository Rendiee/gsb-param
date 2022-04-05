<form>
    <div class="col-xl-4 col-lg-6 col-md-5 col-sm-6 col-8">
        <div class="card m-1">
            <p class="card-title marque-product"><?php echo $infoProduit['marque']; ?></p>
            <div class="name-product title-height"><?php echo $infoProduit['nom']; ?></div>
            <img class="img-product" src="assets/<?php echo $infoProduit['photo'] ?>" alt="image product">
            <p class="card-text description-product"><?php echo $infoProduit['description']; ?></p>
            <div class="card-footer d-flex justify-content-between align-items-center">
                <div class="d-flex flex-column align-items-center">
                    <select class="form-select border-success text-center" id="list-prix" name="list-prix">
                        <?php
                        foreach (getUniteEtPrix($id) as $unPrix) {
                            echo '<option value="' . $unPrix[0] . '|' . $unPrix[5] . '">' . $unPrix[1] . '€ - ' . $unPrix[3] . ' ' . $unPrix[4] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <input class="btn btn-outline-success" type="submit" value="Ajouter">
            </div>
        </div>
    </div>
</form>