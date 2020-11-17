<?php

// Dependency injection container
class Container {

    private $config;

    private $pdo;
    private $user;
    private $validator;
    private $page;
    private $role;
    private $privilege;

    // Constructor
    public function __construct(array $config) {
        $this->config = $config;
    }

    // Database handler
    public function getPDOObj() {
        if($this->pdo === null) {
            $this->pdo = new Dbh($this->config);
        }
        return $this->pdo;
    }

    // User handler
    public function getUserObj() {
        if($this->user === null) {
            $this->user = new User($this->getPDOObj(), $this->getValidatorObj());
        }
        return $this->user;
    }

    // Validator handler
    public function getValidatorObj() {
        if($this->validator === null) {
            $this->validator = new Validator($this->getPDOObj());
        }
        return $this->validator;
    }

    // Page handler
    public function getPageObj() {
        if($this->page === null) {
            $this->page = new Page($this->getPDOObj(), $this->getValidatorObj());
        }
        return $this->page;
    }

    // Role handler
    public function getRoleObj() {
        if($this->role === null) {
            $this->role = new Role($this->getPDOObj(), $this->getValidatorObj());
        }
        return $this->role;
    }

    // Privilege handler
    public function getPrivilegeObj() {
        if($this->privilege === null) {
            $this->privilege = new Privilege($this->getPDOObj(), $this->getValidatorObj());
        }
        return $this->privilege;
    }
}