-- phpMyAdmin SQL Dump
-- Versión corregida para importación directa

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 1. CREACIÓN DE LA BASE DE DATOS (Solución al error #1049)
--
CREATE DATABASE IF NOT EXISTS `registro_viajes` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `registro_viajes`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `usuario` varchar(25) NOT NULL,
  `contraseña` varchar(150) NOT NULL,
  `rol` varchar(20) NOT NULL DEFAULT 'usuario',
  PRIMARY KEY (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario`, `contraseña`, `rol`) VALUES
('admin123', 'admin123', 'admin'),
('usuario123', 'usuario123', 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viajes`
--

CREATE TABLE IF NOT EXISTS `viajes` (
  `id_viaje` int(10) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(150) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `precio` double NOT NULL,
  `destacado` tinyint(1) NOT NULL,
  `tipo_de_viaje` varchar(100) NOT NULL,
  `plazas` int(20) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  PRIMARY KEY (`id_viaje`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `viajes`
--

INSERT INTO `viajes` (`id_viaje`, `titulo`, `descripcion`, `fecha_inicio`, `fecha_fin`, `precio`, `destacado`, `tipo_de_viaje`, `plazas`, `imagen`) VALUES
(1, 'Paris', 'Disfruta de un fin de semana inolvidable frente a la Torre Eiffel con cena incluida.', '2026-06-18', '2026-06-21', 450.5, 1, 'Romántico', 25, 'eiffel.jpg'),
(2, 'Los Andes', 'Ruta de trekking por las montañas de Perú visitando ruinas incas.', '2024-06-15', '2024-06-25', 1200, 1, 'Aventura', 15, 'andes.jpg'),
(3, 'Caribe, Honduras', 'Viaje a una de las playas más hermosas del caribe. Tela en Honduras, un paraíso ', '2024-07-01', '2024-07-07', 899.99, 1, 'Playa', 50, 'caribe.jpg'),
(4, 'Safari en Kenia', 'Avistamiento de los 5 grandes en la reserva Masái Mara.', '2024-08-10', '2024-08-20', 2100, 1, 'Naturaleza', 8, 'safari.jpg'),
(5, 'Italia', 'Recorrido por Roma, Florencia y Nápoles probando las mejores pastas y pizzas.', '2024-09-05', '2024-09-12', 950, 0, 'Cultural', 25, 'Italia.jpg'),
(6, 'Japón', 'Visita Tokio y Kioto, mezclando tradición y tecnología punta.', '2024-10-01', '2024-10-15', 2500, 1, 'Cultural', 12, 'tokio_133ce43a_1284581217_240903122054_1280x854.jpg'),
(7, 'Surf en Bali', 'Campamento de surf para principiantes y avanzados en las mejores olas.', '2024-11-01', '2024-11-10', 750, 0, 'Deporte', 30, 'surf.jpg'),
(8, 'Auroras en Islandia', 'Caza de auroras boreales y relax en la Laguna Azul.', '2024-11-15', '2024-11-22', 1850, 1, 'Naturaleza', 12, 'islandia.jpg'),
(9, 'Nueva York', 'Vive la magia de la Gran Manzana y sus rascacielos.', '2024-12-05', '2024-12-12', 2200, 1, 'Cultural', 20, 'newyork.jpg'),
(10, 'Relax en Maldivas', 'Desconexión total en villas sobre aguas cristalinas.', '2025-01-10', '2025-01-18', 5000, 1, 'Romántico', 10, 'maldivas.jpg'),
(11, 'Egipto Faraónico', 'Crucero por el Nilo y visita a las pirámides de Giza.', '2025-02-15', '2025-02-24', 1450, 1, 'Cultural', 25, 'egipto.png'),
(12, 'Aventura en Costa Rica', 'Canopy, volcanes y biodiversidad en estado puro.', '2025-03-05', '2025-03-15', 1650, 1, 'Aventura', 15, 'costarica.jpg'),
(18, 'Muralla China', 'Viaje entre la nueva y vieja china', '2026-02-18', '2026-02-25', 3200, 1, 'Aventura', 25, 'murallachina.jpg'),
(19, 'Expedición a la Gran Barrera de Coral - Australia', 'El viaje incluye el pago el equipo de submarinismo, hotel y transporte para ir a la gran barrera de coral en Australia uno de los entornos naturales mas importante del planeta tierra', '2026-07-21', '2026-07-28', 6200, 1, 'Aventura', 30, 'Expedicion_barreradecoral.jpg');

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;