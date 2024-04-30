[21:53] Yannick DENIS
<!DOCTYPE html>
<html lang="fr">
 
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style_view_openCheck.css" rel="stylesheet">
</head>
 
<body>
    <?php
    $items = $notes->get_items();
    $id = $notes->get_id();
 
    echo "
    <div class='mb-3  bg-dark text-white'>
        <form action='notes/save' method='post'>
            <input type='hidden' name='idnotes' value='";
    echo $notes->get_id();
    echo "'>
            <label for='title' class='form-label''>Title</label>
            <input type='text' id='title' name='title' class='form-control' aria-describedby='button-addon2' ";
    if (empty($mode)) {
        echo " readonly";
    } else {
        echo "";
    }
 
    echo "value = '" . $notes->get_title() . "'>
    </div>";
 
    echo "<div id='errTitle' style='color: red;'><div  class='invalid-feedback'></div></div>";
 
    foreach ($items as $item) {
        echo "
        <div class='input-group mb-3'>
            <div class='input-group-text'>
                <a href='notes/check/" . $item->get_id() . "'>
                    <input class='form-check-input mt-0' type='checkbox' ";
        if ($item->item_checked()) {
            echo "checked ";
        }
        echo "input'>
                </a>
            </div>
            <input id='" . $item->get_id() . "' type='text' class='form-control";
        if ($item->item_checked()) {
            echo " throughline";
        }
        echo "' aria-label='Text input with checkbox' name='item".$item->get_id()."' value='" . $item->get_content() . "' ";
        if (!empty($mode)) {
            echo "";
        } else {
            echo " readonly";
        }
        echo ">
            <button class='btn btn-danger' form='form-".$item->get_id()."'>Delete</button>
           
        </div>";
    }
    echo"</form>";
    foreach ($items as $item) {
        echo"<form id='form-".$item->get_id()."' action='notes/deleteitem' method='post'>
        <input type='hidden' name='item' value='" . $item->get_content() . "'>
        <input type='hidden' name='id' value='" . $notes->get_id() . "'>
    </form>";
    }
 
    if (!empty($mode)) {
        echo "
        <form action='notes/additem' method='post'>  
            <div class='input-group mb-3'>
                <input id='addItem' type='text' class='form-control' aria-describedby='button-addon2' name='newitem'>
                <button class='btn btn-outline-secondary' type='submit'>Add</button>
                <input type='hidden' name='idnotes' value='" . $id . "'>
            </div>
        </form>";
    }
 
    $id = null;
    $notes = null;
    $items = null;
    ?>
</body>
 
</html>
 