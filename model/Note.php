<?php
require_once "framework/Model.php";

abstract class Note  extends Model{

     public function __construct(private String $title,private User $owner,private DateTime $createat,
                                 private DateTime | null $editedat,private bool $pinned,private bool $archived, private int $weight, private int $id) {
                                  
       
    }

    abstract public static function get_note_by_id(int $id):Note |false;
    abstract public static function get_notes_by_user(User $user):array |false ;
    abstract public function are_you_check(): bool;
    
    
    public function pinned(): bool{
        return $this->pinned;
    }
    public function get_title():string{
        return $this->title;
    }
    public function get_id():int {
        return $this->id;
    }

    public function set_pinned () :bool {
        $this->pinned= !$this->pinned;
        return  $this->pinned;
    }
    public function archived():bool{
        return $this->archived;
    }
    public function set_archived():bool{
        $this->archived=!$this->archived;
        return $this->archived;
    }
    public function get_weight():int {
        return $this->weight;
    }
    private  function validate_title($title):array{
        $errors= [];
        if(strlen($title)<3||strlen($title)>25){
          $errors []="The title must have between 3 and 25 characters";
        }
        return $errors;
    }
    public function set_title($title):array{
        $errors = $this->validate_title($title);
        if(empty($errors)){
            $this->title= $title;
        }
        return $errors;
    }
    public function get_shared_notes($owner, $shared_user) : array|false {
        $query = self::execute("SELECT * 
                                FROM notes n , note_shares ns
                                WHERE ns.note = n.id
                                and ns.user =:owner
                                and n.owner =:shared_user
                                ORDER BY `ns`.`editor` DESC", ["owner"=>$owner , "shared_user"=>$shared_user]);
        $data = $query->fetchAll();
        if ($query->rowCount() == 0) { 
            return false;
        } else {
            $results = [];
            foreach ($data as $row) {
                $results[] = self::__construct($row["title"],$row["owner"],$row["created_at"],$row["edited_at"],$row["pinned"],$row["archived"],$row["weight"],$row["id"]);
            }
            return $results;
        }
    }
    public function get_weight_notes_by_user(User $user) : array {
        $query = self::execute("SELECT * 
                                FROM notes n ,users u  
                                WHERE n.owner = u.id
                                and u.mail = :mail
                                HAVING n.weight > :weight  
                                ORDER BY `n`.`weight` ASC" , ["mail" => $user->get_mail(), "weight" => $this->get_weight()]);
        $data = $query->fetchAll();
        if (!empty($data)){
            foreach($data as $row){
                
            }
        }
        return $data;
    }
}

?>