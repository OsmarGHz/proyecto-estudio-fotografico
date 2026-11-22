<?php
require_once 'includes/auth.php';
$asuntos = ['Cotización', 'Dudas sobre una reserva', 'Otro'];
$ok = false; $errores = []; $v = ['nombre' => '', 'correo' => '', 'telefono' => '', 'asunto' => '', 'mensaje' => ''];
if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(16));
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($v as $k => $_) $v[$k] = trim($_POST[$k] ?? '');
    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'] ?? '')) $errores[] = 'Sesión inválida, recarga la página.';
    if (mb_strlen($v['nombre']) < 3) $errores[] = 'El nombre debe tener al menos 3 caracteres.';
    if (!filter_var($v['correo'], FILTER_VALIDATE_EMAIL)) $errores[] = 'Escribe un correo válido.';
    if ($v['telefono'] !== '' && !preg_match('/^[0-9 +()-]{7,20}$/', $v['telefono'])) $errores[] = 'El teléfono no es válido.';
    if (!in_array($v['asunto'], $asuntos, true)) $errores[] = 'Elige un asunto.';
    if (mb_strlen($v['mensaje']) < 10) $errores[] = 'El mensaje debe tener al menos 10 caracteres.';
    if (!$errores) {
        try {
            db()->prepare("INSERT INTO mensajes_contacto (nombre, correo, telefono, asunto, mensaje) VALUES (?, ?, ?, ?, ?)")
                ->execute([$v['nombre'], $v['correo'], $v['telefono'] ?: null, $v['asunto'], $v['mensaje']]);
            $ok = true; $v = array_map(fn($x) => '', $v);
        } catch (PDOException $ex) { $errores[] = 'No se pudo enviar tu mensaje. Intenta más tarde.'; }
    }
}
$titulo = 'Contáctanos';
require 'includes/header.php';
?>
<h1>Contáctanos</h1>
<?php if ($ok): ?><p class="alerta ok">¡Gracias! Recibimos tu mensaje y te responderemos pronto.</p><?php endif; ?>
<div id="errores" class="alerta error" <?= $errores ? '' : 'hidden' ?>><?php foreach ($errores as $m): ?><p><?= e($m) ?></p><?php endforeach; ?></div>
<div class="dos-col">
<section>
<form class="formulario tarjeta" action="contacto.php" method="post" data-validar novalidate>
<input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>">
<label>Nombre completo<input type="text" name="nombre" value="<?= e($v['nombre']) ?>" required></label>
<label>Correo electrónico<input type="email" name="correo" value="<?= e($v['correo']) ?>" required></label>
<label>Teléfono<input type="tel" name="telefono" value="<?= e($v['telefono']) ?>"></label>
<label>Asunto<select name="asunto"><?php foreach ($asuntos as $a): ?><option<?= $v['asunto'] === $a ? ' selected' : '' ?>><?= e($a) ?></option><?php endforeach; ?></select></label>
<label>Mensaje<textarea name="mensaje" rows="5" required><?= e($v['mensaje']) ?></textarea></label>
<p><button class="btn" type="submit">Enviar</button> <button class="btn btn-sec" type="reset">Limpiar</button></p>
</form>
</section>
<aside class="tarjeta"><h3>Datos del estudio</h3><p>📍 Calle Principal 123, Puebla</p><p>📞 222 000 0000</p><p>✉️ contacto@estudio.com</p><p>🕙 Lunes a sábado, 10:00 a 19:00</p></aside>
</div>
<?php require 'includes/footer.php'; ?>
