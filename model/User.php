<?php
require_once "framework/Model.php";

class User extends Model{

    


    
    public function __construct(private string $mail, private string $hashed_password,private string $fullname,private string  $role) {
        
    }
    public function getMail():string{
        return $this->mail;
    }
    public function getFullnam():string{
        return $this->fullname;
    }
    public function getRole():string{
        return $this->role;
    }
   public function get_id():int{
    $query = self::execute("SELECT * FROM users where mail = :mail", ["mail"=>$this->get_mail()]);
    $data = $query->fetch(); 
    return $data['id'] ;
   }

    public function edit_profil(string $mail,string $fullname):array{
      //peut etre ajoute par le suite une upgrade de role ???? 

        $errors=[];
        if($this->fullname!==$fullname){
         $errors= User ::check_fullname($fullname);

         if(empty($errors)){
            $this->fullname=$fullname;
         }
       }
       if(empty($mail)){
            $mail=$this->mail;
       }

       self::execute("UPDATE users SET mail=:newMail ,full_name =:fullname WHERE mail =:mail ", 
                          [ "mail"=>$this->mail,"fullname"=>$this->fullname, "newMail"=>$mail]);
    
         $this->mail=$mail;
                       
       return $errors;
    }
    public function get_mail() : string{
        return $this->mail;
    }
    public function get_fullnam() : string{
        return $this->fullname;
    }
    public function get_password() : string {
        return $this->hashed_password;
    }

   private function set_mail(string $mail):void{
    $errors = User::validate_unicity_mail($mail);
    if(empty($errors)){
        $this->mail=$mail;
    }
   }
    public function set_password(String $password): array{
        $errors = User::validate_password($password);
         if(empty($errors)){
           $this->hashed_password = Tools::my_hash($password);
         }
         return $errors;
    }

    public function persist() : User {
        if(self::get_user_by_mail($this->mail))
            self::execute("UPDATE users SET hashed_password=:password ,mail=:mail ,full_name =:fullname ,role =:role WHERE mail=:mail ", 
                          [ "mail"=>$this->mail, "password"=>$this->hashed_password,"fullname"=>$this->fullname,"role"=>$this->role]);
        else
            self::execute("INSERT INTO users(mail,hashed_password,full_name,role) VALUES(:mail,:password,:fullname,:role)", 
                          ["mail"=>$this->mail, "password"=>$this->hashed_password,"fullname"=>$this->fullname,"role"=>$this->role]);


        return $this;
    }

    public static function get_user_by_mail(string $mail) : User|false {
        $query = self::execute("SELECT * FROM users where mail = :mail", ["mail"=>$mail]);
        $data = $query->fetch(); // un seul résultat au maximum
        if ($query->rowCount() == 0) {
            return false;
        } else {


            return new User($data["mail"], $data["hashed_password"],$data["full_name"],$data["role"]);
        }
    }
   // besoin pour les notes 
    public static function get_user_by_id(int $id) : User|false {
        $query = self::execute("SELECT * FROM users where id = :id", ["id"=>$id]);
        $data = $query->fetch(); // un seul résultat au maximum
        if ($query->rowCount() == 0) {
            return false;
        } else {

            return new User($data["mail"], $data["hashed_password"],$data["full_name"],$data["role"]);
        }
    }
    
  

   

    public static function get_users() : array {

        $query = self::execute("SELECT * FROM users", []);
        $data = $query->fetchAll();
        $results = [];
        foreach ($data as $row) {

            $results[] = new User($row["pseudo"], $row["password"],$row["full_name"],$row["role"]);
        }
        return $results;
    }
    
    private static function validate_password(string $password) : array {
        $errors = [];
        if (strlen($password) < 8 || strlen($password) > 16) {
            $errors[] = "Password length must be between 8 and 16.";
        } if (!((preg_match("/[A-Z]/", $password)) && preg_match("/\d/", $password) && preg_match("/['\";:,.\/?!\\-]/", $password))) {
            $errors[] = "Password must contain one uppercase letter, one number and one punctuation mark.";
        }
        return $errors;
    }
    
    public static function validate_passwords(string $password, string $password_confirm) : array {
        $errors = User::validate_password($password);
        if ($password != $password_confirm) {
            $errors[] = "You have to enter twice the same password.";
        }
        return $errors;
    }
    
    public static function validate_unicity(string $mail) : array {
        $errors = [];
        $user = self::get_user_by_mail($mail);
        if ($user) {
            $errors[] = "This user already exists.";
        } 
        return $errors;
    }


    public static function validate_unicity_mail(string $mail) : array {
        $errors = [];
        $member = self::get_user_by_mail($mail);
        if ($member) {
            $errors[] = "This user already exists.";
        } 
        return $errors;
    }

    private static function check_password(string $clear_password, string $hash) : bool {
        return $hash === Tools::my_hash($clear_password);
    }
    private static function check_fullname(string $fullname):array{
        $errors=[];
        if(strlen($fullname)<=0){
            $errors []="Name is riquired";
        }
        if(strlen($fullname)<3){
            $errors []="Fullname lenght must be 3.";
        }
        return$errors;
    }

    public function validate() : array {
        $errors = [];
        if (!strlen($this->fullname) > 0) {


            $errors[] = "Name is required.";
            //juste plus que 3 pour le nom 
        } if (!(strlen($this->fullname) >= 3 )) {
            $errors[] = "Fullname lenght must be 3.";
            //ca doit pas etre la 
        } //if (!(preg_match("/^[a-zA-Z][a-zA-Z0-9]*$/", $this->fullname))) {
            //$errors[] = "Name must start by a letter and must contain only letters and numbers.";

        //}

        return $errors;
    }
    
    public static function validate_login(string $mail, string $password) : array {
        $errors = [];
        $user= User::get_user_by_mail($mail);
        if ($user) {
            if (!self::check_password($password, $user->hashed_password)) {
                $errors[] = "Wrong password. Please try again.";
            }
        } else {
            $errors[] = "Can't find a member with the mail '$mail'. Please sign up.";
        }
        return $errors;
    }

    public static function array_shared_user_by_mail(User $user) : array | false {

        $tab_user = [];
        $query = self::execute("SELECT n.owner 
                                FROM users u , notes n, note_shares ns
                                WHERE u.id = ns.user and n.id = ns.note
                                and u.mail = :mail
                                GROUP by n.owner", ["mail"=>$user->mail] );
        $data = $query->fetchAll();
        if($query->rowCount() == 0){
            return false;
        }else {
            foreach ($data as $row) {
                $tab_user[] = self::get_user_by_id($row["owner"]);
            }
        }
        return $tab_user;
    }

    
    public function editor(int $id) : bool{
    

        $query =self::execute("SELECT u.mail
                               from users u 
                               WHERE u.id in (SELECT user 
                                               from note_shares
                                                WHERE editor = 1 AND note =:id
                                              )
                                      or u.id in (SELECT owner 
                                                  FROM notes
                                                  WHERE id= :id) ",["id"=>$id]);
       $data= $query->fetchAll() ;
       if($query->rowCount() == 0){
           return false;                      
        }else{
            foreach($data as $row){
                if($this->get_mail()===$row["mail"]){
                    return true;
                }
            }
        }
        return false;   
        
    }

    public static function not_into_shared(int $idNote): array{
        $query =self::execute("SELECT u.mail
                               from users u 
                               WHERE u.id not in (SELECT user 
                                               from note_shares
                                                WHERE  note =:id
                                              )
                                      and u.id not in (SELECT owner 
                                                  FROM notes
                                                  WHERE id= :id) ",["id"=>$idNote]); 
                                                  
        $data=$query->fetchAll();
        $tabRes=[];
        foreach($data as $row){
            $tabRes[]=self::get_user_by_mail($row["mail"]);
        }
        return $tabRes;
    }

    public static function tab_user_in_share(int $idNote): array{
        $tab=[];
        $query=self::execute("SELECT user
                        from note_shares
                        where note = :id", ["id"=>$idNote]);
        $data=$query->fetchAll();
        foreach($data as $row){
            $tab[]=self::get_user_by_id($row["user"]);
        }
        return $tab;
    }
}



?>