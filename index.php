<?php
require "controllers/FormController.php";

$controller = new FormController();

$action = $_GET['action'] ?? null;

if ($action === 'guardar') {
    $controller->guardar();
} elseif ($action === 'reporte') {
    $controller->reporte();
} else {
    $controller->index();
}
