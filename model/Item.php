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
    public function get_content():string{
        return $this->content;
    }
    public function item_checked():bool{
        return $this->check;
    }
    public function delete_all_by_note(int $idnote):void{
        self::execute("DELETE FROM checklist_note_items WHERE checklist_note= :id;",["id"=>$idnote]);
    }

}

?>