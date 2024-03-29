-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-03-2024 a las 11:45:10
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
-- Estructura de tabla para la tabla `generos`
--

CREATE TABLE `generos` (
  `genero` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`genero`) VALUES
('Acción'),
('Animación'),
('Aventuras'),
('Ciencia ficción'),
('Comedia'),
('Documental'),
('Drama'),
('Fantasía'),
('Musical'),
('Romance'),
('Terror'),
('Thriller');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

CREATE TABLE `peliculas` (
  `ID` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `descripcion` text NOT NULL,
  `director` varchar(20) NOT NULL,
  `genero` varchar(30) NOT NULL,
  `caratula` varchar(100) NOT NULL,
  `trailer` varchar(200) DEFAULT NULL,
  `numValoraciones` int(200) NOT NULL,
  `valoracion` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`ID`, `nombre`, `descripcion`, `director`, `genero`, `caratula`, `trailer`, `numValoraciones`, `valoracion`) VALUES
(4, 'Titanic', 'Un joven aventurero y una hermosa aristócrata se encuentran a bordo del infortunado RMS Titanic durante su viaje inaugural.', 'James Cameron', 'Drama', 'titanic.png', 'https://www.youtube.com/embed/tA_qMdzvCvk?si=wGMbhBcJfEXdUDMM', 0, 0),
(5, 'Avatar', 'En el futuro, un exmarine parapléjico es enviado a la luna Pandora en una misión única que eventualmente se convierte en una épica batalla por la supervivencia.', 'James Cameron', 'Ciencia ficción', 'avatar.png', 'https://www.youtube.com/embed/CpXJHWSXJW0?si=CYAiBuTn7kGFF3pl', 0, 0),
(6, 'Forrest Gump', 'La vida de Forrest Gump, un hombre con una capacidad intelectual por debajo de la media pero con buen corazón, y su extraordinario viaje a través de la historia estadounidense.', 'Robert Zemeckis', 'Comedia', 'forrestgump.png', 'https://www.youtube.com/embed/bLvqoHBptjg?si=gjVEXAAoHT1ECIoV', 0, 0),
(7, 'The Shawshank Redemp', 'Un banquero condenado a cadena perpetua por el asesinato de su esposa y su amante, encuentra esperanza en medio de la desesperación mientras planea su escape de prisión.', 'Frank Darabont', 'Drama', 'shawshankredemption.png', 'https://www.youtube.com/embed/PLl99DlL6b4?si=uDUmWdMDvjisQ8Ly', 0, 0),
(8, 'Pulp Fiction', 'La vida de varios personajes interconectados, incluidos dos asesinos a sueldo, un boxeador, un gángster y su esposa, en tres historias entrelazadas.', 'Quentin Tarantino', 'Drama', 'pulpfiction.png', 'https://www.youtube.com/embed/s7EdQ4FqbhY?si=ujNd7lHeykVYkB2z', 0, 0),
(9, 'The Dark Knight', 'Cuando el caos irrumpe en Gotham City debido a la aparición del Joker, Batman debe enfrentarse a una de las pruebas más grandes de su vida.', 'Christopher Nolan', 'Acción', 'darkknight.png', 'https://www.youtube.com/embed/Qs-NylETt1E?si=DvuAFY9GLHyAR0QF', 0, 0),
(11, 'Fight Club', 'Un insomne empleado de oficina y un fabricante de jabón deprimido forman un club clandestino de lucha, revolucionando pronto toda la ciudad.', 'David Fincher', 'Drama', 'fightclub.png', 'https://www.youtube.com/embed/BdJKm16Co6M?si=FT_sqL2Ik9OTip7J', 0, 0),
(22, 'Inception', 'Un ladrón especializado en robar secretos del subconsciente durante el estado de sueño es contratado para implantar una idea en la mente de un CEO.', 'Christopher Nolan', 'Acción', 'inception.png', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reviews`
--

CREATE TABLE `reviews` (
  `ID` int(20) UNSIGNED NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `critica` varchar(300) NOT NULL,
  `puntuacion` int(5) UNSIGNED NOT NULL,
  `pelicula` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reviews`
--

INSERT INTO `reviews` (`ID`, `usuario`, `titulo`, `critica`, `puntuacion`, `pelicula`) VALUES
(0, 'administrador', 'nais', 'esta guapa', 5, 'Titanic');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`) VALUES
(4, 'usuario', '$2y$10$NjpTa1gbEWGvZ/.sOjNOT.7DfIDOY9oYj8ZoH6iORSF.0YzGpBGVO', 'user@gmail.com', 0),
(5, 'admin', '$2y$10$cYfyWtbnojOf/jDw7cYswuqsbb9WcW7dgVWQioboPCoLWgK4NFh3y', 'admin@gmail.com', 1),
(6, 'administrador', '$2y$10$KwUu5sSB8XiP7myjR4XIb.QSfdP9ue4.nzkMUwQuLHvEksrJ7FpiK', 'administrador@gmail.com', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
