<?php
   echo '
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style_view_opentext.css" rel="stylesheet">
    

    
    
          <div class="container-fluid mt-4">
              <label for="title">Title</label><br>
              <textarea id="title" name="title" rows="1" class="w-100"'  ;
              if(!empty($mode)){echo" ";}else{echo "disabled";} echo'>';
              echo $title;
              echo'</textarea><br>
              <label for="text">Text</label><br>
              <textarea id="text" name="text" rows="50" class="w-100"' ; 
               if(!empty($mode)){echo" ";}else{echo "disabled";} 
               echo '>';
               echo $description;
               echo'</textarea>
              <input type="hidden" id ="id"name="id" value="<?= $id?>">
    </form>
          </div>';
        
    
  ?>

