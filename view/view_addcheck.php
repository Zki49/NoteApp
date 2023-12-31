<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <base href="<?= $web_root ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            /* Style pour le fond de la page */
            background-color: #343a40; /* Couleur foncée de Bootstrap */
            color: white; /* Texte blanc */
            padding: 20px; /* Espacement pour le contenu */
        }

        .custom-input {
            /* Style pour les inputs */
            background-color: transparent; /* Couleur foncée de Bootstrap */
            color: white; /* Texte blanc */
            border: 1px solid #ced4da; /* Bordure avec la couleur de Bootstrap */
            margin-bottom: 10px; /* Ajoute un espace de 10px en bas de chaque input */
        }
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .page-header button {
            background-color: transparent;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
    <title>Titre de la page</title>
</head>

<body class="p-3 mb-2 bg-dark text-white">
<div class="page-header">
        <button onclick="window.history.back();" title="Revenir à l'ancienne page">
            <i class="bi bi-arrow-left"></i>
        </button>
        <button title="Sauvegarder">
            <i class="bi bi-save"></i>
        </button>
    </div>

    <div class="mb-3  bg-dark text-white">
        <label for="formGroupExampleInput" class="form-label">Title</label>
        <input type="text" class="form-control custom-input" id="formGroupExampleInput" >
    </div>
    <div class="mb-3">
        <label for="formGroupExampleInput2" class="form-label">Items</label>
        <ul>
        <li><input type="text" class="form-control custom-input" id="formGroupExampleInput1"></li>
        <li><input type="text" class="form-control custom-input" id="formGroupExampleInput2"></li>
        <li><input type="text" class="form-control custom-input" id="formGroupExampleInput3"></li>
        <li><input type="text" class="form-control custom-input" id="formGroupExampleInput4"></li>
        <li><input type="text" class="form-control custom-input" id="formGroupExampleInput5"></li>
    </ul>

    </div>

</body>

</html>
