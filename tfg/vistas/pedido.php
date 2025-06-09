<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PEDIDO</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="../img/patata-asada.png" type="image/x-icon">
</head>
<body class="bg-neutral-100 cursor-default">
    <?php
        require_once("header.php");
    ?>

    <main>
        <section class="bg-[#5C3B1E] text-white py-16 px-4 text-center">
            <h1 class="text-4xl font-bold mb-4">Datos del Pedido</h1>
        </section>

        <section class="flex flex-col items-center min-h-screen">
            <div class="w-[90%] lg:w-[70%] flex flex-col items-center">
                <div id="datosPedido" class="w-full shadow-md lg:w-[80%] bg-[#F8E5B2] px-5 py-10 rounded-lg my-10">
                   
                </div> 
            </div>
            <!-- Formulario oculto para enviar los datos con post al controlador y realice las acciones para insertar a la bd -->
            <div class="w-full lg:w-[70%]">
                <form action="../controlador/index.php?action=realizarPedido" class="flex flex-col gap-7 items-center text-center justify-between" method="post" id="datos_ocultos_pedido">
                    
                </form>
            </div>
            
        </section>
    </main>
    <?php
        require_once("footer.php");
    ?>
    <script src="../scripts/script_pedido.js"></script>
</body>
</html>