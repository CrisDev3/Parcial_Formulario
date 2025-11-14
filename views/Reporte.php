<?php
function e($s){ return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Reporte de Inscripciones - iTECH</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="public/css/estilos.css">
</head>
<body>
  <main class="container">
    <h1>Reporte de Inscripciones</h1>

    <p><a class="btn" href="index.php">Nuevo registro</a></p>

    <?php if (empty($datos)): ?>
      <div class="alert">No hay registros aún.</div>

    <?php else: ?>

      <div class="table-responsive">
        <table class="tabla">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Email</th>
              <th>Celular</th>
              <th>Edad</th>
              <th>Sexo</th>
              <th>País</th>
              <th>Nacionalidad</th>
              <th>Fecha</th>
              <th>Áreas</th>
              <th>Observaciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($datos as $d): ?>
              <tr>
                <td><?= e($d['id']) ?></td>
                <td><?= e($d['nombre']) ?></td>
                <td><?= e($d['apellido']) ?></td>
                <td><?= e($d['email']) ?></td>
                <td><?= e($d['celular']) ?></td>
                <td><?= e($d['edad']) ?></td>
                <td><?= e($d['sexo']) ?></td>
                <td><?= e($d['pais']) ?></td>
                <td><?= e($d['nacionalidad']) ?></td>
                <td><?= e($d['fecha']) ?></td>
                <td><?= e($d['areas']) ?></td>
                <td><?= e($d['observaciones']) ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

    <?php endif; ?>

    <footer class="site-footer">
      <p>© 2025 iTECH — Contacto: contacto@itech.example</p>
    </footer>

  </main>
</body>
</html>
