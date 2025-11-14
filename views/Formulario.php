<?php
// views/formulario.php
// Variables esperadas: $paises, $areas (si vienen del controller)
function e($s)
{
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Formulario de Inscripción - iTECH</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="public/css/estilos.css">
</head>

<body>
    <main class="container">
        <h1>Formulario de Inscripción - iTECH</h1>

        <?php if (!empty($errors)): ?>
            <div class="alert error">
                <ul>
                    <?php foreach ($errors as $err): ?>
                        <li><?= e($err) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="index.php?action=guardar" method="post" novalidate>
            <div class="grid">
                <label>Nombre*:
                    <input type="text" name="nombre" required value="<?= e($_POST['nombre'] ?? '') ?>">
                </label>

                <label>Apellido*:
                    <input type="text" name="apellido" required value="<?= e($_POST['apellido'] ?? '') ?>">
                </label>

                <label>Correo*:
                    <input type="email" name="email" required value="<?= e($_POST['email'] ?? '') ?>">
                </label>

                <label>Celular:
                    <input type="tel" name="celular" placeholder="+507 6xxxxxxx" value="<?= e($_POST['celular'] ?? '') ?>">
                </label>

                <label>Edad*:
                    <input type="number" name="edad" min="0" max="150" required value="<?= e($_POST['edad'] ?? '') ?>">
                </label>

                <label>Sexo*:
                    <select name="sexo" required>
                        <option value="">--Seleccione--</option>
                        <option value="Masculino" <?= (($_POST['sexo'] ?? '') === 'Masculino') ? 'selected' : '' ?>>Masculino</option>
                        <option value="Femenino" <?= (($_POST['sexo'] ?? '') === 'Femenino') ? 'selected' : '' ?>>Femenino</option>
                        <option value="Otro" <?= (($_POST['sexo'] ?? '') === 'Otro') ? 'selected' : '' ?>>Otro</option>
                    </select>
                </label>

                <label>País de Residencia*:
                    <select name="pais" required>
                        <option value="">--Seleccione País--</option>
                        <?php foreach ($paises as $p): ?>
                            <option value="<?= e($p['id']) ?>" <?= (isset($_POST['pais']) && $_POST['pais'] == $p['id']) ? 'selected' : '' ?>>
                                <?= e($p['nombre']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </label>

                <label>Nacionalidad:
                    <input type="text" name="nacionalidad" value="<?= e($_POST['nacionalidad'] ?? '') ?>">
                </label>

                <label>
                    <span>Fecha de inscripción:</span>
                    <input type="date" name="fecha" required>
                </label>

            </div>

            <fieldset>
                <legend>Tema tecnológico que le gustaría aprender (marque los que apliquen):</legend>
                <div class="checkboxes">
                    <?php foreach ($areas as $a): ?>
                        <label class="chk">
                            <input type="checkbox" name="areas[]" value="<?= e($a['id']) ?>"
                                <?= (isset($_POST['areas']) && in_array($a['id'], $_POST['areas'])) ? 'checked' : '' ?>>
                            <?= e($a['nombre']) ?>
                        </label>
                    <?php endforeach; ?>
                </div>
            </fieldset>

            <label>Observaciones o Consulta sobre el evento:
                <textarea name="obs" rows="4"><?= e($_POST['obs'] ?? '') ?></textarea>
            </label>

            <div class="actions">
                <button class="btn primary" type="submit">Enviar</button>
                <a class="btn" href="index.php?action=reporte">Ver reporte</a>
            </div>
        </form>

        <footer class="site-footer">
            <p>© 2025 iTECH. All rights reserved. — Contacto: contacto@itech.example</p>
        </footer>
    </main>
</body>

</html>