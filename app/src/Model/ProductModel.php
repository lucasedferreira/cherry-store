<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";
class UserModel extends Database
{
    public function getProducts($limit)
    {
        return $this->select("SELECT * FROM products ORDER BY user_id ASC LIMIT ?", ["i", $limit]);
    }
}