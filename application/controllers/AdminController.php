<?php

class AdminController extends CI_Controller {

    // Define variables and initialize with empty values

    private $articlesProposal;

    
    public function index(){ 
      $this->load->helper('url');
      //$this->checkLoggedIn();

      $this->load->model('admin_article_review');
      $this->articlesProposal = $this->admin_article_review->displayProposalArticle();
      echo "articles proposal: ".$this->articlesProposal;
      $data = array('articles_proposal' => $this->articlesProposal);
      $this->load->view('admin_view_no_articles',$data);
    }

    public function displayArticlesData($articleId){
      $this->load->helper('url');
      $this->checkLoggedIn();


    }
   
    private function checkLoggedIn(){
      // Check if the user is already logged in, if yes then redirect him to home page
      if(!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] === true){
          echo"NOT CONNECTED!";
          //header(base_url('index.php/LoginController/index'));
          //exit;
      }
  }



}
?>