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

        if(empty($mode)){
            echo"'  readonly>";
        }else{
            echo"' >";
        }

            echo" 
    </div>

    
    ";

    echo"
    <div id='errTitle' style='color: red;' ><div  class='invalid-feedback'>
        
      </div></div>
          <td></td>
        
      </div>
        ";
    
   echo" 
   
   <label for='title' class='form-label'>Items</label>
   
   ";
   
   for($i = 0; $i < count($items); $i++){
    if(empty($mode)){
        echo"
        <div class='input-group mb-3'>
            <div class='input-group-text'>";
            if($items[$i]->item_checked()){
                echo"<input  class='form-check-input mt-0' type='checkbox' value='' aria-label='Checkbox for following text input' checked>";

            }else{
                echo"<input class='form-check-input mt-0' type='checkbox' value='' aria-label='Checkbox for following text input'>";

            }
            echo"
            </div>
            <input type='text' class='form-control";
            if($items[$i]->item_checked()){
                echo" throughline";
            }
            echo"' value='"; echo $items[$i]->get_content(); echo"'  readonly>
        </div>

        ";
    }else{
        echo"
        <noscript></noscript>
        <div id='removable"; echo $items[$i]->get_id(); echo"'>
        <div id = '";echo $items[$i]->get_id();echo" ' class='input-group mb-3 deletedItem'>
            <div class='input-group-text'>
                <noscript><a id= 'check-"; echo $items[$i]->get_id(); echo"'  href='notes/check/";echo $items[$i]->get_id(); echo"'   ></noscript>";
                echo"<div id= 'check-"; echo $items[$i]->get_id(); echo" ' class='form-check-input' data-checked="; echo $items[$i]->item_checked() ; echo">";
                if($items[$i]->item_checked()){
                    echo"
                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check-square-fill' viewBox='0 0 16 16' >
                        <path d='M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z'/>
                    </svg>
                    ";
//                    <input id= 'check-"; echo $items[$i]->get_id(); echo"' class='form-check-input mt-0' type='checkbox' checked input'>";

                }else{
                    echo"
                    <svg id= 'check-"; echo $items[$i]->get_id(); echo"' xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-square' viewBox='0 0 16 16'>
                        <path d='M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z'/>
                    </svg>";
                   // echo"<input id= 'check-"; echo $items[$i]->get_id(); echo"' class='form-check-input mt-0' type='checkbox' input'>";
                }
                echo"</div>";
                echo"
                <noscript></a></noscript>
            </div>";
            if($items[$i]->item_checked()){
                echo"
            <input id='";echo  $items[$i]->get_id(); echo"' type='text' class='form-control throughline itemclass' aria-label='Text input with checkbox ' name='item";echo $items[$i]->get_id();echo"' value='";echo $items[$i]->get_content(); echo"'   >";
            }else{
                echo"
            <input id='"; echo  $items[$i]->get_id(); echo"' type='text' class='form-control itemclass ' aria-label='Text input with checkbox ' name='item";echo $items[$i]->get_id();echo"' value='";echo $items[$i]->get_content(); echo"'   >";
            }
            
            echo"
            <button form='form-";echo $items[$i]->get_id(); echo"' id= '"; echo $items[$i]->get_id(); echo"' class='btn btn-danger supItem' data-id='sup"; echo $items[$i]->get_id(); echo"' type='submit'>
                
            
            <td class='is-invalid'></td>
            
            <svg id='suppItem"; echo $items[$i]->get_id(); echo"'xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' viewBox='0 0 16 16'>
            <path d='M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8'/>
            
          </svg>
          <input type='hidden' id='idItem' value=''>
          </button> 
          </div>
       <div id='errorInput"; echo $items[$i]->get_id(); echo"' style='color: red;'  ><div  class='invalid-feedback'>
       </div>
       </div>
       </div>
       <noscript></noscript>
        
        ";
    }
    /*echo "
    
    <noscript><form action='notes/deleteitem' method='post'>

            <div class='input-group mb-3'>
                <div class='input-group-text'>
                    <a href='notes/check/" . $items[$i]->get_id() . "'>
                        <input class='form-check-input mt-0' type='checkbox' ";
    if($items[$i]->item_checked()) {
        echo "checked ";
    }
    echo "input'>
                    </a>
                </div>
                <input id='" .$i . "' type='text' class='form-control ";
    if($items[$i]->item_checked()) {
        echo "throughline";
    }
            echo"' aria-label='Text input with checkbox ' name='item' value='";
             echo $items[$i]->get_content()  ;
             if(!empty($mode)){echo"' ";}else{echo " ' readonly";}
             echo"  >";
             echo"
               
             ";
             //
             if(!empty($mode)){echo"   
                <button class='btn btn-danger sup' type='submit'>
                <div class='invalid-feedback' id = 'errorInput" . $i . "'>
                    
                </div>
                <td class='is-invalid'></td>
                <div id='";echo $items[$i]->get_id();echo"' class='supItem'>
                <svg id='suppItem";echo $items[$i]->get_id();echo"'xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' viewBox='0 0 16 16'>
                <path d='M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8'/>
                </div>
              </svg>
              <input type='hidden' id='idItem' value='";
              //echo $items[$i]->get_id();
              echo"'>
           </button>";}else{echo "";}
            
            echo" </div>
            </form>
            </form></noscript>" ;*/
       }
       echo"</form>
       <noscript>
       ";
       foreach ($items as $item) {
        echo"<form id='form-".$item->get_id()."' action='notes/deleteitem' method='post'>
                <input type='hidden' name='item' value='" . $item->get_content() . "'>
                <input type='hidden' name='id' value='" . $notes->get_id() . "'>
            </form>";
    }
       echo"
       </noscript>
       <div class='listItems' id = 'listItems'></div>";
       if(!empty($mode)){ 
        echo"
        <noscript></form></noscript>
        <form action='notes/additem' method='post'>  
        <div class='input-group mb-3'>
        <input type='hidden' name='idnotes' value='" ;
        echo $id ;
        echo"'>
    <input id='addItem' type='text' class='form-control'  aria-describedby='button-addon2' style='background-color: #323232; color: white;'  name ='newitem'>
    <button id='btn-add-item' class='btn btn-outline-secondary' type='submit' style='background-color: #0071FF; color: white;'>
        <svg xmlns='http://www.w3.org/2000/svg' width='18' height='16' fill='currentColor' class='newItem' viewBox='0 0 16 16'>
            <path d='M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4'/>
        </svg>
    </button>
    <div class='invalid-feedback' id = 'errorAddItem'>

    </div>
    <br></br>
    

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

            <input id='addItem' type='text' class='form-control' aria-label='Text input with checkbox'  name='newitem'>
            <input type='hidden' name='idnotes' value='" ;
            //echo $id ;
            echo"'>
            
        </div>-->

        </form>";
       }
      
    
       $id=null;
       $notes=null;
       $items=null;
        ?>





</body>
</html>
