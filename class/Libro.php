<?php
class Libro extends Publicacion{
    protected $editorial;
    protected $paginas;

    public function __construct($isbn, $editorial, $paginas){
        parent::__construct($isbn);
        $this->editorial=$editorial;
        $this->paginas=$paginas;
    }

    public function setEditorial($editorial){
        $this->editorial = $editorial;
    }

    public function setPaginas($paginas){
        $this->paginas = $paginas;
    }
}