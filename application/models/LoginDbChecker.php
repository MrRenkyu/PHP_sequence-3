<?php

class LoginDbChecker extends CI_Model{

    private $password_err,$username_err;


    public function __construct(){
       $this->load->database();
    }

    //verify if account is OK to connect
    //return true or false indeed
    public function authentificate($username,$password){
       
            // Prepare a select statement
            $query = $this->db->query("SELECT id, username, password FROM USER WHERE username = '$username'");
            foreach ($query->result() as $line) {
                $hashed_password = $line->password;
                if(password_verify($password, $hashed_password)){ //password is hashed on Table, so verify with function
                    // Password is correct, so start a new session
                    
                    // Store data in session variables
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $line->id;
                    $_SESSION["username"] = $username;                            
                    
                    return true;
                } else{
                    // Display an error message if password is not valid
                    $this->password_err = "Le mot de passe rentré est mauvais.";
                }
            }
       return false;
    }
    

    public function getNewPassword_err(){
        return $this->password_err;
    }

    public function getNewUsername_err(){
        return $this->username_err;
    }
}


?>