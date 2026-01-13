<?php
// app/models/Registration.php

class Registration extends Model {
    
    protected $table = 'registrations';
    
    public function getAllRegistrations() {
        $stmt = $this->db->prepare("SELECT * FROM " . $this->table . " WHERE deleted_at IS NULL");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}