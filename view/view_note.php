<!--<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <base href="<?= $web_root ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-MQwA9UQGx909+8zz3bV5P1/zPr27R2aFWsUZt5Xz5a9Tq2XUn/6Zl3DSd0ZUEwC" crossorigin="anonymous">
        <link href="css/style_view_note.css" rel="stylesheet">
    
   
</head>
<body>-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-MQwA9UQGx909+8zz3bV5P1/zPr27R2aFWsUZt5Xz5a9Tq2XUn/6Zl3DSd0ZUEwC" crossorigin="anonymous">
        <link href="css/style_view_note.css" rel="stylesheet">
    <div class="container">
        <div class="card half-width">
            <div class="card-body" id= <?= $notes->get_id() ?>>
                
                <!-- Formulaire caché -->
                <a  class ="modif"href=<?php if(!isset($share)){ 
                    if(isset($tab)){
                        echo'"notes/open/';
                        echo $notes->get_id();
                        echo '/'.$tab.'"'; 
                    }
                    
                    if(!isset($tab)&&!isset($retour)){
                        echo'"notes/open/';
                        echo $notes->get_id();
                        echo '"'; 
                    }

                    
                    //
                }else{
                     echo'"notes/openshare/';
                     echo $notes->get_id();
                     echo'"'; 
                    } ?> >
                 
                <!-- Lien stylisé comme un bouton de soumission de formulaire -->
                
                   
                    <h5 class="card-title"><?=$notes->get_title(); ?></h5>
                    <p class="card-text truncate-text">
                        <?=$notes->get_description()===null?" ":$notes->get_description(); ?>
                    </p>
             
                </a>
                <?php
                if($notes->get_labels() ){
                   foreach($notes->get_labels() as $lablel){
                         echo' <span class="badge badge-secondary">';
                         echo $lablel->get_label_name()." ";
                         echo'</span>';
                   }
                }
                ?>
                <noscript>
                <?php if(!$notes->archived()&&!isset($share)){?>
                <div class="d-flex justify-content-between">
                    <?php
                    
                    if((($notes->max_weight() - $notes->get_weight())!=0)&&($notes->max_weight_pined()-$notes->get_weight())!=0){
                    ?>
                    <form action="notes/moveup" method="post">
                <input type="hidden" name="idnotes" value="<?= $notes->get_id()?>">
                  
                    <button type="submit" class="btn btn-primary" >
                        &lt;&lt;
                    </button>
                    <?php
                    }
                    ?>
                   </form>
                   <?php
                   if(((($notes->min_weight()- $notes->get_weight())!=0)&&($notes->min_weight_pined()-$notes->get_weight())!=0)){
                   ?>
                   <form action="notes/movedown" method="post">
                <input type="hidden" name="idnotes" value="<?= $notes->get_id()?>">
                    <button type="submit" class="btn btn-primary" >
                        >>
                    </button>
                   </form>
                 <?php
                 }
                 ?>
                </div>
                <?php }?>
                </noscript>
            </div>
        </div>
    </div>
<!--</body>
</html>-->