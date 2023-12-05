<?php
require_once "framework/Controller.php";

class ControllerTest extends Controller {
    public function index() : void {
        if ($this->user_logged()) {
            $user=  $this->get_user_or_redirect();
            (new View("test"))->show();
            
        } else {
            (new View("login"))->show(["pseudo"=>"","password"=>"","errors"=>""]);
        }        
       
    }
    
    
    
}