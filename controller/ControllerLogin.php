<?php
require_once "framework/Controller.php";
require_once "model/User.php";


class ControllerLogin extends Controller {

public function index(): void{
    if($this->user_logged()){
        $this->redirect("notes");
    }else{
       $this->login();
    }
  }
  private function login():void{
    $pseudo = '';
    $password = '';
    $errors = [];
    if (isset($_POST['pseudo']) && isset($_POST['password'])) { //note : pourraient contenir des chaînes vides

        $pseudo = Tools::sanitize($_POST['pseudo']);
        $password = Tools ::sanitize($_POST['password']);

        $errors = User::validate_login($pseudo, $password);
        if (empty($errors)) {
            $this->log_user(User::get_user_by_mail($pseudo));
            $this->redirect("Notes"); 
            $_SESSION=session_start();

        }
    }
    (new View("login"))->show(["pseudo" => $pseudo, "password" => $password, "errors" => $errors]);

  }

}
?>