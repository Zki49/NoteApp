<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <base href="<?= $web_root ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Label</title>
    <link rel="shortcut icon" href="data:image/png;base64,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" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="css/style_edit_note.css" rel="stylesheet">
    <script>
        let btnAddLabel,idnote,inputNewLabel,tableAllLabels;
        var labels = [];
        $(document).ready(function(){
            btnAddLabel = $("#btn-add-label");
            idnote = $("#idnotes").val();
            inputNewLabel = $("#newlabel");
            tableAllLabels = $("#table-all-labels");

            $('.label').each(function(){
                var value = $(this).val();
                labels.push(value);
            });
            console.log(labels);
            
            $(inputNewLabel).on('input',function(){
                var length = $(this).val().length;
                valideLabelLenght(length);
                var valueLabel = $(this).val();
                uniqueLabel(valueLabel);
               
            })
            

            $(btnAddLabel).click(function(event){
                
                event.preventDefault();
                addLabel(inputNewLabel.val());
            })

            
            $(".delete").each(function(){
                $(this).click(function(){
                    deleteLabel(this.id)
                   
                })
            })
            
        })

        function valideLabelLenght(length){
            
            $("#errorLabel").html("");
            if(length < 2 || length > 10){
                $("#errorLabel").html("<p>Label length must be between 2 and 10.</p>");
                $(btnAddLabel).prop('disabled',true);
            }
            else{
                $(btnAddLabel).prop('disabled',false);
            }
        }
        function uniqueLabel(label){
            if(labels.includes(label)){
                $("#errorLabel").append("<p>A note cannot contain the same label twice.</p>");
                $(btnAddLabel).prop('disabled',true);
            }
            else{
                $(btnAddLabel).prop('disabled',false);
            }
        }

        async function addLabel(newLabel){
            const postdata = {
                idnotes: idnote,
                label : newLabel
            };
            $.ajax({
                type:"POST",
                url: "Notes/add_label_service/",
                data: postdata,
                success: function(response){
                    if(response == "true"){   
                        let label = displayLabel(idnote,newLabel);
                        tableAllLabels.prepend(label);
                        $(".delete").each(function(){
                        $(this).click(function(){
                            deleteLabel(this.id)
                        
                        })
                        })
                        labels.push(newLabel);
                    }
                }
            })

        }

        async function deleteLabel(labelToDelete){
                
            const postdata = {
                idnotes: idnote,
                label : labelToDelete
            };
            $.ajax({
                type:"POST",
                url: "Notes/delete_label_service/",
                data: postdata,
                success: function(response){
                    if(response == "true"){
                        var elemToRemove = $("#removable"+labelToDelete);
                        elemToRemove.remove();
                        var index = labels.indexOf(labelToDelete); 
                        labels.splice(index, 1);
                    }
                }
            })

        }
        function displayLabel(idnote,newlabel){
            
            let html = "";
            html += "<div id='removable"+newlabel+"'>";
            html += "<noscript><form action='notes/delete_label' method='post'></noscript>";
            html += "<div class='input-group mb-3'>";
            html += "<input type='hidden' name='idnotes' value='"+idnote+"'>";
            html += "<input type='text'  name='label' class='form-control label'  aria-describedby='basic-addon2' value='"+newlabel+"' style=' background-color: #323232; color : white;' readonly>";
            html += "<button id='"+newlabel+"' class='btn btn-danger delete' type='submit'>-</button>";
            html += "</div>";
            html += "<noscript></form></noscript>";
            html += "</div>";

            
            /** <form action='notes/delete_label' method='post'>
                    <div class='input-group mb-3'>
                        <input type='hidden' name='idnotes' value='";echo($notes->get_id());echo"'>
                        <input type='text'  name='label' class='form-control'  aria-describedby='basic-addon2' value='";echo($label->get_label_name());echo"' style=' background-color: #323232; color : white;' readonly>
                        <button class='btn btn-danger' type='submit'>-</button>
                    </div>
                </form> */
           
            return html;
        }
     

    </script>
    <style>
    /* CSS pour le placeholder en blanc */
    ::placeholder {
        color: white;
    }
</style>

</head>
<body>
    <input type='hidden' id='idnotes' value='<?= $notes->get_id()?>'>
    <header>
    <a href="notes/open">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
        </svg>
    </a>
    </header>
    <p><h1>Labels: </h1></p>
    <div id="table-all-labels">
    <?php
        if(empty($labels)){
            echo"<label class='italic-label'><i>This note does not yet have a label.</i></label>
            <br>
            <br>
            ";
        }else{
            foreach($labels as $label){
                echo"
                <div id='removable"; echo($label->get_label_name()); echo"'>
                <noscript><form action='notes/delete_label' method='post'></noscript>
                    <div class='input-group mb-3'>
                        <input type='hidden' name='idnotes' value='";echo($notes->get_id());echo"'>
                        <input type='text'  name='label' class='form-control label'  aria-describedby='basic-addon2' value='";echo($label->get_label_name());echo"' style=' background-color: #323232; color : white;' readonly>
                        <button id='";echo($label->get_label_name());echo"'class='btn btn-danger delete' type='submit'>-</button>
                    </div>
                <noscript></form></noscript>
                </div>
                ";
            }
        }
    ?>
    </div>
    
    <label>Add new label</label>
    <noscript><form action='notes/add_label' method='post'></noscript>
        <div class="input-group mb-3">
        <input type='hidden' name='idnotes' value='<?= $notes->get_id()?>'>
            <input id="newlabel" list="datalistOptions" type="text" name='label' class="form-control" placeholder="Type to search or create..." aria-label="New label" aria-describedby="basic-addon2" style=" background-color: #323232; color : white;" >
            <?php 
            echo"<datalist id='datalistOptions'>";
            foreach($datalist as $data){
                echo"<option value='";echo($data);echo"'>";
            }
            echo"</datalist>";
            ?>
            
            <button id="btn-add-label" class="btn btn-primary" type='submit'>+</button>
        </div>
        <!--<div class='invalid-feedback' id='errorLabel'></div>-->
        <div id='errorLabel' style='color: red;' ><div  class='invalid-feedback'>
        
      </div></div>
    <noscript></form></noscript>
    <?php
    if(!empty($errors[0][0])){
        echo"<li style='color : red;' >"; echo($errors[0][0]); echo"</li>";
    }
    
    ?>
</body>
</html>