<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Include config file
include_once("model/config.php");

class RegisterController extends CI_Controller{

	// Define variables and initialize with empty values
	private $username = "";
	private $password = "";
	private $confirm_password = "";
	private $username_err ="";
	private $password_err = "";
	private $confirm_password_err = "";

	public function index()
	{
		// Processing form data when form is submitted
		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			// Validate username
			if (empty(trim($_POST["username"]))){
				$username_err = "Entrer votre pseudo";
			}else{
				// Prepare a select statement
				$sql = "SELECT id FROM USER WHERE username = ?";

				if ($stmt = mysqli_prepare($link, $sql)) {
					// Bind variables to the prepared statement as parameters
					mysqli_stmt_bind_param($stmt, "s", $param_username);

					// Set parameters
					$param_username = trim($_POST["username"]);

					// Attempt to execute the prepared statement
					if (mysqli_stmt_execute($stmt)) {
						/* store result */
						mysqli_stmt_store_result($stmt);

						if (mysqli_stmt_num_rows($stmt) == 1) {
							$username_err = "Le pseudo est déja prit";
						} else {
							$username = trim($_POST["username"]);
						}
					} else {
						echo "Oops! Something went wrong. Please try again later.";
					}

					// Close statement
					mysqli_stmt_close($stmt);
				}
			}

			// Validate password
			if (empty(trim($_POST["password"]))) {
				$password_err = "Entrer votre mot de passe";
			} elseif (strlen(trim($_POST["password"])) < 6) {
				$password_err = "Votre mot de passe contient moins de 6 caractères";
			} else {
				$password = trim($_POST["password"]);
			}

			// Validate confirm password
			if (empty(trim($_POST["confirm_password"]))) {
				$confirm_password_err = "Confirmer votre mot de passe";
			} else {
				$confirm_password = trim($_POST["confirm_password"]);
				if (empty($password_err) && ($password != $confirm_password)) {
					$confirm_password_err = "Mauvais mot de passe";
				}
			}

			// Check input errors before inserting in database
			if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {

				// Prepare an insert statement
				$sql = "INSERT INTO USER (username, password) VALUES (?, ?)";

				if ($stmt = mysqli_prepare($link, $sql)) {
					// Bind variables to the prepared statement as parameters
					mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

					// Set parameters
					$param_username = $username;
					$param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

					// Attempt to execute the prepared statement
					if (mysqli_stmt_execute($stmt)) {
						// Redirect to login page
						header("location: index.php?action=login");
					} else {
						echo "Something went wrong. Please try again later.";
					}

					// Close statement
					mysqli_stmt_close($stmt);
				}
			}

			// Close connection
			mysqli_close($link);
		}
		$this->load->view('register', $username);

	}
}?>
