<?php

require_once 'View.php';

class Tools
{

    //nettoie le string donné
    public static function sanitize(string $var) : string {
        //echo "var : " . $var;
        //echo "trim : " . trim(filter_var($var, FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        //echo "strlen : " . strlen($var);
        //echo "mb strlen : " . mb_strlen($var);
        //return trim(filter_var($var, FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        return $var;
    }

    //dirige vers la page d'erreur
    public static function abort(string $err) : void {
        http_response_code(500);
        (new View("error"))->show(array("error" => $err));
        die;
    }

    //renvoie le string donné haché.
    public static function my_hash(string $password) : string {
        $prefix_salt = "vJemLnU3";
        $suffix_salt = "QUaLtRs7";
        return md5($prefix_salt . $password . $suffix_salt);
    }

}
