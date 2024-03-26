<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <base href="<?= $web_root ?>"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="css/style_view_shared.css" rel="stylesheet">
  
  <title>Shares</title>
  <link rel="shortcut icon" href="data:image/png;base64,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" type="image/x-icon">

  <script src="http://code.jquery.com/jquery.min.js"></script>
  <script>
    let idUser, selectedOptionUser, userName,
    idPermission, selectedOptionPerm, permName,
    div, toggleBtn,
    html;
    

    $(function(){
      $("#btnplus").click(viewShare);
      

      //$('#deleteBtn').click(erase);
      
  //$("#userDropdown").focus(); // This will give focus to the userDropdown element
//});
        $("#userDropdown").change(function() {
        idUser = $(this).val(); // Capture the value of the selected option
        selectedOption = $(this).find("option:selected");
        userName = selectedOption.text();
        console.log("ID de l'utilisateur: ", idUser);
        console.log("Nom de l'utilisateur: ", userName);
        });

      $("#permissionDropdown").change(function(){
        idPermission = $(this).val();
        selectedOptionPerm = $(this).find("option:selected");
        permName = selectedOptionPerm.text();
        console.log("id Perm: ", idPermission); //id Editor : 1, id Reader : 0
      })

      div=$("#viewSharee");
      console.log(div);
    });

    function viewShare(){
      html = '<input id="user" name="user" value="';
      html += userName;
      html += " (";
      html += permName;
      html += ')"';
      html += ' readonly></input>';
      html += '<button type="submit" class="btn btn-primary mb-2" onclick="toggleA()" >'
      html += '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">'
      html += '<path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41m-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9"/>'
      html += '<path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5 5 0 0 0 8 3M3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9z"/>'
      html += '</svg>'
      html += ' </button>'
      html += '<button type="submit" class="btn btn-primary mb-2  btn-danger">'
      html += '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">'
      html+= '<path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8"/>'
      html+= '</svg>'
      html+= '</button>'

      div.append(html);
    }

    function toggleA(){
      if(idPermission == 1){
        idPermission = 0;
        permName = " (Reader)";
      }
      else{
        idPermission = 1;
        permName = " (Editor)";
      }
      userName = $("#user").val().split(" ")[0];
      $("#user").attr("value",userName + permName);
      console.log();
            
    }

    function erase(){

    }
  </script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="#">Retour</a>
</nav>

<div class="container">
  <h2 class="mt-4">Shares</h2>
  <div id="viewSharee">
  <?php
    
    if(empty($tabUSerAlready)){
      echo '<h3 class="mt-4"> This note is not shared yet.</h3> ';
    }
    else{
      foreach($tabUSerAlready as $user){
        echo '<form action="notes/deleteShared" method="Post"
          >';
        echo '<input id="user" name="user" value="';
        echo $user->getFullnam();
        if($user->editor($idnotes)){
          echo '(editor) ';
        }
        else{
          echo '(reader)';
        }
        echo '" readonly></input>
          <input type="hidden" name="idNote" value="';
          echo $idnotes; 
          echo'">
          <input type="hidden" name="idUser" value="';
          echo $user->get_id(); 
          echo'">
          <button type="submit" id="toggleBtn" class="btn btn-primary mb-2" formaction="notes/toggle">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
          <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41m-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9"/>
          <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5 5 0 0 0 8 3M3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9z"/>
        </svg>
            </button>
          <button type="submit" id="deleteBtn" class="btn btn-primary mb-2  btn-danger"">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
              <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8"/>
            </svg>
            </button>
          </form>';
      }
    }    
  ?>
  </div>
  <noscript>
  <form action="notes/shared" method="Post">
  <input type="hidden" name="idnotes" value="<?= $idnotes?>">
  </noscript>
    <div class="form-row align-items-center">
      <div class="col-auto">
        <label class="sr-only" for="userDropdown">Utilisateur</label>
        <select class="form-control mb-2" id="userDropdown" name="idUser">
          <option disabled selected>Choisir un utilisateur...</option>
            <?php
                foreach($tabUsers as $user){
                    echo '<option value="';
                    echo $user->get_id();
                    echo'">';
                    echo $user->getFullnam();
                    echo'</option>';
                }
            ?>
        </select>
      </div>

      <div class="col-auto">
        <label class="sr-only" for="permissionDropdown">Permission</label>
        <select class="form-control mb-2" id="permissionDropdown" name="editor">
          <option disabled selected>Choisir une permission...</option>
          <option value="1">Editor</option>
          <option value="0">Reader</option>
        </select>
      </div>

      <div class="col-auto">
        <button type="submit" id="btnplus" class="btn btn-primary mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
            </svg>
        </button>
      </div>
    </div>
  </form>
</div>

</body>
</html>
