<?php
    //Create a new SQLite3 Database
    $db = new SQLite3('chat.db');

    //Create a table containing the messages
    $query = "CREATE TABLE IF NOT EXISTS Messages (id INTEGER NOT NULL PRIMARY KEY, authorToken INT, groupId INT, content STRING, dateSent TIMESTAMP)";
    $db->exec($query);

    //Create a table containing the users
    $query = "CREATE TABLE IF NOT EXISTS Users (id INTEGER NOT NULL PRIMARY KEY, token STRING)";
    $db->exec($query);

    //Create a table containing the groups and their names
    $query = "CREATE TABLE IF NOT EXISTS Groups (id INTEGER NOT NULL PRIMARY KEY, name STRING)";
    $db->exec($query);

    //Create a table containing the enrollments of users to groups
    $query = "CREATE TABLE IF NOT EXISTS GroupsParticipants (id INTEGER NOT NULL PRIMARY KEY, groupId INTEGER NOT NULL, userToken STRING NOT NULL)";
    $db->exec($query);
?>