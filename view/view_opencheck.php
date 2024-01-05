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
            <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
        </div>
            <input type="text" class="form-control" aria-label="Text input with checkbox" value="<?=$notes->get_title()?>" readonly>
        </div>
        
    
  
</body>

</html>
