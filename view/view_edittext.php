<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <base href="<?= $web_root ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
        }

        .custom-container {
            width: 100vw;
            padding: 20px;
        }

        .black-textarea {
            width: 100%;
            box-sizing: border-box;
            color: white; 
        }
        label{
            color: white;
        }
        textarea{
            background-color: black;
            color: white;
        }
    </style>
</head>


<body>
    
         
          <div>
              <label for="title">Title</label><br>
              <textarea id="title" name="userInput" rows="1" cols="100" ><?= $title?></textarea><br>
              <label for="text">Text</label><br>
              <textarea id="text" name="userInput" rows="50" cols="100" ><?= $description?></textarea>
          </div>
        
    
  
</body>

</html>
