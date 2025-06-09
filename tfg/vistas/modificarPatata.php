<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="../img/patata-asada.png" type="image/x-icon">
    <title>MODIFICAR PATATA</title>
</head>
<body class="cursor-default">
    <?php
        require_once("header.php");
    ?>
    <main>
        <section>
            <div class="flex justify-center flex-col items-center h-screen">
                <div class="w-[90%] lg:w-[50%] p-5 rounded-xl font-bold flex flex-col bg-[#F8E5B2] mt-10 mb-7">
                    <h2 class="font-bold text-[#8C512B] text-xl mb-5">Modificar Patata</h2>
                        <?php
                        if(isset($patataModificada)){
                        ?>
                            <form action="../controlador/index.php?action=cambiarPatata" class="flex flex-col" method="post" enctype="multipart/form-data">
                                <label for="nombre" class="text-[#8C512B]">Nombre Patata:</label>
                                <input type="text" class="mb-5 border w-full text-black rounded-md p-2 bg-white" required name="nombre" value="<?php echo $patataModificada[0] ?>"><br>
                                <label for="precio" class="text-[#8C512B]">Precio:</label>
                                <input type="number" step="0.1" min="0" class="mb-5 border w-30 text-black rounded-md p-2 bg-white" required name="precio" value="<?php echo $patataModificada[1] ?>"><br>
                                <label for="descri" class="text-[#8C512B]">Descripción:</label><br>
                                <input type="text" class="mb-5 border w-full text-black rounded-md p-2 bg-white" required name="descri" value="<?php echo $patataModificada[2] ?>"><br>
                        <?php
                        }
                        ?>
                                <input type="file" class="w-full lg:w-[45%] mb-5 border rounded-md p-2 cursor-pointer text-[#8C512B]" name="img"><br>
                                <input type="hidden" value="<?php echo $_POST["idpatata"] ?>" name="idpatataMod">
                                <input type="hidden" value="<?php echo $patataModificada[3] ?>" name="urlpatataMod">
                                <input type="submit"  class="cursor-pointer lg:w-[50%] bg-[#5C3B1E] mb-3 mt-5 px-8 py-2 w-full rounded-lg hover:bg-[#D9984D] text-white hover:text-[#8C512B] transition duration-300 font-bold" value="Cambiar Patata"><br>
                            </form>
                            <a class="mt-4 w-full lg:w-[50%] text-center inline-block px-6 py-2 border border-[#8C512B] text-[#8C512B] rounded-md hover:bg-[#D9984D] hover:text-white transition duration-300" href="../controlador/index.php">Volver</a>
                </div>
            </div>
        </section>
        
    </main>
    <?php
        require_once("footer.php");
    ?>
</body>
</html>