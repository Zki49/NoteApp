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
    public function get_labels():array{
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
        
        if(strlen($title)<$min||strlen($title)>$max){
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
    public function max_weight(){ 
        $query =self::execute("SELECT * from notes n
                               JOIN users u on n.owner=u.id 
                               WHERE mail = :mail
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
        sleep(5);
        $query = self::execute("SELECT * 
                                FROM notes n 
                                WHERE n.id = :idNote", ["idNote"=>$this->get_id()]);

        if($query->rowCount() == 0){
            return true;
        }else{
            return false;
        }
    }
}

?>