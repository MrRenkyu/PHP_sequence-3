<?php

class LoginDbChecker extends CI_Model{

    public function __construct(){
       $this->load->database();
    }

    public function authentificate($username,$password,$tamp_username_err,$tamp_password_err){
       
        $username = "zozor";
        if(empty($tamp_username_err) && empty($tamp_password_err)){          
            // Prepare a select statement
            $query = $this->db->query("SELECT id, username, password FROM USER WHERE username = '$username'");
            foreach ($query->getResult('array') as $line) {
                $hashed_password = $line['password'];
                if(password_verify($password, $hashed_password)){
                    // Password is correct, so start a new session
                    session_start();
                    
                    // Store data in session variables
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $line['id'];
                    $_SESSION["username"] = $username;                            
                    
                    succesfullConnect_NextPage();
                } else{
                    // Display an error message if password is not valid
                    $tamp_password_err = "Le mot de passe rentré est mauvais.";
                }
            }
        }
       $this->postErrors($tamp_username_err,$tamp_password_err);
    }

    function postErrors($tamp_username_err,$tamp_password_err){
        $_SESSION['usernameError'] = $tamp_username_err;
        $_SESSION['passwordError'] = $tamp_password_err;
    }
}


?>