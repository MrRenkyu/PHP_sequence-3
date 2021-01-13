<?php
require_once("Article.class.php");

class Articles_db_manager extends CI_Model{


    public function __construct(){
        $this->load->database();
    }

    function GetArticleById($id){
        $query = $this->db->query("SELECT * FROM ARTICLE WHERE id = " . $id);
        foreach ($query->result('array') as $line) {
            $articleSelected = new Article($line['public'],$line['author'],$line['title'],$line['date'],$line['summary'],$line['data'], $line['id'],true );
            return $articleSelected; 
        }
    }

    function GetAllArticle(){
        $query = $this->db->query("SELECT * FROM ARTICLE");      
        $listArticle;
        foreach ($query->result('array') as $line) {
            $article = new Article($line['public'],$line['author'],$line['title'],$line['date'],
            $line['summary'],$line['data'],$line['id'],true);
            $listArticle[] = $article;
        }
        return $listArticle;
    }

    function InsertArticle($article){
        $this->db->query("INSERT INTO ARTICLE VALUES('".$article->getId()."', '".$article->isPublic()."', '".base64_encode($article->getAuthor())."', '".base64_encode($article->getTitle())."', '".$article->getPublicationDate()."', '".base64_encode($article->getSummary())."', '".base64_encode($article->getContent())."')"); 
    }

    function InsertArticleBydata($public,$author,$title,$date,$summary,$content,$id){
        $this->db->query("INSERT INTO ARTICLE VALUES('".$id."', '".$public."', '".base64_encode($author)."', '".base64_encode($title)."', '".$date."', '".base64_encode($summary)."', '".base64_encode($content)."')"); 
    }

    function UpdateArticle($article){
        $this->db->query("UPDATE ARTICLE SET public = '".$article->isPublic()."', author = '".base64_encode($article->getAuthor())."', title = '".base64_encode($article->getTitle())."', date = '".$article->getPublicationDate()."', summary = '".base64_encode($article->getSummary())."', data = '".base64_encode($article->getContent())."' WHERE id = '".$article->getId()."'"); 
    }

    function UpdateArticlebydata($public,$author,$title,$date,$summary,$content,$id){
        $this->db->query("UPDATE ARTICLE SET public = '".$public."', author = '".base64_encode($author)."', title = '".base64_encode($title)."', date = '".$date."', summary = '".base64_encode($summary)."', data = '".base64_encode($content)."' WHERE id = '".$id."'"); 
    }
    

    function DeleteArticle($id){
        $this->db->query("DELETE FROM ARTICLE WHERE id = " .$id); 
    }

    function GetNewIdForArticle(){
        $query = $this->db->query("SELECT MAX(id) as nbr FROM ARTICLE"); 
        foreach ($query->result('array') as $line) {
            $idNumber = $line['nbr'] + 1;             
        }
        return $idNumber;
    }

}
?>