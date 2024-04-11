<?php
class Item  extends Model{
    public function __construct(private int $id,private string $content,private bool $check){}
   
    public static function get_item(int $id) : array  {
        $query = self::execute("SELECT * 
                                FROM checklist_note_items cl 
                                WHERE cl.checklist_note = :id", ["id"=>$id]);
        $data= $query->fetchAll();
        $result=[];
        foreach($data as $row){
          
           $result[]=new Item($row["id"],$row["content"],$row["checked"]==1?true:false);

        }

        return $result;
        
    }
    public function get_id_my_note():int{
        $query = self::execute("SELECT * 
        FROM checklist_note_items cl 
        WHERE cl.id = :id", ["id"=>$this->id]);
        $data =$query->fetch();
        return $data["checklist_note"];
    }
    public static function get_un_item(int $id): Item|bool {
        $query = self::execute("SELECT * 
                                FROM checklist_note_items cl 
                                WHERE cl.id = :id", ["id"=>$id]);
        $data =$query->fetch();
        if ($query->rowCount() == 0) { 
            return false;
        } else{ return new Item($data['id'],$data['content'],$data["checked"]==1?true:false);}

       

    }
    public function get_content():string{
        return $this->content;
    }
    public function item_checked():bool{
        return $this->check;
    }
    public function unchecked_checked():void{
        $this->check=!$this->check;
    }
    public function get_id():int{
        return $this->id;
    }

    public function delete_all_by_note(int $idnote):void{
        self::execute("DELETE FROM checklist_note_items WHERE checklist_note= :id;",["id"=>$idnote]);
    }
     public function persit(){
        self::execute("UPDATE checklist_note_items SET content = :content, checked= :check WHERE id = :id",
        ["id"=>$this->id,"content"=>$this->content,"check"=>$this->check]);
     }

}

?>