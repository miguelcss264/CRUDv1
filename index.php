<?php
require_once "autoload.php";
session_start();

$gestor=new GestorPublicacion();

$publicaciones = $gestor->listar();

$accion = $_GET['accion'] ?? null;

//Operaciones del CRUD
if($accion == "crear"){
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
    $gestor->anyadir($publicacion);

    header("Location: index.php");
    exit();
}

if ($accion == "editarLibro") {
    $gestor->actualizarLibro($_POST['isbn'], $_POST['editorial'], $_POST['paginas']);
    header("Location: index.php");
    exit();
}

if ($accion == "eliminar") {
    $gestor->eliminar($_GET['isbn']);
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD PHP con POO y Arrays</title>
</head>
<body>

<h1>Gestión de Publicaciones</h1>
<hr>
<!-- FORMULARIO CREAR -->
<h2>Crear Publicación</h2>

<form method="POST" action="index.php?accion=crear">
    ISBN:
    <input type="number" name="isbn" required><br>

    Editorial:
    <input type="text" name="editorial">

    Páginas:
    <input type="number" name="paginas"><br>

    Color:
    <input type="text" name="color">

    Temática:
    <input type="text" name="tematica"><br>

    <button type="submit">Agregar</button>
</form>

<h3> LIBROS</h3>
<!-- LISTADO DE LIBROS-->
<table border="1" cellpadding="10">
    <tr>
        <th>ISBN</th>
        <th>Editorial</th>
        <th>Páginas</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($publicaciones as $p): ?>
        <?php if ($p instanceof Libro): ?>
    <tr>
        <td><?=$p->getIsbn()?></td>
        <td><?=$p->getEditorial()?></td>
        <td><?=$p->getPaginas()?></td>
        <td>
            <!-- Botón Editar -->
            <form method="POST" action="index.php?accion=editarLibro" style="display:inline;">
                <input type="hidden" name="isbn" value="<?= $p->getIsbn() ?>">
                Editorial: <input type="text" name="editorial" value="<?= $p->getEditorial() ?>" required>
                Páginas: <input type="number" name="paginas" value="<?= $p->getPaginas() ?>" required>
                <button type="submit">Guardar</button>
                <!-- Botón Eliminar -->
                    <a href="index.php?accion=eliminar&isbn=<?= $p->getIsbn() ?>">Eliminar</a>
            </form>
        </td>
    </tr>
    <?php endif; ?>
    <?php endforeach; ?>
    </table>

<h3> REVISTAS </h3>
<!-- LISTADO DE REVISTAS-->
<table border="1" cellpadding="10">
    <tr>
        <th>ISBN</th>
        <th>Editorial</th>
        <th>Páginas</th>
        <th>Acciones</th>
    </tr>
<?php foreach ($publicaciones as $p): ?>
<?php if ($p instanceof Revista): ?>
<tr>
    <td><?= $p->getIsbn() ?></td>
    <td><?= $p->getColor() ?></td>
    <td><?= $p->getTematica() ?></td>
    <td>
        <form method="POST" action="index.php?accion=editarRevista" style="display:inline;">
            <input type="hidden" name="isbn" value="<?= $p->getIsbn() ?>">
            Col: <input type="text" name="color" value="<?= $p->getColor() ?>" required size="10">
            Tema: <input type="text" name="tematica" value="<?= $p->getTematica() ?>" required size="10">
            <button type="submit">Guardar</button>
        </form>
        <a href="index.php?accion=eliminar&isbn=<?= $p->getIsbn() ?>">Eliminar</a>
    </td>
</tr>
<?php endif; ?>
<?php endforeach; ?>
</table>

</body>
</html>
