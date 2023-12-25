<?php

class Notetext extends Note{

     
    public function __construct( $title,$owner, $createat,DateTime |null $editedat, bool $pinned, bool $archived,int $weight,private string|null $description,$id) {
        parent::__construct($title,$owner,$createat,$editedat,$pinned,$archived,$weight,$id);
    }
    public function get_description():string |null{
        return $this->description;
    }

    public static function get_note_by_id(int $id): Notetext |false{
        $query = self::execute("SELECT * FROM text_notes nt ,notes n where n.id= :id and nt.id = n.id", ["id"=>$id] );
        $data = $query->fetch(); // un seul résultat au maximum
        if ($query->rowCount() == 0) { 
            return false;
        } else {
            return new Notetext($data["title"],User::get_user_by_id($data["owner"]),new DateTime( $data["created_at"],null),$data["edited_at"]!==null?new DateTime($data["edited_at"],null):null,$data["pinned"]===1?true:false,
                                $data["archived"]===1?true:false,$data["weight"],$data["content"],$id);
        }
        
    }
    //mode develop a ne pas toucher !!!!!!
    public function persist(){
        if(/*self::get_note_by_id($this->get_id())*/ true){
            self::execute("UPDATE notes SET title =:title ,pinned=:pinned ,weight =:fullname ,archived =:archived WHERE id = :id ", 
            [ "title"=>$this->get_title(), "pinned"=>$this->pinned(),"weight"=>$this->get_weight(),"archived"=>$this->get_weight(),
               "id"=>$this->get_id()]);
        }
    }
    
    public static function get_notes_by_user(User $user): array |false {
        $query = self::execute("select * 
                               FROM text_notes nt 
                               join notes n  on nt.id=n.id 
                               join users u on u.id=n.owner
                               WHERE u.mail =:mail
                               order by n.weight desc", ["mail"=>$user->get_mail()] );
                                
        $data = $query->fetchAll(); 
        
            $results = [];
            foreach ($data as $row) {
                $results[] = new Notetext($row["title"],$user,new DateTime($row["created_at"]),$row["edited_at"]===null? null: new DateTime($row["edited_at"]),$row["pinned"]===1?true:false,
                $row["archived"]===1?true : false,$row["weight"],$row["content"],$row["id"]);
            }
            return $results;
            
        
    }
    public function are_you_check(): bool{
        return false ;
 }  
}
?>