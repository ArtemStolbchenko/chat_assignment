<?php
    include './src/Managers/DBManagers/MessageDbManager.php';
    include './src/Managers/DBManagers/groupEnrolmentDbManager.php';

    class MessageManager {
        private $messageDbManager, $enrolmentDbManager;
        function __construct()
        {
            $this->messageDbManager = new MessageDbManager();
            $this->enrolmentDbManager = new GroupEnrolmentDbManager();
        }

        function GetMessages($groupId, $userToken)
        {
            $isEnrolled = $enrolmentDbManager.IsEnrolled($groupId, $userToken);

            if (!$isEnrolled)
                return "You are unauthorized to browse messages in this group!";

            return $messageDbManager->GetMessages($groupId);
        }
        function PublishMessage($userToken, $groupId, $content)
        {
            $isEnrolled = $enrolmentDbManager.IsEnrolled($groupId, $userToken);

            if (!$isEnrolled)
                return "You are unauthorized to send messages in this group!";

            return $messageDbManager->PublishMessage($userToken, $groupId, $content);
        }
    }
?>