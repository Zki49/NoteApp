<?php

require_once "framework/Controller.php";
require_once "model/User.php";
require_once "model/Note.php";
require_once "model/Notetext.php";
require_once "model/Notetext.php";


class ControllerNotes extends Controller{ 
    public function index() : void { 
        $user = $this->get_user_or_redirect;
        $array_notes = Notetext::get_notes_by_user;
        $array_notesCheck = Notecheck::get_notes_by_user();
    }

}


?>