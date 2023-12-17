<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-MQwA9UQGx909+8zz3bV5P1/zPr27R2aFWsUZt5Xz5a9Tq2XUn/6Zl3DSd0ZUEwC" crossorigin="anonymous">
    <title>Ma Carte</title>
    <style>
        /* Ajoutez ici votre style personnalisé si nécessaire */
        .half-width {
           /* width: 40%; *//* La carte occupe la moitié de la largeur de son contenant */
            margin: 10px; /* Pour centrer la carte sur la page */
            background-color: black; /* Fond de la carte en noir */
            color: white; /* Texte en blanc */
            border: 1px solid white; /* Bordure blanche autour de la carte */
            border-radius: 10px; /* Coins arrondis */
        }

        .card-title {
            border-bottom: 1px solid white; /* Bordure blanche en bas du titre */
            padding-bottom: 10px; /* Espace sous le titre */
        }

        .hidden-checkboxes {
            max-height: 5em; /* Hauteur maximale de trois lignes (2.4em par ligne + espacement) */
            overflow: hidden;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="card half-width">
            <div class="card-body">
                <h5 class="card-title"><!---remetre iun php  $notes->get_title();
                ?>-->titre</h5>
                <div class="hidden-checkboxes">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="checkbox1">
                        <label class="form-check-label" for="checkbox1">
                            <!--ici je pense quon fera un tableaux pour les check dans check note a voir  -->
                            Option 1
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="checkbox2">
                        <label class="form-check-label" for="checkbox2">
                            Option 2
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="checkbox3">
                        <label class="form-check-label" for="checkbox3">
                            Option 3
                        </label>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nextModal">Suivant</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal pour la suite des options -->
    <div class="modal fade" id="nextModal" tabindex="-1" role="dialog" aria-labelledby="nextModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="nextModalLabel">Suite des options</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="checkbox4">
                        <label class="form-check-label" for="checkbox4">
                            Option 4
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="checkbox5">
                        <label class="form-check-label" for="checkbox5">
                            Option 5
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="checkbox6">
                        <label class="form-check-label" for="checkbox6">
                            Option 6
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Précédent</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS et Popper.js (facultatif) pour les fonctionnalités avancées, mais pas nécessaires pour cet exemple -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-c9L0VnFCttxiC8lHbeqofB8UEv5RGrb7I8WtiV+U5P8LME1W9G2mjsU9MVADAN7S" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
        integrity="sha384-c3X+KkBoI3A5mBbCYWABgAuiopwgl/u8S/6+T2Wl13uDAFNSgCfrhDVoF+9DQDje" crossorigin="anonymous"></script> -->

</body>

</html>
