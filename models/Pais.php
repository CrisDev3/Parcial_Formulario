<?php
class Pais {
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function obtenerTodos() {
        $stmt = $this->pdo->query("SELECT id, nombre FROM paises ORDER BY nombre ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function existe($id) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM paises WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetchColumn() > 0;
    }
}
