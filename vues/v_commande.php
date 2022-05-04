<div id="creationCommande" class="d-flex flex-column align-items-center justify-content-center">
   <form method="POST" action="index.php?uc=gererPanier&action=confirmerCommande" class="col-xl-5 col-7 rounded p-3 shadow bg-white">
   <h2 class="fw-bold mb-4 text-center">Commander</h2>		
      <div class="mb-4">
         <label for="nom" class="form-label w-100">Nom</label>
         <input id="nom" class="form-control" type="text" name="nom" value="<?php echo $nom ?>" maxlength="32">
      </div>
      <div class="mb-4">
         <label for="prenom" class="form-label w-100">Prénom</label>
         <input id="prenom" class="form-control" type="text" name="prenom" value="<?php echo $nom ?>" maxlength="32">
      </div>
      <div class="mb-4">
         <label for="rue" class="form-label w-100">Rue</label>
         <input id="rue" class="form-control w-100" type="text" name="rue" value="<?php echo $rue ?>" maxlength="32">
      </div>
      <div class="mb-4">
         <label for="cp" class="form-label w-100">Code postal</label>
         <input id="cp" class="form-control" type="text" name="cp" value="<?php echo $cp ?>" maxlength="5">
      </div>
      <div class="mb-4">
         <label for="ville" class="form-label w-100">Ville</label>
         <input id="ville" class="form-control" type="text" name="ville"  value="<?php echo $ville ?>" maxlength="32">
      </div>
      <div class="mb-4">
         <label for="mail" class="form-label w-100">Email</label>
         <input id="mail" class="form-control" type="text"  name="mail" value="<?php echo $mail ?>" maxlength="50" aria-describedby="emailHelp">
      </div>
      <div class="d-flex justify-content-around">
         <input id="submit" class="btn btn-outline-success" type="submit" value="Valider" name="valider">
         <input class="btn btn-outline-success col-5" type="reset" value="Annuler" name="annuler">
      </div>
   </form>
   <input class="btn btn-success text-light valider col-6 col-sm-5 col-md-4 col-lg-3 mt-3" type="button" onclick="history.go(-1)" value="Retour">
</div>





