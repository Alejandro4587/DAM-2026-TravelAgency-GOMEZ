<?php
session_start();

include '../admin/conexiondb.php'; 

if (isset($_GET['id'])) {
    $id_viaje = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM viajes WHERE id_viaje = :id");
    $stmt->execute([':id' => $id_viaje]);
    $v = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$v) { header("Location: index.php"); exit(); }
} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles - <?= $v['titulo'] ?></title>
    <link rel="stylesheet" href="../assets/css/estilos.css">
    <link rel="stylesheet" href="../assets/css/public.css">
</head>
<body>
    <?php include '../vistas/header.html'; ?>

    <main class="contenedor-detalles">
        <article class="tarjeta-grande">
            
            <img src="../assets/img/<?= $v['imagen'] ?>" class="imagen-banner" alt="<?= $v['titulo'] ?>">

            <div class="cuerpo-detalle">
                <section class="columna-izquierda">
                    <h1><?= $v['titulo'] ?></h1>
                    
                    <div class="precio-caja">
                        <small>PRECIO</small>
                        <p><?= $v['precio'] ?>€</p>
                    </div>
                    
                    <p><strong>Tipo:</strong> <?= $v['tipo_de_viaje'] ?></p>
                    <p><strong>Fechas:</strong> <?= date('d/m/Y', strtotime($v['fecha_inicio'])) ?> / <?= date('d/m/Y', strtotime($v['fecha_fin'])) ?></p>
                    <p><strong>Plazas Totales:</strong> <?= $v['plazas'] ?></p>
                    <p><strong>Destacado:</strong> <?= $v['destacado'] == 1 ? 'Sí' : 'No' ?></p>
                </section>

                <section class="columna-derecha">
                    <h3>Descripción</h3>
                    <div class="texto-bloque">
                        <?= nl2br($v['descripcion']) ?>
                    </div>
                </section>
            </div>

            <div class="pie-detalle">
                <a href="index.php" class="btn-cancelar">Volver a la lista</a>
            </div>
        </article>
    </main>

    <?php include '../vistas/footer.html'; ?>
</body>
</html>