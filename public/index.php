<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto_Final - Three Traveling</title>
    <link rel="stylesheet" href="../assets/css/estilos.css">
    <link rel="stylesheet" href="../assets/css/public.css">
</head>

<body>
    
    <?php include '../vistas/header.html'; ?>
    <?php include '../vistas/buscador.html'; ?>

    <section class="banner">
        <img src="https://media1.giphy.com/media/v1.Y2lkPTZjMDliOTUydnFtZzdiazRhZmI1dnNheHEzMDE0MGF0aXpqeTNnd3MwdnQ3ZDM2NSZlcD12MV9naWZzX3NlYXJjaCZjdD1n/3oz8xLYF0gagozmsgM/200w.gif"
            width="500" height="270" alt="Banner">

        <article class="texto">
            <h1>Bienvenido a Three Traveling</h1>
            <p>En Three Traveling transformamos tus viajes en experiencias inolvidables. Diseñamos aventuras a tu
                medida, cuidando cada detalle para que solo te preocupes por disfrutar, descubrir y vivir momentos
                únicos alrededor del mundo.</p>
        </article>
    </section>

    <?php include '../vistas/menu.php'; ?>

    <?php include '../vistas/footer.html'; ?>

</body>
</html>