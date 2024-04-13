<?php
require_once "framework/Model.php";

 class Notemixte  extends Note{

    public function __construct( $title,$owner, $createat,DateTime |null $editedat, bool $pinned, bool $archived,int $weight,$id) {
        parent::__construct($title,$owner,$createat,$editedat,$pinned,$archived,$weight,$id);

    }

 public static function get_note_by_id(int $id):Notemixte |false{
    $query = self::execute("SELECT * FROM notes n where n.id= :id ", ["id"=>$id] );
    $data = $query->fetch(); // un seul résultat au maximum
    if ($query->rowCount() == 0) { 
        return false;
    } else {
        return new Notemixte($data["title"],User::get_user_by_id($data["owner"]),new DateTime( $data["created_at"],null),$data["edited_at"]!==null?new DateTime($data["edited_at"],null):null,$data["pinned"]===1?true:false,
                            $data["archived"]===1?true:false,$data["weight"],$id);
    }
 }

     public static function get_notes_by_user(User $user):array |false {
        $query = self::execute("select * ,n.id idnote
        FROM notes n
        join users u on u.id=n.owner
        WHERE u.mail =:mail
        order by n.weight desc", ["mail"=>$user->get_mail()] );
         
$data = $query->fetchAll(); 

$results = [];
foreach ($data as $row) {
$results[] = new Notemixte($row["title"],$user,new DateTime($row["created_at"]),$row["edited_at"]===null? null: new DateTime($row["edited_at"]),$row["pinned"]===1?true:false,
$row["archived"]===1?true : false,$row["weight"],$row["idnote"]);
}
return $results;
     }
     public function are_you_check(): bool{
        return false;
     }
     public function delete():void{

     }

                
    public function set_weigth_max():void{
       $query= self::execute("SELECT MAX(weight)
                           from notes
                           WHERE pinned = :pined and owner= :idoner ",["idoner"=>$this->owner()->get_id(),"pined"=>$this->pinned()] );
         $maxweight=$query->fetch();
         $this->set_weight($maxweight['MAX(weight)']+10);
         $this->persist();                  
        
    } 

     public function update_title(string $title):void{
        self::execute("update notes set title=:title where id=:id",["title"=>$title,"id"=>$this->get_id()]);
     }
     public function get_weight_notes_by_user() : void {
        $query = self::execute("SELECT * ,n.id idnote
                                FROM notes n  
                                WHERE n.owner = :owner
                                and n.weight > :weight  
                                ORDER BY `n`.`weight` ASC" , ["owner" => $this->get_idowner(), "weight" => $this->get_weight()]);
        $data = $query->fetchAll();
        if (!empty($data)){
            foreach($data as $row){
                if(!$this->pinned()){
                   if ($row['pinned'] === 0){
                    $note_tmp = new Notemixte($row['title'],User::get_user_by_id($row["owner"]),new DateTime($row["created_at"]),$row["edited_at"]===null? null: new DateTime($row["edited_at"]),$row['pinned'],$row['archived'],$row['weight'],$row['idnote']);
                    $tmp = $note_tmp->get_weight();
                    $note_tmp->set_weight(0);
                    $note_tmp->persist();
                    $note_tmp->set_weight($this->get_weight());
                    $this->set_weight($tmp);
                    $this->persist();
                    $note_tmp->persist();
                    $note_tmp=null;
                    return;
                  }
               }else{
                if ($row['pinned'] === 1){
                    $note_tmp = new Notemixte($row['title'],User::get_user_by_id($row["owner"]),new DateTime($row["created_at"]),$row["edited_at"]===null? null: new DateTime($row["edited_at"]),$row['pinned'],$row['archived'],$row['weight'],$row['idnote']);
                    $tmp = $note_tmp->get_weight();
                    $note_tmp->set_weight(0);
                    $note_tmp->persist();
                    $note_tmp->set_weight($this->get_weight());
                    $this->set_weight($tmp);
                    $this->persist();
                    $note_tmp->persist();
                    $note_tmp=null;
                    return;
                  }
               }
            }
        }
    }
    public function movedown() : void {
        $query = self::execute("SELECT * ,n.id idnote
                                FROM notes n  
                                WHERE n.owner = :owner
                                and n.weight < :weight  
                                ORDER BY n.weight desc" , ["owner" => $this->get_idowner(), "weight" => $this->get_weight()]);
        $data = $query->fetchAll();
        if (!empty($data)){
            foreach($data as $row){
                if(!$this->pinned()){
                if ($row['pinned'] === 0){
                    $note_tmp = new Notemixte($row['title'],User::get_user_by_id($row["owner"]),new DateTime($row["created_at"]),$row["edited_at"]===null? null: new DateTime($row["edited_at"]),$row['pinned'],$row['archived'],$row['weight'],$row['idnote']);
                    $tmp = $note_tmp->get_weight();
                    $note_tmp->set_weight(0);
                    $note_tmp->persist();
                    $note_tmp->set_weight($this->get_weight());
                    $this->set_weight($tmp);
                    $this->persist();
                    $note_tmp->persist();
                    return;
                }
            }else{
                if ($row['pinned'] === 1){
                    $note_tmp = new Notemixte($row['title'],User::get_user_by_id($row["owner"]),new DateTime($row["created_at"]),$row["edited_at"]===null? null: new DateTime($row["edited_at"]),$row['pinned'],$row['archived'],$row['weight'],$row['idnote']);
                    $tmp = $note_tmp->get_weight();
                    $note_tmp->set_weight(0);
                    $note_tmp->persist();
                    $note_tmp->set_weight($this->get_weight());
                    $this->set_weight($tmp);
                    $this->persist();
                    $note_tmp->persist();
                    return;
            }
            }
        }
    }
 }
}
 ?>