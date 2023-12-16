<?php

require_once "framework/Controller.php";
require_once "model/User.php";
require_once "model/Note.php";
require_once "model/Notetext.php";
require_once "model/Notetext.php";


class ControllerNotes extends Controller{ 
    public function index() : void { 
        $user = User::get_user_by_mail("boverhaegen@epfc.eu") ;//$this->get_user_or_redirect();
        $array_notes = Notetext::get_notes_by_user($user);
        $array_notesCheck = Notecheck::get_notes_by_user($user);
        $array_note = array_merge($array_notes,$array_notesCheck);/*donne un seul tableau avec toute les notes 
                                                                   et on peut les identifier gracce a la methode 
                                                                   are you check qui dit si cest une check notes ou pas*/
                                                              
      ( new view("test"))->show($array_notes);
    }

}


?>