<?php
// models/AreaInteres.php
class AreaInteres {
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function obtenerTodos() {
        $stmt = $this->pdo->query("SELECT id, nombre FROM areas_interes ORDER BY nombre ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function nombresPorInscriptor($inscriptorId) {
        $sql = "SELECT a.nombre
                FROM areas_interes a
                JOIN inscriptor_area ia ON ia.area_id = a.id
                WHERE ia.inscriptor_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$inscriptorId]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}
