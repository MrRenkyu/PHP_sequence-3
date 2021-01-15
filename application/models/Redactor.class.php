<?php

class Redactor
{
    protected $id;
    protected $nom;
    protected $prenom;
	protected $dateDeNaissance;
	
    protected $login;
    protected $droit;
    
    protected $articles = array();
	
	
    public function Redactor($Nom, $Prenom,$DateDeNaissance,$UserName,$Id ){
        $this->nom = $Nom;
        $this->prenom = $Prenom;
        $this->id = $Id;
		$this->dateDeNaissance = $DateDeNaissance;
		$this->login = $UserName;
    }
    
   
    public function getNom(){
		return $this->nom;
	}

	public function setNom($nom){
		$this->nom = $nom;
	}

	public function getPrenom(){
		return $this->prenom;
	}

	public function setPrenom($prenom){
		$this->prenom = $prenom;
	}

	public function getLogin(){
		return $this->login;
	}

	public function setLogin($login){
		$this->login = $login;
	}

	public function getDroit(){
		return $this->droit;
	}

	public function setDroit($droit){
		$this->droit = $droit;
	}

	public function getAllArticles(){
		return $this->acticles;
	}

	public function addArticles($newArticle){
		$articleList = $this->articles;
        array_push($articleList, $newArticle);
   
	}
    
    public function getId(){
        return $this->id;
    }
    
    public function getDateNaissance(){
        return $this->dateDeNaissance;
    }
    
    public function setDateNaissance($dateDeNaissance){
        return $this->dateDeNaissance = $dateDeNaissance;
    }

}
?>