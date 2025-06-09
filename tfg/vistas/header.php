<?php
require_once("../modelo/sessionesCookies.php");
// start_session(); COMPROBAR SI FUNCIONA SI NESTO, SI NO LO DESCOMENTO, LO MISMO ENM EL CONTROLADOR
$logueado = is_session("usu");
$nombreUsuario = $logueado ? get_session("usu") : null;
$paginaActual = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$paginaPrincipal = $paginaActual === 'index.php' && empty($_GET);
?>
<!-- bg-orange-400  text-amber-950 -->
<header class=" w-full z-999 <?= $paginaPrincipal ? 'fixed top-0 left-0' : 'sticky top-0' ?>">
  <div id="divHeader" class="flex justify-between items-center p-5 transition-colors duration-300 ease-in-out  font-bold <?= $paginaPrincipal ? 'text-white bg-transparent' : 'bg-[#5C3B1E] text-[#FFE08A]' ?>">
    <div>
      <a href="index.php">  
      <img src="../img/patata-asada.png" alt="Logo" class="w-10"></a>
    </div>

    <!-- Botón de menú móvil (solo visible en móvil) -->
    <button id="mobil-menu-button" class="md:hidden focus:outline-none cursor-pointer">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
      </svg>
    </button>

    <div class="hidden md:flex md:justify-between md:w-[50%]">
      <a href="index.php?action=verCarta" class="relative inline-block after:absolute after:left-0 after:bottom-0 after:h-[3px] after:w-0 after:bg-orange-400 after:transition-all after:duration-300 hover:after:w-full">CARTA</a>
      
      <a href="index.php?action=contacto" class="relative inline-block after:absolute after:left-0 after:bottom-0 after:h-[3px] after:w-0 after:bg-orange-400 after:transition-all after:duration-300 hover:after:w-full">CONTACTO</a>
      <a href="index.php?action=sobreNosotros" class="relative inline-block after:absolute after:left-0 after:bottom-0 after:h-[3px] after:w-0 after:bg-orange-400 after:transition-all after:duration-300 hover:after:w-full">SOBRE NOSOTROS</a>
      <?php
        if($logueado){
          if($_SESSION["tipo"]=="a"){
            ?>
              <a href="index.php?action=verPedidosAdmin"  class="relative inline-block after:absolute after:left-0 after:bottom-0 after:h-[3px] after:w-0 after:bg-orange-400 after:transition-all after:duration-300 hover:after:w-full">PEDIDOS</a>
            <?php
          }else{
            ?>
              <a href="index.php?action=verPedidosUsuario" class="relative inline-block after:absolute after:left-0 after:bottom-0 after:h-[3px] after:w-0 after:bg-orange-400 after:transition-all after:duration-300 hover:after:w-full">PEDIDOS</a>
          <?php
          }
          ?>
          
          <?php
        }
      ?>
    </div>

    <div class="hidden md:flex md:items-center">
      <?php if ($logueado): ?>
        <?php
          if($_SESSION["tipo"]!="a"){
            ?>
              <a href="index.php?action=verPerfil" class="mr-5">
                <span class=" border-2 border-[#FFE08A] rounded-full flex items-center justify-center transition-all duration-300 hover:shadow-md">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#FFE08A] transition-colors duration-300 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4
                        v2h16v-2c0-2.66-5.33-4-8-4z"/>
                  </svg>
                </span>
              </a>
            <?php
          }else{
            ?>  
              <span class="mr-5 relative inline-block after:absolute after:left-0 after:bottom-0 after:h-[3px] after:w-0 after:bg-orange-400 after:transition-all after:duration-300 hover:after:w-full">Hola <?= htmlspecialchars($nombreUsuario) ?></span>
            <?php
          }
        ?>
        
        <!-- poner que solo aparezca para los usuarios normales -->
        <?php
          if($_SESSION["tipo"]!="a"){  
        ?>
        <div  onmouseenter="cargarCarrito()" class="carritoCompras relative inline-block text-left group">
          <!-- Botón del carrito -->
          <button class="flex items-center bg-amber-950  text-white px-4 py-2 rounded hover:bg-gray-700 transition">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="20"
              height="20"
              fill="currentColor"
              viewBox="0 0 16 16"
              class="mr-2"
            >
              <path
                d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"
              />
            </svg>
          </button>

          <!--esto aparece al hacer hover pop up del carrito -->
          <div class="compras absolute right-0 mt-2 w-[300px] md:w-[600px] bg-[#F8E5B2] text-black text-center p-4 rounded shadow-lg z-10 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition duration-200">
            <div id="compraDinamica">
            </div>    
          </div>
    
        </div>
        <?php
          }
        ?>
        <form action="../controlador/index.php?action=logout" method="post" class="ml-4 text-red-600">
          <input type="submit" value="Cerrar Sesión" class="cursor-pointer">
        </form>
      <?php else: ?>
        <a href="index.php?action=login" class="relative inline-block after:absolute after:left-0 after:bottom-0 after:h-[3px] after:w-0 after:bg-orange-400 after:transition-all after:duration-300 hover:after:w-full">INICIAR SESIÓN</a>
      <?php endif; ?>
    </div>

  </div>

<!-- Menú hamburguesa -->
<div id="mobil-menu" class="fixed top-16 left-0 right-0 hidden md:hidden bg-[#5C3B1E] text-[#FFE08A] w-full px-5 pb-5 transform transition-all duration-300 ease-in-out origin-top scale-y-0">
  <div class="flex flex-col space-y-4 pt-5">

    <a href="index.php?action=verCarta" class="block py-2 hover:underline decoration-orange-400 transition">CARTA</a>
    <a href="index.php?action=contacto" class="block py-2 hover:underline decoration-orange-400 transition">CONTACTO</a>
    <a href="index.php?action=sobreNosotros" class="block py-2 hover:underline decoration-orange-400 transition">SOBRE NOSOTROS</a>

    <?php if($logueado): ?>
      <?php if($_SESSION["tipo"]=="a"): ?>
        <a href="index.php?action=verPedidosAdmin" class="block py-2 hover:underline decoration-orange-400 transition">PEDIDOS</a>
      <?php else: ?>
        <a href="index.php?action=verPedidosUsuario" class="block py-2 hover:underline decoration-orange-400 transition">PEDIDOS</a>
      <?php endif; ?>

      <?php if($_SESSION["tipo"]!="a"): ?>
        <a href="index.php?action=verPerfil" class="block py-2 hover:underline decoration-orange-400 transition">MI PERFIL</a>

        <div class="block py-2">
          <a href="index.php?action=verPedido" class="flex items-center text-left hover:underline decoration-orange-400 transition w-full"> 
            <svg xmlns="http://www.w3.org/2000/svg" 
                 class="w-5 h-5 mr-2" 
                 fill="none" 
                 viewBox="0 0 24 24" 
                 stroke="currentColor" 
                 stroke-width="1.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 6h13a1 1 0 001-1V6M7 13h10M9 21a1 1 0 100-2 1 1 0 000 2zm8 0a1 1 0 100-2 1 1 0 000 2z" />
            </svg>CARRITO
          </a>
      <?php endif; ?>

      <form action="../controlador/index.php?action=logout" method="post">
        <button type="submit" class="w-full text-left py-2 cursor-pointer text-red-400 hover:text-red-300 transition">
          CERRAR SESIÓN
        </button>
      </form>

    <?php else: ?>
      <a href="index.php?action=login" class="block py-2 hover:underline cursor-pointer decoration-orange-400 transition">INICIAR SESIÓN</a>
    <?php endif; ?>

  </div>
</div>
</header>

<?php 
    if($paginaPrincipal):
?>
<script src="../scripts/script_menu.js"></script>

<?php endif; ?>
<script>
  // Toggle del menú móvil
 document.getElementById('mobil-menu-button').addEventListener('click', function () {
  const menu = document.getElementById('mobil-menu');

  // Si el menú está oculto
  if (menu.classList.contains('hidden') || menu.classList.contains('scale-y-0')) {
    menu.classList.remove('hidden');
    setTimeout(() => {
      menu.classList.remove('scale-y-0');
      menu.classList.add('scale-y-100');
    }, 10); // Delay pequeño para que la animación ocurra
  } 
  // Si el menú está visible
  else {
    menu.classList.remove('scale-y-100');
    menu.classList.add('scale-y-0');
    setTimeout(() => {    
      menu.classList.add('hidden');
    }, 300); // Debe coincidir con duration-300
  }
});
  
 
</script>
<script>
  const usuactual= <?= json_encode($nombreUsuario)?>;//guardamos el nombre de usuario que essta logueado
</script>
<script src="../scripts/script_carrito.js"></script>