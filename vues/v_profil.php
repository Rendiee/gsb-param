<div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab" aria-controls="info" aria-selected="true">Mes informations</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="commande-tab" data-bs-toggle="tab" data-bs-target="#commande" type="button" role="tab" aria-controls="commande" aria-selected="false">Mes commandes</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="avis-tab" data-bs-toggle="tab" data-bs-target="#avis" type="button" role="tab" aria-controls="avis" aria-selected="false">Mes avis</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active p-2" id="info" role="tabpanel" aria-labelledby="info-tab">
            <div class="d-flex flex-column align-items-center justify-content-center">
                <div class="border border-secondary rounded p-3 fit">
                    <div class="py-2"><span class="text-decoration-underline fw-bold">Nom :</span class="text-decoration-underline fw-bold"> <?php echo $info['u_nom'] ?></div>
                    <div class="py-2"><span class="text-decoration-underline fw-bold">Prenom :</span class="text-decoration-underline fw-bold"> <?php echo $info['u_prenom'] ?></div>
                    <div class="py-2"><span class="text-decoration-underline fw-bold">Email :</span class="text-decoration-underline fw-bold"> <?php echo $info['u_email'] ?></div>
                    <div class="py-2"><span class="text-decoration-underline fw-bold">Adresse :</span class="text-decoration-underline fw-bold"> <?php echo $info['u_adresse'] ?></div>
                    <div class="py-2"><span class="text-decoration-underline fw-bold">Ville :</span class="text-decoration-underline fw-bold"> <?php echo $info['u_cp'] . ', ' . $info['u_ville'] ?></div>
                    <div class="py-2"><span class="text-decoration-underline fw-bold">Niveau habilitation :</span class="text-decoration-underline fw-bold"> <?php echo $info['h_id'] ?></div>
                    <div class="py-2"><span class="text-decoration-underline fw-bold">Habilitation :</span class="text-decoration-underline fw-bold"> <?php echo $info['h_libelle'] ?></div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade p-2" id="commande" role="tabpanel" aria-labelledby="commande-tab">
            <?php
            if (!empty($commande)) {
                foreach ($commande as $uneCommande) {
                    if (!isset($countProduit)) {
                        $countProduit = 1;
                    }
                    if ($countProduit == 1) { ?>
                        <div>Commande du <?php echo $uneCommande['com_dateComande'] ?></div>
                    <?php } ?>
                    <br />
                    <div class="d-flex flex-column">
                        <div><?php echo $uneCommande['p_nom'] ?></div>
                        <div><?php echo $uneCommande['p_description'] ?></div>
                        <div><?php echo $uneCommande['p_marque'] ?></div>
                        <div><?php echo $uneCommande['con_volume'] . ' ' . $uneCommande['un_libelle'] ?></div>
                        <div><?php echo $uneCommande['con_prixVente'] ?>€</div>
                        <div><?php echo $uneCommande['qte_produit'] ?></div>
                    </div>
                    <?php
                    if ($countProduit == intval($uneCommande['nbProduit'])) {
                        $countProduit = 1;
                    } else {
                        $countProduit++;
                    }
                    ?>
            <?php }
            }else{ ?>
                <div>Aucune commande</div>
            <?php } ?>
        </div>
        <div class="tab-pane fade p-2" id="avis" role="tabpanel" aria-labelledby="avis-tab">...</div>
    </div>
</div>