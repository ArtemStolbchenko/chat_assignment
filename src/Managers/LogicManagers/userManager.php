<?php
    include './src/Managers/DBManagers/userDbManager.php';

    class UserManager {
        public $userSessionTag = "User";
        private $dbManager;
        function __construct()
        {
            $this->dbManager = new UserDbManager();
            $this->LoadCurrentUser();
        }

        function LoadCurrentUser()
        {//would much rather something like JWT, which would also make the tokens relatively persistent and take care of their timeouts
            if (!isset($_SESSION[$this->userSessionTag]) ||
                !$this->VerifyUser())
            {
                $this->RegisterUser();
            } 
        }

        function VerifyUser()
        {
            $userExists = $this->dbManager->UserExists($_SESSION[$this->userSessionTag]);
            
            return $userExists;
        }

        function RegisterUser()
        {
            $randomToken = uniqid();
            $this->dbManager->RegisterUser($randomToken);
            $_SESSION[$this->userSessionTag] = $randomToken;
        }
    }
?>