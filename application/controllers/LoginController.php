<?php

class LoginController extends CI_Controller {

    // Define variables and initialize with empty values

    private $username = "";
    private $password = "";
    private $username_err ="";
    private $password_err = "";
    
    public function index(){
        
        
        if(isset($_SESSION['usernameError'])){
            $username_err = $_SESSION['usernameError'];
        }
        if(isset($_SESSION['passwordError'])){
            $password_err = $_SESSION['passwordError'];
        }
        

        session_start();

        // Check if the user is already logged in, if yes then redirect him to home page
        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
            $this->succesfullConnect_NextPage();
            exit;
        }
        

        $this->checkAsPost();
        
        $this->load->helper('url');

        $this->load->model('loginDbChecker');
       
        if( $this->loginDbChecker->authentificate($this->username,$this->password,$this->username_err,$this->password_err)){
            $this->succesfullConnect_NextPage();
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
        header("location: index.php/homeController/index");
    }

}
?>