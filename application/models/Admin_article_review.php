<?php
	// Initialize the session
class Admin_article_review extends CI_Model{

	

    private $listArticle = [];
	private $articleSelected;
	

	public function __construct(){
		$this->load->database();
		session_start();
		$this->load->model('articles_db_manager');
		$this->load->library("article.php");
 
		$listArticle = $this->articles_db_manager->GetAllArticle();

		if(isset($_SESSION['idArticle'])){
			$articleSelected = $this->articles_db_manager->GetArticleById($_SESSION['idArticle']);
		}
     }
   

    function ShowTitle(){
    	if(isset($_SESSION['idArticle'])){
    	 	echo $this->articleSelected->getTitle();
    	}
    }

	function ShowSummary(){
    	if(isset($_SESSION['idArticle'])){
    	 	echo $this->articleSelected->getSummary();
    	}
    }

    function ShowContent(){
    	if(isset($_SESSION['idArticle'])){
    	 	echo $this->articleSelected->getContent();
    	}
    }

    function ShowAuthor(){
    	if(isset($_SESSION['idArticle'])){
    	 	echo $this->articleSelected->getAuthor();
    	}
    }

    function ShowPublicationDate(){
    	if(isset($_SESSION['idArticle'])){
    	 	echo $this->articleSelected->getPublicationDate();
    	}
    }

    function IsPublic(){
    	if(isset($_SESSION['idArticle'])){
    		if($this->articleSelected->isPublic())
    			echo 'checked';
    	}
    }
    
	function displayProposalArticle(){
		$StringHref="";
		$stringURL="";
		 foreach($this->listArticle as $article){
			//$StringHref += ' <button type="submit" name="insert" value="insert" onclick="getArticle('.$article->getId().')">'.htmlspecialchars($article->getTitle()).'</button>';
			$stringURL = base_url('index.php/AdminController/displayArticlesData/'.$article->getId());
			$StringHref .= '<a href='.$stringURL.'>Retour à la page d\'accueil</a>';
			$StringHref .= '<p></p>';
		}
		echo"return of displayPoposal: ".$StringHref;
		return $StringHref;
	}


}
?>