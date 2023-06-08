<?php

require 'conexion.php';

//tomar los datos del formulario login, username y password
$usuario = $_POST['username'];
$pass = $_POST['password'];

//almacenar el usuario en una variable de sesion
session_start();
$_SESSION['username'] = $usuario;

//buscar en la base de datos el usuario y contraseña en las colecciones de pasajero y admins
$busqueda = new MongoDB\Driver\Query(['username' => $usuario, 'password' => $pass]);
$busqueda2 = new MongoDB\Driver\Query(['username' => $usuario, 'password' => $pass]);
//si el usuario es un pasajero se redirige a la pagina de pasajero y si es admin a la pagina de admin
$cursor = $mongo->executeQuery('ViajeSeguro.Pasajeros', $busqueda);
$cursor2 = $mongo->executeQuery('ViajeSeguro.Admins', $busqueda2);

//si el usuario es un pasajero se redirige a la pagina de pasajero y si es admin a la pagina de admin
foreach ($cursor as $document) {
    header("Location: ../php/pasajero.php");
    exit;
}
foreach ($cursor2 as $document) {
    header("Location: ../html/admin.html");
    exit;
}
//si no se encuentra el usuario en ninguna de las colecciones se redirige a la pagina de login
header("Location: ../html/login.html");
exit;