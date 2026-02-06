<?php
session_start();
if ($_SESSION['rol'] !== 'admin') {
    header("Location: login.php");
    exit();
}
include 'conexiondb.php';

if (isset($_GET['id'])) {
    $id_viaje = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM viajes WHERE id_viaje = :id_viaje");
    $stmt->execute([':id_viaje' => $id_viaje]);
    $viaje = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Destino</title>
    <link rel="stylesheet" href="../assets/css/estilos.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>

<body>
    <?php include '../vistas/header.html'; ?>

    <div class="form-container-admin">
        <h2>Editar: <?php echo $viaje['titulo']; ?></h2>

        <form action="../clases/procesar_modificar_viajes.php" method="POST" enctype="multipart/form-data"
            class="form-admin">

            <input type="hidden" name="id_viaje" value="<?php echo $viaje['id_viaje']; ?>">

            <label>Título:</label><br>
            <input type="text" name="titulo" value="<?php echo $viaje['titulo']; ?>" required
                class="input-full"><br><br>

            <label>Descripción:</label><br>
            <textarea name="descripcion" required
                class="area-texto"><?php echo $viaje['descripcion']; ?></textarea><br><br>

            <div class="form-row-admin">
                <div class="form-group-admin">
                    <label>Fecha Inicio:</label><br>
                    <input type="date" name="fecha_inicio" value="<?php echo $viaje['fecha_inicio']; ?>" required
                        class="input-full">
                </div>
                <div class="form-group-admin">
                    <label>Fecha Fin:</label><br>
                    <input type="date" name="fecha_fin" value="<?php echo $viaje['fecha_fin']; ?>" required
                        class="input-full">
                </div>
            </div><br>

            <div class="form-row-admin">
                <div class="form-group-admin">
                    <label>Precio:</label><br>
                    <input type="number" step="0.01" name="precio" value="<?php echo $viaje['precio']; ?>" required
                        class="input-full">
                </div>
                <div class="form-group-admin">
                    <label>Plazas:</label><br>
                    <input type="number" name="plazas" value="<?php echo $viaje['plazas']; ?>" required
                        class="input-full">
                </div>
            </div><br>

            <label>Tipo de Viaje:</label><br>
            <select name="tipo_de_viaje" class="input-full">
                <option value="Romántico" <?php if ($viaje['tipo_de_viaje'] == "Romántico")
                    echo "selected"; ?>>Romántico
                </option>
                <option value="Aventura" <?php if ($viaje['tipo_de_viaje'] == "Aventura")
                    echo "selected"; ?>>Aventura
                </option>
                <option value="Playa" <?php if ($viaje['tipo_de_viaje'] == "Playa")
                    echo "selected"; ?>>Playa</option>
                <option value="Naturaleza" <?php if ($viaje['tipo_de_viaje'] == "Naturaleza")
                    echo "selected"; ?>>
                    Naturaleza</option>
            </select><br><br>

            <label>¿Es destacado?</label><br>
            <select name="destacado" class="input-full">
                <option value="1" <?php if ($viaje['destacado'] == 1)
                    echo "selected"; ?>>Sí</option>
                <option value="0" <?php if ($viaje['destacado'] == 0)
                    echo "selected"; ?>>No</option>
            </select><br><br>

            <label>Imagen:</label><br>
            <input type="file" name="imagen"><br><br>

            <input type="submit" value="Actualizar Cambios" class="btn-actualizar">
        </form>
        <br>
        <a href="visualizar_viajes.php">Cancelar y volver</a>
    </div>

    <?php include '../vistas/footer.html'; ?>
</body>

</html>