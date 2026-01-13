<?php
// app/models/Attendance.php

class Attendance extends Model {
    protected $table = 'attendances';

    public function getAllAttendances() {
        $stmt = $this->db->prepare("SELECT * FROM " . $this->table);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}