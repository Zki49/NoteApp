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
      ( new view("viewNotes"))->show(["array_notes"=>$array_note,"tab_shared"=>$tab_shared,"mode"=>$mode]);
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

     public function edit():void{
      $user= /*$this->get_user_or_redirect()*/User::get_user_by_mail("boverhaegen@epfc.eu");
      

       $mode="edit";
       if(isset($_POST["idnotes"])&& isset($_POST["check"])){
        if($user->editor($_POST["idnotes"])){
           if($_POST["check"]===true){
             $notes= Notecheck::get_note_by_id($_POST["idnotes"]);
            }else{
              $notes= Notetext::get_note_by_id(23);
            }
             (new View("editnote"))->show(["notes"=>$notes,"mode"=>$mode]);
        }else{
          (new View("error"))->show(["error"=>"bien essayer"]);
        }
      }

      
    }
    public function move_note():void {
      $user = $this->get_user_or_redirect();
      $note = $_GET['param1'];
      $notes = Notetext::get_note_by_id($note);
      $notes->get_weight_notes_by_user($user);
    }
    public function delete():void{
      if(isset($_GET['param1'])){
        $id = Tools::sanitize($_GET['param1']);
        if(Note::iamcheck($id)){
          $note = Notecheck::get_note_by_id($id);
        }else{
          $note = Notetext::get_note_by_id($id);
        }
        if($note===false){
          (new View("error"))->show(["errors"=>"cette note n'existe pas"]);
        }
        //verifier si editeur cest ok pour sup ou il faut absolument etre proprio 
        if(($this->get_user_or_redirect())->editor($id)){
            $note->delete();
            $note=null;
        }
        $this->redirect("notes");
      }
    }

    public function addtext():void{
      $mode="edit";
      $user=$this->get_user_or_redirect();
      $notes= new Notetext(" ",$user,new DateTime("now"),null,false,false,0,null,0);
      (new View("editnote"))->show(["notes"=>$notes,"mode"=>$mode]);
    }
    //essayer d envoyer un objet complet en post ou get
    public function save():void{
      if(isset($_GET['param1'])){
        $id = $_GET['param1'];
        if( Note::iamcheck($id)){

        }else{
          $note = Notetext::get_note_by_id($id);
          if($note==false){
            (new View("error"))->show(["error"=>"cette note n'existe pas"]);
          }else{
            $note->persist();
          }
          $this->redirect("notes");
        }
      }
      $this->redirect("notes");
    }
    // refaire comme addtext adapter
    public function addcheck() : void{
      $title = "";
      $item1 = "";
      $item2 = "";
      $item3 = "";
      $item4 = "";
      $item5 = "";
      $error = [];
      $content = [];
      if(isset($_POST['title'])){
        $title = Tools::sanitize($_POST['title']);
        $notes = new Notecheck("","",new DateTime("now"),null,false,false,0,[],0);
        $error = $notes->set_title($title);
        if (isset($_POST['item1'])){
          $content[] = Tools::sanitize($_POST['item1']);
        }
        if (isset($_POST['item2'])){
          $content[] = Tools::sanitize($_POST['item2']);
        }
        if (isset($_POST['item3'])){
          $content[] = Tools::sanitize($_POST['item3']);
        }
        if (isset($_POST['item4'])){
          $content[] = Tools::sanitize($_POST['item4']);
        }
        if (isset($_POST['item5'])){
          $content[] = Tools::sanitize($_POST['item5']);
        }

      }
      (new View("addcheck"))->show();
    }

 }
?>