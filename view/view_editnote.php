<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <base href="<?= $web_root ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-MQwA9UQGx909+8zz3bV5P1/zPr27R2aFWsUZt5Xz5a9Tq2XUn/6Zl3DSd0ZUEwC" crossorigin="anonymous">
    <title></title>
    <style>
        body {
            background-color: black;
            color: white;
        }

        .navbar {
            background-color: black;
        }
        .styled-link-button {
            background: none;
            border: none;
            color: #ffffff;
            cursor: pointer;
            text-decoration: none;
        }
       
    </style>
</head>

<body>

    <div class="container mt-4">
        <div class="row">
            <nav class="navbar">
                <div class="container-fluid">
                    <div class = "col-12">
                    
                        <!-- Icône Bootstrap pour le bouton de retour -->
                        <!--attentiion route doit etre modifier si archive ou partage route de test-->
                        
                        <a href="<?php if($notes->archived()){echo "notes/archive";}else{echo "notes";}?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
            </svg>
                         </a>
                        
                        <!-- Ajoutez ici vos propres icônes -->
                        <a >
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-share" viewBox="0 0 16 16">
  <path d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5m-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3m11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3"/>
</svg>
                        </a>
                    </div>
                    
                    
                    <div class="row">
                     <div class="col-12">
                      <?php
                     if($notes->are_you_check()){
                        (new View("editcheck"))->show();
                      }else{
                        (new View("edittext"))->show(["title"=>$notes->get_title(),"description"=>$notes->get_description()]);
                      }
                      
                      ?> 
                     </div>
                    </div>
             
                </div>
            </nav>
        </div>
    </div>

</body>

</html>
