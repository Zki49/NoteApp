<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <base href="<?= $web_root ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit Profile</title>

    <!-- Link Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyvbR5XsN2lI9zAKLkD/KrO5AiUT6vZnJ"
        crossorigin="anonymous">

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #000;
            color: #fff;
            font-size: 1.2rem;
        }

        .card {
            margin-top: 50px;
        }

        .form-group label {
            font-size: 1.2rem;
        }

        .title-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        /* Ajout de l'espace entre les champs */
        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card">
                    <div class="card-body">
                        <div class="title-bar">
                        <button class="btn btn-light">
                            <a href="settings" id="btnRetour">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                                </svg>
                            </a>
                        </button>
                            <h3>Edit Profile</h3>
                        </div>

                        <!-- Form for editing profile -->
                        <form>
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control form-control-lg" id="username"
                                    value="<?= $user->get_fullnam()?>">
                            </div>

                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control form-control-lg" id="email"
                                value="<?= $user->get_mail()?>">
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg">Save Changes</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Link Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyvbR5XsN2lI9zAKLkD/KrO5AiUT6vZnJ"
        crossorigin="anonymous">

</body>

</html>
