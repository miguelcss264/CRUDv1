<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eco-Sistema Galáctico: Expedición Nova</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #0a0a2e;
            color: #e0e0e0;
        }
        h1 {
            color: #4fc3f7;
            text-align: center;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: #1a1a3e;
            padding: 20px;
            border-radius: 10px;
        }
        .filters {
            background-color: #252550;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .filters form {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;
        }
        .filters label {
            color: #4fc3f7;
        }
        .filters input, .filters select {
            padding: 5px;
            border-radius: 3px;
            border: 1px solid #4fc3f7;
            background-color: #1a1a3e;
            color: #e0e0e0;
        }
        .filters button {
            padding: 5px 15px;
            background-color: #4fc3f7;
            color: #0a0a2e;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-weight: bold;
        }
        .filters button:hover {
            background-color: #81d4fa;
        }
        .btn-crear {
            display: inline-block;
            padding: 10px 20px;
            background-color: #66bb6a;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .btn-crear:hover {
            background-color: #81c784;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th {
            background-color: #4fc3f7;
            color: #0a0a2e;
            padding: 12px;
            text-align: left;
            font-weight: bold;
        }
        td {
            padding: 10px;
            border-bottom: 1px solid #3a3a5e;
        }
        tr.inestable {
            background-color: #4a1a1a;
        }
        tr:hover {
            background-color: #2a2a4e;
        }
        .reaccion {
            font-style: italic;
            color: #81d4fa;
            font-size: 0.9em;
        }
        .acciones a {
            margin-right: 10px;
            color: #4fc3f7;
            text-decoration: none;
        }
        .acciones a:hover {
            text-decoration: underline;
        }
        .acciones a.eliminar {
            color: #ef5350;
        }
        .pagination {
            text-align: center;
            margin-top: 20px;
        }
        .pagination a, .pagination span {
            display: inline-block;
            padding: 8px 12px;
            margin: 0 2px;
            background-color: #252550;
            color: #4fc3f7;
            text-decoration: none;
            border-radius: 3px;
        }
        .pagination span.current {
            background-color: #4fc3f7;
            color: #0a0a2e;
            font-weight: bold;
        }
        .pagination a:hover {
            background-color: #3a3a5e;
        }
        .info {
            text-align: center;
            color: #81d4fa;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🌌 Eco-Sistema Galáctico: Expedición Nova</h1>
        
        <a href="index.php?accion=crear" class="btn-crear">➕ Crear Nueva Entidad Estelar</a>
        
        <!-- Filtros -->
        <div class="filters">
            <form method="GET" action="index.php">
                <input type="hidden" name="accion" value="index">
                
                <label>Tipo:</label>
                <select name="tipo">
                    <option value="">Todos</option>
                    <option value="FormaDeVida" <?= (isset($_GET['tipo']) && $_GET['tipo'] == 'FormaDeVida') ? 'selected' : '' ?>>Forma de Vida</option>
                    <option value="MineralRaro" <?= (isset($_GET['tipo']) && $_GET['tipo'] == 'MineralRaro') ? 'selected' : '' ?>>Mineral Raro</option>
                    <option value="ArtefactoAntiguo" <?= (isset($_GET['tipo']) && $_GET['tipo'] == 'ArtefactoAntiguo') ? 'selected' : '' ?>>Artefacto Antiguo</option>
                </select>
                
                <label>Estabilidad Mínima:</label>
                <input type="number" name="estabilidad_min" min="1" max="10" value="<?= $_GET['estabilidad_min'] ?? '' ?>" placeholder="1">
                
                <label>Estabilidad Máxima:</label>
                <input type="number" name="estabilidad_max" min="1" max="10" value="<?= $_GET['estabilidad_max'] ?? '' ?>" placeholder="10">
                
                <button type="submit">Filtrar</button>
                <a href="index.php" style="color: #ef5350; text-decoration: none; margin-left: 10px;">Limpiar filtros</a>
            </form>
        </div>
        
        <!-- Información de paginación -->
        <div class="info">
            Mostrando <?= count($paginator->getItems()) ?> de <?= $paginator->getTotalItems() ?> entidades estelares
        </div>
        
        <!-- Tabla de entidades -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Nombre</th>
                    <th>Planeta de Origen</th>
                    <th>Nivel de Estabilidad</th>
                    <th>Campo Especial</th>
                    <th>Reacción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($paginator->getItems())): ?>
                    <tr>
                        <td colspan="8" style="text-align: center; color: #81d4fa;">
                            No hay entidades estelares para mostrar. ¡Crea una nueva!
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($paginator->getItems() as $entidad): ?>
                        <tr class="<?= $entidad->getNivelEstabilidad() < 3 ? 'inestable' : '' ?>">
                            <td><?= htmlspecialchars($entidad->getId()) ?></td>
                            <td>
                                <?php
                                $tipoNombre = '';
                                switch($entidad->getTipo()) {
                                    case 'FormaDeVida': $tipoNombre = '🦠 Forma de Vida'; break;
                                    case 'MineralRaro': $tipoNombre = '💎 Mineral Raro'; break;
                                    case 'ArtefactoAntiguo': $tipoNombre = '🗿 Artefacto Antiguo'; break;
                                }
                                echo $tipoNombre;
                                ?>
                            </td>
                            <td><?= htmlspecialchars($entidad->getNombre()) ?></td>
                            <td><?= htmlspecialchars($entidad->getPlanetaOrigen()) ?></td>
                            <td>
                                <?= $entidad->getNivelEstabilidad() ?>
                                <?php if ($entidad->getNivelEstabilidad() < 3): ?>
                                    <span style="color: #ef5350;">⚠️</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <strong><?= htmlspecialchars($entidad->getNombreCampoEspecial()) ?>:</strong>
                                <?= htmlspecialchars($entidad->getCampoEspecial()) ?>
                            </td>
                            <td class="reaccion">
                                <?= htmlspecialchars($entidad->reaccionar()) ?>
                            </td>
                            <td class="acciones">
                                <a href="index.php?accion=editar&id=<?= urlencode($entidad->getId()) ?>">✏️ Editar</a>
                                <a href="index.php?accion=eliminar&id=<?= urlencode($entidad->getId()) ?>" 
                                   class="eliminar" 
                                   onclick="return confirm('¿Estás seguro de que deseas eliminar esta entidad estelar?')">
                                    🗑️ Eliminar
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        
        <!-- Paginación -->
        <?php if ($paginator->getTotalPages() > 1): ?>
            <div class="pagination">
                <?php if ($paginator->hasPreviousPage()): ?>
                    <a href="?accion=index&pagina=<?= $paginator->getCurrentPage() - 1 ?><?= isset($_GET['tipo']) ? '&tipo=' . urlencode($_GET['tipo']) : '' ?><?= isset($_GET['estabilidad_min']) ? '&estabilidad_min=' . urlencode($_GET['estabilidad_min']) : '' ?><?= isset($_GET['estabilidad_max']) ? '&estabilidad_max=' . urlencode($_GET['estabilidad_max']) : '' ?>">
                        « Anterior
                    </a>
                <?php endif; ?>
                
                <?php for ($i = 1; $i <= $paginator->getTotalPages(); $i++): ?>
                    <?php if ($i == $paginator->getCurrentPage()): ?>
                        <span class="current"><?= $i ?></span>
                    <?php else: ?>
                        <a href="?accion=index&pagina=<?= $i ?><?= isset($_GET['tipo']) ? '&tipo=' . urlencode($_GET['tipo']) : '' ?><?= isset($_GET['estabilidad_min']) ? '&estabilidad_min=' . urlencode($_GET['estabilidad_min']) : '' ?><?= isset($_GET['estabilidad_max']) ? '&estabilidad_max=' . urlencode($_GET['estabilidad_max']) : '' ?>">
                            <?= $i ?>
                        </a>
                    <?php endif; ?>
                <?php endfor; ?>
                
                <?php if ($paginator->hasNextPage()): ?>
                    <a href="?accion=index&pagina=<?= $paginator->getCurrentPage() + 1 ?><?= isset($_GET['tipo']) ? '&tipo=' . urlencode($_GET['tipo']) : '' ?><?= isset($_GET['estabilidad_min']) ? '&estabilidad_min=' . urlencode($_GET['estabilidad_min']) : '' ?><?= isset($_GET['estabilidad_max']) ? '&estabilidad_max=' . urlencode($_GET['estabilidad_max']) : '' ?>">
                        Siguiente »
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
