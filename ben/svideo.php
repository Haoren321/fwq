<?php
    class svideoClass{
        var $svId;
        var $title;
        var $coverImg;
        //var $preview_img;
        var $sourceUrl;
        var $author;
        var $introduction;
        var $coutWatch;

        function __construct($svId,$title,$coverImg,$sourceUrl,$author,$introduction,$coutWatch){
            $this->svId = $svId;
            $this->title = $title;
            $this->coverImg = $coverImg;
            $this->sourceUrl = $sourceUrl;
            $this->author = $author;
            $this->introduction = $introduction;
            $this->coutWatch = $coutWatch;
        }

        function getsvId(){
            echo $this->svId;
        }
        function setsvId($svId){
            $this->$svId;
        }
        function getTitle(){
            echo $this->title;
        }
        function setTitle($title){
            $this->title = $title;
        }
        function getcoverImg(){
            echo $this->coverImg;
        }
        function setcoverImg($coverImg){
            $this->coverImg = $coverImg;
        }
        function getsourceUrl(){
            echo $this->sourceUrl;
        }
        function setsourceUrl($sourceUrl){
            $this->sourceUrl = $sourceUrl;
        }   
        function getAuthor(){
            echo $this->author;
        }
        function setAuthor($author){
            $this->author = $author;
        }
        function getIntroduction(){
            echo $this->introduction;
        }
        function setIntroduction($introduction){
            $this->introduction = $introduction;
        }
        function getCoutWatch(){
            echo $this->coutWatch;
        }
        function setCoutWatch($coutWatch){
            $this->coutWatch = $coutWatch;
        }                       
    }
