<?php
require_once "framework/Model.php";

abstract class Note  extends Model{

     public function __construct(String $title,User $owner,DateTime $createat,
                                 DateTime $editedat,bool $pinned,bool $archived) {
       
    }

    abstract public static function get_note_by_id(int $id):Note |false;
    abstract public static function get_notes_by_user(User $user):Note |false ;
    

}

?>