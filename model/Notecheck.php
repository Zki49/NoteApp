<?php
class Notecheck extends Note{

    // a complete demain 
    public function __construct( $title,$owner, $createat,$editedat, bool $pinned, bool $archived,int $weight,private array $content ,$id ) {
        parent::__construct($title,$owner,$createat,$editedat,$pinned,$archived,$weight,$id);
    }
    public static function get_note_by_id(int $id): Notecheck |false{
        $query = self::execute("SELECT * FROM check_listnotes nt ,notes n where n.id= :id and nt.id = n.id", ["id"=>$id] );
        $data = $query->fetch(); // un seul résultat au maximum
        if ($query->rowCount() == 0) { 
            return false;
        } else {
            return new Notecheck($data["title"],User::get_user_by_id($data["owner"]),$data["created_at"],$data["edited_at"],$data["pinned"],
                                $data["archived"],$data["weight"],$data["content"],$id);
        }
        
    }
    public function get_items(){
        return $this->content;
    }
    //encore un peut de mofi et on y est 
    public static function get_notes_by_user(User $user): array |false {
        $query = self::execute("select * 
                                FROM checklist_notes cn 
                                join notes n  on cn.id=n.id 
                                join users u on u.id=n.owner
                                join checklist_note_items cni on cni.checklist_note=cn.id
                                WHERE u.mail =:mail
                                order by n.weight desc", ["mail"=>$user->get_mail()] );
        $data = $query->fetchAll();
        if ($query->rowCount() == 0) { 
            return false;
        } else {
            $results = [];
            foreach ($data as $row) {
                $results[] = new Notecheck($row["title"],$user,new DateTime($row["created_at"]),$row["edited_at"]===null? null: new DateTime($row["edited_at"]),$row["pinned"]===1?true:false,
                $row["archived"]===1?true : false,$row["weight"],$row["content"],$row["id"]);
            }
            return $results;
        }
    }

     public function are_you_check(): bool{
            return true;
     }
    
     public function delete():void{
        self::execute("DELETE FROM checklist_note_items WHERE checklist_note= :id;
        DELETE from checklist_notes WHERE id =:id;
        DELETE from notes WHERE id = :id;",["id"=>$this->get_id()]);
     }
     public function unique_content(array $array_content): array{
          for ($i = 0 ; $i < count($array_content);  $i++){
            $elementI = $array_content[$i];
            for($j = 0 ; $j < count($array_content) ; $j++){
                if ($i != $j ){
                    $elementJ = $array_content[$j];
                    if($elementI === $elementJ){
                        $array_error[$i] = ["Items must be unique"];
                        $array_error[$j] = ["Items must be unique"];
                    }
                }
            }
          }
          return $array_error;
     }
    

}

?>