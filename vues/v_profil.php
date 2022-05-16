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
                <?php if (!empty($commande)) { ?>
                    <?php foreach ($commande as $uneCommande) { ?>
                        <?php if (!isset($idCommande)) {
                            $idCommande = $uneCommande['com_id']; ?>
                            <div class="mx-auto h3">Commande du <?php echo $uneCommande['concat_com_dateComande'] ?> d'un montant de <?php echo $uneCommande['com_totalPrix'] ?>€</div>
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
                            <div class="mx-auto h3 mt-5">Commande du <?php echo $uneCommande['concat_com_dateComande'] ?> d'un montant de <?php echo $uneCommande['com_totalPrix'] ?>€</div>
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
                            <div class="mx-auto fit">Il semblerait que vous n'ayez aucune commande...</div>
                        <?php } ?>
            </div>
        </div>
        <div class="tab-pane fade p-2 mt-3" id="avis" role="tabpanel" aria-labelledby="avis-tab">
            <?php if (!empty($avis)) { ?>
                <?php foreach ($avis as $unAvis) { ?>
                    <div class="row border shadow rounded bg-white my-3">
                        <div class="col-3 border-end d-flex flex-column align-items-center justify-content-between py-3">
                            <div class="d-flex align-items-center">
                                <img class="thumbnail" src="assets/<?= $unAvis['p_photo'] ?>" alt="">
                                <div>
                                    <a class="link-success" href="index.php?uc=voirProduits&produit=<?= $unAvis['p_id'] ?>&action=voirLeProduit">
                                        <div><?= $unAvis['p_marque'] ?></div>
                                        <div><?= $unAvis['p_nom'] ?></div>
                                    </a>
                                </div>
                            </div>
                            <div class="fit">
                                <?php for ($i = 1; $i <= 5; $i++) {
                                    if ($i <= $unAvis['a_note']) { ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1.5rem" width="1.5rem" fill="var(--color-star-full, #ea7315)" viewBox="0 0 24 24">
                                            <path d="M12 18.58 5.82 22 7 14.76 2 9.64l6.91-1.06L12 2l3.09 6.58L22 9.64l-5 5.12L18.18 22 12 18.58z" />
                                        </svg>
                                    <?php } else { ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1.5rem" width="1.5rem" fill="var(--color-star-empty, #d3d2d6)" viewBox="0 0 24 24">
                                            <path d="M12 18.58 5.82 22 7 14.76 2 9.64l6.91-1.06L12 2l3.09 6.58L22 9.64l-5 5.12L18.18 22 12 18.58z" />
                                        </svg>
                                <?php }
                                }
                                ?>
                            </div>
                            <div class="fit">Avis déposé le <?= $unAvis['concat_a_date'] ?></div>
                        </div>
                        <div class="col-9 p-4 commentaireHeight">
                            <div>
                                Commentaire
                            </div>
                            <hr class="w-100">
                            <div class="descriptionAvis"><?= $unAvis['a_description'] ?></div>
                        </div>
                    </div>
                <?php } ?>
        </div>
    <?php } else { ?>
        <div class="mx-auto fit display-2">Oups !</div>
        <div class="mx-auto fit">Il semblerait que vous n'ayez aucun avis...</div>
    <?php } ?>
    </div>
</div>
</div>