<?php
class GestorPublicacion{
    protected $biblioteca;


    public function __construct(){
        $this->biblioteca=[];
    }

    public function anyadir($publicacion){
        $this->biblioteca[]=$publicacion;

    }

    public function listar(){
        return $this->biblioteca;
    }

    public function buscar($isbn){
        foreach ($this->biblioteca as $publicacion){
            if  ($publicacion->getIsbn()==$isbn){
                return $publicacion;
            }
        }
    }

    public function actualizarLibro($isbn, $editorial, $paginas){
        foreach ($this->biblioteca as $i=>$publicacion) {
            if ($publicacion->getIsbn()==$isbn) {
                $this->biblioteca[$i]->setEditorial($editorial);
                $this->biblioteca[$i]->setPaginas($paginas);
            }
        }
    }

    public function actualizarRevista($isbn, $color, $tematica){
        foreach ($this->biblioteca as $i=>$publicacion) {
            if ($publicacion->getIsbn()==$isbn) {
                $this->biblioteca[$i]->setColor($color);
                $this->biblioteca[$i]->setTematica($tematica);
            }
        }
    }

    public function eliminar($isbn){
        foreach ($this->biblioteca as $i=>$publicacion) {
            if ($publicacion->getIsbn()==$isbn) {
                unset($this->biblioteca[$i]);
                $this->biblioteca=array_values($this->biblioteca);
            }
        }
    }
}