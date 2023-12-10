<!DOCTYPE html>
<html lang="fr" >
<head>
    <meta charset="UTF-8">
    <base href="<?= $web_root ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Signup Page</title>
</head>
<body>

<div class="container mt-5">
<div class="p-3 mb-2 bg-body text-body">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center">Signup</h2>
            <form id="signupForm" action="signup/index" method="post">

                 
                <div class="input-group mb-3">
                <span class="input-group-text"  class="bi bi-key" id="basic-addon1">@</span>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= $email ?> "required>
                </div>
                
                
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">@</span>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" value="<?= $name ?>"required>
                </div>
            

                
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">@</span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?= $password ?>"required>
                </div>

                
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">@</span>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm your Password" value="<?= $confirm_password ?>" required>
                </div>

                
                <div class="text-center d-grid gap-2 col-6 mx-auto">
                    <button type="submit" class="btn btn-primary">Signup</button>
                </div>
                <?php
                if(!empty($errors)){ 
                    foreach ($errors as $error): ?>
                        <li><?= $error ?></li>
                <?php endforeach;}?>

            </form>
        </div>
    </div>
    </div>
</div>

<!-- Bootstrap JS (optional, for some features like dropdowns) -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
