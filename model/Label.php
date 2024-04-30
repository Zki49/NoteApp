<?php

 class Label extends Model{
   

     public function  __construct(private int $idnote,private string $label)
     {
        
     }

     public static function  get_labels_by_note(int $idnote):array{
        $query = self::execute("SELECT * from note_labels where note = :idnote",["idnote"=>$idnote])

          $data = $query->fetchAll();
     }
}

?>