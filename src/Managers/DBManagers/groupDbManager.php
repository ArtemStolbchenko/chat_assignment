<?php
    require_once './src/Managers/DBManagers/BaseDbManager.php';
    class GroupDbManager extends BaseDbManager {
        public function __construct()
        {
            $this->tableName = "Groups";
        }
        public function GetAllGroups()
        {
            return $this->Get([], []);
        }
        public function CreateGroup($groupName)
        {
            $parameters = array(
                "name" => $groupName,
            );

            $result = $this->Add($parameters);
            return $result;
        }
    }
?>