<?php

class User extends Model
{
    public function getAllUsers()
    {
        $stmt = $this->db->query("SELECT * FROM user");
        return $stmt->fetchAll();
    }
}
