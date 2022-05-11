<div class="text-center text-success h3 pb-3">Résumé de votre commande</div>
<div class="border rounded shadow col-12 col-xl-9 p-5 mx-auto">
   <div class="d-flex justify-content-between ">
         <div class="col-6">
            <div class="text-center text-success h4 pb-3">Information de livraison</div>
            <div class="py-2"><span class="fw-bold">Date :</span> <span id="current_date"></span></div>
            <div class="py-2"><span class="fw-bold">Numéro de commande :</span> <?php $id = $idCommande[0]; $id++; echo $id; ?></div>
            <div class="py-2"><span class="fw-bold">Numéro client :</span> <?php echo $_SESSION['u_id'] ?></div>
            <div class="py-2"><span class="fw-bold">Contact client :</span> <?php echo $info['u_email'] ?></div>
            <div class="py-2"><span class="fw-bold">Adresse de livraison :</span> <?php echo $info['u_adresse'] .' '. $info['u_cp'] . ', ' . $info['u_ville'] ?></div>
            <div class="py-2"><span class="fw-bold">Montant total :</span> <?php echo sprintf("%.02f", $total) ?> €</div>
         </div>
         <div class="col-6">
            <div class="text-center text-success h4 pb-3">Produits</div>
            <ul>
               <?php
               foreach ($lesProduitsDuPanier as $produit) {
                  ?>
                     <li><?php echo $produit['nom'] ?></li>
                     <ol class="list-arrow" style="list-style: circle;">
                        <li><?php echo 'Quantité : '.$produit['prix'] ?>€ (<?php echo $produit['contenance'] . ' ' . $produit['unite'] ?>)</li>
                        <li><?php echo 'Quantité : '.$produit['quantite'] ?></li>
                     </ol>
                  <?php
               }
               ?>
            </ul>
         </div>
   </div>
   <form class="pt-4 text-center" action="index.php?uc=gererPanier&action=confirmerCommande" method="POST">
      <input class="btn btn-success" type="submit" name="commander">
   </form>
</div>

<script>
   date = new Date();
   year = date.getFullYear();
   month = date.getMonth() + 1;
   day = date.getDate();
   document.getElementById("current_date").textContent = day + "/" + month + "/" + year;
</script>





