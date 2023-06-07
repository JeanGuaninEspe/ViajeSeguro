<?php
include "conexion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el parámetro "accion" enviado desde el formulario
    $accion = $_POST['accion'];
    // Llamar la función que corresponda según la acción recibida
    if ($accion === "login"){
        Login();}
}
function Login(){
    include "conexion.php";

    $usuario = $_POST['username'];
    $pass = $_POST['password'];
    //buscar en la base de datos el usuario y contraseña en las colecciones de pasajero y admins
    $busqueda = new MongoDB\Driver\Query(['username' => $usuario, 'password' => $pass]);
    $busqueda2 = new MongoDB\Driver\Query(['username' => $usuario, 'password' => $pass]);
//si el usuario es un pasajero se redirige a la pagina de pasajero y si es admin a la pagina de admin
    $cursor = $mongo->executeQuery('ViajeSeguro.Pasajeros', $busqueda);
    $cursor2 = $mongo->executeQuery('ViajeSeguro.Admins', $busqueda2);

//si el usuario es un pasajero se redirige a la pagina de pasajero y si es admin a la pagina de admin
    foreach ($cursor as $document) {
        header("Location: ../html/pasajero.html");
        exit;
    }
    foreach ($cursor2 as $document) {
        header("Location: ../html/admin.html");
        exit;
    }
//si no se encuentra el usuario en ninguna de las colecciones se redirige a la pagina de login
    header("Location: ../html/login.html");
    exit;



}
