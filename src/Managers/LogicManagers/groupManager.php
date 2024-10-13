<?php
    include './src/Managers/DBManagers/groupDbManager.php';
    include './src/Managers/DBManagers/groupEnrolmentDbManager.php';

    class GroupManager {
        private $groupDbManager, $enrolmentsDbManager;
        function __construct()
        {
            $this->groupDbManager = new GroupDbManager();
            $this->enrolmentsDbManager = new GroupEnrolmentDbManager();
        }
        function GetAllGroups()
        {
            return $this->groupDbManager->GetAllGroups();
        }
        function CreateGroup($name)
        {
            return $this->groupDbManager->CreateGroup($name);
        }
        function Enroll($groupId, $userId)
        {
            return $this->enrolmentsDbManager->JoinGroup($groupId, $userId);
        }
    }
?>