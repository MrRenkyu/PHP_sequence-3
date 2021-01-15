<?php
require_once("Redactor.class.php");

class Profil_Redactor_Info extends CI_Model{

    private $userInfo;

    function __construct(){
        $this->load->database();
    }

    function loadInfo($id){
        $sql = "SELECT * FROM USER WHERE id=".$id;
        $query = $this->db->query($sql);

        foreach($query->result() as $line){
            $userInfo = new Redactor($line->surname,$line->name,$line->birthdate,$line->username,$line->id );
        }
    }

    public function getRedactor(){
        return $this->userInfo;
    }

    






}

?>