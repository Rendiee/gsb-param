<form class="w-75 m-auto">
    <div class="d-flex flex-lg-row flex-column bg-white border rounded shadow">
        <img class="m-auto h-100 p-1 col-5 pt-3" src="assets/<?php echo $infoProduit['photo'] ?>" alt="image product">
        <div class="border-start d-flex flex-column justify-content-between pt-3">
            <div class="p-2">
                <h3 class="card-title text-success text-center opacity-75"><?php echo $infoProduit['nom']; ?></h3>
                <div class="w-75 mt-4 mx-auto">
                    <div class="name-product mt-3">Produit de la marque <?php echo $infoProduit['marque']; ?> de la catégorie <?php echo strtolower($infoProduit['categorie']); ?></div>
                </div>
                <div class="w-75 mt-3 mx-auto">
                    <div><span class="text-decoration-underline">Description</span> :</div>
                    <p class="description-product text-start mt-0"><?php echo $infoProduit['description']; ?></p>
                </div>
                <hr class="w-75 mx-auto">
                <p class="text-center">Prix allant de <?php echo $prixMin[0] . '€ à ' . $prixMax[0] . '€'; ?></p>
                <div class="d-flex flex-xl-row flex-lg-column flex-row align-items-center justify-content-center col-md-8 col-12 mx-auto">
                    <div class="d-flex justify-content-xl-end justify-content-lg-center justify-content-end">
                        <div class="col-md-8 col-xl-9 col-xxl-8">
                            <select class="form-select border-success rounded-0 rounded-start" id="list-prix" name="list-prix" onchange="checkStock()">
                                <?php
                                foreach (getUniteEtPrix($infoProduit['id']) as $unPrix) {
                                    echo '<option id="' . $unPrix['r_qteStock'] . '" value="' . $unPrix[0] . '|' . $unPrix[5] . '">' . $unPrix[1] . '€ - ' . $unPrix[3] . ' ' . $unPrix[4] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-3 col-lg-3 col-xl-4 col-xxl-3"><input class="form-control border-success border-start-0 rounded-0 rounded-end" value="1" type="number" min="1" max="10" id="nbProduit"></div>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-center align-items-center">
                <input id="ajoutPanier" class="btn btn-success col-5 col-xl-4 me-1" type="submit" value="Ajouter au panier">
                <button class="btn btn-outline-success col-5 col-xl-4 ms-1" type="button" onclick="history.go(-1)">Retour</button>
            </div>
        </div>
    </div>
</form>