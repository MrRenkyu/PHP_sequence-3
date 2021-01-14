<?php

class Reader_model extends CI_Model{

    private $article;

    function __constuct(){
        session_start();
    }

    function loadArticle($id){
        $this->load->model('articles_db_manager');
        $this->article = $this->articles_db_manager->GetArticleById($id);
    }

    function ShowDetails(){
        $str ="";
        $str .=  '<p> Auteur : ' . htmlspecialchars($this->article->getAuthor()) . '<p>';
        $str .=  '<p> Date de publication : ' . htmlspecialchars($this->article->getPublicationDate()) . '<p>';
        return $str;
    }

    function ShowContent(){
        $str ="";
        $str .=  '<p>' . htmlspecialchars($this->article->getTitle()) . '<p>';
        $str .= '<p>' . htmlspecialchars($this->article->getContent()) . '<p>';
        return $str;
    }

}

?>