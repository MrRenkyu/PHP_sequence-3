<?php
require_once("Article.class.php");

class Register_Manager extends CI_Model{

    public function __construct(){
        $this->load->database();
    }

    //call DB and chack if the $username already exist
    //return true/false indeed
    public function usernameExist($username){
        $query = $this->db->query("SELECT id FROM USER WHERE username='".$username."'");
        if($query->num_rows() > 0){
            return yes;
        }else{
            return false;
        }
    }

    //create account, (no details informations)
    public function insertData($username,$password){
        $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
        $sql = "INSERT INTO USER (username, password) VALUES ('".$username."','".$param_password."')";

        $query = $this->db->query($sql);
    }
}