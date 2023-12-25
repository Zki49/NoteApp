<?php

require_once "framework/Controller.php";
require_once "model/User.php";
require_once "model/Note.php";
require_once "model/Notetext.php";
require_once "model/Notecheck.php";


class ControllerNotes extends Controller{ 
  private function comparenote(Note $n1,Note $n2) :int{
    if($n1===$n2||$n1->get_weight()==$n2->get_weight()){
        return 0;
    }
    if($n1->get_weight()>$n2->get_weight()){
        return -1;
    }
    if($n1->get_weight()<$n2->get_weight()){
        return 1;
    }
}
    
    public function index() : void { 
      $mode=" ";
        $user = User::get_user_by_mail("boverhaegen@epfc.eu") ;//$this->get_user_or_redirect();
        $array_notes = Notetext::get_notes_by_user($user);
        $array_notesCheck = Notecheck::get_notes_by_user($user);
        $array_note = array_merge($array_notes,$array_notesCheck);/*donne un seul tableau avec toute les notes 
                                                                   et on peut les identifier gracce a la methode 
                                                                   are you check qui dit si cest une check notes ou pas*/
        $tab_shared = User::array_shared_user_by_mail($user); 
        
        usort($array_note, array($this, "comparenote"));
      ( new view("test"))->show(["array_notes"=>$array_note,"tab_shared"=>$tab_shared,"mode"=>$mode]);
    }

    
    /*
    public function notes():void{
      $mode=" ";
        //PAS OUBLIER DE REFERMLER AVEC UN REDIRECT 
        $user = User::get_user_by_mail("boverhaegen@epfc.eu") ;//$this->get_user_or_redirect();
        $array_notes = Notetext::get_notes_by_user($user);
        $array_notesCheck = Notecheck::get_notes_by_user($user);
        $array_note = array_merge($array_notes,$array_notesCheck);/*donne un seul tableau avec toute les notes 
                                                                   et on peut les identifier gracce a la methode 
                                                                   are you check qui dit si cest une check notes ou pas*/
      /*                                                        
       ( new view("test"))->show(["array_notes"=>$array_note,"tab_shared"=>$tab_shared,"mode"=>$mode]);

    }*/
    public function archive():void{
      $mode="archive";
      $user = User::get_user_by_mail("boverhaegen@epfc.eu") ;//$this->get_user_or_redirect();
        $array_notes = Notetext::get_notes_by_user($user);
        $array_notesCheck = Notecheck::get_notes_by_user($user);
        $array_note = array_merge($array_notes,$array_notesCheck);
        $tab_shared = User::array_shared_user_by_mail($user);  
        ( new view("test"))->show(["array_notes"=>$array_note,"tab_shared"=>$tab_shared,"mode"=>$mode]);
    }
    public function open():void{
      
      if(isset($_POST["idnotes"])&& isset($_POST["check"])){
        
        if($_POST["check"]===true){
          $notes= Notecheck::get_note_by_id($_POST["idnotes"]);
        }else{
        $notes= Notetext::get_note_by_id(23);
        }
        (new View("opennote"))->show(["notes"=>$notes]);
      }
    }
    public function pinned():void{
      if(isset($_POST["idnotes"])&& isset($_POST["check"])){
        
        if($_POST["check"]===true){
          $notes= Notecheck::get_note_by_id($_POST["idnotes"]);
        }else{
        $notes= Notetext::get_note_by_id(23);
        }
        $notes->set_pinned ();
       // $notes->persist();
        
      (new View("opennote"))->show(["notes"=>$notes]);
      }
    }

    public function unpinned():void{
      if(isset($_POST["idnotes"])&& isset($_POST["check"])){
        
        if($_POST["check"]===true){
          $notes= Notecheck::get_note_by_id($_POST["idnotes"]);
        }else{
        $notes= Notetext::get_note_by_id(23);
        }
        $notes->set_pinned ();
       // $notes->persist();
        
      (new View("opennote"))->show(["notes"=>$notes]);
      }
    }
    public function archived():void{
      if(isset($_POST["idnotes"])&& isset($_POST["check"])){
        
        if($_POST["check"]===true){
          $notes= Notecheck::get_note_by_id($_POST["idnotes"]);
        }else{
        $notes= Notetext::get_note_by_id(23);
        }
        $notes->set_archived ();
       // $notes->persist();
        
      (new View("opennote"))->show(["notes"=>$notes]);
      }

     }

 }
?>