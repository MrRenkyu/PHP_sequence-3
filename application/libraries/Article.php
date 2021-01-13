<?php

class Article {
    
    protected $title;
    protected $isPublic;
    protected $author;
    protected $publicationDate;
    protected $summary;
    protected $content;
    protected $id;
    
    public function Article($isPublic, $author, $title, $publicationDate, $summary, $content, $id,$isFromBDD = false){
        if ($isFromBDD) {
        $this->isPublic = $isPublic;
        $this->author = base64_decode($author);
        $this->title = base64_decode($title);
        $this->publicationDate = $publicationDate;
        $this->summary = base64_decode($summary);
        $this->content = base64_decode($content);
        $this->id = $id;
        }else{
        $this->isPublic = $isPublic;
        $this->author = $author;
        $this->title = $title;
        $this->publicationDate = $publicationDate;
        $this->summary = $summary;
        $this->content = $content;
        $this->id = $id;
        }
       
    }
   
    public function getId(){
        return $this->id;
    }

    public function getTitle(){
        return $this->title;
    }

    public function setTitle($title){
        $this->title = $title;
    }

    public function isPublic(){
        return $this->isPublic;
    }

    public function setIsPublic($isPublic){
        $this->isPublic = $isPublic;
    }

    public function getAuthor(){
        return $this->author;
    }

    public function setAuthor($author){
        $this->author = $author;
    }

    public function getPublicationDate(){
        return $this->publicationDate;
    }

    public function setPublicationDate($publicationDate){
        $this->publicationDate = $publicationDate;
    }

    public function getSummary(){
        return $this->summary;
    }

    public function setSummary($summary){
        $this->summary = $summary;
    }

    public function getContent(){
        return $this->content;
    }

    public function setContent($content){
        $this->content = $content;
    }

}
?>