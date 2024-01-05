<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <base href="<?= $web_root ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Signup Page</title>
    <style>
        /* Custom style for input fields matching bg-dark */
        .custom-input-bg {
            background-color: #343a40 !important; /* Important declaration to override Bootstrap styles */
            color: white; /* Text color for better visibility */
        }

        /* Custom style for border around signup section */
        .signup-section {
            border: 1px solid #6c757d; /* Border color */
            border-radius: 8px; /* Border radius */
            padding: 15px 20px !important; /* Important declaration to override Bootstrap styles */
        }

        /* Custom style for span elements */
        .custom-span-color {
            color: #6c757d !important; /* Important declaration to override Bootstrap styles */
        }

        /* Custom style for horizontal line below "Signup" */
        .signup-line {
            border-top: 1px solid #6c757d; /* Border color */
            margin-top: 10px; /* Adjusted margin for space */
            margin-bottom: 15px; /* Adjusted margin for space */
        }

        /* Custom style to match button size with input fields */
        .custom-button-size {
            min-width: 100%; /* Set button width to match input fields */
        }
    </style>
</head>

<body class="bg-dark">

    <div class="container mt-5">
        <div class="p-3 mb-2 bg-body text-body signup-section">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <span>
                        <h2 class="text-center text-white">Signup</h2>
                        <div class="signup-line"></div> <!-- Horizontal line below "Signup" -->
                        <form id="signupForm" action="signup/index" method="post">

                            <div class="input-group mb-3">
                                <span class="input-group-text custom-span-color" id="addon-wrapping">@</span>
                                <input type="email" class="form-control custom-input-bg" id="email" name="email"
                                    placeholder="Email" value="<?= $email ?>" required>
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text custom-span-color" id="basic-addon1">@</span>
                                <input type="text" class="form-control custom-input-bg" id="name" name="name"
                                    placeholder="Full Name" value="<?= $name ?>" required>
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text custom-span-color" id="basic-addon1">@</span>
                                <input type="password" class="form-control custom-input-bg" id="password"
                                    name="password" placeholder="Password" value="<?= $password ?>" required>
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text custom-span-color" id="basic-addon1">@</span>
                                <input type="password" class="form-control custom-input-bg" id="confirm_password"
                                    name="confirm_password" placeholder="Confirm your Password"
                                    value="<?= $confirm_password ?>" required>
                            </div>

                            


                            
                                <div class="text-center d-grid gap-2 col-14 mx-auto">
                                    <button type="submit" class="btn btn-primary custom-button-size">Signup</button>
                                </div>
                                <p></p>
                                <div class="text-center d-grid gap-2 col-14 mx-auto">
                                    <button type="button" href="login/index" class="btn btn-outline-danger custom-button-size">Cancel</button>
                                </div>
                            

                            <?php
                            if (!empty($errors)) {
                                foreach ($errors as $error): ?>
                                    <li><?= $error ?></li>
                            <?php endforeach;
                            }?>

                        </form>
                    </span>
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
