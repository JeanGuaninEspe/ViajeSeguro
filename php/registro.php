<?php
require 'conexion.php';
//tomar los datos del formulario Nombre, Apellido, Username, Password
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$usuario = $_POST['username'];
$pass = $_POST['password'];
$email = $_POST['email'];

//verificar que el usuario no exista en la base de datos de pasajeros
$busqueda = new MongoDB\Driver\Query(['username' => $usuario]);
$cursor = $mongo->executeQuery('ViajeSeguro.pasajero', $busqueda);

//si el usuario no existe se crea el nuevo pasajero
if($cursor->toArray() == null){
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->insert(['nombre' => $nombre, 'apellido' => $apellido, 'username' => $usuario, 'password' => $pass, 'email' => $email]);
    $mongo->executeBulkWrite('ViajeSeguro.Pasajeros', $bulk);
    echo "<script>alert('Usuario registrado exitosamente');</script>";
    echo "<script>window.location.replace('../html/login.html');</script>";
    exit;
}
//si el usuario ya existe se redirige a la pagina de registro y si se registra un nuevo usuario se redirige a la pagina de login
echo "<script>alert('El usuario ya existe o no se pudo registrar, intente nuevamente');</script>";
echo "<script>window.location.replace('../html/registro.html');</script>";
exit;
