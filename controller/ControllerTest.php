<?php
require_once "framework/Controller.php";

class ControllerTest extends Controller {
    public function index() : void {
        if ($this->user_logged()) {
            $this->redirect("test");
        } else {
            (new View("login"))->show(["pseudo"=>"","password"=>"","errors"=>""]);
        }        
       
    }
    
    
    
}