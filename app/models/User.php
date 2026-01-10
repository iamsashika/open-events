<?php
// app/models/User.php

class User extends Model
{
    public function create($data)
    {
        $sql = "INSERT INTO users (name, email, password, role)
                VALUES (:name, :email, :password, :role)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function findByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email AND deleted_at IS NULL");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    public function getAllUsers()
    {
        return $this->db
            ->query("SELECT * FROM users WHERE deleted_at IS NULL")
            ->fetchAll();
    }
}
