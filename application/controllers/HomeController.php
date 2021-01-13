<?php

class HomeController extends CI_Controller {

    public function index(){
        // Initialize the session
        session_start();
        
        // Unset all of the session variables
        $_SESSION = array();
        
        // Destroy the session.
        session_destroy();
        
        // Redirect to login page
        header(base_url('index.php/LoginController/index'));
        exit;
    }


}
?>