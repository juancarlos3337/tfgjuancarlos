<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="../img/patata-asada.png" type="image/x-icon">
    <title>CARTA</title>
</head>
<body class="bg-neutral-100 cursor-default">
    <?php
        require_once("header.php");
    ?>

    <main>
        <!-- vemos todas las patatas, podremos modificar añadir o eliminar patatas si somos admin, si no solo verlas y añadir al carro para pedir -->
       
         <section class="bg-[#5C3B1E] text-white py-20 text-center">
            <?php
            $logueado = is_session("usu");
            
            if(isset($_SESSION["tipo"]) && $logueado){
                if($_SESSION["tipo"] !="a"){
            ?>
                    <div class="text-center text-white font-bold text-2xl lg:text-4xl mb-4"><h1>¡ECHA UN VISTAZO A NUESTRAS PATATAS ASADAS!</h1></div>
                <?php
                }else{
                ?>
                    <div class="text-center text-white font-bold text-2xl lg:text-4xl  mb-4">
                        <h1>TODAS LAS PATATAS</h1>
                    </div>
                <?php
                }
            }else{
                ?>
                 <div class="text-center text-white font-bold text-2xl lg:text-4xl  mb-4"><h1>¡ECHA UN VISTAZO A NUESTRAS PATATAS ASADAS!</h1></div>
                 <?php
            }
                ?>
            
         </section>

        <section class="p-16">
            <?php
            //comprobamos que tenemos sesion
          
            $logueado = is_session("usu");
                if ($contador != 0) {
                    
                    if(($logueado && isset($_SESSION["tipo"]) && $_SESSION["tipo"] !="a") || !$logueado){
                        echo '<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-x-8 gap-y-14">';

                        for ($i = 0; $i < count($patatas); $i++) {
                           
                            echo '
                                <article class=" bg-[#F8E5B2] rounded-3xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col">
                                    <div class="relative h-56">
                                        <img src="'. $patatas[$i][4] .'" alt="patatas" class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                                    </div>
                                    <div class="flex flex-col justify-between flex-1 p-5">
                                        <div class="flex justify-between items-start mb-2">
                                            <h2 class="text-lg font-bold text-[#5C3B1E] max-w-[180px]">'. $patatas[$i][1] .'</h2>
                                            <p class="text-xl text-[#D9984D] font-bold whitespace-nowrap">'. $patatas[$i][2] .'€</p>
                                        </div>
                                        <p class="text-sm text-gray-600 line-clamp-2 mb-3">'. $patatas[$i][3] .'</p>
                                        <h3 class="text-lg font-bold text-[#5C3B1E] max-w-[180px]">Ingredientes: </h3>';
                                        
                                        echo '<div class="bg-gray-100 rounded-lg p-3 text-sm text-gray-700 h-20 overflow-hidden"> <p>';
                                        $ingredientesPatata=$patatas[$i][5]; 
                                        for ($j=0; $j < count($ingredientesPatata) ; $j++) { 
                                            echo $ingredientesPatata[$j];
                                            if ($j < count($ingredientesPatata) - 1) {
                                                echo ", ";
                                            }
                                        }
                                        echo '</p></div>';
                            echo'   </div>';
                            

                            if($logueado){
                                if($_SESSION["tipo"]!= "a"){
                                    ?>         
                                        <button onClick="agregarAlCarrito('<?= $patatas[$i][0] ?>','<?= $patatas[$i][1] ?>',<?= $patatas[$i][2] ?>,'<?= $patatas[$i][4] ?>')" class="cursor-pointer bg-[#5C3B1E] mx-3 mb-3 px-8 py-2 rounded-lg hover:bg-[#D9984D] text-white hover:text-[#8C512B] transition duration-300 font-bold">Añadir al carrito</button>
                                    <?php
                                }
                                
                            }
                            echo '</article>';
                        }
                        echo '</div>';
                    }else{
                        ?>
                        <!-- Vista desde administrador -->
                        <div class="text-center flex justify-center mt-10 pt-10 pb-10 m-auto mt-10 w-full lg:w-[80%]">
                            <?php
                                if(isset($patatas)){
                                    if(count($patatas)!=0){
                                       
                                        echo "<table class=\"w-full\">";
                                            echo "<thead class=\"hidden lg:table-header-group text-xl border-b\"><tr><th class=\"p-2 text-left\">Imagen</th><th class=\"p-2 text-left\">Patata</th><th class=\"p-2 text-left\">Precio</th><th class=\"p-2 text-left\">Descripción</th><th></th></tr></thead>";   

                                            for ($i=0; $i < count($patatas) ; $i++) { 
                                                echo "<tr class=\" flex flex-col lg:table-row p-4 lg:p-0 shadow-sm\">";
                                                echo "<td class=\"p-3 w-full lg:w-auto \">"?> <img class="w-[80%] lg:ml-0 mx-auto lg:w-50 rounded" src="<?php echo $patatas[$i][4]; ?>"><?php "</td>";
                                                for ($j=1; $j < count($patatas[$i])-2; $j++) { 
                                                    echo "<td class=\"p-3 text-lg lg:text-left text-center\">". $patatas[$i][$j] ."</td>";
                                                }
                                                echo "<td>";
                                                ?>  
                            
                                                    <form action="../controlador/index.php?action=modificacionPatata" method="post">
                                                        <input type="hidden" value="<?php echo $patatas[$i][0] ?>" name="idpatata">
                                                        
                                                        <input class="cursor-pointer" type="submit" value="Modificar">
                                                    
                                                    </form>
                                                <?php
                                                echo "</td></tr>";
                                            }
                                        echo "</table>";
                                    }else{
                                        echo "<p class=\" text-4xl\">No tienes Patatas</p>";
                                    }
                                }
                            ?>
                        </div>
                       
                        <?php
                    }
                } else {
                    echo '<div class="p-4 text-red-500 font-semibold">No hay patatas guardadas</div>';
                }
            ?>
        </section>
    </main>
    <?php require_once("footer.php"); ?>  
</body>
</html>