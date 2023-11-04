<?php

use App\Models\Producto;

session_start();
require_once __DIR__ . "/../vendor/autoload.php";

if (!isset($_POST['id'])) {
    $_SESSION['error'] = "No se encontró el producto";
    header("Location:index.php");
    die();
}

Producto::delete(htmlspecialchars(trim($_POST['id'])));

$_SESSION['mensaje'] = "Producto eliminado correctamente";
header("Location:index.php");
