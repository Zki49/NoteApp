<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <base href="<?= $web_root ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Signup Page</title>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="mb-4">Signup</h2>
            <form id="signupForm" action="signup/index" method="post">

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Email:</label>
<<<<<<< HEAD
                    <input type="email" class="form-control" id="email" name="email" value="<?= $mail ?>" required>
=======
                    <input type="email" class="form-control" id="email" name="email" value="<?= $mail ?> "required>
>>>>>>> b85bf74ece5055fa916e20fcb6d3e13d42c28026
                </div>

                <!-- Name -->
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= $pseudo ?>"required>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" value="<?= $password ?>"required>
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="confirm_password">Confirm Password:</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" value="<?= $confirmPassword ?>" required>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Signup</button>

                <?php
                if(!empty($errors)){ 
                foreach ($errors as $error): ?>
                <li><?= $error ?></li>
                <?php endforeach;}?>

            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS (optional, for some features like dropdowns) -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
