<?php

include '../admin/conexiondb.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id_viaje'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $precio = $_POST['precio'];
    $destacado = $_POST['destacado'];
    $tipo = $_POST['tipo_de_viaje'];
    $plazas = $_POST['plazas'];
    
    $nombre_imagen = null;

    if (!empty($_FILES['imagen_nueva']['name'])) {

        $nombre_imagen = $_FILES['imagen_nueva']['name'];
        
        $ruta_destino = "../assets/img/". $nombre_imagen;
        
        move_uploaded_file($_FILES['imagen_nueva']['tmp_name'], $ruta_destino);
    }

    try {

        $sql = "UPDATE viajes SET 
                titulo = :titulo, 
                descripcion = :descripcion, 
                fecha_inicio = :fecha_inicio, 
                fecha_fin = :fecha_fin,
                precio = :precio, 
                destacado = :destacado,
                tipo_de_viaje = :tipo,
                plazas = :plazas";
        
        if ($nombre_imagen) {
            $sql .= ", imagen = :imagen";
        }

        $sql .= " WHERE id_viaje = :id_viaje";

        $stmt = $conn->prepare($sql);
        
        $params = [
            ':id_viaje' => $id,
            ':titulo' => $titulo,
            ':descripcion' => $descripcion,
            ':fecha_inicio' => $fecha_inicio,
            ':fecha_fin' => $fecha_fin,
            ':precio' => $precio,
            ':destacado' => $destacado,
            ':tipo' => $tipo,
            ':plazas' => $plazas
        ];

        if ($nombre_imagen) {
            $params[':imagen'] = $nombre_imagen;
        }

        $stmt->execute($params);

        header("Location: ../admin/visualizar_viajes.php?status=success");
        exit();

    } catch (PDOException $e) {
        die("Error al actualizar: " . $e->getMessage());
    }
}
?>