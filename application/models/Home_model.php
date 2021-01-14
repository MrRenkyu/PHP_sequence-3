<?php
	// Initialize the session
class home_model extends CI_Model{

	

    private $listArticle = [];
	private $articleSelected;
	

	public function __construct(){
		$this->load->database();
        $this->load->model('articles_db_manager');
        $this->load->helper('url');
 
		$this->listArticle = $this->articles_db_manager->GetPublicArticle(); //get all public Articles	
		
     }

     //Create HTMLString Button
    public function GetShowButtonString(){
    	$str = "";
        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){//if logged allow to adminPage and profilPage
        	$str .= '<a href="'.base_url("index.php/AdminController/index").'" class="button">Administrateur</a>';
            $str .= '<a href="'.base_url("index.php/LogoutController/index").'" class="button">Se deconnecter</a>';
            $str .= '<a href="'.base_url("index.php/ProfilController/index").'" class="button">Mon profil</a>';
        }else{//if not, just allow to logging
            $str .= '<a href="'.base_url("index.php/LoginController/index").'" class="button">Se connecter</a>';
        }
        return $str;
    }

    //Create HTMLString Menu, Menu is button that display article data to Reader
   public function GetCreateMenuString(){
   	    $str = "";         
        foreach($this->listArticle as $article){
                  $str .= '<button type="submit" name="insert" value="insert" onclick="SelectArticle(\''.$article->getId().'\')">'. htmlspecialchars($article->getTitle()) .'</button>';
                  $str .= '<p></p>';
        }
        return $str;
    }

    //Create HTMLString basic info of id article
   public function GetShowArticleString($index){
   	    $str = "";         
        if(count($this->listArticle) >= $index){
            $str .= '<button type="submit" name="insert" value="insert" onclick="SelectArticle(\''.$this->listArticle[count($this->listArticle) - $index]->getId().'\')">'. htmlspecialchars($this->listArticle[count($this->listArticle) - $index]->getTitle()) .'</button>';
            $str .= '<p>' . htmlspecialchars($this->listArticle[count($this->listArticle) - $index]->getSummary()) . '<p>';
        }
        return $str;
    }

}
?>