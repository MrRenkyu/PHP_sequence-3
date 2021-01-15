<?php

class ProfilController extends CI_Controller{
	private $profilNom;
	private $profilPrenom;
	private $profilDate;
	private $profilId;
	private $password_err;


	public function index(){

		$this->init();
		$this->getDataUser();
		$data = array('profilId' => $this->profilId,'profilNom' => $this->profilNom,'profilPrenom' => $this->profilPrenom,'profilDate' => $this->profilDate,'password_err' => $this->password_err);
		$this->load->view('profil_view',$data);
	}

	private function getDataUser(){
		$this->profilId = $_SESSION["id"];
		$this->load->model("profil_Redactor_Info");
		$this->profil_Redactor_Info->loadInfo($this->profilId);

		$this->profilNom = $this->profil_Redactor_Info->getRedactor()->getNom();
		$this->profilPrenom = $this->profil_Redactor_Info->getRedactor()->getPrenom();
		$this->profilDate = $this->profil_Redactor_Info->getRedactor()->getDateNaissance();
	}

	private function init(){
		session_start();
		$this->load->helper('url');
	}

	public function updateData(){
		$this->init();
		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			$hasErr = false;

			
			if(strlen(trim($_POST["profilPswd"])) < 6 && !empty(trim($_POST["profilPswd"])) ){//chek if there is POST with password
				$this->password_err = "le mot de passe est trop court";
				$hasErr = true;
			}	

			// after condition checking, if there is something wrong, exit and load page
			if($hasErr != false){
				$this->reloadPage();
			}else{	//if everything is good, insert in db
				$this->profilNom = $_POST["profilNom"];
				$this->profilPrenom= $_POST["profilPrenom"];
				$this->profilDate= $_POST["profilDate"];
				$this->profilId = $_SESSION["id"];
				$password = $_POST["profilPswd"];
				
				$this->load->model("profil_Update_Data");
				$this->profil_Update_Data->updateInfoDb($this->profilId,$this->profilNom,$this->profilPrenom,$this->profilDate,$password);
				$this->reloadPage();
			}
		}
	}

	private function reloadPage(){
		header('Location: '.base_url('index.php/ProfilController/index'));
	}

}
?>

