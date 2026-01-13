<?php
// app/models/User.php

class User extends Model
{

    protected $table = 'users';

    public function create($data)
    {


        $sql = "INSERT INTO " . $this->table . " (first_name, last_name, email, password_hash, role, verification_code)
                VALUES (:first_name, :last_name, :email, :password_hash, :role, :verification_code)";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function findByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM " . $this->table . " WHERE email = :email AND deleted_at IS NULL");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    public function getAllUsers()
    {
        return $this->db
            ->query("SELECT * FROM " . $this->table . " WHERE deleted_at IS NULL")
            ->fetchAll();
    }

    public function verifyEmail($email)
    {
        $sql = "UPDATE " . $this->table . "
                SET status = 'active',
                    verification_code = NULL
                WHERE email = :email";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['email' => $email]);
    }

    public function validateResetCode($email, $code)
    {
        $stmt = $this->db->prepare("
        SELECT id FROM users
        WHERE email = ?
        AND reset_code = ?
        AND reset_expires_at > NOW()
    ");
        $stmt->execute([$email, $code]);
        return $stmt->fetch();
    }

    public function updatePassword($email, $password)
    {
        $stmt = $this->db->prepare("
        UPDATE users
        SET password = ?, reset_token = NULL, reset_expires = NULL
        WHERE email = ?
    ");
        return $stmt->execute([$password, $email]);
    }
}
