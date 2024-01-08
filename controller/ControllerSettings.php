<?php
require_once "framework/Controller.php";
require_once "model/User.php";

class ControllerSettings extends Controller {

    public function index(): void{
        
        $user = User::get_user_by_mail("boverhaegen@epfc.eu"); /*$this->get_user_or_redirect();*/
        (new View("settings"))->show(["user"=>$user]);
    }

    public function editProfile() : void {
    
        $user = User::get_user_by_mail("boverhaegen@epfc.eu"); /* $this->get_user_or_redirect(); */
        $errors=[];

        if(isset($_POST["mail"]) && isset($_POST["fullname"])){
            $mail=Tools::sanitize($_POST["mail"]);
        
            $fullname=Tools::sanitize($_POST["fullname"]);  
            
            $errors=$user->edit_profil($mail, $fullname);
        }

        (new view("editProfile"))->show(["user"=>$user,"errors"=>$errors]);
    }

    public function logout() : void {
        $_SESSION=session_destroy();
        $this->redirect("login");
    }

    public function changePassword() : void {
        $user=User::get_user_by_mail("boverhaegen@epfc.eu"); /* $this->get_user_or_redirect(); */
        $errors=[];
        if(isset($_POST["password"]) && isset($_POST["confirmPassword"]) && isset($_POST["oldPassword"])){

            $oldPassword=Tools::sanitize($_POST["oldPassword"]);

            $errors = $user->validate_login($user->get_mail(), $oldPassword);
     
            if(empty($errors)){
                $password=Tools::sanitize($_POST["password"]);
            
            $confirmPassword=Tools::sanitize($_POST["confirmPassword"]);

            $errors=User::validate_passwords($password, $confirmPassword);

            if(empty($errors)){
                $user->set_password($password);
                $user->persist();
            }
            }
        }
        (new view("changePassword"))->show(["user"=>$user,"errors"=>$errors]);
    }
}
?>