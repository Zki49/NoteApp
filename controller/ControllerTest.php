<?php
require_once "framework/Controller.php";
require_once "model/User.php";
require_once "model/Note.php";

class ControllerTest extends Controller{
    public function index() : void {
        if ($this->user_logged()) {
            $user=$this->get_user_or_redirect();
            $tab_shared = User::array_shared_user_by_mail($user);

            (new View("test"))->show(["user"=>$user, "tab_shared" =>$tab_shared] );
            
        } else {
            (new View("login"))->show(["pseudo"=>"","password"=>"","errors"=>""]);
        }        
       
    }

    /*public function get_shared_notes () : void {
        if ($this->user_logged() && isset($_GET["param1"]) && $_GET["param1"] !== "") {
            $user=$this->get_user_or_redirect();
            $userShared = User::get_user_by_mail($_GET["param1"]);
            $array_shared_notes = Notetext::get_shared_notes($user,$userShared);

            (new View("shared_notes"))->show(["array_shared_notes"=>$array_shared_notes]);
        }else{
            (new View("login"))->show(["pseudo"=>"","password"=>"","errors"=>""]);
        }
    */
    // Controller
public function get_shared_notes() : void {
    if ($this->user_logged() ) {
        $user = $this->get_user_or_redirect();
        $userShared = User::get_user_by_mail($_GET["param1"]);
        $array_shared_notes = Notetext::get_shared_notes($user, $userShared);

        (new View("shared_notes"))->show(["array_shared_notes" => $array_shared_notes]);
    } else {
        (new View("login"))->show(["pseudo" => "", "password" => "", "errors" => ""]);
    }
}

}
    
    
  ?>
