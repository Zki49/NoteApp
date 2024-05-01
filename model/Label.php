<?php

 class Label extends Model{
   

     public function  __construct(private int $idnote,private string $label)
     {
        
     }
     public static function  get_all_labels():array|bool{
        $query = self::execute("SELECT  DISTINCT label from note_labels  ORDER BY label ASC",[]);

          $data = $query->fetchAll();
          if ($query->rowCount() == 0) { 
            return false;
        } else {
            $results = [];
            foreach ($data as $row) {
                $results[] = new Label(0,$row["label"]);
            }
            return $results;
        }
    }

    public static function  get_all_labels_by_user(int $id):array|bool{
     $query = self::execute("SELECT DISTINCT label 
                              FROM note_labels nl 
                              WHERE nl.note in (SELECT n.id
                                             FROM notes n
                                             WHERE n.owner = :idUser)
                              ORDER BY label ASC",["idUser"=>$id]);

       $data = $query->fetchAll();
       if ($query->rowCount() == 0) { 
         return false;
          } else {
          $results = [];
          foreach ($data as $row) {
               $results[] = new Label(0,$row["label"]);
          }
          return $results;
          }
     }

     public function delete_label(int $idnote, string $label){
          self::execute("DELETE FROM note_labels WHERE note = :idnote and label = :label",["idnote" => $idnote,"label" => $label]);
     }

     public function add_label(int $idnote,string $label){    
          self::execute("INSERT INTO note_labels (note,label) VALUES(:idnote,:label)",["idnote"=>$idnote,"label"=>$label]);
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

     public function is_valide_label(int $idnote,string $label):array{
          $error = [];
          if($this->is_unique_label($idnote , $label)){
               $error []= "A note cannot contain the same label twice.";  
          }
          if ($this->is_valide_label_lenght($label)){
               $error []= "Label lenght must be between 2 and 10.";
          }
          return $error;
     }

     public function is_unique_label(int $idnote,string $label):bool{
          $query = self::execute("SELECT * from note_labels where note = :idnote AND label = :label ORDER BY label ASC",
          ["idnote"=>$idnote,"label"=>$label]);
          if($query->rowCount() == 0){
               return true;
          }
          return false;
     }

     public function is_valide_label_lenght(string $label):bool{
          $longueur = strlen($label);
          return ($longueur >= 2 && $longueur <= 10);
     }

}

?>