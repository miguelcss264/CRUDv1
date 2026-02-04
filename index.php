<?php
require_once "autoload.php";
$miBiblio=new GestorPublicacion();

for ($i=1; $i <= 25 ; $i++) { 
    $libro=new Libro(($i*2)+1, "Editorial$i", $i*5);
    $miBiblio->anyadir($libro);
}
for ($i=1; $i <= 25 ; $i++) { 
    $revista=new Revista(($i*2), rand(0,1), "tematica$i");
    $miBiblio->anyadir($revista);
}

var_dump($miBiblio);

$miBiblio->actualizarLibro(3,"ACTUALIZADO",0);
$miBiblio->actualizarRevista(2,"ACTUALIZADA", "ACTUALIZADO");

var_dump($miBiblio);

$miBiblio->eliminar(20);
$miBiblio->eliminar(21);

var_dump($miBiblio);