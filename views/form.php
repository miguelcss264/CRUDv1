<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= isset($entidad) ? 'Editar' : 'Crear' ?> Entidad Estelar</title>
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
            max-width: 600px;
            margin: 0 auto;
            background-color: #1a1a3e;
            padding: 30px;
            border-radius: 10px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #4fc3f7;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #4fc3f7;
            border-radius: 5px;
            background-color: #252550;
            color: #e0e0e0;
            box-sizing: border-box;
        }
        input[type="text"]:focus,
        input[type="number"]:focus,
        select:focus {
            outline: none;
            border-color: #81d4fa;
            box-shadow: 0 0 5px #4fc3f7;
        }
        input[readonly] {
            background-color: #1a1a3e;
            cursor: not-allowed;
        }
        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }
        button, .btn-volver {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            text-decoration: none;
            text-align: center;
            display: inline-block;
        }
        button[type="submit"] {
            background-color: #66bb6a;
            color: white;
        }
        button[type="submit"]:hover {
            background-color: #81c784;
        }
        .btn-volver {
            background-color: #757575;
            color: white;
        }
        .btn-volver:hover {
            background-color: #9e9e9e;
        }
        .campo-especial {
            display: none;
        }
        .campo-especial.active {
            display: block;
        }
        .info {
            background-color: #252550;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            color: #81d4fa;
            font-size: 0.9em;
        }
    </style>
    <script>
        function mostrarCampoEspecial() {
            // Ocultar todos los campos especiales
            document.querySelectorAll('.campo-especial').forEach(function(el) {
                el.classList.remove('active');
            });
            
            // Mostrar el campo correspondiente al tipo seleccionado
            var tipo = document.getElementById('tipo').value;
            if (tipo) {
                var campo = document.getElementById('campo_' + tipo);
                if (campo) {
                    campo.classList.add('active');
                }
            }
        }
        
        window.onload = function() {
            mostrarCampoEspecial();
        };
    </script>
</head>
<body>
    <div class="container">
        <h1>🌌 <?= isset($entidad) ? 'Editar' : 'Crear' ?> Entidad Estelar</h1>
        
        <?php if (isset($entidad)): ?>
            <div class="info">
                ℹ️ Estás editando una entidad existente. El ID no puede ser modificado.
            </div>
        <?php endif; ?>
        
        <form method="POST" action="index.php?accion=<?= isset($entidad) ? 'actualizar' : 'guardar' ?>">
            <?php if (isset($entidad)): ?>
                <input type="hidden" name="id" value="<?= htmlspecialchars($entidad->getId()) ?>">
                
                <div class="form-group">
                    <label for="id_display">ID de la Entidad:</label>
                    <input type="text" id="id_display" value="<?= htmlspecialchars($entidad->getId()) ?>" readonly>
                </div>
            <?php endif; ?>
            
            <div class="form-group">
                <label for="tipo">Tipo de Entidad Estelar: *</label>
                <select name="tipo" id="tipo" required onchange="mostrarCampoEspecial()" <?= isset($entidad) ? 'disabled' : '' ?>>
                    <option value="">Seleccione un tipo...</option>
                    <option value="FormaDeVida" <?= (isset($entidad) && $entidad->getTipo() == 'FormaDeVida') ? 'selected' : '' ?>>
                        🦠 Forma de Vida
                    </option>
                    <option value="MineralRaro" <?= (isset($entidad) && $entidad->getTipo() == 'MineralRaro') ? 'selected' : '' ?>>
                        💎 Mineral Raro
                    </option>
                    <option value="ArtefactoAntiguo" <?= (isset($entidad) && $entidad->getTipo() == 'ArtefactoAntiguo') ? 'selected' : '' ?>>
                        🗿 Artefacto Antiguo
                    </option>
                </select>
                <?php if (isset($entidad)): ?>
                    <input type="hidden" name="tipo" value="<?= htmlspecialchars($entidad->getTipo()) ?>">
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label for="nombre">Nombre: *</label>
                <input type="text" name="nombre" id="nombre" 
                       value="<?= isset($entidad) ? htmlspecialchars($entidad->getNombre()) : '' ?>" 
                       required placeholder="Ej: Criatura Zeta-7">
            </div>
            
            <div class="form-group">
                <label for="planeta_origen">Planeta de Origen: *</label>
                <input type="text" name="planeta_origen" id="planeta_origen" 
                       value="<?= isset($entidad) ? htmlspecialchars($entidad->getPlanetaOrigen()) : '' ?>" 
                       required placeholder="Ej: Kepler-442b">
            </div>
            
            <div class="form-group">
                <label for="nivel_estabilidad">Nivel de Estabilidad (1-10): *</label>
                <input type="number" name="nivel_estabilidad" id="nivel_estabilidad" 
                       min="1" max="10" 
                       value="<?= isset($entidad) ? $entidad->getNivelEstabilidad() : '5' ?>" 
                       required>
                <small style="color: #81d4fa;">⚠️ Niveles inferiores a 3 se consideran inestables</small>
            </div>
            
            <!-- Campo especial para Forma de Vida -->
            <div id="campo_FormaDeVida" class="campo-especial <?= (isset($entidad) && $entidad->getTipo() == 'FormaDeVida') ? 'active' : '' ?>">
                <div class="form-group">
                    <label for="dieta">Dieta: *</label>
                    <input type="text" name="dieta" id="dieta" 
                           value="<?= (isset($entidad) && $entidad->getTipo() == 'FormaDeVida') ? htmlspecialchars($entidad->getDieta()) : '' ?>" 
                           placeholder="Ej: Herbívoro, Carnívoro, Fotosintético">
                </div>
            </div>
            
            <!-- Campo especial para Mineral Raro -->
            <div id="campo_MineralRaro" class="campo-especial <?= (isset($entidad) && $entidad->getTipo() == 'MineralRaro') ? 'active' : '' ?>">
                <div class="form-group">
                    <label for="dureza">Dureza: *</label>
                    <input type="text" name="dureza" id="dureza" 
                           value="<?= (isset($entidad) && $entidad->getTipo() == 'MineralRaro') ? htmlspecialchars($entidad->getDureza()) : '' ?>" 
                           placeholder="Ej: 9 (escala Mohs), Diamantino">
                </div>
            </div>
            
            <!-- Campo especial para Artefacto Antiguo -->
            <div id="campo_ArtefactoAntiguo" class="campo-especial <?= (isset($entidad) && $entidad->getTipo() == 'ArtefactoAntiguo') ? 'active' : '' ?>">
                <div class="form-group">
                    <label for="antiguedad">Antigüedad (años): *</label>
                    <input type="number" name="antiguedad" id="antiguedad" 
                           value="<?= (isset($entidad) && $entidad->getTipo() == 'ArtefactoAntiguo') ? htmlspecialchars($entidad->getAntiguedad()) : '' ?>" 
                           placeholder="Ej: 1000000">
                </div>
            </div>
            
            <div class="buttons">
                <button type="submit">
                    <?= isset($entidad) ? '💾 Actualizar' : '✅ Crear' ?> Entidad
                </button>
                <a href="index.php" class="btn-volver">↩️ Volver</a>
            </div>
        </form>
    </div>
</body>
</html>
