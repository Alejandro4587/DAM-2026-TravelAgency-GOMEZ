<?php
include '../admin/conexiondb.php';

try {
    $stmt = $conn->prepare("SELECT * FROM viajes WHERE destacado = 1 ORDER BY id_viaje DESC");
    $stmt->execute();
    $ofertas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error en la consulta";
}
?>

<nav style="background: #333; padding: 15px; text-align: center; color: white; font-family: Arial, sans-serif;">
    <?php if (isset($_SESSION['usuario'])): ?>
        <div style="margin-bottom: 5px;">Bienvenido: <strong>
                <?php echo $_SESSION['usuario']; ?>
            </strong></div>
        <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'admin'): ?>
            <a href="../admin/visualizar_viajes.php"
                style="color: #ffcc00; text-decoration: none; font-weight: bold; margin: 0 15px;">PANEL ADMIN</a>
        <?php endif; ?>
        <a href="../admin/logout.php" style="color: #ff6666; text-decoration: none; margin: 0 15px;">Cerrar Sesión</a>
    <?php else: ?>
        <a href="../admin/login.php"
            style="color: white; text-decoration: none; border: 1px solid white; padding: 8px 15px; border-radius: 5px;">Iniciar
            Sesión</a>
    <?php endif; ?>
</nav>

<div class="bottom-section">
    <h2 class="titulo-seccion">Ofertas Destacadas</h2>
    <div class="container-grid">
        <?php if (count($ofertas) > 0): ?>
            <?php foreach ($ofertas as $v): ?>
                <div class="card">
                    <a href="detalles_viaje.php?id=<?= $v['id_viaje'] ?>" style="text-decoration: none; color: inherit;">
                        <div class="card-img">
                            <img src="../assets/img/<?= !empty($v['imagen']) ? $v['imagen'] : 'default.jpg' ?>">
                        </div>
                        <div class="card-body">
                            <div class="card-title">
                                <?= $v['titulo'] ?>
                            </div>
                            <p class="card-descripcion">
                                <?= substr($v['descripcion'], 0, 80) ?>...
                            </p>
                            <div class="card-precio">
                                <span class="precio-monto">
                                    <?= $v['precio'] ?>€
                                </span>
                            </div>
                            <div style="margin-top: 15px; text-align: center; color: #3498db; font-weight: bold;">
                                Ver detalles →
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="sin-datos" style="text-align: center; width: 100%;">No hay ofertas disponibles en este momento.</p>
        <?php endif; ?>
    </div>
</div>