<?php
class Revista extends Publicacion{
    protected $color;
    protected $tematica;

    public function __construct($isbn, $color, $tematica){
        parent::__construct($isbn);
        $this->color=$color;
        $this->tematica=$tematica;
    }

    public function setColor($color){
        $this->color = $color;
    }

    public function setTematica($tematica){
        $this->tematica = $tematica;
    }
}