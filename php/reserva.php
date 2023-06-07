<?php
include 'conexion.php';
//tomar los datos del formulario Nombre, Apellido, correo,fecha
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$correo = $_POST['correo'];
$fecha = $_POST['fecha'];
session_start();
$usuario = $_SESSION['username'];

 //insertar los datos en colección reserva solo si estan completos ademas agregar el username del usuario logueado, evitar que se ingrese una fecha anterior a la actual
if ($nombre != "" && $apellido != "" && $correo != "" && $fecha != "" && $fecha > date("Y-m-d")) {
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->insert(['nombre' => $nombre, 'apellido' => $apellido, 'correo' => $correo, 'fecha' => $fecha, 'username' => $usuario]);
    $mongo->executeBulkWrite('ViajeSeguro.Reservas', $bulk);
    echo "<script>alert('Reserva realizada con exito')</script>";
    echo "<script>window.location.replace('../html/pasajero.html')</script>";
} else {
    echo "<script>alert('Error al realizar la reserva')</script>";
    echo "<script>window.location.replace('../html/reserva.html')</script>";
}