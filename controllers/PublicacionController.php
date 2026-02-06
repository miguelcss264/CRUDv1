<?php

class PublicacionController {
    private $gestor;

    public function __construct($gestor) {
        $this->gestor = $gestor;
    }

    public function index() {
        $publicaciones = $this->gestor->listar();
        include "views/listar.php";
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $isbn=$_POST['isbn'];
            if ($_POST['editorial'] != null){
                $editorial=$_POST['editorial'];
                $paginas=$_POST['paginas'];
                $publicacion = new Libro($isbn, $editorial, $paginas);
                
            }else{
                $color=$_POST['color'];
                $tematica=$_POST['tematica'];
                $publicacion = new Revista($isbn, $color, $tematica);
            }
            $this->gestor->anyadir($publicacion);

            header("Location: index.php");
            exit();
        }
        
        include "views/crear.php";
    }
    
    public function editarLibro() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->gestor->actualizarLibro($_POST['isbn'], $_POST['editorial'], $_POST['paginas']);

            header("Location: index.php");
            exit();
        }
    }

    public function editarRevista() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->gestor->actualizarRevista($_POST['isbn'], $_POST['color'], $_POST['tematica']);
            header("Location: index.php");
            exit();
        }
    }

    public function eliminar() {
            $this->gestor->eliminar($_GET['isbn']);
            header("Location: index.php");
            exit();
        }
}