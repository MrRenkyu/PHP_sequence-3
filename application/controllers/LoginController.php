<?php

class LoginController extends CI_Controller {

    // Define variables and initialize with empty values

    private $username = "";
    private $password = "";
    private $username_err ="";
    private $password_err = "";
    
    public function index(){
                
        $this->load->helper('url');
        session_start();

        // Check if the user is already logged in, if yes then redirect him to home page
        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
           $this->succesfullConnect_NextPage();
        }
        
        $this->checkAsPost();
        $this->load->model('loginDbChecker');
       
        if(!empty($this->username) && !empty($this->password)){
            if( $this->loginDbChecker->authentificate($this->username,$this->password)){
                $this->succesfullConnect_NextPage();
            }else{
                $this->username_err = $this->loginDbChecker->getNewUsername_err();
                $this->password_err = $this->loginDbChecker->getNewPassword_err();
            }
        }

        $data = array('username' => $this->username, 'username_err' => $this->username_err,'password_err' => $this->password_err,'password' => $this->password);
        $this->load->view('login_view',$data);
    }

    private function checkAsPost(){
        // Processing form data when form is submitted
        if($_SERVER["REQUEST_METHOD"] == "POST"){

            // Check if username is empty
            if(empty(trim($_POST["username"]))){
               $this->username_err = "Rentrer votre pseudo s'il vous plait";
            } else{
                $this->username = trim($_POST["username"]);
            }
        
            // Check if password is empty
            if(empty(trim($_POST["password"]))){
               $this->password_err = "Rentrer votre mot de passe s'il vous plait";
            } else{
                $this->password = trim($_POST["password"]);
            }  
        }
        
    }

    private function succesfullConnect_NextPage(){       
        header('Location: '.base_url('index.php/HomeController/index'));
    }

}
?>