<?php
class AdminController extends CI_Controller {

    private $articlesProposal;

    public function index(){ 
      $this->load->helper('url');
      //$this->checkLoggedIn();

      $this->load->model('admin_article_review');
      $this->articlesProposal = $this->admin_article_review->displayProposalArticle();
      $data = array('articles_proposal' => $this->articlesProposal);
      $this->load->view('admin_view_no_articles',$data);
    }

    public function displayArticlesData($articleId){
      session_start();
      $this->load->helper('url');
      //$this->checkLoggedIn();

      $this->load->model('admin_article_review');
      $this->articlesProposal = $this->admin_article_review->displayProposalArticle();

      $_SESSION['idArticle'] = $articleId;
     
      $data = $this->admin_article_review->dataArrayPackageArticle($articleId);
      $data += ['articles_proposal' => $this->articlesProposal];
      $this->load->view('admin_view',$data);

    }



    public function deleteArticle(){
      //$this->checkLoggedIn();
      session_start();
      if (isset($_SESSION['idArticle'])) {
        $this->load->model('articles_db_manager');
        $this->articles_db_manager->DeleteArticle($_SESSION['idArticle']);
      }

    }

    public function updateArticle(){
      //$this->checkLoggedIn();
      session_start();
      if (isset($_SESSIOn['idArticle'])) {
        $this->load->model('articles_db_manager');
        $this->articles_db_manager->UpdateArticlebydata($_POST['public'],$_POST['author'],$_POST['title'],$_POST['date'],$_POST['summary'],$_POST['content'],$_SESSION['idArticle']);
      }

    }

    public function addArticle(){
      //$this->checkLoggedIn();
      session_start();
      $this->load->model('articles_db_manager');
      $id = $this->articles_db_manager->GetNewIdForArticle();
      $this->articles_db_manager->InsertArticleBydata($_POST['public'],$_POST['author'],$_POST['title'],$_POST['date'],$_POST['summary'],$_POST['content'],$id);

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