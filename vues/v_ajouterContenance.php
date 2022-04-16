<?php if (isset($_SESSION['messageErrorContenance'])) { ?>
    <div class="alert alert-danger text-center fit mx-auto message">
        <?php echo $_SESSION['messageErrorContenance']; ?>
    </div>
<?php } elseif (isset($_SESSION['messageSuccessContenance']) && $_SESSION['countContenance'] < 2) { ?>
    <div class="alert alert-success text-center fit mx-auto message">
        <?php echo $_SESSION['messageSuccessContenance']; ?>
    </div>
<?php
    $_SESSION['countContenance']++;
    if ($_SESSION['countContenance'] == 2) {
        unset($_SESSION['messageSuccessContenance']);
    }
} ?>
<div class="col-10 col-md-8 col-lg-6 col-xl-5 m-auto bg-white px-5 py-4 rounded shadow">
    <div class="mt-md-2 pb-3">
        <h2 class="fw-bold mb-4 text-center">Ajouter une contenance</h2>
        <form action="index.php?uc=administrer&action=ajouterContenance" method="POST">
            <div class="fs-4 mb-4 text-center">
                <span>Contenance</span>
                <span class="text-decoration-underline">N°<?php echo $lastId['idMax'] + 1 ?></span>
            </div>
            <div class="form-outline form-white mb-4">
                <label class="form-label" for="nomcontenance">Nom de la contenance</label>
                <input required type="text" id="nomcontenance" name="nomcontenance" class="form-control form-control-lg" placeholder="Nom" />
            </div>
            <div class="button-form-center">
                <input class="btn btn-success px-5" type="submit" value="Ajouter la contenance" name="ajoutercontenance">
            </div>
        </form>
    </div>
</div>