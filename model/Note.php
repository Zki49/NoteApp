<?php
require_once "framework/Model.php";

abstract class Note  extends Model{

     public function __construct(String $title,User $owner,DateTime $createat,
                                 DateTime $editedat,bool $pinned,bool $archived) {
       
    }
    

}

?>