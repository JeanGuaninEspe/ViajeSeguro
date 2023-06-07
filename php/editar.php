<?php
include 'conexion.php';
//mostrar los datos del pasajero de la coleccion pasajeros en un input para que puedan ser editados
session_start();
$usuario = $_SESSION['username'];
echo "<h1>Editar datos</h1>";
$busqueda = new MongoDB\Driver\Query(['username' => $usuario]);
$cursor = $mongo->executeQuery('ViajeSeguro.Pasajeros', $busqueda);
foreach ($cursor as $document) {
    echo "<form action='editar.php' method='POST'>";
    echo "<input type='text' name='nombre' value='" . $document->nombre . "'><br>";
    echo "<input type='text' name='apellido' value='" . $document->apellido . "'><br>";
    echo "<input type='text' name='email' value='" . $document->email . "'><br>";
    echo "<input type='text' name='username' value='" . $document->username . "'><br>";
    echo "<input type='submit' value='Actualizar'>";
    echo "</form>";
    echo "<a href='../html/pasajero.html'>Volver</a>";
}
//tomar los datos del formulario y actualizarlos en la coleccion pasajeros
if (isset($_POST['nombre'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['email'];
    $username = $_POST['username'];
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->update(['username' => $usuario], ['$set' => ['nombre' => $nombre, 'apellido' => $apellido, 'email' => $correo, 'username' => $username]]);
    $mongo->executeBulkWrite('ViajeSeguro.Pasajeros', $bulk);
    echo "<script>alert('Datos actualizados con exito')</script>";
    echo "<script>window.location.replace('../html/pasajero.html')</script>";
}

echo'<style>
    input{
    width: 200px;
    height: 30px;
    border-radius: 5px;
    border: 1px solid #588c7e;
    margin: 10px;
    font-family: monospace;
    font-size: 15px;
    text-align: center;
    }
    input[type=submit]{
     color: #f2f2f2;
    background-color: #588c7e;
    border: 1px solid #588c7e;
    border-radius: 5px;
    transition: 0.5s;
    font-size: 20px;
    
    }
    input[type=submit]:hover{
    background-color: #f2f2f2;
    color: #588c7e;
    
   
    }
    body{
    background-color: #f2f2f2;
    
    }
    
    /*centrar el formulario*/
    form{
    margin-left: 40%;
 
    
    }
    h1{
    margin-left: 40%;
    margin-top: 10%;
    font-family: monospace;
    font-size: 30px;
    }
    a{
    text-decoration: none;
background-color: #588c7e;
    font-family: monospace;
    font-size: 20px;
    margin-left: 8%;
    text-align: center;
    padding: 5px;
    border-radius: 5px;
    color: white;
    border: 1px solid #588c7e;
        transition: 0.5s;
   font-size: 20px;

    
    }
    a:hover{
    background-color: #f2f2f2;
    color: #588c7e;
    
    }
</style>'
?>
