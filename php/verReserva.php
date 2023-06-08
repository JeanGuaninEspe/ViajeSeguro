<?php
require 'conexion.php';
//tomar el usuario de la variable de sesion
session_start();
$usuario = $_SESSION['username'];

//buscar en la base de datos las reservas del usuario
$busqueda = new MongoDB\Driver\Query(['username' => $usuario]);
$cursor = $mongo->executeQuery('ViajeSeguro.Reservas', $busqueda);

//mostrar las reservas en una tabla
echo "<table border='1'>";
echo "<tr><td>Nombre</td><td>Apellido</td><td>Correo</td><td>Fecha</td></tr>";
foreach ($cursor as $document) {
    echo "<tr>";
    echo "<td>" . $document->nombre . "</td>";
    echo "<td>" . $document->apellido . "</td>";
    echo "<td>" . $document->correo . "</td>";
    echo "<td>" . $document->fecha . "</td>";
    //boton eliminar que borra la reserva
    echo "<td><a href='eliminar.php?id=" . $document->_id . "'>Eliminar</a></td>";
    echo "</tr>";
}
echo "</table>";

echo "<br><br><a href='../php/pasajero.php' id='volver'>Volver</a>";
echo '<style>
   table{
               border-collapse: collapse;
                width: 100%;
                color: #588c7e;
                font-family: monospace;
                font-size: 25px;
                text-align: center;
            }
            th{
                background-color: #588c7e;
                color: white;
            }
            tr:nth-child(even){background-color: #f2f2f2
            
   }
    #volver{
        text-decoration: none;
        color: #588c7e;
        font-family: monospace;
        font-size: 25px;
        margin-left: 45%;
        text-align: center;
        padding: 5px;
      
        
    }
    #volver:hover{
        color: #f2f2f2;
        background-color: #588c7e;
        border-radius: 10px;
        transition: all 0.3s ease-in-out;
        
    }
    a{
        text-decoration: none;
        color: #588c7e;
        font-family: monospace;
        font-size: 25px;
        text-align: center;
        
    
    }
    a:hover{
        color: #f2f2f2;
        background-color: #588c7e;
        border-radius: 10px;
        transition: all 0.3s ease-in-out;
        
    }
    
        </style>'

?>

