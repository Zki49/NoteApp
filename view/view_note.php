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
        /* width: 40%;*/ /* La carte occupe la moitié de la largeur de son contenant */
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
            height: 4.5em;
        }
        a {
            text-decoration: none; /* Enlever le soulignage */
            color: #ffffff; /* Définir la couleur du texte en blanc */
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="card half-width">  
        <div class="card-body">
        <a href="notes/open"> 
                <h5 class="card-title"><?=$notes->get_title();
                ?></h5>
                <p class="card-text truncate-text">
                <?=$notes->get_description()===null?" ":$notes->get_description();
                    ?>
                </p>
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nextModal">
                        >>
                    </button>
                </div>
                </a>
            </div>
        </div>
    </div>
   

</body>

</html>
