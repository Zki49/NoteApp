
<!DOCTYPE html>
<html lang="fr" >
<head class="bg-dark">
    <meta charset="UTF-8">
    <base href="<?= $web_root ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-MQwA9UQGx909+8zz3bV5P1/zPr27R2aFWsUZt5Xz5a9Tq2XUn/6Zl3DSd0ZUEwC" crossorigin="anonymous">
        <title>test</title>
</head>
<body class="bg-dark">
<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i class="bi bi-sliders"></i></button>

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
            padding-top: 10px; /* Espace sous le titre */
        }

        .truncate-text {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3; /* Affiche uniquement 3 lignes */
            -webkit-box-orient: vertical;
        }
    </style>


    <div class="container">
        <div class="card half-width">
            <div class="card-body">
                <h5 class="card-title">Titre de la carte</h5>
                <p class="card-text truncate-text">
                    Texte sur le corps de la carte. Vous pouvez ajouter ici toutes les informations que vous
                    
                </p>
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nextModal">
                        <<
                    </button>
                
                
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#previousModal">
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Précédent</button>
                </div>
            </div>
        </div>
    </div>

  




<div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
  <div class="offcanvas-header bg-dark">
    <h5 class="offcanvas-title text-avertissement" id="offcanvasScrollingLabel">NoteApp</h5>
    <button type="button" class="btn-close"  data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body bg-dark">
  <ul class="nav flex-column">
  <li class="nav-item">
    <a class="link-light link-offset-2" aria-current="page" href="#">My Notes</a>
    <!--<a href="#" class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Light link</a>-->

  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">My archives</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Settings</a>
  </li>
  <li class="nav-item">
    <a class="nav-link disabled" aria-disabled="true">Disabled</a>
  </li>
</ul>
  </div>
</div>



</body>
</html>



