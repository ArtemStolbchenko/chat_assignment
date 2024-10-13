<?php
    require_once './src/Managers/DBManagers/BaseDbManager.php';
    class UserDbManager extends BaseDbManager {
        public function __construct()
        {
            $this->tableName = "Users";
        }
        public function UserExists($userId)
        {
            $parameters = array(
                "token" => $userId
            );
            $operators = ["="];
            
            $result = $this->Get($parameters, $operators);
            return (!$result == NULL);
        }
        public function RegisterUser($userId)
        {
            $parameters = array(
                "token" => $userId,
            );

            $result = $this->Add($parameters);
            return $result;
        }
    }
?>