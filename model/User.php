<?php
require_once "framework/Model.php";

class User extends Model{



    
    public function __construct(private string $mail, private string $hashed_password,private string $fullname,private string  $role) {
    
    }


    public function get_mail() : string{
        return $this->mail;
    }
    public function get_fullnam() : string{
        return $this->fullname;
    }
   public function set_mail(string $mail){
    $errors = User::validate_unicity_mail($mail);
    if(empty($errors)){
        $this->mail=$mail;
    }
   }
    public function set_password(String $password): void{
        $errors = User::validate_password($password);
         if(empty($errors)){
           $this->hashed_password = Tools::my_hash($password);
         }
    }

    public function persist() : User {

        if(self::get_user_by_mail($this->mail))
            self::execute("UPDATE users SET password=:password ,mail=:mail ,full_name =:fullname ,role =:role WHERE mail=:mail ", 
                          [ "mail"=>$this->mail, "password"=>$this->hashed_password,"fullname"=>$this->fullname,"role"=>$this->role]);
        else
            self::execute("INSERT INTO users(mail,hashed_password,full_name,role) VALUES(:mail,:password,:fullname,:role)", 
                          ["pseudo"=>$this->mail, "password"=>$this->hashed_password,"fullname"=>$this->fullname,"role"=>$this->role]);

        return $this;
    }

    public static function get_user_by_mail(string $mail) : User|false {
        $query = self::execute("SELECT * FROM users where mail = :mail", ["mail"=>$mail]);
        $data = $query->fetch(); // un seul résultat au maximum
        if ($query->rowCount() == 0) {
            return false;
        } else {

            return new User($data["mail"], $data["hashed_password"],$data["full_name"],$data["role"],$data["id"]);
        }
    }
   // besoin pour les notes 
    public static function get_user_by_id(int $id) : User|false {
        $query = self::execute("SELECT * FROM users where id = :id", ["id"=>$id]);

        $data = $query->fetch(); // un seul résultat au maximum
        if ($query->rowCount() == 0) {
            return false;
        } else {

            return new User($data["mail"], $data["hashed_password"],$data["full_name"],$data["role"],$data["id"]);

        }
    }

    public static function get_users() : array {
        $query = self::execute("SELECT * FROM users", []);
        $data = $query->fetchAll();
        $results = [];
        foreach ($data as $row) {
            $results[] = new User($row["pseudo"], $row["password"],$row["full_name"],$row["role"],$row["id"]);
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

}

?>