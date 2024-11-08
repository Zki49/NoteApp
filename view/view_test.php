

<!DOCTYPE html>
<html lang="fr" >
<head class="bg-dark">
    <meta charset="UTF-8">
    <base href="<?= $web_root ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-MQwA9UQGx909+8zz3bV5P1/zPr27R2aFWsUZt5Xz5a9Tq2XUn/6Zl3DSd0ZUEwC" crossorigin="anonymous">
        <title>test</title>
        <script>
     $(document).ready(function(){
      let modal;

      $("#ouvrirModal").click(function(){
          modal = $("#myModal").modal();
      });

      $("#myModal").on('shown.bs.modal', function () {
    
          var bouton = $(this).find('button')
          console.log(bouton);

          
          bouton.click(function() {
              console.log("cc"); 
          });
      });
    });
  
  </script>
</head>
<body class="bg-dark">
<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i class="bi bi-sliders"></i></button>
<div class="row">
<?php

   if ($mode===" "){

   if(!empty($array_notes)){
     
      echo"<div class=row>";
       foreach($array_notes as $notes){
            if(!$notes-> archived()){
            if($notes->are_you_check()){
              echo '<div class="col-6 col-md-6 col-lg-3">';
              (new View("notecheck"))->show(["notes"=>$notes]);
            }else{
              echo '<div class="col-6 col-md-6 col-lg-3">';
              (new View("note"))->show(["notes"=>$notes]);
            }
            echo"</div>";   
      }
    }
      echo"</div>";
  }
  }elseif(!empty($array_notes)){
     
    echo"<div class=row>";
     foreach($array_notes as $notes){
          if($notes-> archived()){
          if($notes->are_you_check()){
            echo '<div class="col-6 col-md-6 col-lg-3">';
            (new View("notecheck"))->show(["notes"=>$notes]);
          }else{
            echo '<div class="col-6 col-md-6 col-lg-3">';
            (new View("note"))->show(["notes"=>$notes]);
          }
          echo"</div>";   
    }
  }
    echo"</div>";
  }else{
    echo "Your notes are empty";
  }
  $array_notes = null;
?>
  </div>
  <a href="notes/addtext">
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark" viewBox="0 0 16 16">
  <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5z"/>
</svg>
  </a>
  <a href="notes/addchec">
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-check" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3.854 2.146a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 3.293l1.146-1.147a.5.5 0 0 1 .708 0m0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 7.293l1.146-1.147a.5.5 0 0 1 .708 0m0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0"/>
</svg>
  </a>
<div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
  <div class="offcanvas-header bg-dark">
    <h5 class="offcanvas-title" id="offcanvasScrollingLabel"><p class="text-warning">NoteApp</p></h5>
    <button type="button" class="btn-close"  data-bs-dismiss="offcanvas" aria-label="Close"><i class="bi bi-heart"></i></button>
  </div>
  <div class="offcanvas-body bg-dark">
  <ul class="nav flex-column">
  <li class="nav-item">
    <a class="nav-link link-secondary" href="Notes">My Notes</a>
  </li>
  <li class="nav-item">
    <a class="nav-link link-secondary" href="Notes/archive">My archives</a>
  </li>

  <?php 
    if(!empty($tab_shared)){
      foreach($tab_shared as $user): ?>
        <li class="nav-item">
          <a class="nav-link link-secondary" href='test/get_shared_notes/<?= $user->get_mail()?>'>Shared by <?php echo $user->get_fullnam() ?></a>
        </li>
  <?php endforeach;}
    $tab_shared = null; 
  ?>

  <li class="nav-item">
    <a class="nav-link link-secondary" href="#">Settings</a>
  </li>
  <li class="nav-item">
    <a class="nav-link disabled" aria-disabled="true">Disabled</a>
  </li>
</ul>
  </div>
</div>
</div>


<!-- Bouton pour ouvrir la modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  Ouvrir la modal
</button>

<!-- La modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
    
      <!-- En-tête de la modal -->
      <div class="modal-header">
        <h4 class="modal-title">Ma Modal</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Corps de la modal -->
      <div class="modal-body">
        <p>Contenu de ma modal...</p>
      </div>
      
      <!-- Pied de la modal -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <button type="button" class="btn btn-primary">Sauvegarder</button>
      </div>
      
    </div>
  </div>
</div>

<!-- JavaScript de Bootstrap (changez le lien pour votre propre version si nécessaire) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

</body>
</html>




