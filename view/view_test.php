
<!DOCTYPE html>
<html lang="fr" >
<head class="bg-dark">
    <meta charset="UTF-8">
    <base href="<?= $web_root ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-MQwA9UQGx909+8zz3bV5P1/zPr27R2aFWsUZt5Xz5a9Tq2XUn/6Zl3DSd0ZUEwC" crossorigin="anonymous">
        <title>test</title>
</head>
<body class="bg-dark">
<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i class="bi bi-sliders"></i></button>
<div class="row">
<?php
/*le deux view qui suiv sont destine a disparaitre par la suite 
*/ 
 //$notes= new Notetext("cc",User::get_user_by_mail("boverhaegen@epfc.eu"),new DateTime(17-12-20223),new DateTime(17-12-2023),false,false,1,"cccccc");
 echo '<div class="col-6 col-md-6 col-lg-3">';
(new View("note"))->show();
echo"</div>";echo '<div class="col-6 col-md-6 col-lg-3">';
(new View("notecheck"))->show();
echo"</div>";
 var_dump($array_notes);
   // idee pour affiche toute les notes 
   if(!empty($array_notes)){
     
      echo"<div class=row>";
       foreach($array_notes as $notes){
        
            if($notes->are_you_check()){
              echo '<div class="col-6 col-md-6 col-lg-3">';
              (new View("notecheck"))->show(["notes"=>$notes]);
            }else{
              echo '<div class="col-6 col-md-6 col-lg-3">';
              (new View("note"))->show(["notes"=>$notes]);
            }
            echo"</div>";   
      }
      echo"</div>";
  }
?>
  </div>
<div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
  <div class="offcanvas-header bg-dark">
    <h5 class="offcanvas-title" id="offcanvasScrollingLabel"><p class="text-warning">NoteApp</p></h5>
    <button type="button" class="btn-close"  data-bs-dismiss="offcanvas" aria-label="Close"><i class="bi bi-heart"></i></button>
  </div>
  <div class="offcanvas-body bg-dark">
  <ul class="nav flex-column">
  <li class="nav-item">
  <a class="nav-link link-secondary" href="#">My Notes</a>
      <!--<a href="#" class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Light link</a>-->

  </li>
  <li class="nav-item">
    <a class="nav-link link-secondary" href="#">My archives</a>
  </li>

  <?php 
    if(!empty($tab_shared)){
      foreach($tab_shared as $tab): ?>
        <li class="nav-item">
          <a class="nav-link link-secondary" href="#">Shared by <?php echo $tab->get_fullnam() ?></a>
        </li>
  <?php endforeach;}?>

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
</body>
</html>



