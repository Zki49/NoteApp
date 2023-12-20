


<!DOCTYPE html>
<html lang="fr">
<head>

    <meta charset="UTF-8">
    <base href="<?= $web_root ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body>
    <div class="settings-container">
        <h1>Settings</h1>
        <h2> Hey 
            <?php
            echo $user->get_fullnam() 
            ?> ! 
        </h2>
        
        <ul class="settings-list">
            <li><a href="settings/editProfile" id="editProfileLink">Edit profile</a></li>

            <li><a href="settings/changePassword" id="changePasswordLink">Change password</a></li>

            <li><a href="settings/logout" id="logoutLink">Logout</a></li>
        </ul>
    </div>
</body>
</html>