<div class="col-10 col-md-8 col-lg-6 col-xl-5 m-auto bg-white px-5 py-4 rounded shadow">
    <div class="mt-md-2 pb-3">
        <h2 class="fw-bold mb-4 text-center">Donner un avis</h2>
        <div class="d-flex align-items-center justify-content-center mb-4">
            <img src="assets/<?php echo $infoProduit['photo'] ?>" alt="<?php echo $infoProduit['nom'] ?>" class="thumbnail">
            <div class="d-flex flex-column justify-content-start">
                <div class="small text-success"><?php echo $infoProduit['marque'] ?></div>
                <div class="small text-success"><?php echo $infoProduit['nom'] ?></div>
            </div>
        </div>
        <form action="" method="POST" id="formAvis">
            <div class="d-flex align-items-center justify-content-center">
                <label class="form-label mb-0 me-1" for="note">Note :</label>
                <div class="d-flex w-25">
                    <input type="number" id="note" name="note" class="form-control rounded-0 rounded-start" placeholder="1" max="5" min="1" value="1">
                    <div class="form-control fit border rounded-0 rounded-end">/5</div>
                </div>
            </div>
            <div class="mt-3">
                <label class="form-label" for="commentaire">Commentaire :</label>
                <textarea rows="3" id="commentaire" name="commentaire" class="form-control" style="resize: none;"></textarea>
            </div>
            <div class="button-form-center mt-3">
                <input class="btn btn-success px-5" type="submit" value="Valider" name="valider" id="valider" onclick="return confirm('Voulez-vous enregistrer cet avis')">
                <button class="btn btn-outline-success col-5 col-xl-4 ms-1" type="button" onclick="location.href='index.php?uc=voirProduits&produit=<?php echo $idProduit ?>&action=voirLeProduit'">Retour</button>
            </div>
        </form>
    </div>
</div>
<script>
    $('#note').on('input', function(){
        if($(this).val() <=0 || $(this).val() >5){
            $(this).val('5');
        }
    })
</script>