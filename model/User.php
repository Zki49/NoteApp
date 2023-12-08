<?php
require_once "framework/Model.php";

class User extends Model{


    
    public function __construct(public string $pseudo, public string $hashed_password) {

    }


    public function persist() : User {
        if(self::get_member_by_pseudo($this->pseudo))
            self::execute("UPDATE Users SET password=:password WHERE pseudo=:pseudo ", 
                          [ "pseudo"=>$this->pseudo, "password"=>$this->hashed_password]);
        else
            self::execute("INSERT INTO Users(pseudo,password) VALUES(:pseudo,:password)", 
                          ["pseudo"=>$this->pseudo, "password"=>$this->hashed_password]);
        return $this;
    }

    public static function get_member_by_pseudo(string $pseudo) : User|false {
        $query = self::execute("SELECT * FROM users where mail = :pseudo", ["pseudo"=>$pseudo]);
        $data = $query->fetch(); // un seul résultat au maximum
        if ($query->rowCount() == 0) {
            return false;
        } else {
            return new User($data["mail"], $data["hashed_password"]);
        }
    }

    public static function get_member_by_mail(string $mail) : User|false {
        $query = self::execute("SELECT * FROM users where mail = :mail", ["mail"=>$mail]);
        $data = $query->fetch(); // un seul résultat au maximum
        if ($query->rowCount() == 0) {
            return false;
        } else {
            return new User($data["mail"], $data["hashed_password"]);
        }
    }

    public static function get_members() : array {
        $query = self::execute("SELECT * FROM users", []);
        $data = $query->fetchAll();
        $results = [];
        foreach ($data as $row) {
            $results[] = new User($row["pseudo"], $row["password"], $row["profile"], $row["picture_path"]);
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
    
    public static function validate_unicity(string $pseudo) : array {
        $errors = [];
        $member = self::get_member_by_pseudo($pseudo);
        if ($member) {
            $errors[] = "This user already exists.";
        } 
        return $errors;
    }

    public static function validate_unicity_mail(string $mail) : array {
        $errors = [];
        $member = self::get_member_by_mail($mail);
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
        if (!strlen($this->pseudo) > 0) {
            $errors[] = "Pseudo is required.";
        } if (!(strlen($this->pseudo) >= 3 && strlen($this->pseudo) <= 16)) {
            $errors[] = "Pseudo length must be between 3 and 16.";
        } if (!(preg_match("/^[a-zA-Z][a-zA-Z0-9]*$/", $this->pseudo))) {
            $errors[] = "Pseudo must start by a letter and must contain only letters and numbers.";
        }
        return $errors;
    }
    
    public static function validate_login(string $pseudo, string $password) : array {
        $errors = [];
        $member = User::get_member_by_pseudo($pseudo);
        if ($member) {
            if (!self::check_password($password, $member->hashed_password)) {
                $errors[] = "Wrong password. Please try again.";
            }
        } else {
            $errors[] = "Can't find a member with the pseudo '$pseudo'. Please sign up.";
        }
        return $errors;
    }

    public static function validate_photo(array $file) : array {
        $errors = [];
        if (isset($file['name']) && $file['name'] != '') {
            if ($file['error'] == 0) {
                $valid_types = ["image/gif", "image/jpeg", "image/png"];
                if (!in_array($_FILES['image']['type'], $valid_types)) {
                    $errors[] = "Unsupported image format : gif, jpg/jpeg or png.";
                }
            } else {
                $errors[] = "Error while uploading file.";
            }
        }
        return $errors;
    }
}

?>