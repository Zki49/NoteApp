<!DOCTYPE html>
<html lang="fr">

<head>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            background-color: black;
            color: white;
        }

        .navbar {
            background-color: black;
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
    
      <?php
       $items=$notes->get_items();
        for($i=0 ; $i<sizeof($items) ;$i++){
            echo"<div class='input-group mb-3'>
            <div class='input-group-text'>
                <input class='form-check-input mt-0' type='checkbox' value='' aria-label='Checkbox for following text input'>
            </div>
            <input type='text' class='form-control' aria-label='Text input with checkbox' value='";
             echo "$items[$i] ' readonly>
             </div>" ;
       }
      ?>
          
        <div class="input-group mb-3">
        <div class="input-group-text">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
  <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
  <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
</svg>
        </div>
            <input type="text" class="form-control" aria-label="Text input with checkbox" >
        </div>
        
    
  
</body>

</html>
