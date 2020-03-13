<?php
    class user{
        var $userId;
        var $userName;
        var $userIcon;        
        var $password;

        function setUserId($userId){
            $this->userId = $userId;
        }
        function getUserId(){
            echo $this->userId;
        }
        function setUserName($userName){
            $this->userName = $userName;
        }
        function getUserName(){
            echo $this->userName;
        }
        function setUserIcon($userIcon){
            $this->userIcon = $userIcon;
        }
        function getUserIcon(){
            echo $this->userIcon;
        }
        function setPassword($password){
            $this->password = $password;
        }
        function getPassword(){
            echo $this->password;
        }
    }
?>