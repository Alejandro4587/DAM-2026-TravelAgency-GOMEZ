<?php
session_start();
include '../admin/conexiondb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $precio = $_POST['precio'];
    $plazas = $_POST['plazas'];
    $tipo_de_viaje = $_POST['tipo_de_viaje'];
    $destacado = $_POST['destacado'];

    $imagen = $_FILES['imagen']['name'];
    move_uploaded_file($_FILES['imagen']['tmp_name'], "../assets/img/" . $imagen);

    try {
        $sql = "INSERT INTO viajes (titulo, descripcion, fecha_inicio, fecha_fin, precio, destacado, tipo_de_viaje, plazas, imagen) 
                VALUES (:titulo, :descripcion, :fecha_inicio, :fecha_fin, :precio, :destacado, :tipo_de_viaje, :plazas, :imagen)";

        $stmt = $conn->prepare($sql);

        $stmt->execute([
            ':titulo' => $titulo,
            ':descripcion' => $descripcion,
            ':fecha_inicio' => $fecha_inicio,
            ':fecha_fin' => $fecha_fin,
            ':precio' => $precio,
            ':destacado' => $destacado,
            ':tipo_de_viaje' => $tipo_de_viaje,
            ':plazas' => $plazas,
            ':imagen' => $imagen
        ]);

        header("Location: ../admin/visualizar_viajes.php");

    } catch (PDOException $e) {
        echo "Hubo un error al guardar: " . $e->getMessage();
    }
}
?>