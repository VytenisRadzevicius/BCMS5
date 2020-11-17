<?php

// Privilege handler
class Privilege {

    private $db = null;
    private $validator;

    // Constructor
    public function __construct(Dbh $db, Validator $validator) {
        $this->db = $db;
        $this->validator = $validator;
    }

    // Add Privilege
    public function addPrivilege($name, $description) {
        $errors = array();

        if($this->validator->isEmpty($name)) {
            $errors['privilege-name'] = 'Privilege name required.';
        }

        if($this->validator->privilegeExists($name)) {
            $errors['privilege-name'] = 'Privilege already exists.';
        }

        if(empty($errors)) {
            $query = 'privileges';
            $data = array('name' => $name, 'description' => $description);
            $this->db->insert($query, $data);

            $query = 'SELECT privilege_id FROM privileges WHERE name = :name LIMIT 1';
            $data = array('name' => $name);
            $privilege = $this->db->select($query, $data);
            $this->db->insert('assignments', array('role_id' => '1', 'privilege_id' => $privilege[0]['privilege_id']));
        }
        
        return $errors;
    }

    // Get Privilege
    public function getPrivilege($id = '%') {
        $query = 'SELECT * FROM privileges WHERE privilege_id LIKE :id ORDER BY name';
        $data = array('id' => $id);
        $privilege = $this->db->select($query, $data);

        return $privilege;
    }

    // Delete Privilege
    public function deletePrivilege($id) {
        $data = array('id' => $id);
        $privilege = $this->db->delete('privileges', 'privilege_id=:id', $data);

        return $privilege;
    }

    // Get Roles
    public function getRoles($id = '%') {
        $query = 'SELECT GROUP_CONCAT(roles.name SEPARATOR ", ") AS roles FROM privileges LEFT JOIN assignments ON assignments.privilege_id = privileges.privilege_id LEFT JOIN roles ON roles.role_id = assignments.role_id WHERE assignments.privilege_id LIKE :id';
        $data = array('id' => $id);
        $role = $this->db->select($query, $data);

        return $role;
    }

}