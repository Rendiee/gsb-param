<div class="fit mx-auto bg-white rounded p-5 border shadow">
    <h3 class="text-center mb-5">Ajouter une contenance au produit<br/>"<?php echo $produitsContenance[0][1] ?>"</h3>
    <form action="index.php?uc=administrer&action=editerProduit" method="POST">
        <select class="form-select fit mx-auto" name="newContenance" id="newContenance" required>
            <option disabled selected value>- Choisissez une contenance -</option>
            <?php
            foreach ($lesUnites as $uneUnite) {
            ?>
                <option value="<?php echo $uneUnite['un_id'] ?>"><?php echo $uneUnite['un_id'] . ' - ' . $uneUnite['un_libelle'] ?></option>
            <?php
            }
            ?>
        </select>
        <input type="text" placeholder="volume de la contenance" class="form-control fit mx-auto my-3">
    </form>
</div>