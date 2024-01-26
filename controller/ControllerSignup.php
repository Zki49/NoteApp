<?php

require_once "framework/Controller.php";
require_once "model/User.php";

class ControllerSignup extends Controller{

    public function index() : void {
        $email = '';
        $name = '';
        $password = '';
        $confirm_password = '';
        $errors = [];


        if (isset($_POST['email']) && isset($_POST['name']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
            $email =Tools::sanitize( $_POST['email']);
            $name =Tools::sanitize ($_POST['name']);
            $password = Tools ::sanitize($_POST['password']);
            $confirm_password = Tools::sanitize($_POST['confirm_password']);


            $member = new User($email, Tools::my_hash($password),$name,"user");
            $errors = User::validate_unicity_mail($email);
            $errors = User::validate_unicity($name);
            $errors = array_merge($errors, $member->validate());
            $errors = array_merge($errors, User::validate_passwords($password, $confirm_password));

            if (count($errors) == 0) { 
                $member->persist(); //sauve l'utilisateur
                $this->log_user($member,"Test" );
            }
            $idUser = $member->get_id();
            $this->redirect("signup" , "redirect_prg", $idUser , $confirm_password);            
        }else
            (new View("signup"))->show(["email" => $email,"name" => $name, "password" => $password,"confirm_password" =>$confirm_password ,"errors" => $errors]);   
    }
    private function redirect_prg() : void {
        $idUser = $_GET['idUser'];
        $member = User::get_user_by_id($idUser);
        $email = $member->get_mail();
        $name = $member->get_fullnam();
        $password = $member->get_password();
        $confirm_password = $_GET['confirm_password'];
        $errors = []; 
        $errors = User::validate_unicity_mail($email);
        $errors = User::validate_unicity($name);
        $errors = array_merge($errors, $member->validate());
        $errors = array_merge($errors, User::validate_passwords($password, $confirm_password));
        (new View("signup"))->show(["email" => $email,"name" => $name, "password" => $password,"confirm_password" =>$confirm_password ,"errors" => $errors]);
    }


}
?>