<?php

require_once "framework/Controller.php";
require_once "model/User.php";

class ControllerSignup extends Controller{

    public function index() : void {
        $mail = '';
        $pseudo = '';
        $password = '';
        $confirmPassword = '';
        $errors = [];


        if (isset($_POST['email']) && isset($_POST['name']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
            $mail = $_POST['email'];
            $pseudo = $_POST['name'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];


            $member = new User($pseudo, Tools::my_hash($password),$pseudo,"user");
            $errors = User::validate_unicity_mail($mail);
            $errors = User::validate_unicity($pseudo);
            $errors = array_merge($errors, $member->validate());
            $errors = array_merge($errors, User::validate_passwords($password, $confirmPassword));

            if (count($errors) == 0) { 
                $member->persist(); //sauve l'utilisateur

                $this->log_user($member, "Test" );
            }            
        }
        (new View("signup"))->show(["mail" => $mail,"pseudo" => $pseudo, "password" => $password,"confirmPassword" =>$confirmPassword ,"errors" => $errors]);   
    }
}
?>