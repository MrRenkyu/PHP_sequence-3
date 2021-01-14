<?php

class LogoutController extends CI_Controller{

    function index(){
        // Initialize the session
        session_start();

        $this->load->helper('url');
        
        // Unset all of the session variables
        $_SESSION = array();
        
        // Destroy the session.
        session_destroy();
        
        // Redirect to login page
        header('Location: '.base_url('index.php/LoginController/index'));
        exit;
    }
}
?>