<?php
// app/models/Payment.php

class Payment extends Model {

    protected $table = 'payments';

    public function getAllPayments() {

        $stmt = $this->db->prepare("SELECT * FROM " . $this->table . " WHERE deleted_at IS NULL");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}