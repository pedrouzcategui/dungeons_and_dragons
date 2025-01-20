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

    // Idealmente cambiar dichas credenciales dependiendo de la conexion establecida.
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

    // Crea y retorna una conexion hacia la base de datos.
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
            // Si hay un error en la preparación de la query, devuelve un error.
            return [
                'error_code' => $conn->errno,
                'error_message' => $conn->error,
                'sql' => $sql,
                'params' => $params
            ];
        }

        if (!empty($params)) {
            // Agrega parametros a la query
            $types = str_repeat('s', count($params)); // Por el momento, solo soporta parametros de tipo string.
            $stmt->bind_param($types, ...$params);
        }

        // Ejecuta la query.
        $stmt->execute();

        if ($stmt->errno) {
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
            // Solo las queries de tipo "SELECT" retornan filas, en tal caso, si existen, se convierten en arreglos.
            $data = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $data;
        } else {
            // Para queries de tipo "INSERT", obtenemos el último ID insertado
            if (stripos($sql, "INSERT") === 0) {
                $lastInsertId = $conn->insert_id;
                $stmt->close();
                return $lastInsertId; // Return the last inserted ID
            }
            // For other queries (UPDATE, DELETE), just check if any rows were affected
            $success = $conn->affected_rows > 0;
            $stmt->close();
            return $success;
        }
    }


    // Funcion que cierra la conexion.
    public function closeConnection()
    {
        if (self::$connection) {
            self::$connection->close();
            self::$connection = null;
        }
    }
}
