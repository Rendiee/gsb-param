<?php if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
}
unset($_SESSION['message']) ?>
<form class="w-75 m-auto" method="POST" action="index.php?uc=voirProduits&produit=<?php echo $id ?>&action=ajouterAuPanier">
    <div class="d-flex flex-lg-row flex-column bg-white border rounded shadow">
        <div class="p-1 col-lg-5 pt-3 d-flex align-items-center">
            <img class="mx-auto w-100" src="assets/<?php echo $infoProduit['photo'] ?>" alt="image product">
        </div>
        <div class="border-start d-flex flex-column justify-content-between pt-3 col-lg-7">
            <div class="p-2">
                <h3 class="card-title text-success text-center opacity-75"><?php echo $infoProduit['nom']; ?></h3>
                <div class="w-75 mt-4 mx-auto">
                    <div class="name-product mt-3">Produit de la marque <?php echo $infoProduit['marque']; ?> de la catégorie <?php echo $infoProduit['categorie']; ?></div>
                </div>
                <div class="w-75 mt-3 mx-auto">
                    <div><span class="text-decoration-underline">Description</span> :</div>
                    <p class="description-product text-start"><?php echo $infoProduit['description']; ?></p>
                </div>
                <hr class="w-75 mx-auto">
                <div class="d-flex flex-column align-items-start justify-content-center col-md-8 col-12 mx-auto">
                    <div><?php echo $prixMin[0] . '€ - ' . $prixMax[0] . '€' ?></div>
                    <div class="d-flex justify-content-start align-items-center pt-2">
                        <div class="text-center me-1">Contenance : </div>
                        <select class="form-select border-success fit" id="list-contenance" name="list-contenance" onchange="checkStock(); checkContenanceEtQte();">
                            <?php
                            foreach ($uniteEtPrix as $unPrix) {
                                echo '<option id="' . $unPrix['quantite'] . '" value="' . $unPrix[5] . '">' . $unPrix[3] . ' ' . $unPrix[4] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="d-flex justify-content-start align-items-center pt-2">
                        <div id="prix" class="text-center me-1"></div>
                    </div>
                    <div class="d-flex w-100 justify-content-center pt-2">
                        <input id="ajoutPanier" class="btn btn-success rounded-0 rounded-end me-1" type="submit" name="ajouter" value="Ajouter au panier">
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-center align-items-center">
                <button class="btn btn-outline-success col-5 col-xl-4 ms-1" type="button" onclick="location.href='<?php echo $categorieActive; ?>'">Retour</button>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    function checkContenanceEtQte() {
        const prix = <?php echo json_encode($uniteEtPrix); ?>;
        prix.forEach(checkPrix);
        const qte = <?php echo json_encode($uniteEtPrix); ?>;
        qte.forEach(checkQte);
    }
    $(document).ready(function() {
        if ($("#list-contenance").children(":selected").attr("id") > 0) {
            var quantite = $("#list-contenance").children(":selected").attr("id")
            $("#prix").append('<small id="stock" class="text-success pt-2 opacity-75"> - En Stock (' + quantite + ')</small>');
        } else {
            $("#prix").append('<small id="stock" class="text-danger pt-2 opacity-75"> - Rupture de Stock</small>');
            $("#ajoutPanier").attr("disabled", true);
            $("#nbProduit").remove();
        }
        const prix = <?php echo json_encode($uniteEtPrix); ?>;
        prix.forEach(checkPrix);
        const qte = <?php echo json_encode($uniteEtPrix); ?>;
        qte.forEach(checkQte);
    });
</script>