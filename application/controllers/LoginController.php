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
            succesfullConnect_NextPage();
            exit;
        }
        

        $this->checkAsPost();
        
        $this->load->helper('url');

        $this->load->model('loginDbChecker');
        $this->loginDbChecker->authentificate($this->username,$this->password,$this->username_err,$this->password_err);
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
    
     function dbCalling(){
        global $username_err,$password_err,$username,$password;
         // Include config file
         include ("model/config.php");
         $db = new PDO("$server:host=$host;dbname=$base",$user,$pass);
            // Validate credentials
            if(empty($username_err) && empty($password_err)){          
                // Prepare a select statement
                $stmt = $db->prepare("SELECT id, username, password FROM USER WHERE username = $username");
                $stmt->execute();
                foreach ($db->query("SELECT id, username, password FROM USER WHERE username = '$username'") as $line) {
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
                                    $password_err = "Le mot de passe rentré est mauvais.";
                                }
                    }
            }
            postErrors();
    }

    


    function postErrors(){
        global $username_err,$password_err;
        $_SESSION['usernameError'] = $username_err;
        $_SESSION['passwordError'] = $password_err;
    }

    function succesfullConnect_NextPage(){                         
        header("location: index.php/homeController/index");
    }

}
?>