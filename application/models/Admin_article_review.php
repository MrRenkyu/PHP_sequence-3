<?php
	// Initialize the session
class Admin_article_review extends CI_Model{

	

    private $listArticle = [];
	private $articleSelected;
	

	public function __construct(){
		$this->load->database();
		$this->load->model('articles_db_manager');
 
		$this->listArticle = $this->articles_db_manager->GetAllArticle();
		
     }
   

    function ShowTitle($id){
    	return $this->getArticleById($id)->getTitle();
    }

	function ShowSummary($id){
    	return $this->getArticleById($id)->getSummary();
    }

    function ShowContent($id){
    	return $this->getArticleById($id)->getContent();
    }

    function ShowAuthor($id){
    	return $this->getArticleById($id)->getAuthor();
    }

    function ShowPublicationDate($id){
    	return $this->getArticleById($id)->getPublicationDate();
    }

    function IsPublic($id){
    	if($this->getArticleById($id)->isPublic()){
			return true;
		}
		return false;
	}
	
	private function getArticleById($id){
		return $this->articles_db_manager->GetArticleById($id);
	}
	function dataArrayPackageArticle($id){
		$article = $this->getArticleById($id);
		$data = array(
			'title'=>$article->getTitle(),
			'summary'=>$article->getSummary(),
			'content'=>$article->getContent(),
			'author'=>$article->getAuthor(),
			'date'=>$article->getPublicationDate(),
			'isPublic'=>$article->isPublic(),
			'id'=>$article->getId()
		);
		return $data;

	}
    
	function displayProposalArticle(){
		$StringHref="";
		$stringURL="";
		 foreach($this->listArticle as $article){
			//$StringHref += ' <button type="submit" name="insert" value="insert" onclick="getArticle('.$article->getId().')">'.htmlspecialchars($article->getTitle()).'</button>';
			$stringURL = base_url('index.php/AdminController/displayArticlesData/'.$article->getId());
			$stringText = htmlspecialchars($article->getTitle());
			$StringHref .= '<a href='.$stringURL.'>'.$stringText.'</a>';
			$StringHref .= '<p></p>';
		}
		return $StringHref;
	}


}
?>