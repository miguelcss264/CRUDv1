<?php

class GestorSesion implements iGestor {
    private $sessionKey = 'entidades_estelares';

    public function __construct() {
        if (!isset($_SESSION[$this->sessionKey])) {
            $_SESSION[$this->sessionKey] = [];
        }
    }

    public function obtenerTodos() {
        return $_SESSION[$this->sessionKey];
    }

    public function guardar($entidad) {
        if ($entidad->getId() === null || $entidad->getId() === '') {
            // Crear nueva entidad con ID autogenerado
            $entidad = $this->generarNuevaEntidad($entidad);
        } else {
            // Actualizar entidad existente
            $this->actualizar($entidad);
            return;
        }
        $_SESSION[$this->sessionKey][] = $entidad;
    }

    private function generarNuevaEntidad($entidad) {
        $nuevoId = $this->generarIdUnico();
        $tipo = $entidad->getTipo();
        
        switch ($tipo) {
            case 'FormaDeVida':
                return new FormaDeVida(
                    $nuevoId,
                    $entidad->getNombre(),
                    $entidad->getPlanetaOrigen(),
                    $entidad->getNivelEstabilidad(),
                    $entidad->getDieta()
                );
            case 'MineralRaro':
                return new MineralRaro(
                    $nuevoId,
                    $entidad->getNombre(),
                    $entidad->getPlanetaOrigen(),
                    $entidad->getNivelEstabilidad(),
                    $entidad->getDureza()
                );
            case 'ArtefactoAntiguo':
                return new ArtefactoAntiguo(
                    $nuevoId,
                    $entidad->getNombre(),
                    $entidad->getPlanetaOrigen(),
                    $entidad->getNivelEstabilidad(),
                    $entidad->getAntiguedad()
                );
            default:
                throw new InvalidArgumentException("Tipo de entidad no válido: {$tipo}");
        }
    }

    private function generarIdUnico() {
        return uniqid('ENT_', true);
    }

    public function buscarPorId($id) {
        foreach ($_SESSION[$this->sessionKey] as $entidad) {
            if ($entidad->getId() == $id) {
                return $entidad;
            }
        }
        return null;
    }

    private function actualizar($entidadActualizada) {
        foreach ($_SESSION[$this->sessionKey] as $i => $entidad) {
            if ($entidad->getId() == $entidadActualizada->getId()) {
                $_SESSION[$this->sessionKey][$i] = $entidadActualizada;
                return;
            }
        }
    }

    public function eliminar($id) {
        foreach ($_SESSION[$this->sessionKey] as $i => $entidad) {
            if ($entidad->getId() == $id) {
                unset($_SESSION[$this->sessionKey][$i]);
                $_SESSION[$this->sessionKey] = array_values($_SESSION[$this->sessionKey]);
                return;
            }
        }
    }

    public function filtrar($tipo = null, $estabilidadMin = null, $estabilidadMax = null) {
        $entidades = $this->obtenerTodos();
        $filtradas = [];

        foreach ($entidades as $entidad) {
            $cumpleTipo = ($tipo === null || $tipo === '' || $entidad->getTipo() === $tipo);
            $cumpleMin = ($estabilidadMin === null || $estabilidadMin === '' || $entidad->getNivelEstabilidad() >= intval($estabilidadMin));
            $cumpleMax = ($estabilidadMax === null || $estabilidadMax === '' || $entidad->getNivelEstabilidad() <= intval($estabilidadMax));

            if ($cumpleTipo && $cumpleMin && $cumpleMax) {
                $filtradas[] = $entidad;
            }
        }

        return $filtradas;
    }
}
