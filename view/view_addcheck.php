<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <base href="<?= $web_root ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.18.0/font/bootstrap-icons.css">

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
        .styled-link-button {
            background: none;
            border: none;
            color: #ffffff;
            cursor: pointer;
            text-decoration: none;
        }
        
    </style>
    <title>Titre de la page</title>
</head>

<body class="p-3 mb-2 bg-dark text-white">
<div class="page-header">
    <a href="notes">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
    </svg>
    </a>
    <form id="addcheckForm" action="notes/addcheck" method="post">
        <button type="submit" class="styled-link-button">
    <svg type="submit" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy" viewBox="0 0 16 16">
        <path d="M11 2H9v3h2z"/>
        <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z"/>
    </svg>
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
    </form>


</body>

</html>
