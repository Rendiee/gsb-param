<div id="creationCommande">
<form method="POST" action="index.php?uc=gererPanier&action=confirmerCommande">
   <fieldset>
     <legend>Commande</legend>
		<p>
			<label for="nom">Nom Prénom*</label>
			<input id="nom" type="text" name="nom" value="<?php echo $nom ?>" maxlength="32">
		</p>
		<p>
			<label for="rue">rue*</label>
			 <input id="rue" type="text" name="rue" value="<?php echo $rue ?>" maxlength="32">
		</p>
		<p>
         <label for="cp">code postal* </label>
         <input id="cp" type="text" name="cp" value="<?php echo $cp ?>" maxlength="5">
      </p>
      <p>
         <label for="ville">ville* </label>
         <input id="ville" type="text" name="ville"  value="<?php echo $ville ?>" maxlength="32">
      </p>
      <p>
         <label for="mail">mail* </label>
         <input id="mail" type="text"  name="mail" value="<?php echo $mail ?>" maxlength="50">
      </p> 
	  	<p>
         <input type="submit" value="Valider" name="valider">
         <input type="reset" value="Annuler" name="annuler"> 
      </p>
	  </fieldset>
</form>
</div>





