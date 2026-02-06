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

<a href="index.php">Volver</a>