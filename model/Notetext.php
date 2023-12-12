<?php

class Notetext extends Note{

    
    public function __construct( $title,$owner, $createat,$editedat,bool $pinned,bool $archived,private string $description) {
        parent::__construct($title,$owner,$createat,$editedat,$pinned,$archived);
    }
    public static function get_note_by_id(int $id): Notetext |false{
        $query = self::execute("SELECT * FROM text_notes nt ,notes n where n.id= :id and nt.id = n.id", ["id"=>$id] );
        $data = $query->fetch(); // un seul résultat au maximum
        if ($query->rowCount() == 0) { 
            return false;
        } else {
            return new Notetext($data["title"],User::get_user_by_id($data["owner"]),$data["created_at"],$data["edited_at"],$data["pinned"],
                                $data["archived"],$data["content"]);
        }
        
    }
    public static function get_notes_by_user(User $user): Notetext |false {
        $query = self::execute("SELECT * FROM text_notes nt ,notes n where n.owner= :idowner and nt.id = n.id", ["idowner"=>$user->get_id()] );
        $data = $query->fetch(); // un seul résultat au maximum
        if ($query->rowCount() == 0) { 
            return false;
        } else {
            return new Notetext($data["title"],User::get_user_by_id($data["owner"]),$data["created_at"],$data["edited_at"],$data["pinned"],
                                $data["archived"],$data["content"]);
        }
    }
    
}
?>