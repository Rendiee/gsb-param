<div>
    <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="h4 nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab" aria-controls="info" aria-selected="true">Mes informations</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="h4 nav-link" id="commande-tab" data-bs-toggle="tab" data-bs-target="#commande" type="button" role="tab" aria-controls="commande" aria-selected="false">Mes commandes</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="h4 nav-link" id="avis-tab" data-bs-toggle="tab" data-bs-target="#avis" type="button" role="tab" aria-controls="avis" aria-selected="false">Mes avis</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active p-2 mt-3" id="info" role="tabpanel" aria-labelledby="info-tab">
            <div class="d-flex justify-content-between border rounded shadow col-12 col-xl-9 p-5 mx-auto">
                <div class="col-5">
                    <div class="text-success h4">Informations personnelles</div>
                    <div class="d-flex flex-column">
                        <div class="py-2"><span class="fw-bold">Nom :</span> <?php echo $info['u_nom'] ?></div>
                        <div class="py-2"><span class="fw-bold">Prenom :</span> <?php echo $info['u_prenom'] ?></div>
                        <div class="py-2"><span class="fw-bold">Email :</span> <?php echo $info['u_email'] ?></div>
                        <div class="py-2"><span class="fw-bold">Habilitation :</span> <?php echo $info['h_libelle'] ?></div>
                    </div>
                </div>
                <div class="col-5">
                    <div class="text-success h4">Informations de facturation</div>
                    <div class="py-2"><span class="fw-bold">Adresse :</span> <?php echo $info['u_adresse'] ?></div>
                    <div class="py-2"><span class="fw-bold">Ville :</span> <?php echo $info['u_cp'] . ', ' . $info['u_ville'] ?></div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade p-2 mt-3" id="commande" role="tabpanel" aria-labelledby="commande-tab">
            <div class="d-flex flex-column">
                <?php
                if (!empty($commande)) { ?>
                    <?php foreach ($commande as $uneCommande) { ?>
                        <?php if (!isset($idCommande)) {
                            $idCommande = $uneCommande['com_id']; ?>
                            <div class="mx-auto h3">Commande du <?php echo $uneCommande['com_dateComande'] ?> d'un montant de <?php echo $uneCommande['com_totalPrix'] ?>€</div>
                            <div class="row border rounded bg-white justify-content-between shadow">
                                <div class="d-flex align-items-center col-5 my-5">
                                    <img class="thumbnail fit" src="assets/<?php echo $uneCommande['p_photo'] ?>" alt="image product">
                                    <div class="d-flex flex-column">
                                        <div><?php echo $uneCommande['p_nom'] ?></div>
                                        <div><?php echo $uneCommande['p_marque'] ?></div>
                                        <div><?php echo $uneCommande['con_volume'] . ' ' . $uneCommande['un_libelle'] ?></div>
                                        <div><?php echo $uneCommande['con_prixVente'] ?>€</div>
                                        <div>quantité : <?php echo $uneCommande['qte_produit'] ?></div>
                                    </div>
                                </div>
                            <?php } elseif ($idCommande != $uneCommande['com_id']) {
                            $idCommande = $uneCommande['com_id']; ?>
                            </div>
                            <div class="mx-auto h3 mt-5">Commande du <?php echo $uneCommande['com_dateComande'] ?> d'un montant de <?php echo $uneCommande['com_totalPrix'] ?>€</div>
                            <div class="row border rounded bg-white justify-content-between shadow">
                                <div class="d-flex align-items-center col-5 my-5">
                                    <img class="thumbnail fit" src="assets/<?php echo $uneCommande['p_photo'] ?>" alt="image product">
                                    <div class="d-flex flex-column">
                                        <div><?php echo $uneCommande['p_nom'] ?></div>
                                        <div><?php echo $uneCommande['p_marque'] ?></div>
                                        <div><?php echo $uneCommande['con_volume'] . ' ' . $uneCommande['un_libelle'] ?></div>
                                        <div><?php echo $uneCommande['con_prixVente'] ?>€</div>
                                        <div>quantité : <?php echo $uneCommande['qte_produit'] ?></div>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="d-flex align-items-center col-5 my-5">
                                    <img class="thumbnail fit" src="assets/<?php echo $uneCommande['p_photo'] ?>" alt="image product">
                                    <div class="d-flex flex-column">
                                        <div><?php echo $uneCommande['p_nom'] ?></div>
                                        <div><?php echo $uneCommande['p_marque'] ?></div>
                                        <div><?php echo $uneCommande['con_volume'] . ' ' . $uneCommande['un_libelle'] ?></div>
                                        <div><?php echo $uneCommande['con_prixVente'] ?>€</div>
                                        <div>quantité : <?php echo $uneCommande['qte_produit'] ?></div>
                                    </div>
                                </div>

                        <?php }
                    } ?>
                            </div>
                        <?php } else { ?>
                            <div class="mx-auto fit display-2">Oups !</div>
                            <div class="mx-auto fit">Il semblerait qu'il n'y ait aucune commande...</div>
                        <?php } ?>
            </div>
        </div>
        <div class="tab-pane fade p-2 mt-3" id="avis" role="tabpanel" aria-labelledby="avis-tab">...</div>
    </div>
</div>