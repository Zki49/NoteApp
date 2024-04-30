<?php

 class Label extends Model{
   

     public function  __construct(private int $idnote,private string $label)
     {
        
     }


     public static function  get_labels_by_note(int $idnote):array|bool{
        $query = self::execute("SELECT * from note_labels where note = :idnote ORDER BY label ASC",["idnote"=>$idnote]);

          $data = $query->fetchAll();
          if ($query->rowCount() == 0) { 
            return false;
        } else {
            $results = [];
            foreach ($data as $row) {
                $results[] = new Label($row["note"],$row["label"]);
            }
            return $results;
        }


     }
     public function get_label_name():string{
        return $this->label;

     }
}

?>