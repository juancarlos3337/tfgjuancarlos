<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Descubre las mejores patatas asadas al estilo tradicional. Ingredientes naturales, entrega rápida y sabor garantizado en cada bocado. ¡Haz tu pedido hoy!">
  <link rel="stylesheet" href="../css/style.css">
  <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="shortcut icon" href="../img/patata-asada.png" type="image/x-icon">
  <title>EL PAPONAZO</title>
</head>

<body class="bg-neutral-100 cursor-default">
  <?php
  // metemos el header
    require_once("header.php");
  ?>
  <main>
    <section id="sec1" class="flex justify-center h-screen items-center bg-no-repeat bg-center bg-cover bg-fixed bg-[url(../img/patata-rellena.webp)]">
      <div class="flex flex-col justify-center items-center text-center px-4 w-full h-full bg-neutral-700/60 ">
        <h1 class="text-white font-bold text-4xl">DISFRUTA DE LAS MEJORES PATATAS ASADAS DE GRANADA</h1>
        <p class="text-white font-bold text-2xl mt-5">Elaboradas con productos de alta calidad y nacional</p>
      </div>
    </section>

    <section id="sec2" class="flex items-center flex-col justify-center mt-10">
      <h2 class="text-4xl md:text-5xl	text-[#5C3B1E] font-bold">Destacados</h2>
      <div class="relative w-full max-w-7xl overflow-hidden rounded-lg shadow-lg mt-7 mb-7">

        <div class="relative">
          <div class="w-full flex transition-transform duration-500 ease-in-out" id="slider">
            <img src="../img/sl2.jpg" class="w-full" alt="Imagen 1">
            <img src="../img/sl1.jpg" class="w-full" alt="Imagen 2">
            <img src="../img/prueba2.jpg" class="w-full" alt="Imagen 3">
          </div>

          <button id="prev"
            class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-black text-white px-4 py-2 rounded-full hover:bg-gray-800 focus:outline-none">
            &#8249;
          </button>
          <button id="next"
            class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-black text-white px-4 py-2 rounded-full hover:bg-gray-800 focus:outline-none">
            &#8250;
          </button>
        </div>
      </div>

    </section>

    <section id="sec3" class="bg-[#F8E5B2] my-10 flex justify-center items-center flex-col">
      <div class="flex flex-col lg:flex-row gap-10 items-center w-[90%] lg:w-[67%] justify-evenly mt-10">

        <div class=" w-full lg:w-[50%] 2xl:w-[30%] h-[270px]  rounded-lg text-white font-bold bg-no-repeat bg-center bg-cover bg-[url(../img/1000123564.jpg)]">
          <div class="flex flex-col justify-center text-center py-7 px-10 rounded-lg items-center w-full h-full bg-neutral-700/60 ">
            <h2 class="text-3xl pb-5">¡DESCUBRE LA PATATA DEL MES!</h2>
            <P>Descubre el nuevo sabor de patata</P>
          </div>
        </div>

        <div class=" w-full lg:w-[50%] 2xl:w-[30%] h-[270px]  rounded-lg text-white font-bold bg-no-repeat bg-center bg-cover bg-[url(../img/sl2.jpg)]">
          <div class="flex flex-col text-center justify-center py-7 px-10 rounded-lg items-center w-full h-full bg-neutral-700/60 ">
            <h2 class="text-3xl pb-5">¡NUEVA PATATA DE SABOR KEBAB!</h2>
            <P>Descubre el nuevo sabor de patata</P>
          </div>
        </div>

      </div>

      <a href="index.php?action=verCarta" class="my-10 bg-[#5C3B1E] text-center w-[67%] lg:w-[20%] 2xl:w-[10%] px-8 py-3 rounded-lg hover:bg-[#D9984D] text-white hover:text-[#8C512B] transition duration-300 font-bold">VER CARTA</a>
    </section>

    <section id="id4" class="flex justify-center py-10">
      <div class="text-center max-w-md px-4">
        <p class="text-lg font-medium text-gray-700">
          ¿Aún no tienes cuenta? 
          <a href="index.php?action=login" class="text-[#5C3B1E] hover:underline">Regístrate o inicia sesión aquí</a>.
        </p>
        <p class="pt-5 text-xl font-semibold text-gray-800">
          ¡Disfruta de las mejores patatas asadas de <span class="text-yellow-600 font-bold">GRANADA</span>!
        </p>
      </div>
    </section>

    <section id="sec5" class="flex justify-center my-10 mb-20 pt-7 pb-7 bg-[#F8E5B2]">
      <div class="flex justify-center items-center flex-col lg:flex-row justify-center w-[90%] lg:w-[67%]">
        <div class="w-full lg:w-[35%] lg:mr-[15%]">
          <img src="../img/prueba2.jpg" alt="oferta" class="w-full rounded-lg">
        </div>
        <div class="flex flex-col mt-7 lg:mt-0 items-start lg:p-5">
          <div>
            <h2>Esta oferta y muchas más sólo en nuestro local</h2>
            <p>Patata más bebida por 5€</p>
          </div>
          <a href="index.php?action=verCarta" class="bg-[#5C3B1E] w-full text-center px-8 py-3 rounded-lg hover:bg-[#D9984D] text-white hover:text-[#8C512B] transition duration-300 font-bold mt-7">¡SABER MÁS!</a>
        </div>
      </div>
    </section>

    
  </main>
  <?php require_once("footer.php"); ?>

  <script>
    const slider = document.getElementById('slider');
    const prevButton = document.getElementById('prev');
    const nextButton = document.getElementById('next');

    let currentIndex = 0;
    const images = slider.children;

    // Función para mover el slider
    const updateSlider = () => {
      const offset = -currentIndex * 100; // Cada imagen ocupa el 100% del contenedor
      slider.style.transform = `translateX(${offset}%)`;
    };

    // Evento de clic en el botón anterior
    prevButton.addEventListener('click', () => {
      currentIndex = (currentIndex - 1 + images.length) % images.length;
      updateSlider();
    });

    // Función para cambiar la imagen automáticamente
    const autoSlide = () => {
      currentIndex = (currentIndex + 1) % images.length; // Avanzamos al siguiente índice
      updateSlider();
    };

    setInterval(autoSlide, 7000);


    // Evento de clic en el botón siguiente
    nextButton.addEventListener('click', () => {
      currentIndex = (currentIndex + 1) % images.length;
      updateSlider();
    });
  </script>

</body>

</html>