<?php
class Notecheck extends Note{

    // a complete demain 
    public function __construct( $title,$owner, $createat,$editedat, bool $pinned, bool $archived,int $weight,private string $content  ) {
        parent::__construct($title,$owner,$createat,$editedat,$pinned,$archived,$weight);
    }
    public static function get_note_by_id(int $id): Notecheck |false{
        $query = self::execute("SELECT * FROM check_listnotes nt ,notes n where n.id= :id and nt.id = n.id", ["id"=>$id] );
        $data = $query->fetch(); // un seul résultat au maximum
        if ($query->rowCount() == 0) { 
            return false;
        } else {
            return new Notecheck($data["title"],User::get_user_by_id($data["owner"]),$data["created_at"],$data["edited_at"],$data["pinned"],
                                $data["archived"],$data["weight"],$data["content"]);
        }
        
    }
    //encore un peut de mofi et on y est 
    public static function get_notes_by_user(User $user): array |false {
        $query = self::execute("select * 
                                FROM checklist_notes cn 
                                join notes n  on cn.id=n.id 
                                join users u on u.id=n.owner
                                join checklist_note_items cni on cni.checklist_note=cn.id
                                WHERE u.mail =:mail
                                and n.archived = 0
                                and n.id not in (SELECT note_shares.note
                                                FROM note_shares);", ["mail"=>$user->get_mail()] );
        $data = $query->fetch();
        if ($query->rowCount() == 0) { 
            return false;
        } else {
            $results = [];
            foreach ($data as $row) {
                $results[] = new Notecheck($row["title"],$user,$row["created_at"],$row["edited_at"],$row["pinned"],
                $row["archived"],$row["weight"],$row["content"]);
            }
            return $results;
        }
    }

     public function are_you_check(): bool{
            return true;
     }
     

}

?>