<?php
	
class ReaderController extends CI_Controller{

	public function index($id){

		$this->load->helper('url');
		$this->load->model('reader_model');
		$this->reader_model->loadArticle($id);
		$details = $this->reader_model->ShowDetails();
		$content = $this->reader_model->ShowContent();

		$data = array('details' => $details, 'content' => $content);
		$this->load->view('reader_view',$data);
	}
}
?>