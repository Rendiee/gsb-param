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
                    <p class="description-product text-start mb-0"><?php echo $infoProduit['description']; ?></p>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <?php for ($i = 1; $i <= 5; $i++) {
                        if ($avisMoyen != null && $avisMoyen >= $i) {
                    ?> <svg xmlns="http://www.w3.org/2000/svg" height="1rem" width="1rem" fill="var(--color-star-full, #ea7315)" viewBox="0 0 24 24">
                                <path d="M12 18.58 5.82 22 7 14.76 2 9.64l6.91-1.06L12 2l3.09 6.58L22 9.64l-5 5.12L18.18 22 12 18.58z" />
                            </svg>
                        <?php } else {
                        ?> <svg xmlns="http://www.w3.org/2000/svg" height="1rem" width="1rem" fill="var(--color-star-empty, #d3d2d6)" viewBox="0 0 24 24">
                                <path d="M12 18.58 5.82 22 7 14.76 2 9.64l6.91-1.06L12 2l3.09 6.58L22 9.64l-5 5.12L18.18 22 12 18.58z" />
                            </svg>
                    <?php }
                    }
                    echo '&nbsp<span id="toAvis" class="pointer text-decoration-underline small">' . $nbAvis . ' avis</span>';
                    ?>

                </div>
                <hr class="w-75 mx-auto">
                <div class="d-flex flex-column align-items-start justify-content-center col-md-8 col-12 mx-auto">
                    <div class="d-flex justify-content-start align-items-center pt-2">
                        <div class="text-center me-1">Contenance : </div>
                        <select class="form-select border-success fit" id="list-contenance" name="list-contenance" onchange="checkStock(); checkContenanceEtQte();">
                            <?php
                            foreach ($uniteEtPrix as $unPrix) {
                                echo '<option id="' . $unPrix['quantite'] . '" value="' . $unPrix['volume'] . '">' . $unPrix['volume'] . ' ' . $unPrix['unite'] . '</option>';
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
<?php if ($avis) { ?>
    <div class="w-75 mx-auto">
        <div class="w-100 text-center h2 text-success fw-bold mt-5 mb-3" id="avis">Avis</div>
        <?php foreach ($avis as $unAvis) { ?>
            <div class="d-flex flex-lg-row flex-column bg-white border rounded mb-2">
                <div class="d-flex flex-column justify-content-center col-3 m-3">
                    <?php $infoUtilisateur = getInfoUtilisateurAvis($unAvis['a_id']); ?>
                    <p class="text-center"><?php echo $infoUtilisateur['nom'] . ' ' . $infoUtilisateur['prenom']; ?></p>
                    <div class="d-flex justify-content-center pb-2">
                        <?php for ($i = 1; $i <= 5; $i++) {
                            if ($unAvis['a_note'] != null && $unAvis['a_note'] >= $i) {
                        ?> <svg xmlns="http://www.w3.org/2000/svg" height="1.5rem" width="1.5rem" fill="var(--color-star-full, #ea7315)" viewBox="0 0 24 24">
                                    <path d="M12 18.58 5.82 22 7 14.76 2 9.64l6.91-1.06L12 2l3.09 6.58L22 9.64l-5 5.12L18.18 22 12 18.58z" />
                                </svg>
                            <?php } else {
                            ?> <svg xmlns="http://www.w3.org/2000/svg" height="1.5rem" width="1.5rem" fill="var(--color-star-empty, #d3d2d6)" viewBox="0 0 24 24">
                                    <path d="M12 18.58 5.82 22 7 14.76 2 9.64l6.91-1.06L12 2l3.09 6.58L22 9.64l-5 5.12L18.18 22 12 18.58z" />
                                </svg>
                        <?php }
                        }
                        ?>
                    </div>
                    <small class="text-center">Avis déposé le <strong><?php echo $unAvis['a_date']; ?></strong></small>
                </div>
                <div class="vr col-1"></div>
                <div class="col-8 m-4">
                    <p>Description</p>
                    <hr class="w-100">
                    <p class=""><?php echo $unAvis['a_description'] ?></p>
                    <small><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 447.514 447.514" style="enable-background:new 0 0 447.514 447.514;" xml:space="preserve" width='1rem' height='1rem'>
                            <path d="M389.183,10.118c-3.536-2.215-7.963-2.455-11.718-0.634l-50.653,24.559c-35.906,17.409-77.917,16.884-113.377-1.418
                c-38.094-19.662-83.542-18.72-120.789,2.487V20c0-11.046-8.954-20-20-20s-20,8.954-20,20v407.514c0,11.046,8.954,20,20,20
                s20-8.954,20-20V220.861c37.246-21.207,82.694-22.148,120.789-2.487c35.46,18.302,77.47,18.827,113.377,1.418l56.059-27.18
                c7.336-3.557,11.995-10.993,11.995-19.146V20.385C394.866,16.212,392.719,12.333,389.183,10.118z" />
                        </svg> <span onclick="alert('Qui t\'as permis de signaler cet avis ?')" class="pointer text-decoration-underline">Signaler un abus</span></small>
                </div>
            </div>
    <?php
        }
    }
    ?>
    </div>
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
        $('#toAvis').on("click", function() {
            $('html,body').animate({
                scrollTop: $('#avis').offset().top
            }, 0);
        });
    </script>