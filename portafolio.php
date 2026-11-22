<?php
$titulo = 'Portafolio';
require 'includes/header.php';
$cats = [['retratos', 'Retratos', 1], ['familia', 'Familia', 4], ['bodas', 'Bodas y XV años', 7], ['producto', 'Producto', 10]];
?>
<h1>Portafolio</h1>
<p>Explora nuestro trabajo por categoría.</p>
<div class="grid">
<?php foreach ($cats as [$slug, $nombre, $img]): ?>
<article class="tarjeta cat-card">
<img src="assets/img/ejemplo<?= $img ?>.jpg" alt="<?= e($nombre) ?>">
<h3><?= e($nombre) ?></h3>
<a class="btn" href="ejemplos.php?cat=<?= $slug ?>">Ver ejemplos</a>
</article>
<?php endforeach; ?>
</div>
<?php require 'includes/footer.php'; ?>
