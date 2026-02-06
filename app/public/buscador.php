<?php
session_start();
include '../admin/conexiondb.php';

$sql = "SELECT * FROM viajes WHERE 1=1";

$destino = isset($_GET["busqueda"]) ? $_GET["busqueda"] : "";
$tipo = isset($_GET["tipo"]) ? $_GET["tipo"] : "";
$fecha = isset($_GET["fecha"]) ? $_GET["fecha"] : "";

if ($destino != "") {
    $sql .= " AND titulo LIKE :destino";
}
if ($tipo != "" && $tipo != "Cualquier tipo") {
    $sql .= " AND tipo_de_viaje = :tipo";
}
if ($fecha != "") {
    $sql .= " AND fecha_inicio >= :fecha";
}

$stmt = $conn->prepare($sql);

if ($destino != "") {
    $stmt->bindValue(':destino', '%' . $destino . '%');
}
if ($tipo != "" && $tipo != "Cualquier tipo") {
    $stmt->bindValue(':tipo', $tipo);
}
if ($fecha != "") {
    $stmt->bindValue(':fecha', $fecha);
}

$stmt->execute();
$viajes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Resultados de Búsqueda</title>
    <link rel="stylesheet" href="../assets/css/estilos.css">
    <link rel="stylesheet" href="../assets/css/public.css">
</head>

<body>

    <?php include '../vistas/header.html'; ?>
    <?php include '../vistas/buscador.html'; ?>

    <div class="resultados-busqueda">
        
        <h2 class="titulo-resultados">
            <?php echo ($destino || $fecha || $tipo) ? "Resultados encontrados" : "Todos nuestros viajes"; ?>
        </h2>

        <?php if (count($viajes) > 0): ?>
            <div class="container-grid">
                <?php foreach ($viajes as $v): ?>
                    <div class="card">
                        <div class="card-img">
                            <img src="../assets/img/<?= !empty($v['imagen']) ? $v['imagen'] : 'default.jpg' ?>" alt="<?= $v['titulo'] ?>">
                        </div>
                        <div class="card-body">
                            <div class="card-title"><?= $v['titulo'] ?></div>
                            <p class="viaje-fechas">
                                 <?= date('d/m/Y', strtotime($v['fecha_inicio'])) ?>
                            </p>
                            <p class="card-descripcion">
                                <?= substr($v['descripcion'], 0, 80) ?>...
                            </p>
                            <div class="card-precio">
                                <span class="precio-label">Desde</span>
                                <div class="precio-monto"><?= $v['precio'] ?>€</div>
                            </div>
                            <a href="detalles_viaje.php?id=<?= $v['id_viaje'] ?>" class="btn-editar btn-detalles">
                                Ver Detalles
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php else: ?>
            <div class="no-resultados">
                <h3>Vaya...</h3>
                <p>No hemos encontrado viajes con esas características.</p>
                <a href="index.php" class="btn-accion">Ver todos los viajes</a>
            </div>
        <?php endif; ?>
        
    </div>

    <?php include '../vistas/footer.html'; ?>
</body>

</html>