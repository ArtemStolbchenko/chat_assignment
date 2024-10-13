<?php
    require_once './src/Managers/DBManagers/BaseDbManager.php';
    class GroupEnrolmentDbManager extends BaseDbManager {
        public function __construct()
        {
            $this->tableName = "GroupsParticipants";
        }
        public function JoinGroup($groupId, $userToken)
        {
            $parameters = array(
                "groupId" => $groupId,
                "userToken" => $userToken
            );

            $result = $this->Add($parameters);
            return $result;
        }
        public function IsEnrolled($groupId, $userToken)
        {
            $parameters = array(
                "groupId" => $groupId,
                "userToken" => $userToken
            );
            $operators = ["=", "="];
            
            $result = $this->Get($parameters, $operators);
            return (!$result == NULL);
        }
    }
?>