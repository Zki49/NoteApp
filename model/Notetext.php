<?php

class Notetext extends Note{

    public static function get_note_by_id(int $id): Note{
        $query = self::execute("SELECT * FROM text_notes where id = :id", ["id"=>$id]);
        $data = $query->fetch(); // un seul résultat au maximum
        if ($query->rowCount() == 0) {
            return false;
        } else {
            return new Notetext($data[]);
        }
        
    }
    
}
?>