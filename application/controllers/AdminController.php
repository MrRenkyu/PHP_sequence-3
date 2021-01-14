<?php
class AdminController extends CI_Controller {

    private $articlesProposal;

    //page called by default, it call an empty view withOut article display.
    public function index(){ 
      $this->init(); 
      $this->checkLoggedIn();

      $this->load->model('admin_article_review');
      $this->articlesProposal = $this->admin_article_review->displayProposalArticle();
      $data = array('articles_proposal' => $this->articlesProposal);//this add HTML String with all link for articles
      $this->load->view('admin_view_no_articles',$data);
    }

    //page called when user clicked on link of articles, so we call a view with alla data that concern article $articleId
    public function displayArticlesData($articleId){
      $this->checkLoggedIn();

      $this->load->model('admin_article_review');
      $this->articlesProposal = $this->admin_article_review->displayProposalArticle();

      $_SESSION['idArticle'] = $articleId; //by protected, we do not let user interact with id, si he wont call delete,update by it self.
     
      $data = $this->admin_article_review->dataArrayPackageArticle($articleId);
      $data += ['articles_proposal' => $this->articlesProposal]; //this add HTML String with all link for articles
      $this->load->view('admin_view',$data);

    }


    //delete he articles actualy displayed.
    public function deleteArticle(){
      $this->init();
      $this->checkLoggedIn();
      if (isset($_SESSION['idArticle'])) {
        $this->load->model('articles_db_manager');
        $this->articles_db_manager->DeleteArticle($_SESSION['idArticle']);
      }

    }

    //update he articles actualy displayed, with area on display.
    public function updateArticle(){
      $this->init();
      $this->checkLoggedIn();
      if (isset($_SESSIOn['idArticle'])) {
        $this->load->model('articles_db_manager');
        $this->articles_db_manager->UpdateArticlebydata($_POST['public'],$_POST['author'],$_POST['title'],$_POST['date'],$_POST['summary'],$_POST['content'],$_SESSION['idArticle']);
      }

    }

    //create a new articles with all area displayed.
    public function addArticle(){
      $this->init();
      $this->checkLoggedIn();
      $this->load->model('articles_db_manager');
      $id = $this->articles_db_manager->GetNewIdForArticle();
      $this->articles_db_manager->InsertArticleBydata($_POST['public'],$_POST['author'],$_POST['title'],$_POST['date'],$_POST['summary'],$_POST['content'],$id);

    }

    //start session and helper, it's used by all methods.
    private function init(){
      session_start();
      $this->load->helper('url');
    }
   
    //if user is not loggedin he can't acces to this page
    private function checkLoggedIn(){
        // Check if the user is not loggedIn, so change him to LoginPage
      if(!isset($_SESSION["loggedin"])){
          header('Location: '.base_url('index.php/LoginController/index'));
          exit;
    }






}
?>