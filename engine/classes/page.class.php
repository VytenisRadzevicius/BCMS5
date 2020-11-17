<?php

// Page handler
class Page {

    private $db = null;
    private $validator;

    // Constructor
    public function __construct(Dbh $db, Validator $validator) {
        $this->db = $db;
        $this->validator = $validator;
    }

    // Post Page
    public function postPage($title, $access, $content) {

        $errors = array();

        if($this->validator->isEmpty($title)) {
            $errors['title'] = 'Title required.';
        }

        if($this->validator->pageExists($title)) {
            $errors['title'] = 'Title already exists.';
        }

        if(empty($errors)) {
            $query = 'pages';
            $data = array('title' => $title, 'content' => $content, 'access' => $access, 'author' => $_SESSION['id'], 'timestamp' => date('Y-m-d H:i:s'));
            $this->db->insert($query, $data);
        }
        
        return $errors;
    }

    // Get Pages
    public function getPage($id = '%', $access = '3') {
        $query = 'SELECT * FROM pages WHERE page_id LIKE :id AND access < :access';
        $data = array('id' => $id, 'access' => $access);
        $page = $this->db->select($query, $data);

        return $page;
    }

    // Delete Pages
    public function deletePage($id) {
        $data = array('id' => $id);
        $page = $this->db->delete('pages', 'page_id=:id', $data);

        return $page;
    }

}