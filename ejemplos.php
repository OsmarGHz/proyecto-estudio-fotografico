<?php
$titulo = 'Ejemplos de fotografías';
require 'includes/header.php';
$cats = ['retratos' => 'Retratos', 'familia' => 'Familia', 'bodas' => 'Bodas y XV', 'producto' => 'Producto'];
$orden = array_keys($cats);
?>
<h1>Ejemplos de fotografías</h1>
<div class="filtro" role="group" aria-label="Filtrar por categoría">
<button type="button" data-cat="todos" class="activo">Todos</button>
<?php foreach ($cats as $slug => $n): ?><button type="button" data-cat="<?= $slug ?>"><?= e($n) ?></button><?php endforeach; ?>
</div>
<section class="galeria">
<?php for ($i = 1; $i <= 12; $i++): $slug = $orden[intdiv($i - 1, 3)]; ?>
<figure data-cat="<?= $slug ?>"><img src="assets/img/ejemplo<?= $i ?>.jpg" alt="Ejemplo <?= $i ?> - <?= e($cats[$slug]) ?>" loading="lazy"><figcaption>Ejemplo <?= $i ?> · <?= e($cats[$slug]) ?></figcaption></figure>
<?php endfor; ?>
</section>
<div id="lightbox" class="lightbox" hidden><button type="button" aria-label="Cerrar">✕</button><img id="lbImg" src="" alt=""><p id="lbCap"></p></div>
<?php require 'includes/footer.php'; ?>
