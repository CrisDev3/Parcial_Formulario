<?php
require "controllers/FormController.php";

$controller = new FormController();

if (!isset($_GET["action"])) {
    $controller->index();
} else {
    if ($_GET["action"] == "guardar") {
        $controller->guardar();
    } elseif ($_GET["action"] == "reporte") {
        $controller->reporte();
    }
}
