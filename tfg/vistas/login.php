
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="../img/patata-asada.png" type="image/x-icon">
    <title>INICIAR-SESION</title>
</head>
<body class="bg-neutral-100 cursor-default">
    <?php
        require_once("header.php");
    ?>
    <main>
        <section class="flex justify-center flex-col xl:flex-row  items-center">
            <div class="hidden xl:block xl:w-[50%] h-screen bg-[url('../img/pasada.webp')] bg-cover bg-center">
            </div>

            <div class="w-full xl:w-[50%] flex bg-[#F8E5B2] justify-center items-center text-center h-screen">
                <div class=" w-[90%] xl:w-[50%] h-full rounded-lg flex justify-center items-center flex-col">
                    <div class="p-7">
                        <h1 class="text-[#5C3B1E] text-2xl font-bold">INICIA SESIÓN</h1>
                        <p class="text-[#5C3B1E] font-bold">Inicia sesion y realiza tu pedido</p>
                    </div>
                
                    <div class="w-full lg:w-[50%] xl:w-[80%]">
                        <?php     
                        
                            if (isset($_SESSION['errorIniciar'])) {
                                echo '<p class="text-red-600 font-semibold mb-4">' . htmlspecialchars($_SESSION['errorIniciar']) . '</p>';
                                unset($_SESSION['errorIniciar']);
                            }
                        ?>
                        <form action="../controlador/index.php?action=iniciarSesion" method="post" class="flex w-full flex-col items-center">
                            <input type="text" class="bg-white p-2 rounded-lg w-full" name="nombre" placeholder="Usuario" required>
                            <input type="email" name="email" placeholder="Email" class="bg-white mt-5 p-2 rounded-lg w-full" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Introduce un correo válido" required >
                            <input type="password" class="bg-white p-2 mt-5 mb-5 rounded-lg w-full" name="pw" placeholder="Contraseña" required>                        
                            <input type="submit" class="cursor-pointer lg:w-[50%] bg-[#5C3B1E] mb-3 mt-5 px-8 py-2 w-full rounded-lg hover:bg-[#D9984D] text-white hover:text-[#8C512B] transition duration-300 font-bold" value="Iniciar Sesion" >
                        </form>
                        
                        <div class="flex justify-between items-center flex-col">
                            <div class="flex text-yellow-600 gap-2 font-bold items-center justify-center w-full">
                            <p>¿No tienes cuenta?</p> 
                            <a href="../controlador/index.php?action=registro">Regístrate</a>
                            </div>
                            <a href="../controlador/index.php" class="mt-4 w-full lg:w-[50%] text-center inline-block px-6 py-2 border border-[#8C512B] text-[#8C512B] rounded-md hover:bg-[#D9984D] hover:text-white transition duration-300">Volver</a>
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