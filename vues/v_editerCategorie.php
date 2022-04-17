<?php if (isset($_SESSION['messageErrorCategorie'])) { ?>
    <div class="alert alert-danger text-center fit mx-auto message">
        <?php echo $_SESSION['messageErrorCategorie']; ?>
    </div>
<?php } elseif (isset($_SESSION['messageSuccessCategorie']) && $_SESSION['countCategorie'] < 2) { ?>
    <div class="alert alert-success text-center fit mx-auto message">
        <?php echo $_SESSION['messageSuccessCategorie']; ?>
    </div>
<?php
    $_SESSION['countCategorie']++;
    if ($_SESSION['countCategorie'] == 2) {
        unset($_SESSION['messageSuccessCategorie']);
    }
} ?>
<div class="col-10 col-md-8 col-lg-6 col-xl-5 m-auto bg-white px-5 py-4 rounded shadow">
    <div class="mt-md-2 pb-3">
        <h2 class="fw-bold mb-4 text-center">Editer une catégorie</h2>
        <form action="index.php?uc=administrer&action=ajouterContenance" method="POST">
        </form>
    </div>
</div>