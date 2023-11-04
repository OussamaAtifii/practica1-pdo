<?php

use App\Models\Producto;
use App\Utils\Utils;

// Inicia la sesión y carga las clases necesarias
session_start();
require_once __DIR__ . "/../vendor/autoload.php";

// Verifica si se ha enviado el formulario
if (isset($_POST['btn'])) {
    // Obtiene y sanitiza los datos del formulario
    $name = htmlspecialchars(trim($_POST['name']));
    $price = (float) trim($_POST['price']);
    $errores = false;

    // Verifica errores en el nombre
    if (Utils::textError("Nombre", $name, 5)) {
        $errores = true;
    }

    // Verifica errores en el precio
    if (Utils::numError("Precio", $price, 1, 9000)) {
        $errores = true;
    }

    // Si hay errores, redirige a la misma página
    if ($errores) {
        header("Location:{$_SERVER['PHP_SELF']}");
        die();
    }

    // Crea un nuevo producto y lo guarda en la base de datos
    (new Producto)->setNombre($name)
        ->setPrecio($price)
        ->create();

    // Establece un mensaje de éxito y redirige a la página principal
    $_SESSION['mensaje'] = "Producto creado correctamente";
    header("Location:index.php");
} else {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Crear Productos</title>

        <!-- Enlaces a bibliotecas externas (Tailwind, FontAwesome, SweetAlert) -->
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>

    <body class="flex items-center justify-center h-screen">
        <!-- Formulario para agregar productos -->
        <form class="w-1/3 mx-auto" autocomplete="off" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <!-- Campo de entrada para el nombre del producto -->
            <div class="relative z-0 w-full mb-6 group">
                <input type="text" name="name" id="name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="name" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nombre</label>
                <?php Utils::showErrors('Nombre') ?>
            </div>

            <!-- Campo de entrada para el precio del producto -->
            <div class="relative z-0 w-full mb-6 group">
                <input type="number" name="price" id="price" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="price" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Precio</label>
                <?php Utils::showErrors('Precio') ?>
            </div>

            <!-- Botón para enviar el formulario -->
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center" name="btn">Añadir</button>
        </form>
    </body>

    </html>

<?php
}
?>