<?php

class HomeController extends CI_Controller {

    public function index(){
      session_start();
      $this->load->helper('url');

      $this->load->model('home_model');
     
      $data = array('stringButton' => $this->home_model->GetShowButtonString(),
        'stringMenu' => $this->home_model->GetCreateMenuString(),
        'stringArticle1' => $this->home_model->GetShowArticleString(1),
        'stringArticle2' => $this->home_model->GetShowArticleString(2),
        'stringArticle3' => $this->home_model->GetShowArticleString(3)
        );

      $this->load->view('home_view',$data);
    }


}
?>