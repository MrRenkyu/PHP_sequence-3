<?php
	
class ReaderController extends CI_Controller{

	//index is called by default 
	public function index($id){ // $id of articles we want to display

		$this->load->helper('url');
		$this->load->model('reader_model'); //model that has information of articles.

 		// see Model "Reader_model"
		$this->reader_model->loadArticle($id);
		$details = $this->reader_model->ShowDetails();
		$content = $this->reader_model->ShowContent();

		$data = array('details' => $details, 'content' => $content);
		$this->load->view('reader_view',$data);
	}
}
?>