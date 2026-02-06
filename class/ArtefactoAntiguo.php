<?php

class ArtefactoAntiguo extends EntidadEstelar {
    private $antiguedad;

    public function __construct($id, $nombre, $planetaOrigen, $nivelEstabilidad, $antiguedad) {
        parent::__construct($id, $nombre, $planetaOrigen, $nivelEstabilidad);
        $this->antiguedad = $antiguedad;
    }

    public function getAntiguedad() {
        return $this->antiguedad;
    }

    public function setAntiguedad($antiguedad) {
        $this->antiguedad = $antiguedad;
    }

    public function reaccionar() {
        return "El artefacto '{$this->nombre}' resuena con energía ancestral de hace {$this->antiguedad} años.";
    }

    public function getTipo() {
        return 'ArtefactoAntiguo';
    }

    public function getCampoEspecial() {
        return $this->antiguedad;
    }

    public function setCampoEspecial($valor) {
        $this->antiguedad = $valor;
    }

    public function getNombreCampoEspecial() {
        return 'Antigüedad (años)';
    }
}
