<?php

class profilController extends CI_Controller{
	private $profilNom;
	private $profilPrenom;
	private $profilDate;
	private $profilId;
	private $password_err;
	private $asPost;

	public function __construct(){
		$this->load->database();
	}
	

	//checkAsPost();

	//if ($asPost == true)
	//updateDB();

	//displayOldInfo();
	//
	//session_start(); Je sais pas ou le mettre

	public function index(){

		$this->load->helper('url');
		$this->getDataUser();
		$data = array('profilId' => $this->profilId,'profilPrenom' => $this->profilPrenom,'profilDate' => $this->profilDate,'password_err' => $this->password_err);
		$this->load->view('profil_view');
	}

	private function getDataUser(){
		$this->profilId = $_SESSION["id"];
		$this->load->model("profil_Redactor_Info");
		$this->profil_Redactor_Info->loadInfo($this->profilId);

		$this->profilNom = $this->profil_Redactor_Info->getRedactor()->getNom();
		$this->profilPrenom = $this->profil_Redactor_Info->getRedactor()->getPrenom();
		$this->profilDate = $this->profil_Redactor_Info->getRedactor()->getDateNaissance();
	}

	public function updateData(){
		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			$hasErr = false;

			
			if(strlen(trim($_POST["profilPswd"])) < 6 && !empty(trim($password)) ){//chek if there is POST with password
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
				$password = $_SESSION["pwd"];
				
				$this->load->model("profil_Update_Data");
				$this->profil_Update_Data->updateInfoDb();
				$this->reload();
			}
		}
	}














	public function checkAsPost()
	{
		// Processing form data when form is submitted

		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			// Check if name isn't empty
			if (!empty(trim($_POST["profilNom"]))) {
				$this->profilNom = trim($_POST["profilNom"]);
				echo "le nom : " . $this->profilNom;
				$this->asPost = true;
			} else {
				echo "pas de nom en post\n";
			}

			// Check if first name isn't empty
			if (!empty(trim($_POST["profilPrenom"]))) {
				$this->profilPrenom = trim($_POST["profilPrenom"]);
				echo "le prenom : " . $this->profilPrenom;
				$this->asPost = true;
			} else {
				echo "pas de prenom en post\n";
			}

			// Check if date isn't empty
			if (!empty(trim($_POST["profilDate"]))) {
				$this->profilDate = trim($_POST["profilDate"]);
				echo "la date : " . $this->profilDate;
				$this->asPost = true;
			} else {
				echo "pas de date en post\n";
			}

			// Check if password isn't empty
			if (!empty(trim($_POST["profilPswd"]))) {
				$this->profilPswd = trim($_POST["profilPswd"]);
				echo "le mdp : " . $this->profilPswd;
				$this->asPost = true;
			} else {
				echo "pas de pwd en post\n";
			}
		}
	}

	public function updateDB()
	{

		//if password area as something inside, we also changed the password
		if (empty(trim($this->profilPswd))) {
			$data = [
				'profilNom' => $this->profilNom,
				'profilPrenom' => $this->profilPrenom,
				'profilDate' => $this->profilDate,
				'id' => $this->profilId
			];
			$sql = "UPDATE USER SET name=:profilPrenom, surname=:profilNom, birthdate=:profilDate WHERE id=:id";
		} else {
			$data = [
				'profilNom' => $this->profilNom,
				'profilPrenom' => $this->profilPrenom,
				'profilDate' => $this->profilDate,
				'id' => $this->profilId,
				'profilPswd' => password_hash($this->profilPswd, PASSWORD_DEFAULT)
			];
			$sql = "UPDATE USER SET name=:profilPrenom, surname=:profilNom, birthdate=:profilDate, password=:profilPswd WHERE id=:id";
		}

		echo "\n la requète update: $sql";
		$query = $this->db->query($sql);

		//insert $data ton the sql query and execute
		if ($query->execute($data) === TRUE) {
			echo "les données ont été mises à jour";
		} else {
			echo "Une erreur est survenue" . $db->error;
		}
		$data = array('profilNom' => $this->profilNom, 'profilPrenom' => $this->profilPrenom, 'profilDate' => $this->profilDate, 'id' => $this->profilId, 'profilPswd' => $this->profilPswd);
		$this->load->view('register_view', $data);
	}

	//retreive data from old  configuration from server
	public function displayOldInfo()
	{
		include("../models/Redactor.class.php");

		$sql = "SELECT * FROM USER WHERE username='" . $_SESSION["username"] . "'";
		echo "\nla requète displayOldINFo: $sql";

		foreach ($db->query($sql) as $line) {
			$this->userInfo = new Redactor($line[4], $line[5], $line[6], $line[1], $line[0]);
			echo "eachrows -> " . $this->userInfo->getNom();
		}

		$this->profilNom = $this->userInfo->getNom();
		$this->profilPrenom = $this->userInfo->getPrenom();
		$this->profilDate = $this->userInfo->getDateNaissance();

		echo "\n$this->profilNom,  $this->profilPrenom,   $this->profilDate";


	}

}
?>

