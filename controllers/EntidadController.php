<?php

class EntidadController {
    private $gestor;

    public function __construct(iGestor $gestor) {
        $this->gestor = $gestor;
    }

    public function index() {
        // Obtener parámetros de filtrado y paginación
        $tipo = $_GET['tipo'] ?? null;
        $estabilidadMin = $_GET['estabilidad_min'] ?? null;
        $estabilidadMax = $_GET['estabilidad_max'] ?? null;
        $pagina = $_GET['pagina'] ?? 1;

        // Filtrar entidades
        $entidades = $this->gestor->filtrar($tipo, $estabilidadMin, $estabilidadMax);

        // Crear paginador
        $paginator = new Paginator($entidades, 5, $pagina);

        include "views/lista.php";
    }

    public function crear() {
        include "views/form.php";
    }

    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $tipo = $_POST['tipo'];
            $nombre = $_POST['nombre'];
            $planetaOrigen = $_POST['planeta_origen'];
            $nivelEstabilidad = $_POST['nivel_estabilidad'];

            switch ($tipo) {
                case 'FormaDeVida':
                    $dieta = $_POST['dieta'];
                    $entidad = new FormaDeVida(null, $nombre, $planetaOrigen, $nivelEstabilidad, $dieta);
                    break;
                case 'MineralRaro':
                    $dureza = $_POST['dureza'];
                    $entidad = new MineralRaro(null, $nombre, $planetaOrigen, $nivelEstabilidad, $dureza);
                    break;
                case 'ArtefactoAntiguo':
                    $antiguedad = $_POST['antiguedad'];
                    $entidad = new ArtefactoAntiguo(null, $nombre, $planetaOrigen, $nivelEstabilidad, $antiguedad);
                    break;
                default:
                    header("Location: index.php");
                    exit();
            }

            $this->gestor->guardar($entidad);
            header("Location: index.php");
            exit();
        }
    }

    public function editar() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: index.php");
            exit();
        }

        $entidad = $this->gestor->buscarPorId($id);
        if (!$entidad) {
            header("Location: index.php");
            exit();
        }

        include "views/form.php";
    }

    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $tipo = $_POST['tipo'];
            $nombre = $_POST['nombre'];
            $planetaOrigen = $_POST['planeta_origen'];
            $nivelEstabilidad = $_POST['nivel_estabilidad'];

            switch ($tipo) {
                case 'FormaDeVida':
                    $dieta = $_POST['dieta'];
                    $entidad = new FormaDeVida($id, $nombre, $planetaOrigen, $nivelEstabilidad, $dieta);
                    break;
                case 'MineralRaro':
                    $dureza = $_POST['dureza'];
                    $entidad = new MineralRaro($id, $nombre, $planetaOrigen, $nivelEstabilidad, $dureza);
                    break;
                case 'ArtefactoAntiguo':
                    $antiguedad = $_POST['antiguedad'];
                    $entidad = new ArtefactoAntiguo($id, $nombre, $planetaOrigen, $nivelEstabilidad, $antiguedad);
                    break;
                default:
                    header("Location: index.php");
                    exit();
            }

            $this->gestor->guardar($entidad);
            header("Location: index.php");
            exit();
        }
    }

    public function eliminar() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->gestor->eliminar($id);
        }
        header("Location: index.php");
        exit();
    }
}
