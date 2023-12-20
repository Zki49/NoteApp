<?php
require_once "framework/Controller.php";
require_once "model/User.php";

class ControllerSettings extends Controller {

    public function index(): void{
        
        $user = $this->get_user_or_redirect();
        (new View("settings"))->show(["user"=>$user]);
    }

    public function editProfile() : void {
        $user = User::get_user_by_mail("boverhaegen@epfc.eu"); /* $this->get_user_or_redirect(); */
        (new view("editProfile"))->show(["user"=>$user]);

        if(isset ($_POST)){
            $mail=Tools::sanitize($_POST["mail"]);
            $fullname=Tools::sanitize($_POST["fullname"]);  
        }
          
        $user->edit_profil($mail, $fullname);
    }

    public function logout() : void {
        $_SESSION=session_destroy();
        (new View("login"))->show(["pseudo" => "", "password" => "", "errors" => ""]);
    }

    public function changePassword() : void {
        
    }
}
?>