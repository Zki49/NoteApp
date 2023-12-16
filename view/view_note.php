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
            width: 40%; /* La carte occupe la moitié de la largeur de son contenant */
            margin: 10px; 
            background-color: black; /* Fond de la carte en noir */
            color: white; /* Texte en blanc */
            border: 1px solid white; /* Bordure blanche autour de la carte */
            border-radius: 10px; /* Coins arrondis */
        }

        .card-title {
            border-bottom: 1px solid white; /* Bordure blanche en bas du titre */
            padding-bottom: 10px; /* Espace sous le titre */
        }
        .d-flex{
            border-top: 1px solid white; /* Bordure blanche en bas du titre */
            padding-top: 10px;
        }

        .truncate-text {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3; /* Affiche uniquement 3 lignes */
            -webkit-box-orient: vertical;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="card half-width">
            <div class="card-body">
                <h5 class="card-title">Titre de la carte</h5>
                <p class="card-text truncate-text">
                    Texte sur le corps de la carte. Vous pouvez ajouter ici toutes les informations que vous
                    souhaitez. Si le texte dépasse trois lignes, il sera tronqué et un bouton "Suivant" sera
                    affiché.
                </p>
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nextModal">
                        >>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal pour la suite du texte -->
    <div class="modal fade" id="nextModal" tabindex="-1" role="dialog" aria-labelledby="nextModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="nextModalLabel">Suite du texte</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        Texte continué... Vous pouvez ajouter ici toutes les informations supplémentaires que vous
                        souhaitez. Si le texte dépasse trois lignes, il sera tronqué et un bouton "Précédent" sera
                        affiché.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><<</button>
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
