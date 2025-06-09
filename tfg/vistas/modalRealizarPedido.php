<?php
$usu = $_SESSION["usu"] ?? "nologueado";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
     <link rel="stylesheet" href="../css/style.css">
     <link rel="shortcut icon" href="../img/patata-asada.png" type="image/x-icon">
    <title>REDIRECCION</title>
</head>
<body class="cursor-default">
    <div class="fixed inset-0 flex items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-lg p-8 text-center max-w-sm">
            <h2 class="text-2xl font-semibold text-green-600 mb-2">¡Pedido realizado!</h2>
            <p class="text-gray-700">Estamos redirigiéndote a la página principal...</p>
        </div>
    </div>

    <!-- Script para esperar 3 segundos en la vista y redirigir a la pagina principal -->
    <script>
        localStorage.removeItem("carrito_<?php echo $usu; ?>");
        setTimeout(function() {
            window.location.href = "../controlador/index.php";
        }, 3000);
    </script>
</body>
</html>