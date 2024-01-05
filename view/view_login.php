<!DOCTYPE html>
<html lang="fr">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <base href="<?= $web_root ?>"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Signin Template for Bootstrap</title>
  <!-- Custom styles for this template -->
  <style>
    body{
      background-color: black;
      color: white;
    }
    
  </style>
</head>
<body class="text-center">
  <div class="container mt-5">  
  <form class="form-signin" action="login"  method="post" >
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" name="pseudo" id="pseudo" class="form-control" placeholder="Email address" required autofocus value="<?= $pseudo ?>">
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required value="<?= $password ?>">
    
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    

    <a href="signup/index" >Sing up</a>
    

    <?php
    if(!empty($errors)){ 
    foreach ($errors as $error): ?>
     <li><?= $error ?></li>
    <?php endforeach; }?>

  </form>
  </div>
</body>
</html>
