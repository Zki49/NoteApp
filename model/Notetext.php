<?php

class Notetext extends Note{
     
    public function __construct( $title,$owner, $createat,DateTime |null $editedat, bool $pinned, bool $archived,int $weight,private string|null $description,$id,$labels) {
        parent::__construct($title,$owner,$createat,$editedat,$pinned,$archived,$weight,$id,$labels);

    }
    public function get_description():string |null{
        return $this->description;
    }

    public function set_description($description):array{
        $errors = $this->validate_description($description);
        if(empty($errors)){
            $this->description= $description;
        }
        return $errors;
    }
    private  function validate_description($description):array{
        $errors=[];
        $min =Configuration::get("min_length_description");
        $max =Configuration::get("max_length_description");
        if(strlen($description)<$min||strlen($description)>$max){
            if(strlen(trim($description))!=0){
          $errors []="The description must have between 3 and 100 characters OR nothing";
        }}
        return $errors;
    }



    public static function get_note_by_id(int $id): Notetext |false{
        $query = self::execute("SELECT * FROM text_notes nt ,notes n where n.id= :id and nt.id = n.id", ["id"=>$id] );
        $data = $query->fetch(); // un seul résultat au maximum
        if ($query->rowCount() == 0) { 
            return false;
        } else {
            return new Notetext($data["title"],User::get_user_by_id($data["owner"]),new DateTime( $data["created_at"],null),$data["edited_at"]!==null?new DateTime($data["edited_at"],null):null,$data["pinned"]===1?true:false,
                                $data["archived"]===1?true:false,$data["weight"],$data["content"],$id,Label::get_labels_by_note($id));
        }
        
    }
    public static function note_already_exist(string $title , int $id): bool {
        $query = self::execute("SELECT * FROM notes n where n.title = :title and n.owner = :id ", ["title"=>$title , "id"=>$id] );
        if ($query->rowCount() == 0) { 
            return false;
        } else {
            return true;
        }
        
    }
    
    public function persist(){
        try{
        if(self::get_note_by_id($this->get_id($this->get_id())) ){
            self::execute("UPDATE notes SET title =:title ,pinned=:pinned ,weight =:weight ,archived =:archived WHERE id = :id ;
                           UPDATE text_notes set content = :description where id=:id", 
            [ "title"=>$this->get_title(), "pinned"=>$this->pinned()?1:0,"weight"=>$this->get_weight(),"archived"=>$this->archived()?1:0,
               "description"=>$this->get_description(),  "id"=>$this->get_id()]);
        }else{
         
            self::execute("insert into notes (title,pinned,weight,archived,owner)  values(:title ,:pinned ,:weight ,:archived,:owner); ", 
            [ "title"=>$this->get_title(), "pinned"=>0,"weight"=>$this->get_weight(),"archived"=>0,
               "owner"=>$this->get_idowner()]);
            $id= $this->lastInsertId();
            self::execute("insert into text_notes(id,content) values($id,:description)",["description"=>$this->description]);
        }
    }
    catch(Exception $e){
        
    }
    }
    
   /* public static function get_notes_by_user(User $user): array |false {
        $query = self::execute("select * ,n.id idnote
                               FROM text_notes nt 
                               join notes n  on nt.id=n.id 
                               join users u on u.id=n.owner
                               WHERE u.mail =:mail
                               order by n.weight desc", ["mail"=>$user->get_mail()] );
                                
        $data = $query->fetchAll(); 
        
            $results = [];
            foreach ($data as $row) {
                $results[] = new Notetext($row["title"],$user,new DateTime($row["created_at"]),$row["edited_at"]===null? null: new DateTime($row["edited_at"]),$row["pinned"]===1?true:false,
                $row["archived"]===1?true : false,$row["weight"],$row["content"],$row["idnote"]);
            }
            return $results;
            
        
    }*/

    public static function get_notes_by_user(User $user): array |false {
        $query = self::execute("select * ,n.id idnote
                               FROM text_notes nt 
                               join notes n  on nt.id=n.id 
                               join users u on u.id=n.owner
                               WHERE u.mail =:mail
                               order by n.weight desc", ["mail"=>$user->get_mail()] );

        $data = $query->fetchAll(); 

            $results = [];
            foreach ($data as $row) {
                $results[] = new Notetext($row["title"],$user,new DateTime($row["created_at"]),$row["edited_at"]===null? null: new DateTime($row["edited_at"]),$row["pinned"]===1?true:false,
                $row["archived"]===1?true : false,$row["weight"],$row["content"],$row["idnote"],Label::get_labels_by_note($row['idnote']));
            }
            return $results;


    }
    public function are_you_check(): bool{
        return false ;
 }

 public function delete():void{
     self::execute("DELETE from text_notes WHERE id=:id;
    DELETE from notes WHERE id = :id",["id"=>$this->get_id()]);

 }
 public function to_json(): string {


    $labels = $this->get_labels();
if (is_array($labels)) {
    $labels_data = array_map(function($item) {
        return [
            "name" => $item->get_label_name(),
            "check" => $item->is_check()
        ];
    }, $labels);
} else {
    $labels_data = [];
}
    $data = [
        "title" => $this->get_title(),
        "owner" => [
            "id" => $this->owner()->get_id(),
            "mail" => $this->owner()->get_mail(),
            "fullname"=> $this->owner()->get_fullnam()
        ],
        "pinned" => $this->pinned(),
        "archived" => $this->archived(),
        "weight" => $this->get_weight(),
        "id" => $this->get_id(),
        "check"=>false,
        "labels" => $labels_data,
        "description" => $this->get_description()
    ];
    return json_encode($data);
}


}
?>