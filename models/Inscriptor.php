<?php
class Inscriptor {
    private $pdo;

    public $fecha;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function guardar($data){
        $nombre = ucwords(strtolower(trim($data["nombre"] ?? '')));
        $apellido = ucwords(strtolower(trim($data["apellido"] ?? '')));
        $email = trim($data["email"] ?? '');
        $celular = trim($data["celular"] ?? '');
        $edad = isset($data["edad"]) ? intval($data["edad"]) : null;
        $sexo = trim($data["sexo"] ?? '');
        $pais = isset($data["pais"]) ? intval($data["pais"]) : null;
        $nacionalidad = trim($data["nacionalidad"] ?? '');
        $observaciones = trim($data["obs"] ?? '');
        $fecha = trim($data["fecha"] ?? '');

        $sql = "INSERT INTO inscriptores (nombre, apellido, email, celular, edad, sexo, pais_id, nacionalidad, fecha, observaciones)
                VALUES (:nombre, :apellido, :email, :celular, :edad, :sexo, :pais, :nacionalidad, :fecha, :obs)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':nombre' => $nombre,
            ':apellido' => $apellido,
            ':email' => $email,
            ':celular' => $celular,
            ':edad' => $edad,
            ':sexo' => $sexo,
            ':pais' => $pais,
            ':nacionalidad' => $nacionalidad,
            ':fecha' => $fecha,
            ':obs' => $observaciones
        ]);

        return $this->pdo->lastInsertId();
    }

    public function guardarAreas($idInscriptor, $areas){
        if (empty($areas) || !is_array($areas)) return;
        $sql = "INSERT INTO inscriptor_area (inscriptor_id, area_id) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        foreach ($areas as $area) {
            $stmt->execute([$idInscriptor, intval($area)]);
        }
    }

    public function obtenerTodoConAreas() {
        $sql = "SELECT i.id, i.nombre, i.apellido, i.email, i.celular, i.edad, i.sexo, p.nombre AS pais, 
                       i.nacionalidad, i.fecha, i.observaciones,
                       IFNULL(GROUP_CONCAT(a.nombre SEPARATOR ', '), '') AS areas
                FROM inscriptores i
                JOIN paises p ON p.id = i.pais_id
                LEFT JOIN inscriptor_area ia ON ia.inscriptor_id = i.id
                LEFT JOIN areas_interes a ON a.id = ia.area_id
                GROUP BY i.id
                ORDER BY i.fecha DESC, i.id DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
