<?php

namespace App;

class Database
{
    private $host;
    private $port;
    private $dbname;
    private $username;
    private $password;
    private static $connection;

    public function __construct()
    {
        $this->setHost('localhost');
        $this->setPort('3306');
        $this->setDBName('dungeons_and_dragons');
        $this->setUsername('root');
        $this->setPassword('');
    }

    // Getters
    public function getHost()
    {
        return $this->host;
    }
    public function getPort()
    {
        return $this->port;
    }
    public function getDBName()
    {
        return $this->dbname;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function getPassword()
    {
        return $this->password;
    }

    // Setters
    public function setHost($host)
    {
        $this->host = $host;
    }
    public function setPort($port)
    {
        $this->port = $port;
    }
    public function setDBName($dbname)
    {
        $this->dbname = $dbname;
    }
    public function setUsername($username)
    {
        $this->username = $username;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }

    // Create and return a connection
    private static function connect()
    {
        if (!self::$connection) {
            $db = new self();
            self::$connection = new \mysqli(
                $db->getHost(),
                $db->getUsername(),
                $db->getPassword(),
                $db->getDBName(),
                $db->getPort()
            );

            if (self::$connection->connect_error) {
                die("Database connection failed: " . self::$connection->connect_error);
            }
        }
        return self::$connection;
    }

    public static function query($sql, $params = [])
    {
        $conn = self::connect();
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            // Return preparation error details
            return [
                'error_code' => $conn->errno,
                'error_message' => $conn->error,
                'sql' => $sql,
                'params' => $params
            ];
        }

        if (!empty($params)) {
            // Dynamically bind parameters based on their types
            $types = str_repeat('s', count($params)); // Assuming all parameters are strings by default
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();

        if ($stmt->errno) {
            // Return execution error details
            $stmt->close();
            return [
                'error_code' => $stmt->errno,
                'error_message' => $stmt->error,
                'sql' => $sql,
                'params' => $params
            ];
        }

        $result = $stmt->get_result();

        if ($result) {
            // SELECT queries: Fetch all rows
            $data = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $data;
        } else {
            // Non-SELECT queries: Return true for successful execution
            $success = $conn->affected_rows > 0;
            $stmt->close();
            return $success;
        }
    }


    // Close the connection when the script ends
    public static function closeConnection()
    {
        if (self::$connection) {
            self::$connection->close();
            self::$connection = null;
        }
    }
}
