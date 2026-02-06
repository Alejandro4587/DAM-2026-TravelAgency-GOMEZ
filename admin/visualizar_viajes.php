<?php
session_start();
if ($_SESSION['rol'] !== 'admin') { header("Location: login.php"); exit(); }

include 'conexiondb.php';

try {
    $stmt = $conn->prepare("SELECT * FROM viajes ORDER BY id_viaje DESC");
    $stmt->execute();
    $viajes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/estilos.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <title>Panel de Administración - Three Traveling</title>
</head>

<body>

    <?php include '../vistas/header.html'; ?>

    <div class="bottom-section">
        <h2 class="admin-title">Panel de Administración</h2>

        <div class="admin-nav">
            <a href="añadir_viaje.php" class="btn-nuevo-viaje">
                + Añadir Nuevo Viaje
            </a>
            <a href="../public/index.php" class="link-ver-web">Ver Web</a>
        </div>

        <div class="container-grid">
            <?php foreach ($viajes as $viaje): ?>
                <div class="card">
                    <div class="card-img">
                        <img src="../assets/img/<?php echo !empty($viaje['imagen']) ? $viaje['imagen'] : 'default.jpg'; ?>"
                            alt="viaje">
                    </div>

                    <div class="card-body">
                        <div class="card-title"><?php echo $viaje['titulo']; ?></div>
                        <small style="color: #888;"><?php echo $viaje['tipo_de_viaje']; ?></small>

                        <div class="viaje-fechas" style="margin-top: 10px;">
                            <strong><?php echo date("d/m/Y", strtotime($viaje['fecha_inicio'])); ?></strong> al
                            <strong><?php echo date("d/m/Y", strtotime($viaje['fecha_fin'])); ?></strong>
                        </div>

                        <p style="font-size: 0.85em; margin: 5px 0;">
                            Plazas: <?php echo $viaje['plazas']; ?> |
                            Destacado: <?php echo ($viaje['destacado'] == 1) ? 'Sí' : 'No'; ?>
                        </p>

                        <div class="card-precio">
                            <?php echo number_format($viaje['precio'], 2, ',', '.'); ?>€
                        </div>

                        <div class="acciones" style="margin-top: 15px; display: flex; gap: 10px; justify-content: center;">
                            <a href="modificar_viajes.php?id=<?php echo $viaje['id_viaje']; ?>" class="btn-editar">
                                Editar
                            </a>

                            <a href="../clases/eliminar_viaje.php?id=<?php echo $viaje['id_viaje']; ?>"
                                onclick="return confirm('¿Estás seguro de eliminar este viaje?');" class="btn-borrar">
                                Borrar
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php include '../vistas/footer.html'; ?>

</body>

</html>