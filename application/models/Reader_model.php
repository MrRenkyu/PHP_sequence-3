<?php

class Reader_model extends CI_Model{

    private $article;

    function __constuct(){
        session_start();
    }

    //load on atribut articles id
    function loadArticle($id){
        $this->load->model('articles_db_manager');//acces to database
        $this->article = $this->articles_db_manager->GetArticleById($id);
    }

    //get HTMLString of detail, author and publish date 
    function ShowDetails(){
        $str ="";
        $str .=  '<p> Auteur : ' . htmlspecialchars($this->article->getAuthor()) . '<p>';
        $str .=  '<p> Date de publication : ' . htmlspecialchars($this->article->getPublicationDate()) . '<p>';
        return $str;
    }

    //get HTMLString of content, title and body
    function ShowContent(){
        $str ="";
        $str .=  '<p>' . htmlspecialchars($this->article->getTitle()) . '<p>';
        $str .= '<p>' . htmlspecialchars($this->article->getContent()) . '<p>';
        return $str;
    }

}

?>