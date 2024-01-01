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
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
       
    </style>
</head>

<body>
<div class="page-header">                        
                     <a href="<?php  if($notes->archived()){echo "notes/archive";}else{echo "notes";}?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
            </svg>
                         </a>
                        
                        
                        
                        
                        <a  href="notes/save"><!--reset a ajoute le text et le titre en get ou post ???-->
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy" viewBox="0 0 16 16">
  <path d="M11 2H9v3h2z"/>
  <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z"/>
</svg>
                        </a>

</div>                 
                    
                    <div class="row">
                     <div class="col-12">
                      <?php
                     if($notes->are_you_check()){
                        (new View("editcheck"))->show();
                      }else{
                        (new View("opentext"))->show(["title"=>$notes->get_title(),"description"=>$notes->get_description(),"mode"=>$mode]);
                      }
                      $notes=null;
                      ?> 
                    
                   
             
                </div>
            </nav>
        </div>
    </div>

</body>

</html>
