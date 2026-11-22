<?php
$titulo = 'Servicios y paquetes';
require 'includes/header.php';
try {
    $servicios = db()->query("SELECT nombre, descripcion, precio FROM servicios WHERE activo = 1 ORDER BY precio")->fetchAll();
} catch (PDOException $ex) { $servicios = []; $error = 'No se pudo cargar el catálogo.'; }
?>
<h1>Servicios y paquetes</h1>
<section>
<h2>Nuestros servicios</h2>
<?php if (!empty($error)): ?><p class="alerta error"><?= e($error) ?></p><?php endif; ?>
<div class="grid">
<?php foreach ($servicios as $s): ?>
<article class="tarjeta"><h3><?= e($s['nombre']) ?></h3><p><?= e($s['descripcion']) ?></p><p class="precio">$<?= number_format($s['precio']) ?> MXN</p></article>
<?php endforeach; ?>
</div>
</section>
<section>
<h2>Paquetes</h2>
<div class="tabla-wrap">
<table>
<thead><tr><th>Paquete</th><th>Fotos editadas</th><th>Duración</th><th>Precio</th></tr></thead>
<tbody>
<tr><td>Básico</td><td>10</td><td>30 min</td><td>$500</td></tr>
<tr><td>Estándar</td><td>25</td><td>1 hora</td><td>$1,200</td></tr>
<tr><td>Premium</td><td>50</td><td>2 horas</td><td>$2,500</td></tr>
</tbody>
</table>
</div>
<p style="margin-top:1rem"><a class="btn" href="reservar.php">Reservar</a></p>
</section>
<?php require 'includes/footer.php'; ?>
