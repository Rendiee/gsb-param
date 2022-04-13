<div class="col-10 col-md-8 col-lg-6 col-xl-5 m-auto">
    <div class="card" style="border-radius: 1rem;">
        <div class="card-body p-4">
            <div class="mt-md-2 pb-3">
                <h2 class="fw-bold mb-4 text-center">Ajouter une contenance</h2>
                <?php if (isset($_SESSION['messageError'])) { ?>
                <div class="alert alert-danger text-center w-100">
                    <?php echo $_SESSION['messageError']; ?>
                </div>
                <?php } elseif (isset($_SESSION['messageSuccess'])) { ?>
                    <div class="alert alert-success text-center w-100">
                        <?php echo $_SESSION['messageSuccess']; ?>
                    </div>
                <?php } ?>
                <form action="index.php?uc=administrer&action=ajouterContenance" method="POST">
                    <div class="form-outline form-white mb-4">
                        <label class="form-label" for="numcontenance">Numéro de la contenance</label>
                        <input required type="number" id="numcontenance" name="numcontenance" class="form-control"  value="<?php echo $lastId['idMax'] + 1 ?>" disabled />
                    </div>
                    <div class="form-outline form-white mb-4">
                        <label class="form-label" for="nomcontenance">Nom de la contenance</label>
                        <input required type="text" id="nomcontenance" name="nomcontenance" class="form-control form-control-lg" />
                    </div>
                    <div class="button-form-center">
                        <input class="btn btn-success px-5" type="submit" value="Ajouter la contenance" name="ajoutercontenance">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>