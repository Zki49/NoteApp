<?php
require_once "model/Item.php";
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
                                $data["archived"],$data["weight"],Item::get_item($id),$id);
        }
        
    }

    public static function note_already_exist(string $title , int $id) : bool {
        $query = self::execute("SELECT * FROM notes n where n.title = :title and n.owner = :id ", ["title"=>$title , "id"=>$id] );
        //var_dump($query);
        //sleep(5);
        if ($query->rowCount() == 0) { 
            return false;
        } else {
            return true;
        }
        
    }

    public  function get_items():array{
        return $this->content;
    }

    public static function get_all_items_service_as_json(Notecheck $note) : string{
        $items = $note->get_items();
        $table = [];
        foreach($items as $item){
            $row = [];
            $row["id"] = $item->get_id();
            $row["content"] = $item->get_content();
            $row["checked"] = $item->item_checked();
            $table[] = $row;
        }
        return json_encode($table);
    }

    /*private static function get_item(int $id) : array  {
        $query = self::execute("SELECT * 
                                FROM checklist_note_items cl 
                                WHERE cl.checklist_note = :id", ["id"=>$id]);
        $data= $query->fetchAll();
        $result=[];
        foreach($data as $row){
          
           $result[$row["content"]] = $row["checked"];

        }

        return $result;
        
    }*/

   /* public function check_item(int $id, string $content) : void {
        if(self::item_is_checked($id)){
            self::execute("UPDATE checklist_note_items ci
                           SET ci.checked = 0
                           WHERE ci.id = :id
                           AND ci.content = :content", ["id"=>$id , "content"=>$content]);
        }else{
            self::execute("UPDATE checklist_note_items ci
                           SET ci.checked = 1
                           WHERE ci.id = :id
                           AND ci.content = :content", ["id"=>$id , "content"=>$content]);
        }
    }*/

   /* public function item_is_checked(int $id): bool {
        $query = self::execute("SELECT * 
                                FROM checklist_note_items cl 
                                WHERE cl.id = :id
                                and cl.checked = 1", ["id"=>$id]);
        $data= $query->fetchAll();
        if (count($data) > 0){
            return true;
        }
        return false;
    }*/
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
                $results[] = new Notecheck($row["title"],$user,new DateTime($row["created_at"]),$row["edited_at"]===null? null: new DateTime($row["edited_at"]),$row["pinned"]===1?true:false,
                $row["archived"]===1?true : false,$row["weight"],Item::get_item($row["idnote"]),$row["idnote"]);
            }
            return $results;
        }
    }

     public function are_you_check(): bool{
            return true;
     }
    
     public function delete():void{
        if(!empty($this->content)){
       $item= $this->content[0];
       $item->delete_all_by_note($this->get_id());
        }
        self::execute("DELETE from checklist_notes WHERE id =:id;
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

     public function additem(string $new):array | int{
        
        $error=[];//$this->validateitem($new);
        if(empty($error)){
            
         self::execute("insert into checklist_note_items (checklist_note ,content) VALUES( :id,:content) ",["id"=>$this->get_id(),"content"=>$new]);
         return $this->lastInsertId();
        }
        return $error;
     }


     public function service_add_item(string $new):void{
        self::execute("insert into checklist_note_items (checklist_note ,content) VALUES( :id,:content) ",["id"=>$this->get_id(),"content"=>$new]);

     }


     public function deleteitem(string $item){
       self::execute("delete from checklist_note_items where checklist_note = :id and content = :item ",
                      ["id"=>$this->get_id(),"item"=>$item]);
     }

     public function service_delete_item(string $iditem){
        $iditem = intval($iditem);
        self::execute("delete from checklist_note_items where checklist_note = :id and id = :idItem ",
                       ["id"=>$this->get_id(),"idItem"=>$iditem]);
      }
    
     private function validateitem(string $new):array{
        $result = [];
         if(strlen($new)<1||strlen($new)>60){
           $result []= "The item must have between 1 and 60 characters";
         }
         /*if($this->itemexist($new)){
            $result [] = "item must be unique" ;
         }*/

         return $result;
     }
     private function itemexist(string $new):bool{
        foreach($this->get_items() as $item ){
            if($item->get_content()==$new){
                return true;
            }
        }
        return false;
     }

     public function getFirstItem() : Item{
        return $this->content[0];
     }
     public function update_title(string $title):void{
        self::execute("update notes set title=:title where id=:id",["title"=>$title,"id"=>$this->get_id()]);
     }

}

?>