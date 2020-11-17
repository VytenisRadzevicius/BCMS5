<?php

// Data validator
class Validator {

    private $db = null;

    // Constructor
    public function __construct(Dbh $db) {
        $this->db = $db;
    }

    // Empty?
    public function isEmpty($input) {
        if (is_array($input)) {
            return empty($input);
        }

        if ($input == '') {
            return true;
        }

        return false;
    }

    // Longer?
    public function isLonger($string, $num) {
        if (strlen($string) < $num) {
            return true;
        }

        return false;
    }

    // Email valid?
    public function isEmail($email) {
        return !preg_match("/^[_a-z0-9-]+(\.[_a-z0-9+-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $email);
    }

    // Username exists?
    public function nameExists($username) {
        return $this->exists('users', 'username', $username);
    }

    // Page exists?
    public function pageExists($page) {
        return $this->exists('pages', 'title', $page);
    }

    // Role exists?
    public function roleExists($role) {
        return $this->exists('roles', 'name', $role);
    }

    // Privilege exists?
    public function privilegeExists($privilege) {
        return $this->exists('roles', 'name', $privilege);
    }

    // Email exists?
    public function emailExists($email) {
        return $this->exists('users', 'email', $email);
    }

    // Exists?
    private function exists($table, $column, $value) {
        $result = $this->db->select(
            "SELECT * FROM `$table` WHERE `$column` = :val",
            array('val' => $value )
        );

        return count($result) > 0;
    }
}