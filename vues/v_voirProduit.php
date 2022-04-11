<?php if (isset($_SESSION['message'])) {
    echo '<div class="m-auto fit alert alert-danger mb-2">' . $_SESSION['message'] . '</div>';
}
unset($_SESSION['message']) ?>
<form class="w-75 m-auto" method="POST" action="index.php?uc=voirProduits&produit=<?php echo $id ?>&action=ajouterAuPanier">
    <div class="d-flex flex-lg-row flex-column bg-white border rounded shadow">
        <img class="m-auto h-100 p-1 col-5 pt-3" src="assets/<?php echo $infoProduit['photo'] ?>" alt="image product">
        <div class="border-start d-flex flex-column justify-content-between pt-3">
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
                        <select class="form-select border-success rounded fit" id="list-contenance" name="list-contenance" onchange="checkStock(); checkContenance();">
                            <?php
                            foreach ($uniteEtPrix as $unPrix) {
                                echo '<option id="' . $unPrix['r_qteStock'] . '" value="' . $unPrix[5] . '">' . $unPrix[3] . ' ' . $unPrix[4] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="d-flex justify-content-start align-items-center pt-2">
                        <div id="prix" class="text-center me-1"></div>
                    </div>
                    <div class="d-flex w-100 justify-content-center input-group pt-2">
                        <input class="form-control border-success flex-grow-0 fit qte" value="1" type="number" name="quantite" min="1" max="10" id="nbProduit">
                        <input id="ajoutPanier" class="btn btn-success me-1" type="submit" name="ajouter" value="Ajouter au panier">
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
    function checkContenance() {
        const prix = <?php echo json_encode($uniteEtPrix); ?>;
        prix.forEach(checkPrix);
    }

    function checkPrix(item) {
        if ($("select").children(":selected").attr("value") == item[5]) {
            unPrix = item['r_prixVente'];
            $('#prix span').remove();
            $('#prix').prepend('<span class="text-success fw-bold opacity-75" value="' + unPrix + '">' + unPrix + '€');
        }
    }

    $(document).ready(function() {
        if ($("#list-contenance").children(":selected").attr("id") > 0) {
            $("#prix").append('<small id="stock" class="text-success pt-2 opacity-75"> - En Stock</small>');
        } else {
            $("#prix").append('<small id="stock" class="text-danger pt-2 opacity-75"> - Rupture de Stock</small>');
            $("#ajoutPanier").attr("disabled", true);
            $("#nbProduit").attr("disabled", true);
            $("#nbProduit").val("0");
        }
        const prix = <?php echo json_encode($uniteEtPrix); ?>;
        prix.forEach(checkPrix);
    });
    $(function() {
        $(".qte").on("change", function() {
            if (parseInt($(this).val()) > 10) {
                $(this).val(10);
            } else if (parseInt($(this).val()) < 1) {
                $(this).val(1);
            }
        });
    });
</script>