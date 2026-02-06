<?php
session_start();
if ($_SESSION['rol'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Añadir Nuevo Viaje</title>
    <link rel="stylesheet" href="../assets/css/estilos.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <?php include '../vistas/header.html'; ?>

    <div class="form-container-admin">
        <h2>Nuevo Viaje</h2>
        
        <form action="../clases/procesar_añadir_viaje.php" method="POST" enctype="multipart/form-data" class="form-admin">

            <label>Título:</label>
            <input type="text" name="titulo" required>

            <label>Descripción:</label>
            <textarea name="descripcion" required></textarea>

            <div class="form-row-admin">
                <div class="form-group-admin">
                    <label>Fecha Inicio:</label>
                    <input type="date" name="fecha_inicio" required>
                </div>
                <div class="form-group-admin">
                    <label>Fecha Fin:</label>
                    <input type="date" name="fecha_fin" required>
                </div>
            </div>

            <div class="form-row-admin">
                <div class="form-group-admin">
                    <label>Precio:</label>
                    <input type="number" step="0.01" name="precio" required>
                </div>
                <div class="form-group-admin">
                    <label>Plazas:</label>
                    <input type="number" name="plazas" required>
                </div>
            </div>

            <label>Tipo de Viaje:</label>
            <select name="tipo_de_viaje">
                <option value="Romántico">Romántico</option>
                <option value="Aventura">Aventura</option>
                <option value="Playa">Playa</option>
                <option value="Naturaleza">Naturaleza</option>
            </select>

            <label>¿Es un viaje destacado?</label>
            <select name="destacado">
                <option value="1">Sí</option>
                <option value="0" selected>No</option>
            </select>

            <label>Imagen:</label>
            <input type="file" name="imagen" required>

            <input type="submit" value="Guardar Viaje" class="btn-admin-submit">
        </form>
        <br>
        <a href="visualizar_viajes.php">Volver atrás</a>
    </div>

    <?php include '../vistas/footer.html'; ?>
</body>
</html>