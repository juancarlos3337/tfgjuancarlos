<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="../img/patata-asada.png" type="image/x-icon">
    <title>MIS PEDIDOS</title>
</head>
<body class="cursor-default">
    <?php
        require_once("header.php");
    ?>
    <main>
        <section class="bg-[#5C3B1E] text-white py-16 px-4 text-center">
            <h1 class="text-4xl font-bold mb-4">Mis Pedidos</h1>
        </section>

        <section class="min-h-screen">   
            <div class="text-center flex flex-col items-center justify-center mt-10 pt-10 pb-10 m-auto mt-10 mx-5">
            <?php
            
                if(isset($pedidosDeHoy)){
                    if(count($pedidosDeHoy)!=0){      
                        foreach ($pedidosDeHoy as $pedido) {
                            echo "<div class='w-full md:w-[80%] xl:w-[50%] 2xl:w-[30%] py-10 px-5 bg-[#F8E5B2] shadow-md text-[#5C3B1E] rounded-lg mt-20'>";
                                echo "<div class='flex text-2xl font-bold justify-between border-b px-3'>";
                                    echo "<p>Patata</p><p>Precio</p>";
                                echo "</div>";
                                foreach ($pedido['productos'] as $producto) {
                                    echo "<div class='flex justify-between font-bolder text-xl my-7 md:px-5'>
                                        <span>{$producto['nombre']} x {$producto['cantidad']}</span>
                                        <span>" . ($producto['precioUnitario'] * $producto['cantidad']) . "€</span>
                                    </div>";
                                }
                                echo "<div class='flex justify-between font-bolder text-xl pt-5 border-t md:px-5'>";
                                    echo "<p>Total a Pagar: </p>";
                                    echo "<p>". $pedido['precioTotal'] ."€</p>";
                                echo "</div>";

                                echo "<div class='flex justify-between font-bolder text-xl md:px-5'>";
                                    echo "<p>Hora de Recogida: </p>";
                                    echo "<p>". substr($pedido['hora'],0,5) ."</p>";
                                echo "</div>";

                                $estado = $pedido['realizado'] === 1 ? "Finalizado" : "En preparación";
                                echo "<div class='flex justify-between font-bolder text-xl md:px-5'>";
                                    echo "<p>Estado del Pedido: </p>";
                                    echo "<p>". $estado ."</p>";
                                echo "</div>";
                            echo "</div>";
                        }
                    }else{
                        echo "<p class=\"text-3xl text-[#5C3B1E] h-screen font-bold\">No tienes Pedidos</p>";
                    }
                }
            ?>
        </div>
        </section>
    </main>
     <?php
        require_once("footer.php");
    ?>
</body>
</html>