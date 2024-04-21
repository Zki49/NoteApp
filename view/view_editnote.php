<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <base href="<?= $web_root ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-MQwA9UQGx909+8zz3bV5P1/zPr27R2aFWsUZt5Xz5a9Tq2XUn/6Zl3DSd0ZUEwC" crossorigin="anonymous">
        <link href="css/style_edit_note.css" rel="stylesheet">
    <title>edit note</title>
    <link rel="shortcut icon" href="data:image/png;base64,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" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
  let inputTitle,idNote,errTitle,errorInput,errorAddItem,inputItem,titleAtFirst,descrAtFirst,test,newItem,buttonGeneral,btnAddItem;
        let tableItems;
        let description, errDescr, inputDescr;
        
        var inputs = $('input[id^="[0-9]"]');
        
        var valeursInputs;
        var arrayError = [];
        var val4input = [];
        var numberOfItems = 0;

        
        $(document).ready(function(){
        
            $('.form-check-input').each(function() {
        $(this).click( function() {
            console.log(this.id);
            //throughline
            $("#text-"+this.id).toggleClass("throughline");
            $.ajax({
                type: "get",
                url: "notes/check_uncheck_service/"+this.id,
               
            });

           
        });
    });

            inputTitle = $("#title");
            inputDescr = $("#textArea");
            titleAtFirst = inputTitle.val();
            descrAtFirst = inputDescr.val();

            var modificationAlertModal = $('#modificationAlertModal');
            
            idNote = $("#idnotes");
            idnote = idNote.val();
            errTitle = $("#errTitle");
            buttonGeneral = $("#buttonSave");
            inputItem = $("#addItem");
            btnAddItem = $("#btn-add-item");
            $(btnAddItem).prop('disabled' ,true);
            errorAddItem = $("#errorAddItem");
            tableItems = $("#listItems");
            errDescr= $("#errDescr");
      
             test = $("#modificationAlertModal");

			$("#goBack").click(function(){
                event.preventDefault();
                isModified();
            
			});
            
            
            var modificationAlertModal = $('#modificationAlertModal');

            
            getItems();

            $(btnAddItem).click(function(){
                event.preventDefault();
                const item = $(inputItem).val();
                addNewItem(item);
            });

            const items = document.querySelectorAll(".form-check-input");
            $('.input-group-mb3').find('button').map(function() {
                this.click(function(){
                    console.log('marche');
                })
            })
           
            console.log(items);
            [...items].forEach(item => {
                item.addEventListener('click' , () => {
                    console.log(item.id);
                });
            });

            inputTitle.bind("input",valideTitle);
            inputDescr.bind("input",valideDescr);
            inputTitle.bind("input" , uniqueNoteByOwner);
            inputItem.bind("input",addItem);

            getNumberOfItems();
            getAllValueInputs4Items(numberOfItems);
            //uniqueItems(valeursInputs);
            validateItems();
            

        });

        function valideTitle(){
           console.log("valide tile ");
            $(inputTitle).on('input', function() {
                var title = $(inputTitle).val();
                errTitle.html("");
                if (title.length < 3 || title.length > 25) {
                    $(inputTitle).addClass('is-invalid');
                    errTitle.html("<p>Title lenght must be between 3 and 25.</p>");
                    $("#buttonSave").prop('disabled',true);
                } else {
                    $(inputTitle).removeClass('is-invalid');
                    $(inputTitle).addClass('is-valid');
                    $("#buttonSave").prop('disabled',false);
                    checkErrors();
                }
                
            });
        }

        function valideDescr(){
            console.log("valide description ");
            console.log($(inputDescr).val());
            var description = $(inputDescr).val()
            errDescr.html("");
            if ((description.length < 3 || description.length > 25)&&description.length!=0) {
                    $(inputDescr).addClass('is-invalid');
                    errDescr.html("<p>Text lenght must be between 3 and 25 OR nothing.</p>");
                    $("#buttonSave").prop('disabled',true);
                } else {
                    $(inputDescr).removeClass('is-invalid');
                    $(inputDescr).addClass('is-valid');
                    $("#buttonSave").prop('disabled',false);
                    checkErrors();
                }
           /* $(inputDescr).on('textarea', function() {
                var descr = $(inputDescr).val();
                errDescr.html("");
                if (description.length < 3 || description.length > 25) {
                    $(inputDescr).addClass('is-invalid');
                    errDescr.html("<p>Text lenght must be between 3 and 25 OR nothing.</p>");
                    $("#buttonSave").prop('disabled',true);
                } else {
                    $(inputDescr).removeClass('is-invalid');
                    $(inputDescr).addClass('is-valid');
                    $("#buttonSave").prop('disabled',false);
                }
                
            });*/
        }
        
        function checkErrors() {
            // Vérifier s'il y a d'autres éléments avec la classe 'is-invalid'
            if ($('.is-invalid').length > 0 || inputTitle.hasClass('is-invalid')) {
                $("#buttonSave").prop('disabled', true); // Désactiver le bouton Save s'il y a des erreurs
            } else {
                $("#buttonSave").prop('disabled', false); // Activer le bouton Save si aucune erreur n'est présente
            }
        }

// Colruyt tartiflette

    function attachDeleteHandlers() {
            $('.supItem').on('click', function(event) {
                const itemId = $(this).data('id');
                console.log(itemId);
                //event.preventDefault();
                //delete_item(itemId); // Appel de la fonction de suppression
            });
        }
        async function uniqueNoteByOwner(){
            const dataTitle=  inputTitle.val();
            const postData = {
             title: dataTitle
            };
          
            $.ajax({
                type: "POST", // Specify the request method
                url: "Notes/note_exists_service/", // Specify the URL to which you want to send the request
                data: postData, 
                success: function(response) {
                    // Handle the response from the server
                    var debutTrue = response.indexOf('true');
                    var finTrue = response.lastIndexOf('true');
                    var trueString = response.substring(debutTrue, finTrue + 4); // Ajoutez 4 pour inclure "true"

                   if(trueString === "true"){
                    $(inputTitle).removeClass('is-valid');
                    $(inputTitle).addClass('is-invalid');
                        errTitle.html("<p></p>");
                        errTitle.append("Title already exists.");
                        console.log(buttonGeneral.html);
                        buttonGeneral.prop("disabled", true);
                        console.log("success");
                        console.log(errTitle.html);
                        checkErrors();
                   }
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error("Error:", error);
                }
                
});            
        }
        
        function validateItems(){
            $(this).on('input', function() {
                var item = $(this).val();
                console.log(item);
                errorInput.html("");
                if (item.value.trim == ""  || item.length > 60) {
                    $(this).addClass('is-invalid');
                    errorInput = document.getElementById("errorInput"+i);
                    errorInput.append("Item lenght must be between 1 and 60");
                    $("#buttonSave").prop('disabled',true);
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).addClass('is-valid');
                    $("#buttonSave").prop('disabled',false);
                }
                uniqueItems(valeursInputs);
            });
        }

        function getAllValueInputs4Items(numberOfItems){
            for(var i = 0 ; i < numberOfItems ; i++) {
                var valeurInput = document.getElementById(i);
                val4input.push(valeurInput.value);
            } 
        }
        function getNumberOfItems(){
                var inputs = document.querySelectorAll('input[type="text"]');

                for (var i = 0; i < inputs.length; i++) {
                    if (!isNaN(parseInt(inputs[i].id))) {
                        numberOfItems++;
                    }
                }
        }
        function addItem(){
            const allItems = document.querySelectorAll('.items');
            okAdd = false;
            errorAddItem.html("");
            if(!(/^.{1,60}$/).test(inputItem.val()) || inputItem.val() === ''){
                errorAddItem.append("<p>Item length must be between 1 and 60.</p>");
                okAdd = true;
                inputItem.addClass('is-invalid');
            }else{
                allItems.forEach(item =>{
                    if(inputItem.val() === item.value){
                        errorAddItem.append("<p>Item must be unique.</p>");
                        inputItem.addClass('is-invalid');
                        okAdd = true;
                    }
                });
               
            }
            $(btnAddItem).prop('disabled' ,okAdd);
            $("#buttonSave").prop('disabled',okAdd);
            console.log(okAdd);
            if(!okAdd){
                $(inputItem).className = "";
                console.log("tout est bon");
                $(inputItem).addClass('is-valid');
            }

            /*$(inputItem).on('input', function() {
                var newItem = $(this).val();
                //console.log(newItem);
                errorAddItem.html("");
                if (newItem.length < 1 || newItem.length > 60) {
                    $(this).addClass('is-invalid');
                    errorAddItem.append("Item lenght must be between 1 and 60");
                    $("#buttonSave").prop('disabled',true);
                } if (newItem == "test "){
                    $(this).addClass('is-invalid');
                    errorAddItem.append("Item must be unique ");
                    $("#buttonSave").prop('disabled',true);
                    console.log("error");
                }
                else{
                    $(this).removeClass('is-invalid');
                    $(this).addClass('is-valid');
                    $("#buttonSave").prop('disabled',false);
                }
                
            });   */
        }
        function ItemAlreadyExist(arrayContent){
            let trouve = false;
            var newItem = $(this).val; 
            arrayContent.forEach(function(element) {
                if (element === newItem) {
                    trouve = true;
                }
            });
            return trouve;
            
        }
        async function deleteItem(id){
            var URL = "&idItem=" + id +"/&idNote=" + idnote;
            const res = await fetch("Notes/service_delete_item/", {
                                        method: 'POST',
                                        headers: {"Content-type": "application/x-www-form-urlencoded"},
                                        body: "name=" + encodeURIComponent("A & B = ? / :") + URL
                                        });
            getItems();
            displayItems();
            const data = await res.text(); 

            console.log(data);
        }
        async function addNewItem(newItem){
            var URL = "&newitem=" + newItem +"&idnotes=" + idnote;
            const res = await fetch("Notes/service_add_item/", {
                                        method: 'POST',
                                        headers: {"Content-type": "application/x-www-form-urlencoded"},
                                        body: "name=" + encodeURIComponent("A & B = ? / :") + URL
                                        });
            getItems();
            displayItems();
            const data = await res.text();
            
        }
        function displayItems(){
            let html = "";
            let cpt = 0;
            for(let item of valeursInputs){
                html += "<div class='input-group mb-3'>";
                html += "<div class='input-group-text'>";
                html += "<a href='notes/check/"+item.id+"'>";
                if (item.checked){
                    html += "<input class='form-check-input mt-0' type='checkbox' checked>";
                }else{
                    html += "<input class='form-check-input mt-0' type='checkbox'>";
                }
                html += " </a>";
                html += "</div>";
                if (item.checked){
                    html += "<input id='"+cpt+"' type='text' class='form-control throughline' aria-label='Text input with checkbox ' name='item' value='"+item.content+" / display' >";
                }else{
                    html += "<input id='"+cpt+"' type='text' class='form-control' aria-label='Text input with checkbox ' name='item' value='"+item.content+" / display' >";
                }
                html += "<button  class='btn btn-danger supItem' onclick='"+"deleteItem("+item.id+")' type='submit'>";
                html += "<div class='invalid-feedback' id = 'errorInput"+cpt+"'>";
                html += "</div>";
                html += "<td class='is-invalid'></td>";
                html += "<div id='"+item.id+"' >";
                html += "<svg id='supItem"+item.id+"'xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' viewBox='0 0 16 16'>";
                html += "<path d='M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8'/>";
                html += "</svg>";
                html += "</div>";
                html += "<input type='hidden' id='idItem' value=''>";
                html += "</button>";
                html += "</div>";
                
                cpt++;
            }
            tableItems.html(html);
            
            
        }
        async function getItems(){
            valeursInputs = await $.getJSON("Notes/get_all_items_service/" + idnote);
            displayItems();
        }

        function isModified(){
           var hasBeenModified = false;
           if(inputTitle.val() !== titleAtFirst || descrAtFirst !== inputDescr.val()){
               hasBeenModified = true;
           }
           console.log(hasBeenModified);
           if(hasBeenModified){
            test.modal("show");
            $("#cancel").click(function(){
                event.preventDefault();
                test.modal("hide");
            });
            $("#leave").click(function(){
                window.history.back();
                window.history.back(); 
            });
           }
           else{
                window.history.back();
                window.history.back();  
           }
        }
</script>
    
</head>

<body>
<div class="page-header">                        
                     <a href="<?php  if($notes->archived()){echo "notes/archive";}else{echo "notes";}?>">
                        <svg id="goBack" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
            </svg>
                         </a>
                        
                        
                        
                        <form action="notes/save" method="post">
                        <input type="hidden" name="idnotes" value="<?= $notes->get_id()?>">
                        <button type="submit" class="styled-link-button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy" viewBox="0 0 16 16">
                        <path d="M11 2H9v3h2z"/>
                        <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z"/>
                        </svg>
                        </button>

</div>                 
                    
                    <div class="row">
                     <div class="col-12">
                      <?php
                     if($notes->are_you_check()){
                        (new View("opencheck"))->show(["notes"=>$notes,"mode"=>$mode ]);
                      }else{
                        (new View("opentext"))->show(["title"=>$notes->get_title(),"description"=>$notes->get_description(),"mode"=>$mode,"id"=>$notes->get_id()]);
                      }
                      $notes=null;
                      ?> 
                    
                   
             
                </div>
            </nav>
        </div>
    </div>
   
    <?php
        echo"
        <div id='modificationAlertModal' class='modal hide fade' role='dialog'>
             <div class='modal-dialog'>
                 <div class='modal-content bg-dark text-white' style='margin-top:240px;'>
                     <div class='header'><h3>Unsaved changes !</h3></div>
                     <div class='body'>Are you sure you want to leave this form ?
                         <br>
                         <br>
                         Changes you made will not be saved.
                     </div>
                     <div class='footer' style='text-align: right;'>
                         <button class='btn btn-secondary' id='cancel'>Cancel</button>
                         <button class='btn btn-danger' id='leave'>Leave Page</button>
                     </div>
                 </div>
             </div>
         </div>
         
         ";

            if (!empty($errors)) {
                echo "<h6>Your item has not been added because:</h6>";
                echo "<ul>";
                foreach ($errors as $error) {
                    if (is_array($error)) {
                    foreach ($error as $subError) {
                        echo "<li>$subError</li>";
                    }
                } else {
                    echo "<li>$error</li>";
                }
            }
            echo "</ul>";
            }

            


        ?>
    
</body>

</html>
