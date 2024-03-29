<?php

require_once "framework/Controller.php";
require_once "model/User.php";
require_once "model/Note.php";
require_once "model/Notetext.php";
require_once "model/Notecheck.php";
require_once "model/Notemixte.php";
require_once  "model/Sharenote.php";


class ControllerNotes extends Controller{ 
  private function comparenote(Note|Sharenote $n1,Note|Sharenote $n2) :int{
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
  
    public function pinned():void{
      if(isset($_GET["param1"])){
        $id=$_GET["param1"];
        $notes = Notemixte::get_note_by_id($id);
        $notes->set_pinned ();
        $notes->persist();
        
        $this->redirect("notes","open", $id);
      }
    }

    public function archived():void{
      if(isset($_GET["param1"])){
        $id=$_GET["param1"];
        $notes = Notemixte::get_note_by_id($id);
        if(($this->get_user_or_redirect())->editor($id)){
        $notes->set_archived();
        $notes->persist();
        $this->redirect("notes","open", $id);
        }else{
          (new view("error"))->show(["error"=>"you are note editor"]);
        }
      }

     }
     public function open():void{
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
        if(isset($_GET['param2'])){
        (new View("opennote"))->show(["notes"=>$notes ,"is_editor"=>$is_editor,"deleted"=>$_GET['param2']]);
        }
        else{
        (new View("opennote"))->show(["notes"=>$notes,"is_editor"=>$is_editor]);
        }
      }else {
        $this->redirect("notes");
      }
     }
     public function openshare():void{
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
        (new View("opennote"))->show(["notes"=>$notes,"is_editor"=>$is_editor,"share"=>true]);
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
        $note->get_weight_notes_by_user();
      
      }
      if($note->archived()){
        $this->redirect("notes","archive");
      }else{
           $this->redirect("notes");
      }
    }
    public function movedown():void{
      if(isset($_POST["idnotes"])){
        $id=Tools::sanitize($_POST["idnotes"]);
        $note= Notemixte::get_note_by_id($id);
        $note->movedown();        
      }
      if($note->archived()){
        $this->redirect("notes","archive");
      }else{
           $this->redirect("notes");
      }
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
        
        if(($this->get_user_or_redirect())==$note->owner()){
            $note->delete();
            $note=null;
            $this->redirect("notes/archive");
        }else{
          (new View("error"))->show(["error"=>"your are not owner  "]);
        }
        
      }
    }

    public function addtext():void{
      $mode="edit";
      $user=$this->get_user_or_redirect();
      $notes= new Notetext(" ",$user,new DateTime("now"),null,false,false,0,null,0);
      (new View("editnote"))->show(["notes"=>$notes,"mode"=>$mode]);
    }
    public function save():void{
       if(isset($_POST['title']) && isset($_POST['idnotes'])){
        $id = Tools::sanitize($_POST['idnotes']);
        $title= Tools::sanitize($_POST['title']);
        if( Note::iamcheck($id)){
          $note= Notemixte::get_note_by_id($id);
          $error=$note->set_title($title);
          if(empty($error)){
            $note->update_title($title); 
          }
           $this->redirect("notes"); 
        }
      if( isset( $_POST['text'])){    
        $text= Tools::sanitize($_POST['text']);
        
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
              $this->redirect("notes");
            }else{
              (new View("editnote"))->show(["notes"=>$note,"mode"=>"edit","errors"=>$error]);
            }
          }else{
            //remetre les ereur dans les vue si il y en a 
            $error=$note->set_title($title);
            $note->set_description($text);
            if(empty($error)){
              $note->persist();
              $this->redirect("notes");
            }else{
              (new View("editnote"))->show(["notes"=>$note,"mode"=>"edit","errors"=>$error]);
            }
            
          
         
        }
      }
     // $this->redirect("notes");
      }
     
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
    public function check():void{
      $item = Item::get_un_item($_GET['param1']);
      $item->unchecked_checked();
      $item->persit();
      $idNote= $item->get_id_my_note();
      $this->redirect("notes","open",$idNote);
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
    public function confirm():void{
      if(isset($_GET['param1'])){
         $cofirm =true;
         $this->redirect("notes","open",$_GET['param1'],$cofirm);
      }

    }

    public function deleteShared(): void{
      $note=Notemixte::get_note_by_id($_POST["idNote"]);
      $note->delete_shared($_POST["idUser"]);
      self::shared2($_POST["idNote"]);
    }

    private function shared2(int $idNote): void{
      $user=$this->get_user_or_redirect();
      
      $userShare="";
        $id=$idNote;

        if(isset($_POST["idUser"]) && isset($_POST["editor"])){
          
          $tabAddShare[$_POST["idUser"]]=$_POST["editor"];
          $note=Notemixte::get_note_by_id($id);
          $note->add_shared($tabAddShare);
          
        }

        $tabUsers=User::not_into_shared($id);

        $tabUSersAlready=User::tab_user_in_share($id);
        (new View("shared"))->show(["tabUsers"=>$tabUsers, "idnotes"=>$id, "tabUSerAlready"=>$tabUSersAlready]);
      
    }

    public function toggle(): void{
      $idNote=$_POST["idNote"];
      $note=Notemixte::get_note_by_id($idNote);
      $idUser=$_POST["idUser"];

      $note->change_permission($idUser);
      self::shared2($_POST["idNote"]);
    }
    public function get_shared_notes() : void {
      if ($this->user_logged() ) {
          $user = $this->get_user_or_redirect();
          if(isset($_GET["param1"])){
          $userShared = User::get_user_by_id($_GET["param1"]);
          
          $array_shared_notes_editor = Sharenote::get_shared_notes_editor($user, $userShared);
          $array_shared_notes_not_editor = Sharenote::get_shared_notes_not_editor($user, $userShared);
          $tab_shared = User::array_shared_user_by_mail($user);
          if(!empty($array_shared_notes_editor)){
             usort($array_shared_notes_editor, array($this, "comparenote"));
          }
          if(!empty($array_shared_notes_not_editor)){
          usort($array_shared_notes_not_editor, array($this, "comparenote"));
          }

  
  
          (new View("shared_notes"))->show(["array_shared_notes_editor" => $array_shared_notes_editor,
                                            "array_shared_notes_not_editor"=>$array_shared_notes_not_editor, 
                                            "tab_shared"=>$tab_shared,
                                            "userShared"=>$userShared]);
        }
      } else {
          (new View("login"))->show(["pseudo" => "", "password" => "", "errors" => ""]);
      }
  }

 }
?>