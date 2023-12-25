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

    public function get_shared_notes (User $shared_user) : array {
        $user=$this->get_user_or_redirect();
        $array_shared_notes = Notetext::get_shared_notes($user, $shared_user);
        return $array_shared_notes;
    }
    
    
    
}