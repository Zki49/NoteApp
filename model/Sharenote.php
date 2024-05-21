<?php
require_once "framework/Model.php";
require_once "model/Note.php";

class Sharenote extends Model{

    public function __construct(private Note $note){
        
    }

    public function get_note():Note{
        return $this->note;
    }
    public function get_weight():int{
        return $this->note->get_weight();
    }
    public static function get_shared_notes_not_editor(User $owner,User $shared_user) : array|false {
        $query = self::execute("SELECT * 
                                FROM notes n , note_shares ns
                                WHERE ns.note = n.id
                                and ns.user =:owner
                                and n.owner =:shared_user
                                and ns.editor = 0
                                ORDER BY `ns`.`editor` DESC", ["owner"=>$owner->get_id() , "shared_user"=>$shared_user->get_id()]);
        $data = $query->fetchAll();
        if ($query->rowCount() == 0) { 
            return false;
        } else {
            $results = [];
            foreach ($data as $row) {
                if(Note::iamcheck($row["id"])){  
                    
                    $results[] = new Sharenote(Notecheck::get_note_by_id($row["id"]));
                }else{
                    $results[] =  new Sharenote(Notetext::get_note_by_id($row["id"]));                    
                }
            }
            return $results;
            
        }
    }
    public static function get_all_share_with_me(User $user):array|bool{
        $sql = "SELECT n.*
        FROM note_shares ns,notes n 
        WHERE ns.user = :ownerid
        and ns.note = n.id
        ";


$query = self::execute($sql,["ownerid"=>$user->get_id()]);

$data =$query->fetchAll();
if($query->rowCount()==0){
return false;
}else{
$results = [];
foreach ($data as $row) {
    if(Note::iamcheck($row['id'])){
        $results[] = Notecheck::get_note_by_id($row['id']);
    }else{
        $results[] = Notetext::get_note_by_id($row['id']);
    }
   
}
return $results;
}

    }
    public static function get_all_by_users_label( array $labels ,User $user): array|false {
        $conditions = implode(" AND ", array_map(function($label) {
            return "EXISTS (SELECT 1 FROM note_labels WHERE note = n.id AND label = '$label')";
        }, $labels));
        
        $sql = "SELECT n.*
                FROM note_shares ns,notes n 
                WHERE $conditions
                and ns.user = :ownerid
                and ns.note = n.id
                ";


        $query = self::execute($sql,["ownerid"=>$user->get_id()]);

      $data =$query->fetchAll();
      if($query->rowCount()==0){
        return false;
      }else{
        $results = [];
        foreach ($data as $row) {
            if(Note::iamcheck($row['id'])){
                $results[] = Notecheck::get_note_by_id($row['id']);
            }else{
                $results[] = Notetext::get_note_by_id($row['id']);
            }
           
        }
        return $results;
      }
    }
    
    public static function get_shared_notes_editor(User $owner,User $shared_user) : array|false {
        $query = self::execute("SELECT * 
                                FROM notes n , note_shares ns
                                WHERE ns.note = n.id
                                and ns.user =:owner
                                and n.owner =:shared_user
                                and ns.editor = 1
                                ORDER BY `ns`.`editor` DESC", ["owner"=>$owner->get_id() , "shared_user"=>$shared_user->get_id()]);
        $data = $query->fetchAll();
        if ($query->rowCount() == 0) { 
            return false;
        } else {
            $results = [];
            foreach ($data as $row) {
                if(Note::iamcheck($row["id"])){  
                    
                    $results[] =new Sharenote(Notecheck::get_note_by_id($row["id"]));
                }else{
                    $results[] = new Sharenote(Notetext::get_note_by_id($row["id"]));                  
                }
            }
            return $results;
            
        }
    }
   public function shared():bool{
    return true;
   }
   public function share_by():User{
    return $this->note->owner();
   }
    
}

?>