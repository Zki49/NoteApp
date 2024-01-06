<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <base href="<?= $web_root ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-MQwA9UQGx909+8zz3bV5P1/zPr27R2aFWsUZt5Xz5a9Tq2XUn/6Zl3DSd0ZUEwC" crossorigin="anonymous">
    <title>Ma Carte</title>
    <style>
        /* Ajoutez ici votre style personnalisé si nécessaire */
        .half-width {
            margin: 10px;
            background-color: black;
            color: white;
            border: 1px solid white;
            border-radius: 10px;
            padding: 10px;
        }

        .card-title {
            border-bottom: 1px solid white;
            margin-bottom: 10px;
        }

        .d-flex {
            border-top: 1px solid white;
            padding-top: 10px;
        }

        .truncate-text {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            height: 4.5em;
        }

        .styled-link-button {
            background: none;
            border: none;
            color: #ffffff;
            cursor: pointer;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="card half-width">
            <div class="card-body">
                <!-- Formulaire caché -->
                <form action="notes/open" method="post">
                <input type="hidden" name="idnotes" value="<?= $notes->get_id()?>">
                 
                <!-- Lien stylisé comme un bouton de soumission de formulaire -->
                <button type="submit" class="styled-link-button">
                    
                    <h5 class="card-title"><?=$notes->get_title(); ?></h5>
                    <p class="card-text truncate-text">
                        <?=$notes->get_description()===null?" ":$notes->get_description(); ?>
                    </p>
                </button>
                </form>

                <div class="d-flex justify-content-between">
                    <?php
                    if(($notes->max_weight() - $notes->get_weight())!=0){
                    ?>
                    <form action="notes/moveup" method="post">
                <input type="hidden" name="idnotes" value="<?= $notes->get_id()?>">
                    <button type="submit" class="btn btn-primary" >
                        <<
                    </button>
                    <?php
                    }
                    ?>
                   </form>
                   <form action="notes/movedown" method="post">
                <input type="hidden" name="idnotes" value="<?= $notes->get_id()?>">
                    <button type="submit" class="btn btn-primary" >
                        >>
                    </button>
                   </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
