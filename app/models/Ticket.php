<?php
// app/models/Ticket.php

class Ticket extends Model {
    
    protected $table = 'tickets';

    public function getAllTickets() {
        $stmt = $this->db->prepare("SELECT * FROM " . $this->table . " WHERE deleted_at IS NULL");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}