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
    <a href="index.php?uc=gererPanier&action=voirPanier"><button class="btn btn-success mt-4">Voir mon panier</button> </a>
</div>