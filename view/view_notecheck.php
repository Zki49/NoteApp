<!DOCTYPE html>
<html lang="en">

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
           height: 5em; /* Hauteur maximale de trois lignes (2.4em par ligne + espacement) */
            overflow: hidden;
        }
        a {
            text-decoration: none; /* Enlever le soulignage */
            color: #ffffff; /* Définir la couleur du texte en blanc */
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

                <form action="notes/open" method="post">
                    <input type="hidden" name="idnotes" value="<?= $notes->get_id() ?>">

                    <button type="submit" class="styled-link-button">
                        <h5 class="card-title"><?= $notes->get_title(); ?></h5>
                        <div class="hidden-checkboxes">
                            <!-- Loop through items -->
                            <?php
                            $id = $notes->get_id();
                            $items = $notes->get_items();
                            if (!empty($items)) {
                                for ($i = 0; $i < sizeof($items); $i++) {
                                    echo "
                                    <div class='form-check'>
                                        <input class='form-check-input' type='checkbox'  id='checkbox1' ";
                                         if(!empty($mode)){echo" ";}else{echo "readonly";}
                                        echo ">
                                        <label class='form-check-label' for='checkbox1'>";
                                    echo $items[$i];
                                    echo "</label></div>";
                                }
                            }
                            ?>
                        </div>
                    </button>
                </form>

                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nextModal">Suivant</button>
                </div>
            </div>
        </div>
    </div>

    <?php
    $id = null;
    $items = null;
    $notes = null;
    ?>
</body>

</html>
