<?php
include "conexion.php";

//seleccionar los datos de la coleccion Reservas y eliminar la reserva con el id seleccionado
$id = $_GET['id'];
$bulk = new MongoDB\Driver\BulkWrite;
$bulk->delete(['_id' => new MongoDB\BSON\ObjectId($id)]);
$mongo->executeBulkWrite('ViajeSeguro.Reservas', $bulk);

//redirigir a la pagina de verReserva
echo "<script>alert('Reserva eliminada con exito')</script>";
echo "<script>window.location.replace('../php/verReserva.php')</script>";

