<?php
function e($s){ return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Gracias - iTECH</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="public/css/estilos.css">
</head>
<body>
  <main class="container">
    <h1>¡Gracias por inscribirte!</h1>
    <p>Hemos recibido tus datos correctamente.</p>
    <p><a class="btn" href="index.php">Volver al formulario</a>
       <a class="btn" href="index.php?action=reporte">Ver reporte</a></p>

    <footer class="site-footer">
      <p>© 2025 iTECH. All rights reserved. — Contacto: contacto@itech.example</p>
    </footer>
  </main>
</body>
</html>
