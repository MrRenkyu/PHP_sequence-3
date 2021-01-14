<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RegisterController extends CI_Controller{

	// Define variables and initialize with empty values
	private $username = "";
	private $password = "";
	private $confirm_password = "";
	private $username_err ="";
	private $password_err = "";
	private $confirm_password_err = "";

	public function index(){
		// Processing form data when form is submitted
		$this->load->helper('url');
		$data = array('username' => $this->username, 'username_err' => $this->username_err,'password_err' => $this->password_err,'password' => $this->password, 'confirm_password' => $this->confirm_password, 'confirm_password_err' => $this->confirm_password_err);
		$this->load->view('register_view', $data);

	}


	public function insertAccount(){

		//chek if there is POST méthod
		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			$hasErr = false;
			$this->load->model('register_Manager');

			if(!isset($_POST["username"]) || empty(trim($_POST["username"]))){//chek if there is POST with username
				$this->username_err = "le nom d'utilisateur est vide"; //if empty set error msg
				$hasErr = true;
			}else{
				$this->username = $_POST["username"];
				if($this->register_Manager->usernameExist($this->username)){ //check if username already exist
					$this->username_err = "le nom d'utilisateur exist déjà";//set msg error 
					$hasErr = true;
				}
			}

			if(!isset($_POST["password"]) || empty(trim($_POST["password"]))){//chek if there is POST with password
				$this->password_err = "le mot de passe est vide";
				$hasErr = true;
			}else if(strlen(trim($_POST["password"])) < 6){ //check if password as less then 6 char
				$this->password_err = "le mot de passe a moins de 6 caractères";
				$hasErr = true;
			}else{
				$this->password = $_POST["password"];
			}

			if(!isset($_POST["confirm_password"]) || empty(trim($_POST["confirm_password"]))){ //check if POST has confirm_pwd 
				$this->confirm_password_err = "la confirmation de mot de passe est vide"; 
				$hasErr = true;
			}else{
				$this->confirm_password = $_POST["confirm_password"];
			}

			//check if POST pwd and confim_pwd exist
			if(isset($_POST["confirm_password"]) && !empty(trim($_POST["confirm_password"]) && isset($_POST["password"]) && !empty(trim($_POST["password"])) )){
				if($_POST["confirm_password"] != $_POST["password"] ){ // check if they are similar
					$this->confirm_password_err = "la confirmation de mot de passe est différente";// if not set error msg
					$hasErr = true;
				}
			}


			// after condition checking, if there is something wrong, exit and load page
			if($hasErr != false){
				$this->reloadPage();
			}else{//if everything is good, insert in db
				$this->register_Manager->insertData($this->username,$this->password);
				$this->exitToLogin();
			}
		}

	}


	private function reloadPage(){
		$this->load->helper('url');
		//parameter array to set correctly view data
		$data = array('username' => $this->username, 'username_err' => $this->username_err,'password_err' => $this->password_err,'password' => $this->password, 'confirm_password' => $this->confirm_password, 'confirm_password_err' => $this->confirm_password_err);
		$this->load->view('register_view', $data);
	}


	private function exitToLogin(){
		$this->load->helper('url');
		header(base_url('index.php/LoginPage/index'));
	}


	
}?>
