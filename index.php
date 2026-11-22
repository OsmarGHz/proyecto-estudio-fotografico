<?php
$titulo = 'Inicio';
require 'includes/header.php';
try {
    $destacados = db()->query("SELECT nombre, descripcion, precio FROM servicios WHERE destacado = 1 AND activo = 1 ORDER BY id LIMIT 3")->fetchAll();
} catch (PDOException $ex) { $destacados = []; $error = 'No se pudieron cargar los servicios.'; }
?>
<section class="hero">
<h1>Capturamos tus mejores momentos</h1>
<p>Reserva tu sesión fotográfica en línea.</p>
<a class="btn" href="reservar.php">Reservar ahora</a>
</section>
<section>
<h2>Servicios destacados</h2>
<?php if (!empty($error)): ?><p class="alerta error"><?= e($error) ?></p><?php endif; ?>
<div class="grid">
<?php foreach ($destacados as $s): ?>
<article class="tarjeta"><h3><?= e($s['nombre']) ?></h3><p><?= e($s['descripcion']) ?></p><p class="precio">$<?= number_format($s['precio']) ?> MXN</p></article>
<?php endforeach; ?>
</div>
<p><a href="servicios.php">Ver todos los servicios y paquetes →</a></p>
</section>
<section>
<h2>¿Por qué elegirnos?</h2>
<div class="grid">
<article class="tarjeta"><h3>📅 Reserva fácil</h3><p>Elige servicio, fecha y hora en minutos.</p></article>
<article class="tarjeta"><h3>🖼️ Fotos editadas</h3><p>Entrega en galería digital.</p></article>
<article class="tarjeta"><h3>⭐ Experiencia</h3><p>Más de 10 años capturando recuerdos.</p></article>
</div>
</section>
<aside class="alerta info"><strong>Horario:</strong> lunes a sábado, 10:00 a 19:00. Conoce <a href="nosotros.php">quiénes somos</a> o mira nuestros <a href="ejemplos.php">ejemplos de fotografías</a>.</aside>
<?php require 'includes/footer.php'; ?>
