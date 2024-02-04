<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <base href="<?= $web_root ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-MQwA9UQGx909+8zz3bV5P1/zPr27R2aFWsUZt5Xz5a9Tq2XUn/6Zl3DSd0ZUEwC" crossorigin="anonymous">
        <link href="css/style_view_noteCheck.css" rel="stylesheet">
    <title>Ma Carte</title>
    
</head>

<body>

    <div class="container">
        <div class="card half-width">
            <div class="card-body">

                <form action="notes/open" method="post">
                    <input type="hidden" name="idnotes" value="<?= $notes->get_id() ?>">

                    <button type="submit" class="styled-link-button">
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
                                        <input class='form-check-input' type='checkbox'  id='checkbox1'";
                                        if($item->item_checked()){echo"checked";}
                                        echo" disabled>
                                        <label class='form-check-label' for='checkbox1'>";
                                    echo $item->get_content();
                                    echo "</label></div>";
                                }
                            }
                            ?>
                        </div>
                    </button>
                </form>
                 <?php if(!$notes->archived()&&!isset($share)){?>
                <div class="d-flex justify-content-between">
                    <?php

                if(($notes->max_weight() - $notes->get_weight())!=0){
                    ?>
                    <form action="notes/moveup" method="post">
                <input type="hidden" name="idnotes" value="<?= $notes->get_id()?>">
                    <button type="submit" class="btn btn-primary" >
                        <<
                    </button>
                    <?php
                    }
                    ?>
                   </form>
                   <form action="notes/movedown" method="post">
                <input type="hidden" name="idnotes" value="<?= $notes->get_id()?>">
                    <button type="submit" class="btn btn-primary" >
                        >>
                    </button>
                   </form>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php
    $id = null;
    $items = null;
    $notes = null;
    ?>
</body>

</html>
