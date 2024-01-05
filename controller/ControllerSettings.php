<?php
require_once "framework/Controller.php";
require_once "model/User.php";

class ControllerSettings extends Controller {

    public function index(): void{
        
        $user = $this->get_user_or_redirect();
        (new View("settings"))->show(["user"=>$user]);
    }

    public function editProfile() : void {
        $user = $this->get_user_or_redirect(); 
        (new view("editProfile"))->show(["user"=>$user]);

        if(isset($_POST["mail"]) && isset($_POST["fullname"])){
            $mail=Tools::sanitize($_POST["mail"]);
            $fullname=Tools::sanitize($_POST["fullname"]);  

            $user->edit_profil($mail, $fullname);
        }
    }

    public function logout() : void {
        $_SESSION=session_destroy();
        $this->redirect("login");
    }

    public function changePassword() : void {
        $user= $this->get_user_or_redirect(); 
        (new view("changePassword"))->show(["user"=>$user]);

        if(isset($_POST["password"])){
            $password=Tools::sanitize($_POST["password"]);
            $errors=$user->set_password($password);
            if(!empty($errors)){
                (new view("changePassword"))->show(["user"=>$user, "error"=>$errors]);
            }
        }
    }
}
?>