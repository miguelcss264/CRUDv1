<?php

class FormaDeVida extends EntidadEstelar {
    private $dieta;

    public function __construct($id, $nombre, $planetaOrigen, $nivelEstabilidad, $dieta) {
        parent::__construct($id, $nombre, $planetaOrigen, $nivelEstabilidad);
        $this->dieta = $dieta;
    }

    public function getDieta() {
        return $this->dieta;
    }

    public function setDieta($dieta) {
        $this->dieta = $dieta;
    }

    public function reaccionar() {
        return "La forma de vida '{$this->nombre}' emite señales bioquímicas desde {$this->planetaOrigen}.";
    }

    public function getTipo() {
        return 'FormaDeVida';
    }

    public function getCampoEspecial() {
        return $this->dieta;
    }

    public function setCampoEspecial($valor) {
        $this->dieta = $valor;
    }

    public function getNombreCampoEspecial() {
        return 'Dieta';
    }
}
