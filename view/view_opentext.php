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
    
         
          <div class="container-fluid mt-4">
              <label for="title">Title</label><br>
              <textarea id="title" name="title" rows="1" class="w-100" <?php if(!empty($mode)){echo" ";}else{echo "disabled";}?>><?= $title?></textarea><br>
              <label for="text">Text</label><br>
              <textarea id="text" name="text" rows="50" class="w-100"  <?php if(!empty($mode)){echo" ";}else{echo "disabled";}?>><?= $description?></textarea>
              <input type="hidden" id ="id"name="id" value="<?= $id?>">
    </form>
          </div>
        
    
  
</body>

</html>
