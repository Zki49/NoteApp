<?php
require_once "framework/Model.php";

abstract class Note  extends Model{

     public function __construct(private String $title,private User $owner,private DateTime $createat,
                                 private DateTime | null $editedat,private bool $pinned,private bool $archived, private int $weight) {
                                  
       
    }

    abstract public static function get_note_by_id(int $id):Note |false;
    abstract public static function get_notes_by_user(User $user):array |false ;
    abstract public function are_you_check(): bool;
    
    public function pinned(): bool{
        return $this->pinned;
    }
    public function get_title():string{
        return $this->title;
    }

    public function set_pinned () :bool {
        $this->pinned= !$this->pinned;
        return  $this->pinned;
    }
    public function archived():bool{
        return $this->archived;
    }
    public function set_archived():bool{
        $this->archived=!$this->archived;
        return $this->archived;
    }
    public function get_weight():int {
        return $this->weight;
    }
    private  function validate_title($description):array{
        $errors= [];
        if(strlen($description)<3||strlen($description)){
          $errors []="The title must have between 3 and 25 characters";
        }
        return $errors;
    }
   
}

?>