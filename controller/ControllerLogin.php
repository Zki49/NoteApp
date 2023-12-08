<?php
require_once "framework/Controller.php";
require_once "model/User.php";


class ControllerLogin extends Controller {

public function index(): void{
    $pseudo = '';
    $password = '';
    $errors = [];
    if (isset($_POST['pseudo']) && isset($_POST['password'])) { //note : pourraient contenir des chaînes vides
        $pseudo = $_POST['pseudo'];
        $password = $_POST['password'];

        $errors = User::validate_login($pseudo, $password);
        if (empty($errors)) {
            echo" $pseudo";
            $this->log_user(User::get_user_by_pseudo($pseudo));
            (new View("test"))->show(["pseudo"=>(User::get_user_by_pseudo($pseudo))->get_mail()]); 
        }
    }
    (new View("login"))->show(["pseudo" => $pseudo, "password" => $password, "errors" => $errors]);

  }
}
?>