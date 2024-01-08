<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <base href="<?= $web_root ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Signup Page</title>
    <link rel="shortcut icon" href="data:image/png;base64,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" type="image/x-icon">

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
