<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
</head>

<body>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
              <label for="title">Title</label><br>
              <textarea id="title" name="userInput" rows="1" cols="100" disabled><?= $title?></textarea><br>
              <label for="text">Text</label><br>
              <textarea id="text" name="userInput" rows="50" cols="100" disabled><?= $description?></textarea>
            </div>
        </div>
    </div>
 
</body>

</html>
