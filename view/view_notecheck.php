<!--<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <base href="<?= $web_root ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-MQwA9UQGx909+8zz3bV5P1/zPr27R2aFWsUZt5Xz5a9Tq2XUn/6Zl3DSd0ZUEwC" crossorigin="anonymous">
    <link href="css/style_view_noteCheck.css" rel="stylesheet">

    
</head>

<body>-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-MQwA9UQGx909+8zz3bV5P1/zPr27R2aFWsUZt5Xz5a9Tq2XUn/6Zl3DSd0ZUEwC" crossorigin="anonymous">
        <link href="css/style_view_noteCheck.css" rel="stylesheet">
    <div class="container">
        <div class="card half-width">
        <div class="card-body" id= <?= $notes->get_id() ?>>

            <a href=<?php if(!isset($share)){ echo'"notes/open/';
                    echo $notes->get_id();
                    echo'"'; 
                }else{
                     echo'"notes/openshare/';
                     echo $notes->get_id();
                     echo'"'; 
                    } ?> >
                

                   
                        <h5 class="card-title"><?= $notes->get_title(); ?></h5>
                        <div class="hidden-checkboxes">
                            <!-- Loop through items -->
                            <?php
                            $id = $notes->get_id();
                            $items = $notes->get_items();
                            if (!empty($items)) {
                                foreach ($items as $item) {
                                    echo "
                                    <div class='form-check'>
                                        <input class='form-check-input' type='checkbox'  id='checkbox";echo $item->get_id(); echo"'";
                                        if($item->item_checked()){echo" checked";}
                                        echo" disabled>
                                        <label class='form-check-label' for='checkbox";echo $item->get_id();echo"'>";
                                    echo $item->get_content();
                                    echo "</label></div>";
                                }
                            }
                            ?>
                        </div>
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
                    echo "</form>";
                    }
                    ?>
                    <?php
                   if(((($notes->min_weight()- $notes->get_weight())!=0)&&($notes->min_weight_pined()-$notes->get_weight())!=0)){
                   ?>
                   <form action="notes/movedown" method="post">
                <input type="hidden" name="idnotes" value="<?= $notes->get_id()?>">
                    <button type="submit" class="btn btn-primary" >
                        >>
                    </button>
                   </form>
                </div>
                <?php }} ?>
                </noscript>
            </div>
        </div>
    </div>

    <?php
    $id = null;
    $items = null;
    $notes = null;
    ?>
<!--</body>

</html>-->
