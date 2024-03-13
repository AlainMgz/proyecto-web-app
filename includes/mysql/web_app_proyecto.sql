-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-03-2024 a las 19:19:44
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `web_app_proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

CREATE TABLE `peliculas` (
  `ID` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `descripcion` text NOT NULL,
  `director` varchar(20) NOT NULL,
  `genero` varchar(10) NOT NULL,
  `caratula` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`ID`, `nombre`, `descripcion`, `director`, `genero`, `caratula`) VALUES
(2, 'Interestellar', 'Un equipo de exploradores viaja a través de un agujero de gusano en el espacio en un intento de garantizar la supervivencia de la humanidad.', 'Christopher Nolan', 'Ciencia ficción', 'interestellar.png'),
(3, 'El Padrino', 'La historia de una poderosa familia de la mafia en Nueva York, que se involucra en actividades criminales y luchas de poder.', 'Francis Ford Coppola', 'Drama', 'elpadrino.png'),
(4, 'Titanic', 'Un joven aventurero y una hermosa aristócrata se encuentran a bordo del infortunado RMS Titanic durante su viaje inaugural.', 'James Cameron', 'Drama', 'titanic.png'),
(5, 'Avatar', 'En el futuro, un exmarine parapléjico es enviado a la luna Pandora en una misión única que eventualmente se convierte en una épica batalla por la supervivencia.', 'James Cameron', 'Ciencia ficción', 'avatar.png'),
(6, 'Forrest Gump', 'La vida de Forrest Gump, un hombre con una capacidad intelectual por debajo de la media pero con buen corazón, y su extraordinario viaje a través de la historia estadounidense.', 'Robert Zemeckis', 'Comedia', 'forrestgump.png'),
(7, 'The Shawshank Redemption', 'Un banquero condenado a cadena perpetua por el asesinato de su esposa y su amante, encuentra esperanza en medio de la desesperación mientras planea su escape de prisión.', 'Frank Darabont', 'Drama', 'shawshankredemption.png');

INSERT INTO `peliculas` (`ID`, `nombre`, `descripcion`, `director`, `genero`, `caratula`) VALUES
(8, 'Pulp Fiction', 'La vida de varios personajes interconectados, incluidos dos asesinos a sueldo, un boxeador, un gángster y su esposa, en tres historias entrelazadas.', 'Quentin Tarantino', 'Drama', 'pulpfiction.png'),
(9, 'The Dark Knight', 'Cuando el caos irrumpe en Gotham City debido a la aparición del Joker, Batman debe enfrentarse a una de las pruebas más grandes de su vida.', 'Christopher Nolan', 'Acción', 'darkknight.png'),
(10, 'Inception', 'Un ladrón especializado en robar secretos del subconsciente durante el estado de sueño es contratado para implantar una idea en la mente de un CEO.', 'Christopher Nolan', 'Acción', 'inception.png'),
(11, 'Fight Club', 'Un insomne empleado de oficina y un fabricante de jabón deprimido forman un club clandestino de lucha, revolucionando pronto toda la ciudad.', 'David Fincher', 'Drama', 'fightclub.png'),
(12, 'The Matrix', 'Un hacker informático descubre la verdad sobre su realidad simulada y el papel de la humanidad en la guerra contra las máquinas.', 'Lana Wachowski, Lilly Wachowski', 'Ciencia ficción', 'matrix.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `admin`) VALUES
(4, 'usuario', '$2y$10$NjpTa1gbEWGvZ/.sOjNOT.7DfIDOY9oYj8ZoH6iORSF.0YzGpBGVO', 'user@gmail.com', 0),
(5, 'admin', '$2y$10$cYfyWtbnojOf/jDw7cYswuqsbb9WcW7dgVWQioboPCoLWgK4NFh3y', 'admin@gmail.com', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `nombre` (`nombre`),
  ADD KEY `director` (`director`),
  ADD KEY `genero` (`genero`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
