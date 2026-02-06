<?php

abstract class EntidadEstelar implements iInteractuable {
    protected $id;
    protected $nombre;
    protected $planetaOrigen;
    protected $nivelEstabilidad;

    public function __construct($id, $nombre, $planetaOrigen, $nivelEstabilidad) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->planetaOrigen = $planetaOrigen;
        $this->setNivelEstabilidad($nivelEstabilidad);
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getPlanetaOrigen() {
        return $this->planetaOrigen;
    }

    public function setPlanetaOrigen($planetaOrigen) {
        $this->planetaOrigen = $planetaOrigen;
    }

    public function getNivelEstabilidad() {
        return $this->nivelEstabilidad;
    }

    public function setNivelEstabilidad($nivelEstabilidad) {
        // Clamp entre 1 y 10
        $this->nivelEstabilidad = max(1, min(10, intval($nivelEstabilidad)));
    }

    abstract public function reaccionar();
    abstract public function getTipo();
    abstract public function getCampoEspecial();
    abstract public function setCampoEspecial($valor);
    abstract public function getNombreCampoEspecial();
}
