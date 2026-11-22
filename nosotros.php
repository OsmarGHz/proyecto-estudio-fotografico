<?php
$titulo = 'Quiénes somos';
require 'includes/header.php';
$equipo = [['Ana López', 'Fotógrafa principal'], ['Carlos Ruiz', 'Edición y retoque'], ['Marta Díaz', 'Atención a clientes']];
?>
<h1>Quiénes somos</h1>
<section class="tarjeta"><h2>Nuestra historia</h2><p>Somos un estudio fotográfico con más de 10 años de experiencia, dedicado a transformar momentos en recuerdos duraderos.</p></section>
<section class="grid">
<article class="tarjeta"><h3>Misión</h3><p>Ofrecer fotografía profesional con trato cercano.</p></article>
<article class="tarjeta"><h3>Visión</h3><p>Ser el estudio de referencia de la región.</p></article>
</section>
<section>
<h2>Nuestro equipo</h2>
<div class="grid">
<?php foreach ($equipo as [$n, $r]): ?>
<article class="tarjeta equipo"><div class="avatar"><?= e(mb_substr($n, 0, 1)) ?></div><h3><?= e($n) ?></h3><p><?= e($r) ?></p></article>
<?php endforeach; ?>
</div>
</section>
<?php require 'includes/footer.php'; ?>
