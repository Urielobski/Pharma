<?php

$idProducto = $_GET['id'];

$conex = mysqli_connect("localhost:3306", "root", "", "crud_productos");
$consultaEliminar = "DELETE FROM insumos WHERE id = $idProducto";
$resultEliminar = mysqli_query($conex, $consultaEliminar);
mysqli_close($conex);
header("Location:  ./insumos.php");

?>