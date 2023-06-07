<?php
//conexion a mongo
$mongo=new MongoDB\Driver\Manager("mongodb://localhost:27017/ViajeSeguro");

echo "Conexion exitosa";