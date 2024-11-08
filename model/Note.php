<?php
require_once "framework/Model.php";
require_once "model/Notecheck.php";
require_once "model/Notetext.php";
require_once "model/User.php";
require_once "model/Label.php";


abstract class Note  extends Model{

     public function __construct(private String $title,private User $owner,private DateTime $createat,

                                 private DateTime | null $editedat,private bool $pinned,private bool $archived, private int $weight, private int $id,private array | bool $labels) {
                                  

    }

    abstract public static function get_note_by_id(int $id):Note |false;
    abstract public static function note_already_exist(String $title , int $id): bool;
    abstract public static function get_notes_by_user(User $user):array |false ;
    abstract public function are_you_check(): bool;
    abstract public function delete():void;

    public function pinned(): bool{
        return $this->pinned;
    }
    public function get_labels():array|bool{
        return $this->labels;
    }

    public function get_title():string{
        return $this->title;
    }
    public function get_id():int {
        return $this->id;
    }
    
    public function owner():User{
        return $this->owner;
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
    public function set_weight(int $new_weight): void {
        $this->weight = $new_weight;
    }
    public function get_idowner():int{
       return $this->owner->get_id();
    }
    private  function validate_title($title):array{
        $errors=[];
        $min= Configuration::get("title_min_length ");
        $max = Configuration::get("title_max_length");
        
        if(mb_strlen($title)<$min||mb_strlen($title)>$max){
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
    public function is_shared():bool{
        $query = self::execute("SELECT * 
                                FROM note_shares ns 
                                WHERE ns.note = :id ",["id" => $this->get_id()]);
        return $query->rowCount() == 0 ? false : true;
    }
    
    public function persist(){
        if($this->get_note_by_id($this->get_id())){
            self::execute("UPDATE notes SET title =:title ,pinned=:pinned ,weight =:weight ,archived =:archived WHERE id = :id ", 
            [ "title"=>$this->get_title(), "pinned"=>$this->pinned()?1:0,"weight"=>$this->get_weight(),"archived"=>$this->archived()?1:0,
               "id"=>$this->get_id()]);
        }
    }
    public static function iamcheck(int $id):bool{
        $query =self::execute("SELECT * 
                                FROM notes n
                                JOIN checklist_notes cn on cn.id=n.id
                                where n.id = $id
                                ",[]);
      $data = $query->fetch();
      if($query->rowCount()==0){
        return false;
      }
      return true;
    }
    public function min_weight(){ 
        $query =self::execute("SELECT * from notes n
                               JOIN users u on n.owner=u.id 
                               WHERE mail = :mail
                               and archived = 0
                               and pinned = 0
                               ORDER by weight asc ",["mail"=>$this->owner->get_mail()]);//et regarder que la note soit pas archiver 
        $data = $query->fetch();//on pren que la premiere ligne 
        if($query->rowCount()==0){
            return 0;
        }
        $min=$data['weight'];
        return $min;
    }
    public function min_weight_pined(){ 
        $query =self::execute("SELECT * from notes n
                               JOIN users u on n.owner=u.id 
                               WHERE mail = :mail
                               and archived = 0
                               and pinned = 1
                               ORDER by weight asc ",["mail"=>$this->owner->get_mail()]);//et regarder que la note soit pas archiver 
        $data = $query->fetch();//on pren que la premiere ligne 
        if($query->rowCount()==0){
            return 0;
        }
        $min=$data['weight'];
        return $min;
    }
    public function max_weight(){ 
        $query =self::execute("SELECT * from notes n
                               JOIN users u on n.owner=u.id 
                               WHERE mail = :mail
                               and archived = 0
                               and pinned = 0
                               ORDER by weight DESC ",["mail"=>$this->owner->get_mail()]);
        $data = $query->fetch();//on pren que la premiere ligne 
        if($query->rowCount()==0){
            return 0;
        }
        $max=$data['weight'];
        return $max;
    }
    public function max_weight_pined(){ 
        $query =self::execute("SELECT * from notes n
                               JOIN users u on n.owner=u.id 
                               WHERE mail = :mail
                               and archived = 0
                               and pinned = 1
                               ORDER by weight DESC ",["mail"=>$this->owner->get_mail()]);
        $data = $query->fetch();//on pren que la premiere ligne 
        if($query->rowCount()==0){
            return 0;
        }
        $max=$data['weight'];
        return $max;
    }
    public function is_editor(int $id) : bool {
        $query = self::execute("SELECT * 
                                FROM note_shares ns
                                WHERE ns.note = :id
                                and ns.editor = 1", ["id"=>$id]);
        if($query->rowCount() == 0){
            return false;
        }else{
            return true;
        }

    } 
    public function change_permission(int $idUser) : void{
        if(self::get_permission($idUser)){
            self::execute("UPDATE note_shares ns
                            SET ns.editor = 0
                            WHERE ns.note = :id AND ns.user=:idUser" , ["id"=>$this->get_id(), "idUser"=>$idUser]);
        }else{
            self::execute("UPDATE note_shares ns
                            SET ns.editor = 1
                            WHERE ns.note = :id AND ns.user=:idUser", ["id"=>$this->get_id(), "idUser"=>$idUser]);
        }
    }
    public function get_permission(int $idUser) : bool{
        $query = self::execute("SELECT *
                                FROM note_shares ns 
                                WHERE ns.note = :id AND ns.user = :idUser
                                AND ns.editor = 1", ["id"=>$this->get_id(), "idUser"=>$idUser]);

        if($query->rowCount() == 0){
            return false;
        }else{
            return true;
        }
    }

    public function add_shared(array $tabUsers): void{
        foreach($tabUsers as $user=>$editor){
            self::execute("Insert into note_shares(user, note, editor) values(:idUser, :idNote, :editor)", ["idUser"=>$user, "idNote"=>$this->get_id(), "editor"=>$editor]); /* user faut mettre id, editor bool ou int 0,1 */
        }
    }

    public function delete_shared(int $idUser): void{
        self::execute("Delete From note_shares where note=:idNote and user=:idUser", ["idUser"=>$idUser, "idNote"=>$this->get_id()]);
    }
    public function has_been_deleted() : bool {
        $query = self::execute("SELECT * 
                                FROM notes n 
                                WHERE n.id = :idNote", ["idNote"=>$this->get_id()]);

        if($query->rowCount() == 0){
            return true;
        }else{
            return false;
        }
    }


    public static function get_all_by_users_label( array $labels ,User $user): array|false {
        $conditions = implode(" AND ", array_map(function($label) {
            return "EXISTS (SELECT 1 FROM note_labels WHERE note = n.id AND label = '$label')";
        }, $labels));
        
        $sql = "SELECT n.*
                FROM notes n
                WHERE $conditions
                and owner = :ownerid";


        $query = self::execute($sql,["ownerid"=>$user->get_id()]);

      $data =$query->fetchAll();
      if($query->rowCount()==0){
        return false;
      }else{
        $results = [];
        foreach ($data as $row) {
            if(self::iamcheck($row['id'])){
                $results[] = Notecheck::get_note_by_id($row['id']);
            }else{
                $results[] = Notetext::get_note_by_id($row['id']);
            }
           
        }
        return $results;
      }

    }
    public function add_label(int $idnote,string $label):array{
        
        $error[] = $this->is_valide_label($idnote,$label);
        $longueur = mb_strlen( $label);
        if(empty($error[0])){
            self::execute("INSERT INTO note_labels (note,label) VALUES(:idnote,:label)",["idnote"=>$idnote,"label"=>$label]);
            return $error;
        }
        return $error;
    }
    public function delete_label(int $idnote,string $label):bool{
        self::execute("DELETE FROM note_labels WHERE note = :idnote and label = :label",["idnote" => $idnote,"label" => $label]);
        $query = self::execute("SELECT * FROM note_labels WHERE note = :idnote and label = :label",["idnote" => $idnote,"label" => $label]);
        $data = $query->fetchAll();
        if(count($data) == 0){
            return true;
        }else{
            return false;
        }
    }
    

    public function is_valide_label(int $idnote,string $label):array{
        $error = [];
        if(!$this->is_unique_label($idnote , $label)){
             $error []= "A note cannot contain the same label twice.";  
        }
        if(!$this->is_valide_label_lenght($label)){
             $error []= "Label lenght must be between 2 and 10.";
        }
        return $error;
   }

   public function is_unique_label(int $idnote,string $label):bool{
        $query = self::execute("SELECT * from note_labels where note = :idnote AND label = :label ORDER BY label ASC",
        ["idnote"=>$idnote,"label"=>$label]);
        if($query->rowCount() == 0){
             return true;
        }
        return false;
   }

   public function is_valide_label_lenght(string $label):bool{
        $longueur = mb_strlen($label,'UTF-8');
        return ($longueur >= 2 && $longueur <= 10);
   }
}

?>