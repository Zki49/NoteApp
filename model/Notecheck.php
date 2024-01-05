<?php
class Notecheck extends Note{

    // a complete demain 
    public function __construct( $title,$owner, $createat,$editedat, bool $pinned, bool $archived,int $weight,private array $content ,$id ) {
        parent::__construct($title,$owner,$createat,$editedat,$pinned,$archived,$weight,$id);
    }

    public function set_content(array $items):void{
        $this->content = $items;
    }

    public static function get_note_by_id(int $id): Notecheck |false{
        $query = self::execute("SELECT * FROM checklist_notes nt ,notes n where n.id= :id and nt.id = n.id", ["id"=>$id] );
        $data = $query->fetch(); // un seul résultat au maximum
        if ($query->rowCount() == 0) { 
            return false;
        } else {
            return new Notecheck($data["title"],User::get_user_by_id($data["owner"]),new DateTime( $data["created_at"],null),$data["edited_at"]!==null?new DateTime($data["edited_at"],null):null,$data["pinned"],
                                $data["archived"],$data["weight"],self::get_item($id),$id);
        }
        
    }
    public  function get_items(){
        return $this->content;
    }
    private static function get_item(int $id) : array  {
        $query = self::execute("SELECT * 
                                FROM checklist_note_items cl 
                                WHERE cl.checklist_note = :id", ["id"=>$id]);
        $data= $query->fetchAll();
        $result=[];
        foreach($data as $row){
           $result[]= $row["content"];
        }
        return $result;
        
    }
    //encore un peut de mofi et on y est 
    public static function get_notes_by_user(User $user): array |false {
        $query = self::execute("select * ,n.id idnote
                                FROM checklist_notes cn 
                                join notes n  on cn.id=n.id 
                                join users u on u.id=n.owner
                                WHERE u.mail =:mail
                                order by n.weight desc", ["mail"=>$user->get_mail()] );
        $data = $query->fetchAll();
        if ($query->rowCount() == 0) { 
            return false;
        } else {
            $results = [];
            foreach ($data as $row) {
                $id =self::get_item($row["idnote"]) ;
                $results[] = new Notecheck($row["title"],$user,new DateTime($row["created_at"]),$row["edited_at"]===null? null: new DateTime($row["edited_at"]),$row["pinned"]===1?true:false,
                $row["archived"]===1?true : false,$row["weight"],$id,$row["idnote"]);
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

     
     public function add():void{
        self::execute("INSERT INTO notes (title,pinned,weight,archived,owner) VALUES (:title,:pinned,:weight,:archived,:owner)",
        ["title"=>$this->get_title(),"pinned"=>$this->pinned(), "weight"=>$this->get_weight(), "archived"=>$this->archived(),"owner"=>$this->get_idowner()]);

        $idLastInsert = $this->lastInsertId();
        self::execute("insert into checklist_notes (id) values (:id)",["id"=>$idLastInsert]);

        $tab_items = $this->get_items();
        for ($i = 0 ; $i < sizeof($tab_items) ; ++$i){
            self::execute("insert into checklist_note_items(checklist_note,content,checked) VALUES (:checklist_notes,:content,:checked)",
            ["checklist_notes"=>$idLastInsert,"content"=>$tab_items[$i] , "checked"=>0]);
        }
     }

     public function unique_content(array $array_content): array {
        $array_error=[];
          for ($i = 0 ; $i < count($array_content);  $i++){
            $elementI = $array_content[$i];
            for($j = 0 ; $j < count($array_content) ; $j++){
                if ($i !== $j ){
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