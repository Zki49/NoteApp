<?php
require_once "framework/Model.php";

abstract class Note  extends Model{

     public function __construct(private String $title,private User $owner,private DateTime $createat,
                                 private DateTime $editedat,private bool $pinned,private bool $archived, private int $weight) {
            $this->pinned=false;
            $this->archived= false;                        
       
    }

    abstract public static function get_note_by_id(int $id):Note |false;
    abstract public static function get_notes_by_user(User $user):array |false ;
    abstract public function are_you_check(): bool;
    
    public function pinned(): bool{
        return $this->pinned;
    }

    public function set_pinned () :bool {
        $this->pinned= !$this->pinned;
        return true;
    }
    public function set_archived():bool{
        $this->archived=!$this->archived;
        return true;
    }
    public function get_weight():int {
        return $this->weight;
    }
}

?>