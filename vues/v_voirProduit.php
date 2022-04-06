<form class="w-75 m-auto">
    <div class="d-flex bg-white border rounded shadow">
        <img class="m-auto h-100 p-1 col-5 pt-3" src="assets/<?php echo $infoProduit['photo'] ?>" alt="image product">
        <div class="border-start d-flex flex-column justify-content-between pt-3">
            <div class="p-2">
                <h3 class="card-title text-success text-center opacity-75"><?php echo $infoProduit['nom']; ?></h3>
                <div class="w-75 mt-4 mx-auto">
                    <div class="mt-3"><span class="text-decoration-underline">Catégorie</span> : <?php echo $infoProduit['categorie']; ?></div>
                    <div class="mt-3"><span class="text-decoration-underline">Marque</span> : <?php echo $infoProduit['marque']; ?></div>
                </div>
                <div class="w-75 mt-3 mx-auto">
                    <div><span class="text-decoration-underline">Description</span> :</div>
                    <p class="description-product text-start mt-0"><?php echo $infoProduit['description']; ?></p>
                </div>
                <hr class="w-75 mx-auto">
                <p class="text-center">Prix allant de <?php echo $prixMin[0] . '€ à ' . $prixMax[0] . '€'; ?></p>
                <div class="d-flex align-items-center justify-content-center">
                    <select class="form-select border-success fit me-2" id="list-prix" name="list-prix" onchange="checkStock()">
                        <?php
                        foreach (getUniteEtPrix($infoProduit['id']) as $unPrix) {
                            echo '<option id="' . $unPrix['r_qteStock'] . '" value="' . $unPrix[0] . '|' . $unPrix[5] . '">' . $unPrix[1] . '€ - ' . $unPrix[3] . ' ' . $unPrix[4] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div id="cc" class="card-footer d-flex justify-content-center align-items-center">
                <input id="ajoutPanier" class="btn btn-success col-4 me-1" type="submit" value="Ajouter au panier">
                <button class="btn btn-outline-success col-4 ms-1" type="button" onclick="history.go(-1)">Retour</button>
            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        if ($("select").children(":selected").attr("id") > 0) {
            $("select").after(' <div id="minus">-</div> <small id="enStock" class="ms-2 text-success opacity-75">En Stock</small>');
        } else {
            $("select").after(' <div id="minus">-</div> <small id="rupture" class="ms-2 text-danger opacity-75">Rupture de Stock</small>');
            $("#ajoutPanier").attr("disabled", true);
        }
    });
</script>