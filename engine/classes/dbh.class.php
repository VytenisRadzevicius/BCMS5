<?php

// Database handler
class Dbh {
    private $dsn;
    private $user = null;
    private $pass = null;
    private $options = [
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT,
    ];

    // Constructor
    public function __construct($config) {
        $this->dsn = $config['db_type'] . ':host=' . $config['db_host'] . ';dbname=' . $config['db_name'] . ';charset=' . $config['db_char'];
        $this->user = $config['db_user'];
        $this->pass = $config['db_pass'];
        $this->options = array_replace($this->options, $config['options']);

        $this->connect();
    }

    // Connection method
    private function connect() {
        try {
            $pdo = new PDO($this->dsn, $this->user, $this->pass, $this->options);
        } catch (PDOException $e) {
            echo $this->dsn;
            echo $this->user;
            echo $this->pass;
            die('Connection failed: ' . $e->getMessage());
        }

        return $pdo;
    }

    // Select from the database
    public function select($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC) {
        $stmt = $this->connect()->prepare($sql);

        foreach ($array as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        $stmt->execute();

        return $stmt->fetchAll($fetchMode);
    }

    // Insert to the database
    public function insert($table, array $data) {
        ksort($data);

        $fieldNames = implode('`, `', array_keys($data));
        $fieldValues = ':' . implode(', :', array_keys($data));

        $stmt = $this->connect()->prepare("INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)");

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        $stmt->execute();
    }

    // Update database
    public function update($table, $data, $where, $whereBindArray = array()) {
        ksort($data);

        $fieldDetails = null;

        foreach ($data as $key => $value) {
            $fieldDetails .= "`$key`=:$key,";
        }

        $fieldDetails = rtrim($fieldDetails, ',');

        $stmt = $this->connect()->prepare("UPDATE $table SET $fieldDetails WHERE $where");

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        foreach ($whereBindArray as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        $stmt->execute();
    }

    // Delete
    public function delete($table, $where, $bind = array(), $limit = null) {
        $query = "DELETE FROM $table WHERE $where";

        if ($limit) {
            $query .= " LIMIT $limit";
        }

        $stmt = $this->connect()->prepare($query);

        foreach ($bind as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        $stmt->execute();
    }
}