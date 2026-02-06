<?php
class GestorPublicacion{
    
    public function __construct(){
        if (!isset($_SESSION['publicaciones'])){
            $_SESSION['publicaciones']=[];
        }
    }

    public function anyadir($publicacion){
        $_SESSION['publicaciones'][]=$publicacion;
    }

    public function listar(){
        return $_SESSION['publicaciones'];
    }

    public function buscar($isbn){
        foreach ($_SESSION['publicaciones'] as $publicacion){
            if  ($publicacion->getIsbn()==$isbn){
                return $publicacion;
            }
        }
    }

    public function actualizarLibro($isbn, $editorial, $paginas){
        foreach ($_SESSION['publicaciones'] as $i=>$publicacion) {
            if ($publicacion->getIsbn()==$isbn) {
                $_SESSION['publicaciones'][$i]->setEditorial($editorial);
                $_SESSION['publicaciones'][$i]->setPaginas($paginas);
            }
        }
    }

    public function actualizarRevista($isbn, $color, $tematica){
        foreach ($_SESSION['publicaciones'] as $i=>$publicacion) {
            if ($publicacion->getIsbn()==$isbn) {
                $_SESSION['publicaciones'][$i]->setColor($color);
                $_SESSION['publicaciones'][$i]->setTematica($tematica);
            }
        }
    }

    public function eliminar($isbn){
        foreach ($_SESSION['publicaciones'] as $i=>$publicacion) {
            if ($publicacion->getIsbn()==$isbn) {
                unset($_SESSION['publicaciones'][$i]);
                $_SESSION['publicaciones']=array_values($_SESSION['publicaciones']);
            }
        }
    }
}