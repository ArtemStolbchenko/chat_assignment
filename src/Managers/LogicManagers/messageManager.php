<?php
    require_once './src/Managers/DBManagers/MessageDbManager.php';
    require_once './src/Managers/DBManagers/groupEnrolmentDbManager.php';

    class MessageManager {
        private $messageDbManager, $enrolmentDbManager;
        function __construct()
        {
            $this->messageDbManager = new MessageDbManager();
            $this->enrolmentDbManager = new GroupEnrolmentDbManager();
        }

        function GetMessages($groupId, $userToken)
        {
            $isEnrolled = $this->enrolmentDbManager->IsEnrolled($groupId, $userToken);

            if (!$isEnrolled)
                return "You are unauthorized to browse messages in this group!";

            return $this->messageDbManager->GetMessages($groupId);
        }
        function PublishMessage($userToken, $groupId, $content)
        {
            $isEnrolled = $this->enrolmentDbManager->IsEnrolled($groupId, $userToken);

            if (!$isEnrolled)
                return "You are unauthorized to send messages in this group!";

            return $this->messageDbManager->PublishMessage($userToken, $groupId, $content);
        }
    }
?>