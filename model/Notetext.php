<?php

class Notetext extends Note{

    //demande pk redef les atribut deja def dans la classe parent 
    public function __construct( $title,$owner, $createat,$editedat, bool $pinned, bool $archived,int $weight,private string $description) {
        parent::__construct($title,$owner,$createat,$editedat,$pinned,$archived,$weight);
    }
    public function get_description():string{
        return $this->description;
    }

    public static function get_note_by_id(int $id): Notetext |false{
        $query = self::execute("SELECT * FROM text_notes nt ,notes n where n.id= :id and nt.id = n.id", ["id"=>$id] );
        $data = $query->fetch(); // un seul résultat au maximum
        if ($query->rowCount() == 0) { 
            return false;
        } else {
            return new Notetext($data["title"],User::get_user_by_id($data["owner"]),new DateTime($data["created_at"]),new DateTime($data["edited_at"]),$data["pinned"],
                                $data["archived"],$data["weight"],$data["content"]);
        }
        
    }
    //a modififfier encore un peut la requete 
    public static function get_notes_by_user(User $user): array |false {
        $query = self::execute("select * FROM text_notes nt 
                                join notes n  on nt.id=n.id 
                                join users u on u.id=n.owner
                                WHERE u.mail =:mail", ["mail"=>$user->get_mail()] );
        $data = $query->fetch(); 
        
            $results = [];
            foreach ($data as $row) {
                $results[] = new Notetext($row["title"],$user,$row["created_at"],$row["edited_at"],$row["pinned"],
                $row["archived"],$row["weight"],$row["content"]);
            }
            return $results;
            
        
    }
    public function are_you_check(): bool{
        return false ;
 }
    
}
?>