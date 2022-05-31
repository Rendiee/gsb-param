<div class="h3 text-center">Test 1</div>
<hr>

<!-- CHANGER LE NOM DES CHAMPS POUR LES RECUPERER DANS LE CONTROLEUR -->

<!-- CHANGER L'ACTION DU FORMULAIRE -->

<form action="index.php?uc=connexion&action=connexion" method="POST" id="formConnexion">
    <div>
        <label for="number">Nombre</label>
        <input required type="number" id="nombre" name="nombre"/>
    </div>
    <div>
        <label for="text">Texte</label>
        <input required type="text" id="text" name="text"/>
    </div>
    <div>
        <label for="liste">Liste déroulante</label>
        <select id="list-edit-categorie" name="list-edit-categorie">
            <option selected disabled value="">- Changer le titre -</option>
            <?php

            // CHANGER LE NOM DE LA FONCTION ET DES VALEUS EN FONCTION DU CONTROLEUR

            foreach ($lesCategories as $uneCategorie) {
            ?>
                <option value="<?php echo $uneCategorie['ca_id'] ?>"><?php echo $uneCategorie['ca_id'] . ' - ' . $uneCategorie['ca_libelle'] ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <div>
        <label for="date">Date début</label>
        <input required type="date" id="date-debut" name="date-debut"/>
    </div>
    <div>
        <label for="date">Date fin</label>
        <input required type="date" id="date-fin" name="date-fin"/>
    </div>
    <div>
        <input type="submit" value="Connexion" name="connexion" id="connexion">
    </div>
</form>