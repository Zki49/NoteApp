<?php

require_once "framework/Controller.php";
require_once "model/User.php";
require_once "model/Note.php";
require_once "model/Notetext.php";
require_once "model/Notecheck.php";
require_once "model/Notemixte.php";


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
      $array_note= [];
      $user =$this->get_user_or_redirect();
      $array_notes = Notetext::get_notes_by_user($user);
       $array_notesCheck = Notecheck::get_notes_by_user($user);
       if($array_notes && $array_notesCheck){
            $array_note = array_merge($array_notes,$array_notesCheck);
            usort($array_note, array($this, "comparenote"));
        }elseif($array_notes){
          $array_note = $array_notes;
        }elseif($array_notesCheck){
          $array_note = $array_notesCheck;
        }
                                                                  /*donne un seul tableau avec toute les notes 
                                                                   et on peut les identifier gracce a la methode 
                                                                   are you check qui dit si cest une check notes ou pas*/
      $tab_shared = User::array_shared_user_by_mail($user);   
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
      $user = $this->get_user_or_redirect();
      $array_note=[];
        $array_notes = Notetext::get_notes_by_user($user);
        $array_notesCheck = Notecheck::get_notes_by_user($user);
        if($array_notes && $array_notesCheck){
          $array_note = array_merge($array_notes,$array_notesCheck);
          usort($array_note, array($this, "comparenote"));
      }elseif($array_notes){
        $array_note = $array_notes;
      }elseif($array_notesCheck){
        $array_note = $array_notesCheck;
      }
               
        $tab_shared = User::array_shared_user_by_mail($user);  
        ( new view("viewNotes"))->show(["array_notes"=>$array_note,"tab_shared"=>$tab_shared,"mode"=>$mode]);
    }
    public function open():void{
      
      if(isset($_POST["idnotes"])){
        $id=Tools::sanitize($_POST["idnotes"]);
        $this->redirect("notes","reopen", $id);
       /* if(Note::iamcheck($id)){
          $notes= Notecheck::get_note_by_id($id);
        }else{
        $notes= Notetext::get_note_by_id($id);
        }
        $user= $this->get_user_or_redirect();
        $is_editor = $user->editor($notes->get_id());
        (new View("opennote"))->show(["notes"=>$notes, "is_editor"=>$is_editor]);*/
      }
    }
    public function pinned():void{
      if(isset($_POST["idnotes"])){
        $id=Tools::sanitize($_POST["idnotes"]);
        $id=Tools::sanitize($_POST["idnotes"]);
        $notes = Notemixte::get_note_by_id($id);
        $notes->set_pinned ();
        $notes->persist();
        
        $this->redirect("notes","reopen", $id);
      }
    }

    public function archived():void{
      if(isset($_POST["idnotes"])){
        $id=Tools::sanitize($_POST["idnotes"]);
        $notes = Notemixte::get_note_by_id($id);
        $notes->set_archived();
        $notes->persist();
        $this->redirect("notes","reopen", $id);
      }

     }
     public function reopen():void{
      if(isset($_GET["param1"])){
        $id = Tools::sanitize($_GET["param1"]);
        if(Note::iamcheck($id)){
          $notes= Notecheck::get_note_by_id($id);
          
        }else{
        $notes= Notetext::get_note_by_id($id);
        }
        if($notes==false){
          (new View("error"))->show(["error"=>"cette note nexiste pas"]);
        }
        $user= $this->get_user_or_redirect();
        $is_editor = $user->editor($notes->get_id());
        (new View("opennote"))->show(["notes"=>$notes,"is_editor"=>$is_editor]);
      }else {
        $this->redirect("notes");
      }
     }

     public function edit():void{
      $user= $this->get_user_or_redirect();
      

       $mode="edit";
       if(isset($_POST["idnotes"])){
        $id=Tools::sanitize($_POST["idnotes"]);
        if($user->editor($_POST["idnotes"])){
           if(Note::iamcheck($id)){
             $notes= Notecheck::get_note_by_id($id);
            }else{
              $notes= Notetext::get_note_by_id($id);
            }
             (new View("editnote"))->show(["notes"=>$notes,"mode"=>$mode]);
        }else{
          (new View("error"))->show(["error"=>"bien essayer"]);
        }
      }

      
    }
    public function note_is_first_or_last(int $id) : void {
      $last = "last";
      $first = "first";
      $user = $this->get_user_or_redirect();
      $array_note = Note::get_notes_by_user($user);
      if(isset($_GET["idnotes"])){
        $id = Tools::sanitize($_GET["idnotes"]);
        $note = Notecheck::get_note_by_id($id);
        foreach($array_note as $row){
          if(key($array_note) == 0 && $row->get_id() == $note->get_id()){
            if($note->are_you_check()){
              (new View("notecheck"))->show(["notes"=>$note , "pos"=>$first]);
            }else{
              (new View("note"))->show(["notes"=>$note, "pos"=>$first]);
            }
          }
          if(key($array_note) == end($array_note) && $row->get_id() == $note->get_id()){
            if($note->are_you_check()){
              (new View("notecheck"))->show(["notes"=>$note , "pos"=>$last]);
            }else{
              (new View("note"))->show(["notes"=>$note, "pos"=>$last]);
            }
          }
        }
      }
    }
    public function moveup():void{
      if(isset($_POST["idnotes"])){
        $id=Tools::sanitize($_POST["idnotes"]);
        $note= Notemixte::get_note_by_id($id);
        if(!$note->pinned()){
             $note->get_weight_notes_by_user();
        }
      }
      $this->redirect("notes");
    }
    public function movedown():void{
      if(isset($_POST["idnotes"])){
        $id=Tools::sanitize($_POST["idnotes"]);
        $note= Notemixte::get_note_by_id($id);
        if(!$note->pinned()){
           $note->movedown();
        }
      }
      $this->redirect("notes");
    }
    public function move_note():void {
      $user = $this->get_user_or_redirect();
      $note = $_GET['param1'];
      $notes = Notemixte::get_note_by_id($note);
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
    public function save():void{
      if(isset($_POST['title']) && isset( $_POST['text'])&& $_POST['idnotes']){
        $id = Tools::sanitize($_POST['idnotes']);
        var_dump($id);
        $title= Tools::sanitize($_POST['title']);
        $text= Tools::sanitize($_POST['text']);
        if( Note::iamcheck($id)){

        }else{
          $note = Notetext::get_note_by_id($id);
          if($note==false){
           $user= $this->get_user_or_redirect();
            $note= new Notetext(" ",$user,new DateTime("now"),null,false,false,0,null,0);
            $weight= $note->max_weight();
            $note->set_weight($weight+1);
            $error=$note->set_title($title);
            $note->set_description($text);
            if(empty($error)){
              $note->persist();
            }
          }else{
            //remetre les ereur dans les vue si il y en a 
            $error=$note->set_title($title);
            $note->set_description($text);
            if(empty($error)){
              $note->persist();
            }
            
          }
          $this->redirect("notes");
        }
      }
      $this->redirect("notes");
    }
   
    public function addcheck() : void{
      $userOwner = $this->get_user_or_redirect();
      $title = "";
      $error = null;
      $content = [];
      $error1=[];
      $errors = [];
     
      if(isset($_POST['title'])){
        $title = Tools::sanitize($_POST['title']);
        $notes = new Notecheck($title,$userOwner,new DateTime("now"),null,false,false,0,[],0);
        $user=$this->get_user_or_redirect();
        $error = $notes->set_title($title);
        $weight= $notes->max_weight();
        $notes->set_weight($weight+1);
        

        if (isset($_POST['item1']) && !empty($_POST['item1']) && !ctype_space($_POST['item1'])){
          $content[] = Tools::sanitize($_POST['item1']);
        }
        if (isset($_POST['item2'])&& !empty($_POST['item2']) && !ctype_space($_POST['item2'])){
          $content[] = Tools::sanitize($_POST['item2']);
        }
        if (isset($_POST['item3'])&& !empty($_POST['item3']) && !ctype_space($_POST['item3'])){
          $content[] = Tools::sanitize($_POST['item3']);
        }
        if (isset($_POST['item4'])&& !empty($_POST['item4']) && !ctype_space($_POST['item4'])){
          $content[] = Tools::sanitize($_POST['item4']);
        }
        if (isset($_POST['item5'])&& !empty($_POST['item5']) && !ctype_space($_POST['item5'])){
          $content[] = Tools::sanitize($_POST['item5']);
        }
        $notes->set_content($content);
        $error1 = $notes->unique_content($content);
        if(empty($error)&& empty($error1)){
          $notes->add();
        $this->redirect("notes");
        }
        $errors = array_merge($error,$error1);
      }
      
      (new View("addcheck"))->show(["errors" => $errors , "title"=>$title]);
    }

    public function additem():void{
       $mode="edit";
       
       if(isset($_POST["newitem"]) && isset($_POST["idnotes"])){
          $new = Tools::sanitize($_POST["newitem"]);
          $id = Tools::sanitize($_POST["idnotes"]);
          if(Note::iamcheck($id)){
              $note = Notecheck::get_note_by_id($id);
              $error=$note->additem($new);
              $note = Notecheck::get_note_by_id($id);
              (new View("editnote"))->show(["notes"=>$note,"mode"=>$mode,"errors"=>$error]);
            
          }
          
       }
    }
    public function deleteitem():void {
      if(isset($_POST["item"])&& isset($_POST['id'])){
        $id= $_POST["id"];
        $item=$_POST["item"];
        if(Note::iamcheck($id)){
          $note= Notecheck::get_note_by_id($id);
          $note->deleteitem($item);
          $note= Notecheck::get_note_by_id($id);
        (new View("editnote"))->show(["notes"=>$note,"mode"=>'edit']);
        }else{
         
        }
      }
    }

    public function shared():void{
      $user=$this->get_user_or_redirect();
      
      if(isset($_POST["idnotes"])){
        $userShare="";
        $id=$_POST["idnotes"];

        if(isset($_POST["idUser"]) && isset($_POST["editor"])){
          
          $tabAddShare[$_POST["idUser"]]=$_POST["editor"];
          $note=Notemixte::get_note_by_id($id);
          $note->add_shared($tabAddShare);
          
        }

        $tabUsers=User::not_into_shared($id);

        $tabUSersAlready=User::tab_user_in_share($id);
        (new View("shared"))->show(["tabUsers"=>$tabUsers, "idnotes"=>$id, "tabUSerAlready"=>$tabUSersAlready]);
      }
      else{
        (new View("shared"))->show([]);
      }

    }

    public function deleteShared(): void{
      
    }

 }
?>