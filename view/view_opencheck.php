<!DOCTYPE html>
<html lang="fr">

<head>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style_view_openCheck.css" rel="stylesheet">
  
</head>


<body>
   
      <?php
       $items=$notes->get_items();
       $id=$notes->get_id();

        
        echo"
        <div class='mb-3  bg-dark text-white'>
        <form action='notes/save' metod='post'>
        <input type='hidden' name='idnotes' value='";
        echo $notes->get_id();
        echo"'>
        <label for='title' class='form-label''>Title</label>
        <input type='text' id='title'  name='title' class='form-control'  aria-describedby='button-addon2'  ' value = '"; echo($notes->get_title());    
        echo"'>
          <div class='invalid-feedback'>
            Title lenght must be between 3 and 25
          </div>
        
      </div>
        ";
        if(empty($mode)){
            echo"'  readonly";
        }else{
            echo"' ";
        }

            echo" >
    </div>
    ";
    echo" </form>";
   echo" <label for='title' class='form-label'>Items</label>";
        foreach($items as $item){
            echo"<form action='notes/deleteitem' method='post'>
            <div class='input-group mb-3'>
            <div class='input-group-text'>
            <a href='notes/check/";
               echo $item->get_id();
               echo"'>
                <input class='form-check-input mt-0' type='checkbox' ";
                if($item->item_checked()){echo"checked";}
                echo" input'>
              
             </a>
            </div>
            <input id='"; echo $items-> ;echo"' type='text' class='form-control ";
            if($item->item_checked()){
                echo"throughline";
            }
            echo"' aria-label='Text input with checkbox ' name='item' value='";
             echo $item->get_content()  ;
             if(!empty($mode)){echo"' ";}else{echo " ' readonly";}
             echo"  >";
             echo"
                <div class='invalid-feedback'>
                    Title lenght must be between 3 and 25
                </div>
             ";
             //
             if(!empty($mode)){echo"   
                <button class='btn btn-danger' type='submit'>
                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-dash' viewBox='0 0 16 16'>
                <path d='M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8'/>
              </svg>
              <input type='hidden' name='id' value='";
              echo $id;
              echo"'>
           </button>";}else{echo "";}
            
            echo" </div>
             </form>" ;
       }
      
      
       if(!empty($mode)){ 
        echo"
        <form action='notes/additem' method='post'>  
        <div class='input-group mb-3'>
        <input type='hidden' name='idnotes' value='" ;
        echo $id ;
        echo"'>
    <input type='text' class='form-control'  aria-describedby='button-addon2' style='background-color: #323232; color: white;'  name ='newitem'>
    <button class='btn btn-outline-secondary' type='submit' id='button-addon2' style='background-color: #0071FF; color: white;'>
        <svg xmlns='http://www.w3.org/2000/svg' width='18' height='16' fill='currentColor' class='bi bi-plu' viewBox='0 0 16 16'>
            <path d='M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4'/>
        </svg>
    </button>
</div>

<!--<div class='input-group mb-3'>
        <div class='input-group-text'>
        <button type='submit' class='styled-link-button'>
        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-plus-square' viewBox='0 0 16 16'>
  <path d='M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z'/>
  <path d='M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4'/>
</svg>
 </button>
        </div>

            <input type='text' class='form-control' aria-label='Text input with checkbox'  name='newitem'>
            <input type='hidden' name='idnotes' value='" ;
            //echo $id ;
            echo"'>
            
        </div>
        </form>-->";
       }
      
    
       $id=null;
       $notes=null;
       $items=null;
        ?>



</form>

</body>

</html>
