<?php
require_once "framework/Controller.php";
require_once "model/User.php";

class ControllerSettings extends Controller {

    public function index(): void{
        
        $user = $this->get_user_or_redirect();
        (new View("settings"))->show(["user"=>$user]);
    }

    public function editProfile() : void {
        
    }

    public function logout() : void {
        session_destroy();
        (new View("login"))->show(["pseudo" => "", "password" => "", "errors" => ""]);
    }

    public function changePassword() : void {
        
    }
}
?>