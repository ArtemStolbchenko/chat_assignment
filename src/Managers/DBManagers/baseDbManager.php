<?php
    class BaseDbManager {
        public static $DB;
        private static $IsInitialized = false;
        private static $DatabaseName = "chat.db";
        
        public $tableName;

        public static function Initialize()
        {//Initializes the database connection. It is vital to call it at the startup
            if (!self::$IsInitialized) {
                self::$DB = new SQLite3(self::$DatabaseName);
                self::$IsInitialized = true;
            }
        }

        public function Add($parameters) {
            // Check if parameters are passed
            if (empty($parameters)) {
                throw new Exception('Parameters array cannot be empty');
            }

            $bindingKeys = self::GetBindingKeys(array_keys($parameters));

            // Get the column names and the corresponding values keys
            $columns = implode(", ", array_keys($parameters));
            $valuesKeys = implode(", ", $bindingKeys);
            // Prepare the SQL statement
            $query = "INSERT INTO " . $this->tableName . " (" . $columns . ") VALUES (" . $valuesKeys . ")";

            $stmt = self::Sanitize($parameters, $query);
            // Execute the query
            $result = $stmt->execute();

            // Check if the query execution was successful
            if (!$result) {
                throw new Exception('Error executing query: ' . self::$DB->lastErrorMsg());
            }

            return true;
        }

        public function Get($parameters, $operators)
        {
            $bindingKeys = self::GetBindingKeys(array_keys($parameters));

            // Break up parameters into columns and values keys
            $columns = array_keys($parameters);
            $valuesKeys = $bindingKeys;

            // Prepare the SQL statement
            $query = "SELECT * FROM " . $this->tableName;

            foreach ($operators as $index=>$operator)
            {
                $query .= ($index != 0)? " AND " : " WHERE ";
                $query .= ($columns[$index] . " " . $operator . " " . $valuesKeys[$index]);
            }
            $stmt = self::Sanitize($parameters, $query);
            // Execute the query
            $result = $stmt->execute();

            // Check if the query execution was successful
            if (!$result) {
                throw new Exception('Error executing query: ' . self::$DB->lastErrorMsg());
            }
            $output = [];
            while ($row = $result->fetchArray())
            {
                $output[] = $row;
            }
            return $output;
        }

        protected function BreakupParameters($parameters)
        {

            return [$columns, $valuesKeys];
        }

        protected function Sanitize($parameters, $query)
        {//returns the prepared statement for the given query
            $bindingKeys = self::GetBindingKeys(array_keys($parameters));
            $stmt = self::$DB->prepare($query);
            
            foreach(array_values($parameters) as $index=>$parameter)
            {
                $stmt->bindValue($bindingKeys[$index], $parameter);
            }
            return $stmt;
        }

        protected function GetBindingKeys($keys)
        {//adds a ":" before each key for proper input sanitization
            $result = [];
            foreach($keys as $key)
            {
                $result[] = ":" . $key;
            }
            return $result;
        }
    }
?>