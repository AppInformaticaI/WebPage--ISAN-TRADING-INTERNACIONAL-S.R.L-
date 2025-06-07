<?php
/* index.php – MR Crusher “Stellar-look++++”
   build 2025-06-06  ·  Hero con vídeo, botón rojo
*/
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <meta name="description" content="MR Crusher – Fabricante de trituradoras, molinos, briquetadoras y soluciones llave en mano para minería, áridos y reciclaje. Exportamos a 130+ países.">
  <meta name="keywords" content="MR Crusher, Mountain River Machinery, trituradoras, molinos, briquetadoras, equipos de minería, soluciones de trituración, repuestos">
  <link rel="icon" href="/favicon.ico">
  <title>MR Crusher – Stellar Pro</title>

  <!-- MapLibre GL + Turf -->
  <link href="https://unpkg.com/maplibre-gl@2.4.0/dist/maplibre-gl.css" rel="stylesheet">
  <script src="https://unpkg.com/maplibre-gl@2.4.0/dist/maplibre-gl.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@turf/turf@6/turf.min.js"></script>

  <!-- Tailwind CDN -->
  <script>
    tailwind.config={
      theme:{
        fontFamily:{sans:['Poppins','ui-sans-serif','system-ui']},
        extend:{
          colors:{
            primary:{50:'#FFE5E5',500:'#E53935',700:'#B71C1C'},
            accent :{500:'#FF8C00',700:'#FFD600'},
            neutral:{50:'#fafafa',100:'#f5f5f5',300:'#e5e7eb',500:'#6b7280',700:'#374151',900:'#111827'},
            slate  :{50:'#F8FAFC',100:'#F1F5F9',300:'#CBD5E1',500:'#64748B',700:'#475569',900:'#0F172A'}
          },
          boxShadow:{deep:'0 10px 20px rgba(0,0,0,.18)',deeper:'0 25px 35px rgba(0,0,0,.28)'}
        }
      }
    };
  </script>
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Fuentes & iconos -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icons/6.14.0/css/flag-icons.min.css">
  <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">

  <!-- Estilos rápidos -->
  <style>
    html{scroll-behavior:smooth}
    body{font-family:'Poppins',sans-serif}

    .nav-link{color:#374151;text-align:center;transition:color .2s}
    .nav-link:hover{color:#E53935}

    .btn-primary{
      display:inline-block;padding:.5rem 1.5rem;border-radius:.5rem;
      font-weight:600;color:#fff;background:#E53935;
      box-shadow:0 10px 20px rgba(0,0,0,.18);
      transition:transform .2s,background .2s,box-shadow .2s
    }
    .btn-primary:hover{
      transform:translateY(-2px);background:#B71C1C;
      box-shadow:0 25px 35px rgba(0,0,0,.28)
    }

    .card-3d{
      transition:.35s;transform-style:preserve-3d;
      box-shadow:0 10px 20px rgba(0,0,0,.18);
      display:flex;flex-direction:column;height:100%
    }
    .card-3d:hover{
      transform:rotateX(5deg) rotateY(-5deg) scale(1.04);
      box-shadow:0 25px 35px rgba(0,0,0,.28)
    }

    @keyframes logo-scroll{0%{transform:translateX(0)}100%{transform:translateX(-50%)}}
    .animate-scroll{animation:logo-scroll 20s linear infinite}
  </style>
</head>

<body class="bg-slate-50 text-slate-900 antialiased">

<?php
/* ---------------- Enlaces ---------------- */
$allLinks=[
  'inicio'       =>'Inicio',
  'nosotros'     =>'Sobre nosotros',
  'destacados'   =>'Productos',
  'noticias'     =>'Noticias',
  'clientes'     =>'Clientes',
  'publicaciones'=>'Publicaciones',
  'ventajas'     =>'Ventajas',
  'mapa'         =>'Mapa',
  'alianza'      =>'Alianza',
  'contacto'     =>'Contáctenos'
];
$mainLinks=array_slice($allLinks,0,4);
$moreLinks=array_slice($allLinks,4);
?>

<!-- ================= HEADER ================= -->
<header class="fixed inset-x-0 top-0 z-50 bg-white shadow-deeper">
  <div class="max-w-7xl mx-auto px-6 lg:px-8 h-16 flex items-center relative">
    <a href="#" class="text-2xl font-extrabold text-primary-700 z-10">MR&nbsp;Crusher</a>

    <!-- Desktop -->
    <nav class="hidden lg:flex absolute inset-x-0 justify-center gap-6 text-sm">
      <?php foreach($mainLinks as $id=>$lbl) echo "<a href='#$id' class='nav-link'>$lbl</a>"; ?>
      <?php if($moreLinks): ?>
      <div class="relative group">
        <button class="nav-link flex items-center gap-1">Más <i class="fa-solid fa-chevron-down text-xs"></i></button>
        <div class="absolute left-1/2 -translate-x-1/2 mt-2 w-44 bg-white border border-neutral-200 rounded-lg shadow-lg opacity-0 group-hover:opacity-100 invisible group-hover:visible transition">
          <?php foreach($moreLinks as $id=>$lbl) echo "<a href='#$id' class='block px-4 py-2 text-sm hover:bg-neutral-50'>$lbl</a>"; ?>
        </div>
      </div>
      <?php endif; ?>
    </nav>

    <!-- Idiomas + CTA -->
    <div class="ml-auto flex items-center gap-4 z-10">
      <div class="hidden lg:flex items-center gap-2 text-xl">
        <a href="/"    class="fi fi-es" title="Español"></a>
        <a href="/en/" class="fi fi-us" title="English"></a>
        <a href="/pt/" class="fi fi-br" title="Português"></a>
      </div>
      <a href="#contacto" class="hidden lg:inline-block btn-primary text-sm">Cotiza&nbsp;ya</a>
      <button id="mobile-menu-button" class="lg:hidden text-primary-700" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa-solid fa-bars fa-2x"></i>
      </button>
    </div>
  </div>

  <!-- Mobile -->
  <nav id="mobile-nav" class="hidden lg:hidden flex-col bg-white text-center py-4 space-y-4">
    <?php foreach($allLinks as $id=>$lbl) echo "<a href='#$id' class='nav-link block'>$lbl</a>"; ?>
    <div class="flex justify-center gap-6 text-3xl my-2">
      <a href="/"    class="fi fi-es"></a>
      <a href="/en/" class="fi fi-us"></a>
      <a href="/pt/" class="fi fi-br"></a>
    </div>
  </nav>
</header>

<main class="scroll-smooth pt-16">

<!-- HERO (parallax con vídeo) -->
<section id="inicio" class="relative h-screen overflow-hidden">
  <!-- Vídeo de fondo (tu URL original) -->
  <video
    class="absolute inset-0 w-full h-full object-cover"
    src="https://cdn.coverr.co/videos/coverr-huge-mining-excavator-6233/1080p.mp4"
    autoplay
    muted
    loop
    playsinline
    poster="https://picsum.photos/id/57/1920/1080?blur">
    <!-- Fallback si el navegador no reproduce el MP4 -->
    <img src="https://picsum.photos/id/57/1920/1080?blur" alt="Minería a cielo abierto">
  </video>

  <!-- Capa oscura para contraste del texto -->
  <div class="absolute inset-0 bg-black/50"></div>

  <!-- Contenido centrado -->
  <div class="relative z-10 flex flex-col items-center justify-center h-full text-center px-4">
    <div class="flex items-center gap-4 mb-4">
      <span class="fi fi-cn text-3xl"></span>
      <i class="fa-solid fa-handshake text-white text-2xl" aria-hidden="true"></i>
      <span class="fi fi-bo text-3xl"></span>
    </div>

    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white mb-6 drop-shadow-lg">
      China &middot; Bolivia<br>
      <span class="text-red-500">Innovación sin fronteras</span>
    </h1>

   <p class="text-white/90 text-lg sm:text-xl max-w-2xl mx-auto mb-8">
  ipmsun quorah blixter navoxt remdul zaphor quilnor trexla vintos meqra
</p>

    <a href="#destacados"
       class="inline-block px-8 py-3 bg-red-600 text-white font-semibold rounded-lg shadow-lg hover:bg-red-700 transition">
      Descubre nuestros productos
    </a>
  </div>
</section>


<<!-- ================ NOSOTROS ================= -->
<section id="nosotros" class="bg-neutral-50 py-16">
  <div class="max-w-4xl mx-auto px-4 space-y-12">

    <!-- Historia -->
    <div class="flex flex-col lg:flex-row items-center" data-aos="fade-right">
      <div class="lg:w-1/2 mb-6 lg:mb-0">
        <img src="https://picsum.photos/seed/parallax1/800/500"
             alt="Historia MR Crusher"
             class="w-full h-auto rounded-xl shadow-lg">
      </div>
      <div class="lg:w-1/2 lg:pl-8">
        <h3 class="text-2xl font-semibold text-primary-700 mb-2">Historia</h3>
        <p class="text-neutral-600 text-base leading-relaxed">
          ipmsun quorah blixter navoxt remdul zaphor quilnor trexla vintos meqra.
        </p>
      </div>
    </div>

    <!-- Fábrica -->
    <div class="flex flex-col lg:flex-row-reverse items-center" data-aos="fade-left">
      <div class="lg:w-1/2 mb-6 lg:mb-0">
        <img src="https://picsum.photos/seed/parallax2/800/500"
             alt="Fábrica MR Crusher"
             class="w-full h-auto rounded-xl shadow-lg">
      </div>
      <div class="lg:w-1/2 lg:pr-8">
        <h3 class="text-2xl font-semibold text-primary-700 mb-2">Fábrica &amp; I+D</h3>
        <p class="text-neutral-600 text-base leading-relaxed">
          ipmsun quorah blixter navoxt remdul zaphor quilnor trexla vintos meqra.
        </p>
      </div>
    </div>

    <!-- Texto + Botón -->
<!-- Texto + Botón -->
<div class="text-center space-y-4" data-aos="zoom-in">
  <p class="text-neutral-700 text-base">
    Descubre nuestra trayectoria, tecnología y el equipo que nos respalda.
  </p>
  <a href="#contacto" class="btn-primary px-8 py-3">
    Más información
  </a>
</div>


    <!-- Valores -->
    <div class="text-center" data-aos="fade-up">
      <h3 class="text-2xl font-semibold text-primary-700 mb-4">Valores</h3>
      <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="flex flex-col items-center">
          <!-- icono corregido -->
          <i class="fa-solid fa-hand-holding-heart text-primary-500 text-3xl mb-2" aria-hidden="true"></i>
          <span class="text-neutral-700 font-medium">Integridad</span>
        </div>
        <div class="flex flex-col items-center">
          <i class="fa-solid fa-lightbulb text-primary-500 text-3xl mb-2" aria-hidden="true"></i>
          <span class="text-neutral-700 font-medium">Innovación</span>
        </div>
        <div class="flex flex-col items-center">
          <i class="fa-solid fa-tree text-primary-500 text-3xl mb-2" aria-hidden="true"></i>
          <span class="text-neutral-700 font-medium">Sostenibilidad</span>
        </div>
        <div class="flex flex-col items-center">
          <i class="fa-solid fa-users-cog text-primary-500 text-3xl mb-2" aria-hidden="true"></i>
          <span class="text-neutral-700 font-medium">Calidad</span>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- ================ CLIENTES ================= -->
<section id="clientes" class="section py-14 bg-slate-300">
  <h2 class="text-3xl font-bold text-center text-neutral-900 mb-8">Confían en nosotros</h2>
  <div class="overflow-hidden h-24 sm:h-20">
    <div class="flex animate-scroll whitespace-nowrap items-center h-full">
      <?php
        $logos=['tesla.com','apple.com','microsoft.com','amazon.com','google.com','ibm.com','vale.com','barrick.com','bhp.com','codelco.cl','cemex.com','arcelormittal.com'];
        $logos=array_merge($logos,$logos);
        foreach($logos as $d){
          echo '<img src="https://logo.clearbit.com/'.$d.'" class="h-16 sm:h-20 mx-6 sm:mx-12 card-3d filter grayscale opacity-60 hover:grayscale-0 hover:opacity-100 transition" loading="lazy" decoding="async" alt="Logo '.$d.'">';
        }
      ?>
    </div>
  </div>
</section>

<!-- ================ PRODUCTOS DESTACADOS ================= -->
<section id="destacados" class="section py-24 bg-slate-50">
  <div class="max-w-7xl mx-auto px-6 text-center">
    <h2 class="text-4xl font-extrabold mb-14">Productos Destacados</h2>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 [grid-auto-rows:1fr]">
      <?php
        $prods=[
          ['Jaw Crusher','fa-mountain','https://picsum.photos/seed/jaw3/600/400','10-800 t/h','≤1200 mm'],
          ['Cone Crusher','fa-circle-nodes','https://picsum.photos/seed/cone3/600/400','45-2180 t/h','≤560 mm'],
          ['Impact Crusher','fa-gauge-high','https://picsum.photos/seed/impact3/600/400','30-2000 t/h','≤800 mm'],
          ['Mobile Crusher','fa-truck-ramp-box','https://picsum.photos/seed/mobile3/600/400','60-650 t/h','≤800 mm'],
          ['Ultrafine Mill','fa-gears','https://picsum.photos/seed/mill3/600/400','400-2500 malla','≤20 mm'],
          ['Raymond Mill','fa-gears','https://picsum.photos/seed/mill4/600/400','200-325 malla','≤35 mm'],
          ['Ball Mill','fa-baseball','https://picsum.photos/seed/ball3/600/400','0.65-615 t/h','≤25 mm'],
          ['Briquette Press','fa-cubes-stacked','https://picsum.photos/seed/briq3/600/400','1-35 t/h','≤3 mm']
        ];
        foreach($prods as [$n,$ic,$img,$cap,$feed]){
          echo "
          <a href=\"producto1.php\" class=\"block transform hover:-translate-y-1 transition-shadow shadow-lg hover:shadow-2xl rounded-xl overflow-hidden\">
            <div class=\"card-3d bg-white rounded-xl overflow-hidden\" itemscope itemtype=\"https://schema.org/Product\">
              <img src=\"$img\" alt=\"Imagen de $n\" class=\"w-full h-auto\" loading=\"lazy\" decoding=\"async\">
              <div class=\"p-6 flex flex-col flex-1\">
                <i class=\"fa-solid $ic text-primary-500 text-3xl mb-3\" aria-hidden=\"true\"></i>
                <h3 class=\"font-semibold mb-1\" itemprop=\"name\">$n</h3>
                <p class=\"text-neutral-600 text-sm flex-1\">Capacidad: $cap · Alimentación máx.: $feed</p>
              </div>
            </div>
          </a>";
        }
      ?>
    </div>

    <a href="productos.php" class="btn-primary mt-12 inline-block">Ver catálogo completo</a>
  </div>
</section>


<!-- ================ MAPA 3-D ================= -->
<section id="mapa" class="section py-24 bg-white">
  <div class="max-w-6xl mx-auto px-6">
    <h2 class="text-4xl font-extrabold text-center mb-8">ipmsun quorah blixter navoxt remdul zaphor quilnor trexla vintos meqra.</h2>
    <p class="text-center text-neutral-600 mb-6">
      ipmsun quorah blixter navoxt remdul zaphor quilnor trexla vintos meqra. <strong>24–72 h</strong>.
    </p>
    <div id="chinaBoliviaMap" class="w-full h-[300px] sm:h-[480px] rounded-xl shadow-deep"></div>
  </div>
</section>

<!-- ================ ALIANZA MOSAICO ================= -->
<section id="alianza" class="section py-16 bg-neutral-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12" data-aos="fade-down">
      <h2 class="text-3xl md:text-4xl font-extrabold text-primary-700">Alianza China 🤝 Bolivia</h2>
      <p class="text-neutral-600 text-base md:text-lg mt-2">ipmsun quorah blixter navoxt remdul zaphor quilnor trexla vintos meqra..</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-center">
      <!-- China -->
      <div class="grid grid-cols-2 gap-4 lg:flex lg:flex-col lg:space-y-4" data-aos="fade-right">
        <div class="overflow-hidden rounded-xl shadow-lg">
          <img src="https://picsum.photos/seed/china1/900/600" alt="Fábrica en Shanghái" class="w-full h-auto object-cover">
        </div>
        <div class="overflow-hidden rounded-xl shadow-lg">
          <img src="https://picsum.photos/seed/china2/900/600" alt="Centro CNC en China" class="w-full h-auto object-cover">
        </div>
      </div>

      <!-- Texto -->
      <div class="text-center space-y-6 px-4 sm:px-6" data-aos="zoom-in">
        <div class="inline-block bg-primary-100 rounded-full px-3 py-1">
          <span class="text-primary-500 font-semibold text-sm">Uniendo Fuerzas</span>
        </div>
        <h3 class="text-2xl md:text-3xl font-semibold text-primary-700">Fortaleza Global • Soporte Local</h3>
        <p class="text-neutral-600 text-sm sm:text-base md:text-lg leading-relaxed">
          En <strong>MR Crusher</strong> combinamos la capacidad industrial de China con la experiencia y cercanía de Bolivia.
          Esta alianza estratégica garantiza:
        </p>
        <ul class="list-inside list-disc text-neutral-600 text-sm sm:text-base md:text-lg space-y-2 text-left max-w-md mx-auto">
          <li><strong>Producción Avanzada</strong> ipmsun quorah blixter navoxt remdul zaphor quilnor trexla vintos meqra.</li>
          <li><strong>Logística Exprés:</strong> ipmsun quorah blixter navoxt remdul zaphor quilnor trexla vintos meqra.</li>
          <li><strong>ipmsun quorah blixter navoxt remdul zaphor quilnor trexla vintos meqra.:</strong> equipo local 24/7 y almacén con stock en La Paz.</li>
          <li><strong>Costos Competitivos:</strong> ipmsun quorah blixter navoxt remdul zaphor quilnor trexla vintos meqra.</li>
        </ul>
        <a href="#contacto" class="mt-6 inline-block btn-primary px-6 py-3">Cotiza con Entrega Local</a>
      </div>

      <!-- Bolivia -->
      <div class="grid grid-cols-2 gap-4 lg:flex lg:flex-col lg:space-y-4" data-aos="fade-left">
        <div class="overflow-hidden rounded-xl shadow-lg">
          <img src="https://picsum.photos/seed/bolivia1/900/600" alt="Paisaje de La Paz" class="w-full h-auto object-cover">
        </div>
        <div class="overflow-hidden rounded-xl shadow-lg">
          <img src="https://picsum.photos/seed/bolivia2/900/600" alt="Almacén en Bolivia" class="w-full h-auto object-cover">
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ================ PUBLICACIONES DESTACADAS ================= -->
<section id="publicaciones" class="relative py-12 sm:py-24 bg-gradient-to-r from-slate-50 via-white to-slate-100 overflow-hidden">
  <div class="absolute -top-16 -left-16 w-64 h-64 sm:w-96 sm:h-96 bg-primary-500/10 rounded-full blur-3xl"></div>
  <div class="absolute -bottom-20 -right-12 w-64 h-64 sm:w-96 sm:h-96 bg-accent-500/10 rounded-full blur-3xl"></div>

  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 grid lg:grid-cols-2 gap-8 sm:gap-16 items-center">
    <!-- Texto -->
    <div data-aos="fade-right" class="space-y-8">
      <h2 class="text-4xl sm:text-5xl font-extrabold text-neutral-900 leading-tight">
        <span class="relative inline-block">
          Nuestras Publicaciones
          <span class="absolute left-0 -bottom-1 h-2 w-full rounded-full bg-primary-50"></span>
        </span>
      </h2>

      <p class="text-neutral-600 text-lg leading-relaxed">
        Inspírate con estudios de casos, white papers y guías prácticas.
        Aprende las mejores técnicas de trituración, tendencias de la industria
        y consejos para optimizar tus operaciones.
      </p>

      <div class="flex justify-center lg:justify-start">
        <a href="#noticias" class="btn-primary inline-flex justify-center items-center gap-3 shadow-lg">
          Ver Publicaciones
          <i class="fa-solid fa-arrow-right-long -rotate-45" aria-hidden="true"></i>
        </a>
      </div>
    </div>

    <!-- Imagen -->
    <figure data-aos="fade-left" class="relative overflow-hidden rounded-3xl shadow-2xl">
      <img src="https://picsum.photos/seed/publicaciones/900/650" alt="Personas leyendo publicaciones técnicas" class="w-full h-auto object-cover transition-transform duration-700 group-hover:scale-105 max-h-48 sm:max-h-none">
      <figcaption class="absolute inset-0 bg-gradient-to-t from-black/40 via-black/10 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-700"></figcaption>
    </figure>
  </div>
</section>

<!-- ================ VENTAJAS ================= -->
<section id="ventajas" class="section py-12 bg-neutral-50">
  <div class="max-w-7xl mx-auto px-6">
    <h2 class="text-3xl font-extrabold text-center text-primary-700 mb-8" data-aos="fade-down">Nuestras ventajas</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <div data-aos="fade-up" class="bg-white p-6 rounded-md shadow-lg border-l-4 border-primary-500">
        <div class="flex items-center mb-3">
          <i class="fa-solid fa-check-circle text-primary-500 text-2xl mr-3" aria-hidden="true"></i>
          <h3 class="font-semibold text-lg">Calidad Premium</h3>
        </div>
        <p class="text-neutral-600 text-sm">Materiales de primera y procesos con certificación ISO que aseguran equipos duraderos.</p>
      </div>
      <div data-aos="fade-up" data-aos-delay="100" class="bg-white p-6 rounded-md shadow-lg border-l-4 border-primary-500">
        <div class="flex items-center mb-3">
          <i class="fa-solid fa-tags text-primary-500 text-2xl mr-3" aria-hidden="true"></i>
          <h3 class="font-semibold text-lg">Precio Competitivo</h3>
        </div>
        <p class="text-neutral-600 text-sm">Ahorros de producción que trasladamos a tu inversión, sin sacrificar calidad.</p>
      </div>
      <div data-aos="fade-up" data-aos-delay="200" class="bg-white p-6 rounded-md shadow-lg border-l-4 border-primary-500">
        <div class="flex items-center mb-3">
          <i class="fa-solid fa-truck-fast text-primary-500 text-2xl mr-3" aria-hidden="true"></i>
          <h3 class="font-semibold text-lg">Entrega Exprés</h3>
        </div>
        <p class="text-neutral-600 text-sm">Logística optimizada para que recibas tu equipo en Bolivia en un plazo de 24–72 h.</p>
      </div>
      <div data-aos="fade-up" data-aos-delay="300" class="bg-white p-6 rounded-md shadow-lg border-l-4 border-primary-500">
        <div class="flex items-center mb-3">
          <i class="fa-solid fa-headset text-primary-500 text-2xl mr-3" aria-hidden="true"></i>
          <h3 class="font-semibold text-lg">Soporte 24/7</h3>
        </div>
        <p class="text-neutral-600 text-sm">Equipo de ingenieros en español disponible todo el año para resolver cualquier incidencia.</p>
      </div>
    </div>
  </div>
</section>

<?php
/* ---------------- Noticias (mock) ---------------- */
$raw=[
  ['Proyectos','HPGR 300 TPH Chile finalizado','2025-05-12'],
  ['Proyectos','Planta 200 TPH Perú','2025-04-25'],
  ['Proyectos','Modernización cantera Gran Roca','2025-04-02'],
  ['Innovación','Jaw Crusher JC-8X lanzado','2025-04-18'],
  ['Innovación','Sistema IIoT para monitoreo','2025-03-07'],
  ['Corporativo','Almacén La Paz inaugurado','2025-04-29']
];
$news=[];
foreach($raw as $n){
  $news[]=[
    'cat'=>$n[0],
    'tit'=>$n[1],
    'fecha'=>$n[2],
    'url'=>'#',
    'img'=>"https://picsum.photos/seed/".crc32($n[1])."/800/600",
    'txt'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit…'
  ];
}
?>

<!-- ================ NOTICIAS ================= -->
<section id="noticias" class="section py-24 bg-white">
  <div class="max-w-7xl mx-auto px-6">
    <h2 class="text-4xl font-extrabold text-center mb-10">Noticias Recientes</h2>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-10">
      <?php foreach(array_slice($news,0,3) as $n): ?>
      <article class="card-3d bg-white rounded-xl overflow-hidden flex flex-col" data-aos="zoom-in">
        <div class="relative aspect-[4/3] overflow-hidden">
          <img src="<?= $n['img'] ?>" alt="<?= htmlspecialchars($n['tit']) ?>" class="w-full h-full object-cover" loading="lazy" decoding="async">
          <span class="absolute top-3 left-3 bg-primary-500 text-white text-xs px-2 py-1 rounded"><?= htmlspecialchars($n['cat']) ?></span>
        </div>
        <div class="p-6 flex-1 flex flex-col">
          <span class="text-neutral-500 text-xs mb-1"><?= date('d M Y',strtotime($n['fecha'])) ?></span>
          <h3 class="font-semibold mb-2 line-clamp-2"><?= htmlspecialchars($n['tit']) ?></h3>
          <p class="text-neutral-600 text-sm line-clamp-3 mb-4"><?= htmlspecialchars($n['txt']) ?></p>
          <a href="<?= $n['url'] ?>" class="mt-auto inline-flex items-center gap-2 text-primary-700 font-medium hover:underline">Leer más <i class="fa-solid fa-arrow-right text-xs" aria-hidden="true"></i></a>
        </div>
      </article>
      <?php endforeach; ?>
    </div>

    <div class="mt-12 text-center">
      <a href="noticias.php" class="btn-primary inline-block">Ver todas las noticias</a>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>

<!-- ================= JS ================= -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({duration:800,once:true});

  /* Menu móvil */
  const mobileBtn=document.getElementById('mobile-menu-button');
  const mobileNav=document.getElementById('mobile-nav');
  mobileBtn.addEventListener('click',()=>{
    const open=mobileBtn.getAttribute('aria-expanded')==='true';
    mobileBtn.setAttribute('aria-expanded',!open);
    mobileNav.classList.toggle('hidden');
  });
  document.querySelectorAll('a.nav-link').forEach(link=>{
    link.addEventListener('click',e=>{
      e.preventDefault();
      const id=link.getAttribute('href').substring(1);
      const tgt=document.getElementById(id);
      if(!tgt) return;
      const off=document.querySelector('header').offsetHeight+16;
      const top=tgt.getBoundingClientRect().top+scrollY-off;
      scrollTo({top,behavior:'smooth'});
      mobileNav.classList.add('hidden');
      mobileBtn.setAttribute('aria-expanded',false);
    });
  });


  /* MapLibre GL (sin cambios) */
  const map=new maplibregl.Map({
    container:'chinaBoliviaMap',
    style:'https://demotiles.maplibre.org/style.json',
    projection:'globe',
    center:[25,5],zoom:1.5,pitch:35,bearing:-10,antialias:true
  });
  const cn=[121.4737,31.2304],bo=[-63.588652,-16.290154];
  map.on('load',()=>{
    const arc=turf.greatCircle(cn,bo,{npoints:100}).geometry;
    map.addSource('route',{type:'geojson',data:{type:'Feature',geometry:arc}});
    map.addLayer({id:'route-line',type:'line',source:'route',
      paint:{'line-color':'#E53935','line-width':4,'line-dasharray':[2,2]}});
    const mk=(pos,png,label)=>{
      const el=document.createElement('div');
      el.style.cssText=`width:40px;height:40px;border-radius:50%`,
      el.style.background=`url(${png}) center/cover`;
      el.style.border='2px solid #fff';el.style.boxShadow='0 2px 6px rgba(0,0,0,.3)';
      new maplibregl.Marker({element:el,anchor:'bottom'})
        .setLngLat(pos).setPopup(new maplibregl.Popup({offset:25}).setHTML(label)).addTo(map);
    };
    mk(cn,'https://flagcdn.com/w40/cn.png','Fábrica Shanghái 🇨🇳');
    mk(bo,'https://flagcdn.com/w40/bo.png','Bolivia 🇧🇴');
    let spin=true;map.on('mousedown',()=>spin=false);
    (function rot(){if(!spin) return;
      map.easeTo({bearing:map.getBearing()+0.05,duration:5e3,easing:t=>t});
      requestAnimationFrame(rot);
    })();
  });
</script>
</body>
</html>
