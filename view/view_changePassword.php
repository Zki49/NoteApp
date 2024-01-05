<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <base href="<?= $web_root ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change password</title>
    <style>
        body {
            background-color: black;
            color: white;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        #btnBack {
            position: absolute;
            top: 10px;
            left: 10px;
            color: white;
            background-color: black;
        }

        #pageTitle {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        #btnSave {
            padding: 10px;
            background-color: black;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #btnSave:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <button class="btn btn-light">
        <a href="settings" id="btnRetour">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
            </svg>
        </a>
    </button>
    <h1 id="pageTitle">Change password</h1>

    <div class="form-group">
        <label for="oldPassword">Old password</label>
        <input type="password" id="oldPassword" name="oldPassword" required>
    </div>

    <div class="form-group">
        <label for="newPassword">New password</label>
        <input type="password" id="newPassword" name="newPassword" required>
    </div>

    <button id="btnSave">Save</button>
</div>

<?php
    if(!empty($errors)){
        foreach($errors as $error){
            echo "<li>";
            echo $error;
            echo "</li>";
        }
    }
?>

</body>
</html>
