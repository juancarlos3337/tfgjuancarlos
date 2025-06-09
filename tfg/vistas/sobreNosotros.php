<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="../img/patata-asada.png" type="image/x-icon">
    <title>SOBRE NOSOTROS</title>
</head>
<body class="bg-neutral-100 cursor-default">
    <?php
        require_once("header.php");
    ?>
    <main>
        <section class="bg-[#5C3B1E] text-white py-16 px-4 text-center">
          <h1 class="text-4xl font-bold mb-4">Sobre Nosotros</h1>
          <p class="text-lg max-w-2xl mx-auto">Conoce la historia, el alma y el sabor detrás de El Paponazo</p>
        </section>


        <section class="py-20 px-6">
          <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-10 items-center">
            <img src="../img/local.jpg" alt="local" class="rounded-xl mx-auto shadow-lg">
            <div>
              <h2 class="text-3xl font-bold text-[#5C3B1E] mb-4">Nuestra historia</h2>
              <p>
                EL Paponazo nació en 2001 con una simple idea, llevar las patatas asadas a su máxima expresión. Desde un pequeño local en Granada hasta convertirnos en una referencia del street food, nuestra pasión por lo artesanal y sabroso no ha parado de crecer.
              </p>
            </div>
          </div>
        </section>


        <section class="py-20 px-6 bg-[#F8E5B2] text-[#5C3B1E] text-center">
          <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl font-bold mb-8">Nuestra misión y visión</h2>
            <div class="grid md:grid-cols-2 gap-10 text-center">
              <div>
                <h3 class="text-xl font-semibold mb-2">Misión</h3>
                <p>Servir comida rápida de calidad con ingredientes frescos, fomentando un consumo consciente y delicioso.</p>
              </div>
              <div>
                <h3 class="text-xl font-semibold mb-2">Visión</h3>
                <p>Convertirnos en la primera opción de quienes aman las patatas, expandiéndonos sin perder la esencia casera.</p>
              </div>
            </div>
          </div>
        </section>


        <section class="py-20 px-6 bg-white">
          <div class="max-w-5xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-[#5C3B1E] mb-10">Nuestros valores</h2>
            <div class="grid md:grid-cols-3 gap-8 text-[#3d2b1f]">
              <div class="bg-[#FFF8E7] rounded-xl shadow p-6">
                <h3 class="font-bold text-lg mb-2">Calidad</h3>
                <p>Ingredientes seleccionados, cocinados con mimo.</p>
              </div>
              <div class="bg-[#FFF8E7] rounded-xl shadow p-6">
                <h3 class="font-bold text-lg mb-2">Cercanía</h3>
                <p>Trato humano y auténtico, como en casa.</p>
              </div>
              <div class="bg-[#FFF8E7] rounded-xl shadow p-6">
                <h3 class="font-bold text-lg mb-2">Sostenibilidad</h3>
                <p>Reducimos residuos y apostamos por el producto local.</p>
              </div>
            </div>
          </div>
        </section>


        <section class="py-20 px-6 bg-[#F8E5B2] text-center text-[#5C3B1E]">
          <h2 class="text-3xl font-bold mb-10">Nuestro equipo</h2>
          <div class="max-w-6xl mx-auto grid md:grid-cols-3 gap-10">
            <div>
              <img src="../img/21.jpg" alt="equipo" class="w-40 h-40 mx-auto rounded-full shadow-lg mb-4">
              <h3 class="text-lg font-semibold">Carlos Gómez</h3>
              <p class="text-sm">Fundador & Hornero</p>
            </div>
            <div>
              <img src="../img/76.jpg" alt="equipo" class="w-40 h-40 mx-auto rounded-full shadow-lg mb-4">
              <h3 class="text-lg font-semibold">Lucía Martín</h3>
              <p class="text-sm">Atención al Cliente</p>
            </div>
            <div>
              <img src="../img/46.jpg" alt="equipo" class="w-40 h-40 mx-auto rounded-full shadow-lg mb-4">
              <h3 class="text-lg font-semibold">Pedro Rivas</h3>
              <p class="text-sm">Encargos</p>
            </div>
          </div>
        </section>
    </main>
    <?php
        require_once("footer.php");
    ?>
</body>
</html>