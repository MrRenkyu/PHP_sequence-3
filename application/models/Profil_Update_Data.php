<?php
class Profil_Update_Data extends CI_Model{

    function __construct(){
        $this->load->database();
    }

    function updateInfoDb($id,$nom,$prenom,$date,$password){

        //if password area as something inside, we also changed the password
        if (empty(trim($password))) {
            $data = array(
                'name' => $prenom,
                'surname' => $nom,
                'birthdate' => $date
            );

        } else {
            $data = array(
                'name' => $title,
                'surname' => $name,
                'birthdate' => $date,
                'password' => password_hash()
            );
        }
    
        $this->db->where('id', $id);
        $this->db->update('USER', $data);

    }
   

    
    






}

?>