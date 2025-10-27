<?php
// =====================
// Config rápido (colores/velocidad)
// =====================
$BG      = '#0b1736';   // azul oscuro
$INK     = '#e9eef9';   // tinta clara
$ACCENT  = '#d45c73';   // acento para la “S”
$INKDIM  = '#a9b4cc';   // tinta secundaria
$LINE    = '#2a3557';   // línea decorativa
$SPEED   = 1;           // multiplicador de velocidad (1 = normal)
?><!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Del Sur Construcciones — Animación</title>
  <style>
    :root{
      --bg: <?= $BG ?>;
      --ink: <?= $INK ?>;
      --accent: <?= $ACCENT ?>;
      --ink-dim: <?= $INKDIM ?>;
      --line: <?= $LINE ?>;
      --speed: <?= max(0.1, floatval($SPEED)) ?>;
    }
    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0;
      background:var(--bg);
      color:var(--ink);
      font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif;
      display:grid; place-items:center;
      overflow:hidden;
    }
    .backdrop{
      position:fixed; inset:0; pointer-events:none;
      background:
        radial-gradient(1200px 600px at 70% 20%, rgba(255,255,255,.06), transparent 60%),
        radial-gradient(900px 500px at 20% 80%, rgba(255,255,255,.05), transparent 60%),
        linear-gradient(180deg, rgba(255,255,255,.03), transparent 30%),
        var(--bg);
    }
    .stage{ width:min(92vw,900px); display:grid; gap:28px; justify-items:center; padding:24px; }
    .emblem{ width:min(82vw,540px); aspect-ratio:16/11; }
    svg{ width:100%; height:100%; display:block }

    /* Animación de trazado */
    .draw{
      stroke:var(--ink);
      stroke-width:8;
      fill:none;
      stroke-linejoin:round;
      stroke-linecap:round;
      pathLength:1;
      stroke-dasharray:1;
      stroke-dashoffset:1;
      animation: draw calc(1.1s/var(--speed)) ease forwards;
    }
    .delay-1{ animation-delay:.15s }
    .delay-2{ animation-delay:.45s }
    .delay-3{ animation-delay:.85s }
    .delay-4{ animation-delay:1.25s }
    .delay-5{ animation-delay:1.65s }
    .delay-6{ animation-delay:2.05s }

    @keyframes draw{ to{ stroke-dashoffset:0 } }

    .fill-pop{
      fill: var(--ink);
      opacity:0; transform-origin:center;
      animation: pop .6s cubic-bezier(.2,1,.2,1) forwards;
      animation-delay:2.25s;
    }
    @keyframes pop{ 0%{opacity:0; transform:scale(.8)} 100%{opacity:.08; transform:scale(1)} }

    .brand{ display:flex; gap:14px; align-items:baseline; flex-wrap:wrap; font-weight:800; letter-spacing:.06em; user-select:none; }
    .brand .big{
      font-size: clamp(44px, 8vw, 84px);
      line-height:1; display:flex; gap:.25ch; align-items:baseline;
      opacity:0; transform:translateY(10px);
      animation: fadeUp .7s ease forwards; animation-delay:2.4s;
    }
    .brand .big .s{
      color:var(--accent); position:relative; display:inline-block; transform-origin:60% 60%;
      animation: sBreathe 2s ease-in-out infinite; animation-delay:3.3s;
    }
    @keyframes sBreathe{ 0%,100%{transform:scale(1) rotate(0)} 50%{transform:scale(1.04) rotate(.2deg)} }

    .divider{
      width:100%; height:4px; border-radius:2px;
      background: linear-gradient(90deg, var(--line), var(--ink) 30%, var(--line));
      opacity:0; transform:scaleX(.8);
      animation: fadeBar .7s ease forwards; animation-delay:2.6s;
    }
    @keyframes fadeBar{ to{opacity:1; transform:scaleX(1)} }

    .tagline{
      font-size: clamp(14px, 2.5vw, 22px); letter-spacing:.38em; color:var(--ink-dim);
      text-transform:uppercase; text-align:center;
      opacity:0; transform:translateY(8px);
      animation: fadeUp .7s ease forwards; animation-delay:2.9s;
    }
    @keyframes fadeUp{ to{opacity:1; transform:translateY(0)} }

    .replay{
      position:fixed; inset:auto 16px 16px auto;
      background:#ffffff10; border:1px solid #ffffff22; color:var(--ink);
      padding:10px 14px; border-radius:12px; backdrop-filter: blur(6px);
      font-size:14px; letter-spacing:.06em; cursor:pointer;
      transition: transform .15s ease, background .2s ease;
    }
    .replay:hover{ transform: translateY(-1px); background:#ffffff18 }

    @media (prefers-reduced-motion: reduce){
      .draw, .fill-pop, .brand .big, .divider, .tagline{ animation-duration:.001ms !important; animation-delay:0ms !important; animation-iteration-count:1 !important; }
      .brand .big .s{ animation:none }
    }
  </style>
</head>
<body>
  <div class="backdrop" aria-hidden="true"></div>

  <main class="stage" aria-label="Animación Del Sur Construcciones">
    <div class="emblem" id="emblem">
      <svg viewBox="0 0 900 620" role="img" aria-label="Trazado de casa estilizada">
        <!-- Guías tipo “mira” -->
        <circle cx="300" cy="310" r="210" class="draw delay-1" />
        <line x1="60" y1="310" x2="840" y2="310" class="draw delay-2" />
        <line x1="300" y1="40" x2="300" y2="580" class="draw delay-2" />

        <!-- Casa -->
        <path d="M170 460 H430" class="draw delay-3"/>
        <path d="M170 460 L300 330 L430 460" class="draw delay-3"/>
        <path d="M355 360 v-60 h40 v85" class="draw delay-4"/>
        <path d="M210 460 V380 H390 V460" class="draw delay-4"/>
        <path d="M260 460 V410 H340 V460" class="draw delay-5"/>
        <path d="M225 395 h60 v-40 h-60 v40" class="draw delay-5"/>
        <path class="fill-pop" d="M170 460 L300 330 L430 460 Z M210 460 V380 H390 V460 Z" />
        <line x1="40" y1="560" x2="860" y2="560" class="draw delay-6"/>
      </svg>
    </div>

    <div class="brand">
      <div class="big" aria-label="DEL SUR">
        <span>DEL</span><span class="s">S</span><span>UR</span>
      </div>
      <div class="divider" aria-hidden="true"></div>
      <div class="tagline">CONSTRUCCIONES</div>
    </div>
  </main>

  <button class="replay" id="replayBtn" aria-label="Reiniciar animación">Reiniciar (R)</button>

  <script>
    const emblem = document.getElementById('emblem');
    const replayBtn = document.getElementById('replayBtn');

    function restartAnimations(){
      const clone = emblem.cloneNode(true);
      emblem.replaceWith(clone);
      document.querySelectorAll('.brand .big, .divider, .tagline').forEach(el=>{
        el.style.animation='none'; void el.offsetWidth; el.style.animation='';
      });
    }
    replayBtn.addEventListener('click', restartAnimations);
    window.addEventListener('keydown', (e)=>{ if(e.key.toLowerCase()==='r') restartAnimations(); });
  </script>
</body>
</html>
