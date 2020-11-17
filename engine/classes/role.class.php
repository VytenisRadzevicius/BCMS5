<?php

// Role handler
class Role {

    private $db = null;
    private $validator;

    // Constructor
    public function __construct(Dbh $db, Validator $validator) {
        $this->db = $db;
        $this->validator = $validator;
    }

    // Add Role
    public function addRole($name, $description) {
        $name = ucwords($name);
        $errors = array();

        if($this->validator->isEmpty($name)) {
            $errors['role-name'] = 'Role name required.';
        }

        if($this->validator->roleExists($name)) {
            $errors['role-name'] = 'Role already exists.';
        }

        if(empty($errors)) {
            $query = 'roles';
            $data = array('name' => $name, 'description' => $description);
            $this->db->insert($query, $data);
        }
        
        return $errors;
    }

    // Get Roles
    public function getRole($id = '%') {
        $query = 'SELECT * FROM roles WHERE role_id LIKE :id';
        $data = array('id' => $id);
        $role = $this->db->select($query, $data);

        return $role;
    }

    // Delete Roles
    public function deleteRole($id) {
        $data = array('id' => $id);
        $role = $this->db->delete('roles', 'role_id=:id', $data);
        $this->db->update('users', ['role' => '2'], 'role=:id', ['id' => $id]);

        return $role;
    }

    // Get privileges
    public function getPrivileges($id = '%') {
        $query = 'SELECT GROUP_CONCAT(privileges.name ORDER BY privileges.name SEPARATOR ", ") AS privileges FROM roles LEFT JOIN assignments ON assignments.role_id = roles.role_id LEFT JOIN privileges ON privileges.privilege_id = assignments.privilege_id WHERE assignments.role_id LIKE :id';
        $data = array('id' => $id);
        $role = $this->db->select($query, $data);

        return $role;
    }

    // Get privileges to add
    public function getPrivilegesToAdd($id = '%') {
        $query = 'SELECT privileges.privilege_id, privileges.name, privileges.description FROM privileges LEFT OUTER JOIN assignments ON assignments.privilege_id = privileges.privilege_id AND assignments.role_id = :id WHERE assignments.role_id IS NULL';
        $data = array('id' => $id);
        $role = $this->db->select($query, $data);

        return $role;
    }

    // Get privileges to remove
    public function getPrivilegesToRemove($id = '%') {
        $query = 'SELECT privileges.privilege_id, privileges.name, privileges.description FROM roles LEFT JOIN assignments ON assignments.role_id = roles.role_id LEFT JOIN privileges ON privileges.privilege_id = assignments.privilege_id WHERE assignments.role_id LIKE :id';
        $data = array('id' => $id);
        $role = $this->db->select($query, $data);

        return $role;
    }

    // Add privileges to a Role
    public function addAssignment($role, $privilege) {
        $query = 'assignments';
        $data = array('role_id' => $role, 'privilege_id' => $privilege);
        $this->db->insert($query, $data);
    }

    // Remove privileges from a Role
    public function removeAssignment($role, $privilege) {
        $query = 'assignments';
        $data = array('r_id' => $role, 'p_id' => $privilege);
        $this->db->delete($query, 'role_id=:r_id AND privilege_id=:p_id', $data);
    }

    // Change Role
    public function changeRole($user, $role) {
        $_SESSION['role'] = $role;
        $query = 'users';
        $this->db->update($query, ['role' => $role], 'user_id=:id', ['id' => $user]);
    }
}