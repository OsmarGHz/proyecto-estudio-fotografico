(() => {
  const $ = s => document.querySelector(s), $$ = s => [...document.querySelectorAll(s)];
  // Menú hamburguesa
  const t = $('#menuToggle'), n = $('#navLinks');
  if (t) t.addEventListener('click', () => t.setAttribute('aria-expanded', n.classList.toggle('abierto')));
  // Filtro de galería por categoría (acepta ?cat=retratos en la URL)
  const bs = $$('.filtro button'), fs = $$('.galeria figure');
  const filtrar = c => { bs.forEach(b => b.classList.toggle('activo', b.dataset.cat === c)); fs.forEach(f => f.hidden = !(c === 'todos' || f.dataset.cat === c)); };
  if (bs.length) {
    bs.forEach(b => b.addEventListener('click', () => filtrar(b.dataset.cat)));
    const q = new URLSearchParams(location.search).get('cat');
    filtrar(bs.some(b => b.dataset.cat === q) ? q : 'todos');
  }
  // Lightbox
  const lb = $('#lightbox');
  if (lb) {
    const im = $('#lbImg'), cp = $('#lbCap'), cerrar = () => lb.hidden = true;
    fs.forEach(f => f.addEventListener('click', () => { const i = f.querySelector('img'); im.src = i.src; im.alt = i.alt; cp.textContent = f.querySelector('figcaption').textContent; lb.hidden = false; }));
    lb.addEventListener('click', e => { if (e.target !== im) cerrar(); });
    document.addEventListener('keydown', e => { if (e.key === 'Escape') cerrar(); });
  }
  // Validación del formulario de contacto
  const f = $('form[data-validar]');
  if (f) f.addEventListener('submit', e => {
    const m = [], v = x => f.elements[x].value.trim();
    if (v('nombre').length < 3) m.push('El nombre debe tener al menos 3 caracteres.');
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v('correo'))) m.push('Escribe un correo válido.');
    if (v('telefono') && !/^[0-9 +()-]{7,20}$/.test(v('telefono'))) m.push('El teléfono no es válido.');
    if (v('mensaje').length < 10) m.push('El mensaje debe tener al menos 10 caracteres.');
    const box = $('#errores');
    if (m.length) { e.preventDefault(); box.innerHTML = m.map(x => '<p>' + x + '</p>').join(''); box.hidden = false; box.scrollIntoView({behavior: 'smooth'}); }
    else box.hidden = true;
  });
})();
