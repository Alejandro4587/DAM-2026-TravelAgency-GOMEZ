<?php

session_start();

include '../admin/conexiondb.php';

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../admin/login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id_viaje = $_GET['id'];

    try {

        $sql = "DELETE FROM viajes WHERE id_viaje = :id";
        $stmt = $conn->prepare($sql);

        $stmt->execute([':id' => $id_viaje]);

        header("Location: ../admin/visualizar_viajes.php?status=deleted");
        exit();

    } catch (PDOException $e) {
        die("Error al eliminar el registro: " . $e->getMessage());
    }

    $conn = null;

} else {
    header("Location: ../admin/visualizar_viajes.php");
    exit();
}
?>