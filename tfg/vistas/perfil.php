<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="../img/patata-asada.png" type="image/x-icon">
    <title>MI PERFIL</title>
</head>
<body class="cursor-default">
    <?php
        require_once("header.php");
    ?>

    <main>
        <section>
            <div class="flex  justify-center flex-col items-center h-screen">
                <div class="w-[90%] lg:w-[50%] shadow-md p-5 rounded-xl font-bold flex flex-col items-center bg-[#F8E5B2] mt-10 mb-7">
                    <h2 class="font-bold text-[#8C512B] text-3xl mb-5">Mis Datos</h2>
                        <?php
                        if(isset($datosUsuario)){
                        ?>
                        <div class="w-full lg:w-[90%] 2xl:w-[50%]">
                            <form action="../controlador/index.php?action=modificarPerfil" class="flex flex-col mb-7" method="post" enctype="multipart/form-data">
                                <label for="nombre" class="text-[#8C512B] mb-2">Nombre Usuario:</label>
                                <input type="text" class="mb-5 text-black rounded-md p-2 bg-white" required name="nombre" value="<?php echo $datosUsuario[0] ?>">
 
                                <label for="ape" class="text-[#8C512B]  mb-2">Apellidos:</label>
                                <input type="text" step="0.1" min="0" class="mb-5 text-black rounded-md p-2 bg-white" required name="ape" value="<?php echo $datosUsuario[1] ?>">

                                <label for="tlf" class="text-[#8C512B]  mb-2">Teléfono:</label>
                                <input type="tel" class="mb-5 w-full lg:w-[50%] text-black rounded-md p-2 bg-white" oninput="this.value = this.value.replace(/[^0-9]/g, '')" name="tlf" maxlength="9" pattern="^[6|7][0-9]{8}$" required value="<?php echo $datosUsuario[2] ?>">
                        <?php
                        }
                        ?>
                                <input type="hidden" value="<?php echo $_SESSION["idUsu"] ?>" name="idusuMod">
                                <input type="submit"  class="bg-[#5C3B1E] cursor-pointer px-8 py-3 rounded-lg hover:bg-[#D9984D] text-white hover:text-[#8C512B] transition duration-300 font-bold w-full lg:w-[50%]" value="Modificar Datos">
                            </form>
                            <div class="w-full ">
                                <a class="mt-4 w-full lg:w-[50%] text-center inline-block px-6 py-2 border border-[#8C512B] text-[#8C512B] rounded-md hover:bg-[#D9984D] hover:text-white transition duration-300" href="../controlador/index.php">Volver</a>
                            </div>
                            
                        </div>
                    </div>
            </div>
        </section>
        
    </main>

    <?php
        require_once("footer.php");
    ?>
</body>
</html>