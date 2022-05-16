        <div id="foot" class="bg-success">
            <footer class="container d-flex flex-column justify-content-between text-center">
                <div class="pt-3 d-flex flex-column justify-content-center">
                    <a class="navbar-brand m-auto fit" href="index.php?uc=accueil">
                        <span class="text-light h5"><u>Projet GSB</u></span>
                    </a>
                    <p class="text-light text-center my-2 m-auto col-11 col-lg-7 col-md-9 col-xl-5">
                        Projet de BTS SIO 2ème année : boutique de produit pharmaceutique avec un système de commande de produits sous forme d'un site Web pour l'entreprise GSB avec base de donnée et des comptes utilisateurs ainsi que des habilitations.
                    </p>
                </div>
                <div class="w-100 footercustom py-3">
                    <small class="text-center text-light">
                        © Copyright 2022 Randy Durelle | Tristan Da Silva.
                    </small>
                </div>
            </footer>
        </div>
        </body>

        </html>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

        <script>
            let page = <?php echo json_encode($_SESSION['page']); ?>;
            $('#' + page).css({
                "text-decoration": "underline #198754",
                "text-underline-offset": "0.8rem",

            });
            $(function() {
                let filtre = <?php echo json_encode($_SESSION['filtre']); ?>;
                if (filtre !== 'undefined' && filtre !== false) {
                    $("#formFiltrer").after('<form action="index.php?uc=voirProduits&action=nosProduits" method="POST" id=\'formSuppFiltre\' class="w-100"><button type="submit" class="mx-auto btn btn-outline-danger mt-2 align-items-center w-75 input-group d-flex justify-content-around" name="suppFiltre"><div>Supprimer filtre</div><i class="bi bi-x-circle"></i></button>');
                }
            });
            $(function() {
                var nb = <?php echo $nbProduits; ?>;
                if (nb > 0) {
                    $('#panier').before('<div id="pastille" class="d-flex align-items-center justify-content-center">' + nb + '</div>')
                    $('#panier').parent().addClass('d-flex justify-content-end')
                }
            });
        </script>