<?php

// User handler
class User {

    private $db = null;
    private $validator;

    // Constructor
    public function __construct(Dbh $db, Validator $validator) {
        $this->db = $db;
        $this->validator = $validator;
    }

    // Login
    public function loginUser($name, $pass) {

        $errors = array();

        $query = 'SELECT * FROM users WHERE username = :username';
        $data = array('username' => $name);
        $user = $this->db->select($query, $data);

        if(empty($user)) {
            $errors['username'] = 'Username does not exist.';
        }

        elseif(!password_verify($pass, $user[0]['password'])) {
            $errors['password'] = 'Password incorrect.';
        }

        if($this->validator->isEmpty($name)) {
            $errors['username'] = 'Username required.';
        }

        if($this->validator->isEmpty($pass)) {
            $errors['password'] = 'Password required.';
        }

        if(empty($errors)) {
            session_regenerate_id();
			$_SESSION['loggedin'] = true;
            $_SESSION['name'] = $user[0]['username'];
			$_SESSION['id'] = $user[0]['user_id'];
            $_SESSION['role'] = $user[0]['role'];
            $this->db->update('users', ['login' => date('Y-m-d H:i:s')], 'user_id=:id', ['id' => $user[0]['user_id']]);
        }

        return $errors;
    }

    public function isLoggedIn() {
        if(isset($_SESSION['loggedin'])) {
            return true; }
            
        return false;
    }

    // Register
    public function registerUser($name, $email, $pass1, $pass2) {

        $errors = array();

        if($this->validator->nameExists($name)) {
            $errors['register-username'] = 'Username already exists.';
        }

        if($this->validator->isLonger($name, 3)) {
            $errors['register-username'] = 'Username is too short.';
        }

        if($this->validator->isEmpty($name)) {
            $errors['register-username'] = 'Username required.';
        }

        if($this->validator->emailExists($email)) {
            $errors['register-email'] = 'Email already exists.';
        }

        if($this->validator->isEmail($email)) {
            $errors['register-email'] = 'Email is not valid.';
        }
        
        if($this->validator->isEmpty($email)) {
            $errors['register-email'] = 'Email required.';
        }
        
        if($pass1 != $pass2) {
            $errors['register-password1'] = 'Passwords does not match.';
            $errors['register-password2'] = 'Passwords does not match.';
        }

        if($this->validator->isLonger($pass1, 5)) {
            $errors['register-password1'] = 'Password is too short.';
        }

        if($this->validator->isEmpty($pass1)) {
            $errors['register-password1'] = 'Password required.';
        }

        if($this->validator->isEmpty($pass2)) {
            $errors['register-password2'] = 'Repeat the password.';
        }

        if(empty($errors)) {
            $pass1 = password_hash($pass1, PASSWORD_DEFAULT);
            $query = 'users';
            $data = array('username' => $name, 'email' => $email, 'password' => $pass1, 'joined' => date('Y-m-d H:i:s'));
            $this->db->insert($query, $data);
        }
        
        return $errors;
    }

    // Get Users
    public function getUser($id = '%') {
        $query = 'SELECT user_id, username, email, role, joined, login FROM users WHERE user_id LIKE :user_id';
        $data = array('user_id' => $id);
        $user = $this->db->select($query, $data);

        return $user;
    }

    // Get User Role
    public function getUserRole($id = '') {
        if(!$id) $id = $_SESSION['id'];
        $query = 'SELECT role FROM users WHERE user_id = :id LIMIT 1';
        $data = array('id' => $id);
        $role = $this->db->select($query, $data);

        return $role[0]['role'];
    }

    // Delete User
    public function deleteUser($id) {
        $data = array('id' => $id);
        $page = $this->db->delete('users', 'user_id=:id', $data);

        return $page;
    }

    // Check privilege
    public function hasPrivilege($id) {
        $query = 'SELECT assignment_id FROM assignments WHERE role_id = :role AND privilege_id = :privilege';
        $data = array('role' => $this->getUserRole(), 'privilege' => $id);
        $privilege = $this->db->select($query, $data);

        if(!empty($privilege)) {
            return true;
        }

        return false;
    }

}