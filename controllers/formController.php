<?php
require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../models/Inscriptor.php';
require_once __DIR__ . '/../models/Pais.php';
require_once __DIR__ . '/../models/AreaInteres.php';

class FormController {
    public function index() {
        $db = new Database();
        $pdo = $db->pdo;
        $paisModel = new Pais($pdo);
        $areaModel = new AreaInteres($pdo);

        $paises = $paisModel->obtenerTodos();
        $areas = $areaModel->obtenerTodos();

        require __DIR__ . '/../views/formulario.php';
    }

    public function guardar() {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: index.php"); exit;
        }

        $errs = [];
        $nombre = trim($_POST["nombre"] ?? '');
        $apellido = trim($_POST["apellido"] ?? '');
        $email = trim($_POST["email"] ?? '');
        $celular = trim($_POST["celular"] ?? '');
        $edad = $_POST["edad"] ?? '';
        $sexo = $_POST["sexo"] ?? '';
        $pais = $_POST["pais"] ?? '';
        $nacionalidad = trim($_POST["nacionalidad"] ?? '');
        $areas = $_POST["areas"] ?? [];
        $obs = trim($_POST["obs"] ?? '');
        $fecha = trim($_POST["fecha"] ?? '');

        if ($nombre === '') $errs[] = "El nombre es obligatorio.";
        if ($apellido === '') $errs[] = "El apellido es obligatorio.";
        if ($email === '') $errs[] = "El correo es obligatorio.";
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errs[] = "Formato de correo inválido.";

        if ($celular !== '') {
            if (!preg_match('/^[\d\+\-\s]{7,20}$/', $celular)) {
                $errs[] = "Teléfono/celular inválido.";
            }
        }

        if ($edad === '' || !is_numeric($edad) || intval($edad) < 0 || intval($edad) > 150) $errs[] = "Edad inválida.";
        $sexo_allowed = ['Masculino','Femenino','Otro'];
        if (!in_array($sexo, $sexo_allowed)) $errs[] = "Seleccione un sexo válido.";
        if (!is_numeric($pais)) $errs[] = "Seleccione un país válido.";
        if ($fecha === '') $errs[] = "La fecha es obligatoria.";

        if (count($errs) > 0) {
            $db = new Database();
            $pdo = $db->pdo;
            $paisModel = new Pais($pdo);
            $areaModel = new AreaInteres($pdo);
            $paises = $paisModel->obtenerTodos();
            $areasList = $areaModel->obtenerTodos();
            $errors = $errs;
            require __DIR__ . '/../views/formulario.php';
            return;
        }

        $db = new Database();
        $pdo = $db->pdo;
        $inscriptor = new Inscriptor($pdo);

        $data = [
            'nombre' => $nombre,
            'apellido' => $apellido,
            'email' => $email,
            'celular' => $celular,
            'edad' => intval($edad),
            'sexo' => $sexo,
            'pais' => intval($pais),
            'nacionalidad' => $nacionalidad,
            'obs' => $obs,
            'fecha' => $fecha
        ];

        $id = $inscriptor->guardar($data);
        if (!empty($areas) && is_array($areas)) {
            $inscriptor->guardarAreas($id, $areas);
        }

        require __DIR__ . '/../views/gracias.php';
    }

    public function reporte() {
        $db = new Database();
        $pdo = $db->pdo;
        $inscriptor = new Inscriptor($pdo);
        $datos = $inscriptor->obtenerTodoConAreas();

        require __DIR__ . '/../views/reporte.php';
    }
}
