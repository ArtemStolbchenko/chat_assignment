<?php
    require_once './src/Managers/DBManagers/BaseDbManager.php';
    class MessageDbManager extends BaseDbManager {
        public function __construct()
        {
            $this->tableName = "Messages";
        }
        public function GetMessagesPerGroup($groupId)
        {
            $parameters = array(
                "groupId" => $groupId
            );
            $operators = ["="];
            
            $result = $this->Get($parameters, $operators);
            return $result;
        }
        public function AddMessage($userToken, $groupId, $content)
        {
            $timestamp = date(DATE_RFC3339); //the same format as in the SQLite
            
            $parameters = array(
                "authorId" => $userToken,
                "groupId" => $groupId,
                "content" => $content,
                "dateSent" => $timestamp
            );

            $result = $this->Add($parameters);
            return $result;
        }
    }
?>