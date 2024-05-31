<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <base href="<?= $web_root ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-MQwA9UQGx909+8zz3bV5P1/zPr27R2aFWsUZt5Xz5a9Tq2XUn/6Zl3DSd0ZUEwC" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style_view_openCheck.css" rel="stylesheet">
        <link href="css/stylenot.css" rel="stylesheet">
        
    <title>search</title>
    <link rel="shortcut icon" href="data:image/png;base64,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" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   <script>
    let tablabel=[];
     $(document).ready(function(){
      $(".styled-link-button").click(function(){
        let self = this
        if (tablabel.includes(self.id)){
           console.log('cc')
          tablabel=  tablabel.filter(function(element) {
              return element != self.id; 
         });
          
        }else{
        
         tablabel.push(self.id);
        }
            
            if(this.getAttribute('data-checked') == 'true'){
               this.innerHTML = `
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-square" viewBox="0 0 16 16">
                    <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                </svg>`;
            this.setAttribute('data-checked', 'false');
            }else{
              this.innerHTML = `
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-square-fill" viewBox="0 0 16 16">
              <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z"/>
            </svg>`;
            this.setAttribute('data-checked', 'true');
            }
            console.log(tablabel)
           if(tablabel.length!=0){
            searchByLabel()
           }else{
            realodShare();
            reloadallnotes();
           }
            
        });

     })

    function reloadallnotes(){

      $.ajax({
            url: 'notes/realodallnote_service',
            method: 'POST',
        data: {
            labels: tablabel
           
        }, 
            success: function(response) {
             
                $("#myNote").empty();
                const jsonStringArray = JSON.parse(response);
                const jsonObjectArray = jsonStringArray.map(jsonString => JSON.parse(jsonString));
                console.log(jsonObjectArray)  
                for (let i = 0; i < jsonObjectArray.length; i++) {
                  if(jsonObjectArray[i].check==false){
                    $("#myNote").append(displaynote(jsonObjectArray[i]))
                  }else{
                    $("#myNote").append(displaychecknote(jsonObjectArray[i]))
                  }
          }         
               

               
                
                
          
                //$('#myNote').html(response);
               
            },
            error: function(xhr, status, error) {
              console.log(tablabel);
                console.error('Erreur lors de la récupération des notes : ' + error);
            }
        });

    }
    //realodallnote_share_service()
    function realodShare(){
      $.ajax({
            url: 'notes/realodallnote_share_service',
            method: 'POST',
        data: {
            labels: tablabel
           
        }, 
            success: function(response) {
              
                $("#noteshare").empty();
                console.log(response)
                const jsonStringArray = JSON.parse(response);
                const jsonObjectArray = jsonStringArray.map(jsonString => JSON.parse(jsonString));
                for (let i = 0; i < jsonObjectArray.length; i++) {
                  if(jsonObjectArray[i].check==false){
                    $("#noteshare").append(displaynote(jsonObjectArray[i]))
                  }else{
                    $("#noteshare").append(displaychecknote(jsonObjectArray[i]))
                  }
          }         
               

               
                
                
          
                //$('#myNote').html(response);
               
            },
            error: function(xhr, status, error) {
              console.log(tablabel);
                console.error('Erreur lors de la récupération des notes : ' + error);
            }
        });


    }

    function searchByLabel(){
       search();
       searchshare();
      // videz les div 
      
    }
    function search(){
      $.ajax({
            url: 'notes/search_service',
            method: 'POST',
        data: {
            labels: tablabel
           
        }, 
            success: function(response) {
              console.log(tablabel);
                $("#myNote").empty();
                const jsonStringArray = JSON.parse(response);
                const jsonObjectArray = jsonStringArray.map(jsonString => JSON.parse(jsonString));
                console.log(jsonObjectArray)  
                for (let i = 0; i < jsonObjectArray.length; i++) {
                  if(jsonObjectArray[i].check==false){
                    $("#myNote").append(displaynote(jsonObjectArray[i]))
                  }else{
                    $("#myNote").append(displaychecknote(jsonObjectArray[i]))
                  }
          }         
               

               
                
                
          
                //$('#myNote').html(response);
               
            },
            error: function(xhr, status, error) {
              console.log(tablabel);
                console.error('Erreur lors de la récupération des notes : ' + error);
            }
        });
    }
    function  searchshare(){
      $.ajax({
            url: 'notes/searchshare_service',
            method: 'POST',
        data:{
            labels: tablabel
        }, 
            success: function(response) {
                $("#noteshare").empty();
                const jsonStringArray = JSON.parse(response);
                const jsonObjectArray = jsonStringArray.map(jsonString => JSON.parse(jsonString));
                console.log(jsonObjectArray)  
                for (let i = 0; i < jsonObjectArray.length; i++) {
                  if(jsonObjectArray[i].check==false){
                    $("#noteshare").append(displaynote(jsonObjectArray[i]))
                  }else{
                    $("#noteshare").append(displaychecknote(jsonObjectArray[i]))
                  }
          }         
               
            },
            error: function(xhr, status, error) {
                
                console.error('Erreur lors de la récupération des notes : ' + error);
            }
        });
    }

    function displaynote(note){

      let html = ' <div  class="col-6 col-md-6 col-lg-3"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"'
        html +='integrity="sha384-MQwA9UQGx909+8zz3bV5P1/zPr27R2aFWsUZt5Xz5a9Tq2XUn/6Zl3DSd0ZUEwC" crossorigin="anonymous">'
        html +='<link href="css/style_view_note.css" rel="stylesheet">'
        html+='     <div class="container">        <div class="card half-width"> <div class="card-body" id='+note.id+' >'
        html += '<a href="notes/open/'+note.id+'">'
        html += '  <h5 class="card-title">'+note.title+'</h5> <p class="card-text truncate-text">'
       html += note.description ? note.description : "";
       html+= ' </p></a>'
       for (let i = 0; i < note.labels.length; i++) {
        html += ' <span class="badge badge-secondary">'
        html+=  note.labels[i].name
        html += '</span>'
       }
       html+='     </div> </div> </div></div>'
       return html
       
   
        

    }
    function displaychecknote(note){
       let html = '<div  class="col-6 col-md-6 col-lg-3"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"'
           html+='integrity="sha384-MQwA9UQGx909+8zz3bV5P1/zPr27R2aFWsUZt5Xz5a9Tq2XUn/6Zl3DSd0ZUEwC" crossorigin="anonymous">'
           html +='<link href="css/style_view_noteCheck.css" rel="stylesheet"> <div class="container">'
          html+='<div class="card half-width"><div class="card-body" id='+  note.id +'>'
          html+='<a href="notes/open/'+note.id+'>';
          html+=' <h5 class="card-title">'+ note.title+'</h5><div class="hidden-checkboxes">'
          for (let i = 0; i < note.content.length; i++) {
            html +=  "<div class='form-check'> <input class='form-check-input' type='checkbox'  id='checkbox"+note.content[i].id+"'"
            if(note.content[i].check==true){
              html+='checked'
             
            }
            html+= "disabled><label class='form-check-label' for='checkbox"+ note.content[i].id+"'>"
            html+= note.content[i].content+"</label></div>"
          }
          
          html+='</div></a>'
        for (let i = 0; i < note.labels.length; i++) {
               html += ' <span class="badge badge-secondary">'
               html+=  note.labels[i].name
               html += '</span>'
       }
       html+=    '</div></div></div>'
       return html
                    
    }

   </script>
</head>
<body>
<button class="btn btn-primary btn-transparent" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
        </svg>
    </button>

<div class="container">
    <h5>search notes by tag :</h5>
    <div class="checkboxes">
        <?php
         if($labels){
            $cpt=0;
           // echo '<form   action="notes/search_by_labels " methode="post" >  ';
           //<input type="checkbox" id=';echo$label-> get_label_name();echo'name= ';echo$label-> get_label_name();echo'value=';echo$label-> get_label_name();echo'">
            foreach($labels as $label){
                $cpt++;
            echo '<noscript><form   action="notes/search_by_labels/'; if(isset($tab)){echo $tab;};echo' " method="Post" ></noscript> ';
            echo'<div class="checkbox,row"> <button  id="';echo $label->get_label_name();echo'" class="styled-link-button" data-checked="'; echo $label->is_check() ;echo' ">';
            if(!$label->is_check()){
            echo'
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-square" viewBox="0 0 16 16">
            <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
              </svg>';
            }else{
              echo'<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-square-fill" viewBox="0 0 16 16">
              <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z"/>
            </svg>';
            }
              echo'
            </button> '; 

            echo $label-> get_label_name();
            echo'<input type="hidden" name="label" value="';echo $label-> get_label_name();echo'">
                 </div>
                 <noscript></form></noscript>';
            }
           // echo'    </form>';
         }
         echo' </div>';
        
         if($array_notes){
          
          echo"<h5 >your Notes</h5>";
         
         echo"<div  id='myNote' class='row , connectedSortable'>";
         foreach($array_notes as $notes){
           if(!$notes-> archived()){
           if($notes->are_you_check()){
             
             echo ' <div  class="col-6 col-md-6 col-lg-3">';
             (new View("notecheck"))->show(["notes"=>$notes]);
           }else{
             echo '<div  class="col-6 col-md-6 col-lg-3">';
             (new View("note"))->show(["notes"=>$notes]);
           }
           echo"</div>"; 

          }
        }
      }
        echo'</div>';
        if(isset($array_note_share)){
        echo"<h5>Notes share</h5><div  id='noteshare' class='row , connectedSortable'>";
        foreach($array_note_share as $notes){
          if(!$notes-> archived()){
          if($notes->are_you_check()){
            
            echo ' <div  class="col-6 col-md-6 col-lg-3">';
            (new View("notecheck"))->show(["notes"=>$notes]);
          }else{
            echo '<div  class="col-6 col-md-6 col-lg-3">';
            (new View("note"))->show(["notes"=>$notes]);
          }
          echo"</div>"; 

         }
       }
       echo'</div>';
      }

        ?>
      
        
    
   



</div>


<div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
  <div class="offcanvas-header bg-dark">
    <h5 class="offcanvas-title text-warning" id="offcanvasScrollingLabel"> NoteApp</h5>
    <button type="button" class="btn-close"  data-bs-dismiss="offcanvas" aria-label="Close"><i class="bi bi-heart"></i></button>
  </div>
  <div class="offcanvas-body bg-dark">
  <ul class="nav flex-column">
  <li class="nav-item">
  <a class="nav-link link-secondary" href="Notes">My Notes</a>
  </li>
  <li class="nav-item">
  <a class="nav-link link-secondary" href="Notes/search">Search</a>
  </li>
  <li class="nav-item">
    <a class="nav-link link-secondary" href="Notes/archive">My archives</a>
  </li>

  <?php 
    if(!empty($tab_shared)){
      foreach($tab_shared as $user): ?>
        <li class="nav-item">
          <a class="nav-link link-secondary" href='notes/get_shared_notes/<?= $user->get_id()?>'>Shared by <?php echo $user->get_fullnam() ?></a>
        </li>
  <?php endforeach;}
    $tab_shared = null; 
  ?>

  <li class="nav-item">
    <a class="nav-link link-secondary" href="settings">Settings</a>
  </li>
  <li class="nav-item">
    <a class="nav-link disabled" aria-disabled="true">Disabled</a>
  </li>
</ul>
  </div>
</div>
</div>

    
</body>
</html>