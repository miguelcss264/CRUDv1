<?php

class Publicacion{

    protected $isbn;

    public function __construct($isbn){
        $this->isbn=$isbn;
    }

    public function getIsbn(){
        return $this->isbn;
    }
}