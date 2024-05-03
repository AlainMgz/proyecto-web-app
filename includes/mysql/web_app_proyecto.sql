-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 03, 2024 at 04:41 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_app_proyecto`
--

-- --------------------------------------------------------

--
-- Table structure for table `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `contenido` text NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `follows` int(11) NOT NULL,
  `since` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`id`, `user`, `follows`, `since`) VALUES
(16, 4, 5, '2024-04-30'),
(17, 5, 4, '2024-04-30'),
(28, 15, 5, '2024-04-30');

-- --------------------------------------------------------

--
-- Table structure for table `generos`
--

CREATE TABLE `generos` (
  `genero` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `generos`
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
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `id_post` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peliculas`
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
-- Dumping data for table `peliculas`
--

INSERT INTO `peliculas` (`ID`, `nombre`, `descripcion`, `director`, `genero`, `caratula`, `trailer`, `numValoraciones`, `valoracion`) VALUES
(5, 'Avatar', 'En el futuro, un exmarine parapléjico es enviado a la luna Pandora en una misión única que eventualmente se convierte en una épica batalla por la supervivencia.', 'James Cameron', 'Ciencia ficción', 'avatar.png', 'https://www.youtube.com/embed/CpXJHWSXJW0?si=CYAiBuTn7kGFF3pl', 0, 0),
(6, 'Forrest Gump', 'La vida de Forrest Gump, un hombre con una capacidad intelectual por debajo de la media pero con buen corazón, y su extraordinario viaje a través de la historia estadounidense.', 'Robert Zemeckis', 'Comedia', 'forrestgump.png', 'https://www.youtube.com/embed/bLvqoHBptjg?si=gjVEXAAoHT1ECIoV', 0, 0),
(7, 'The Shawshank Redemp', 'Un banquero condenado a cadena perpetua por el asesinato de su esposa y su amante, encuentra esperanza en medio de la desesperación mientras planea su escape de prisión.', 'Frank Darabont', 'Drama', 'shawshankredemption.png', 'https://www.youtube.com/embed/PLl99DlL6b4?si=uDUmWdMDvjisQ8Ly', 0, 0),
(8, 'Pulp Fiction', 'La vida de varios personajes interconectados, incluidos dos asesinos a sueldo, un boxeador, un gángster y su esposa, en tres historias entrelazadas.', 'Quentin Tarantino', 'Drama', 'pulpfiction.png', 'https://www.youtube.com/embed/s7EdQ4FqbhY?si=ujNd7lHeykVYkB2z', 0, 0),
(9, 'The Dark Knight', 'Cuando el caos irrumpe en Gotham City debido a la aparición del Joker, Batman debe enfrentarse a una de las pruebas más grandes de su vida.', 'Christopher Nolan', 'Acción', 'darkknight.png', 'https://www.youtube.com/embed/Qs-NylETt1E?si=DvuAFY9GLHyAR0QF', 0, 0),
(11, 'Fight Club', 'Un insomne empleado de oficina y un fabricante de jabón deprimido forman un club clandestino de lucha, revolucionando pronto toda la ciudad.', 'David Fincher', 'Drama', 'fightclub.png', 'https://www.youtube.com/embed/BdJKm16Co6M?si=FT_sqL2Ik9OTip7J', 0, 0),
(22, 'Inception', 'Un ladrón especializado en robar secretos del subconsciente durante el estado de sueño es contratado para implantar una idea en la mente de un CEO.', 'Christopher Nolan', 'Acción', 'inception.png', NULL, 0, 0),
(23, 'Titanic', 'Un joven aventurero y una hermosa arist&amp;oacute;crata se encuentran a bordo del infortunado RMS Titanic durante su viaje inaugura.', 'James Cameron', 'Drama', 'titanic.png', 'https://www.youtube.com/embed/tA_qMdzvCvk?si=wGMbhBcJfEXdUDMM', 0, 4),
(26, 'Barbie', 'Después de ser expulsada de Barbieland por no ser una muñeca de aspecto perfecto, Barbie parte hacia el mundo humano para encontrar la verdadera felicidad', 'Greta Gerwig', 'Comedia', 'Barbie.jpg', 'https://www.youtube.com/embed/eUP3hlBel5I?si=IEJg4XVQKfTbESHR', 0, 0),
(28, 'Gladiator', 'El general romano Máximo es el soporte más leal del emperador Marco Aurelio, que lo ha conducido de victoria en victoria. Sin embargo, Cómodo, el hijo de Marco Aurelio, está celoso del prestigio de Máximo y aún más del amor que su padre siente por él.', 'Ridley Scott', 'Acción', 'Gladiator.jpg', 'https://www.youtube.com/embed/P5ieIbInFpg?si=NbeZsbqCNLVbmCKN', 0, 0),
(29, 'El dictador', 'El Almirante Haffaz Aladeen (Baron Cohen), un dictador antioccidental, arriesga su vida con tal de evitar el establecimiento de la democracia en Wadiya, un país norteafricano con recursos petrolíferos. Su más fiel consejero es su tío Tamir (Ben Kingsley), Jefe de la Policía Secreta, Jefe de Seguridad y Proveedor de Mujeres. Por desgracia para Aladeen y sus consejeros, Occidente ha empezado a inmiscuirse en los asuntos de Wadiya, país que ha sido sancionado varias veces por las Naciones Unidas en la última década. Tras sufrir un atentado que le cuesta la vida a uno de sus consejeros, Tamir convence a Aladeen para que vaya a Nueva York a solucionar la cuestión en la ONU', 'Sacha Baron-Cohen', 'Comedia', 'El dictador.jpg', 'https://www.youtube.com/embed/opqLwNj0428?si=Tss0_6DnloibNwsb', 0, 0),
(31, 'Los increibles', 'Un súper héroe retirado lucha contra el aburrimiento en un suburbio y junto con su familia tiene la oportunidad de salvar al mundo.', 'Brad Bird', 'Animación', 'Los increibles.jpeg', '//www.youtube.com/embed/6-Vql6wlW7o?si=SoFxkLB-mrwXRpvl', 0, 0),
(32, 'Cars', 'El aspirante a campeón de carreras Rayo McQueen parece que está a punto de conseguir el éxito. Su actitud arrogante se desvanece cuando llega a una pequeña comunidad olvidada que le enseña las cosas importantes de la vida que había olvidado.', 'John Lasseter', 'Animación', 'Cars.jpg', '//www.youtube.com/embed/W_H7_tDHFE8?si=4-Tfsveidv3qXoex', 0, 5),
(34, 'Gran Torino', 'Walt Kowalski, un veterano de la guerra de Corea, es un obrero jubilado del sector del automóvil que ha enviudado recientemente. Su máxima pasión es cuidar de su más preciado tesoro: un coche Gran Torino de 1972', 'Clint Eastwood', 'Acción', 'Gran Torino.jpg', '//www.youtube.com/embed/RMhbr2XQblk?si=x82aS_3FoX5qLVs3', 0, 0),
(35, 'Shrek', 'Hace mucho tiempo, en una lejana ciénaga, vivía un ogro llamado Shrek. Un día, su preciada soledad se ve interrumpida por un montón de personajes de cuento de hadas que invaden su casa. Todos fueron desterrados de su reino por el malvado Lord Farquaad.', 'Andrew Adamson', 'Animación', 'Shrek.jpg', '//www.youtube.com/embed/B88JfTyJ1Fw?si=_YXlKG1DSve3yboI', 0, 0),
(38, 'dasdasfaasf', 'asfasfasfa', 'asfas', 'Terror', 'dasdasfaasf.jpeg', 'sada', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `ID` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `texto` text NOT NULL,
  `likes` int(11) DEFAULT 0,
  `esComentario` tinyint(1) DEFAULT 0,
  `IDPadre` int(11) DEFAULT -1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
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
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`ID`, `usuario`, `titulo`, `critica`, `puntuacion`, `pelicula`) VALUES
(0, 'administrador', 'nais', 'esta guapa', 5, 'Titanic'),
(2, 'administrador', 'nais', 'esta bien', 3, 'Titanic'),
(5, 'administrador', 'nais', 'asdas', 5, 'Titanic');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` tinyint(2) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `profile_image`) VALUES
(4, 'usuario', '$2y$10$NjpTa1gbEWGvZ/.sOjNOT.7DfIDOY9oYj8ZoH6iORSF.0YzGpBGVO', 'user@gmail.com', 0, 'user_default.png'),
(5, 'admin', '$2y$10$cYfyWtbnojOf/jDw7cYswuqsbb9WcW7dgVWQioboPCoLWgK4NFh3y', 'admin@gmail.com', 1, 'user_default.png'),
(6, 'administrador', '$2y$10$KwUu5sSB8XiP7myjR4XIb.QSfdP9ue4.nzkMUwQuLHvEksrJ7FpiK', 'administrador@gmail.com', 1, 'user_default.png'),
(7, 'samuel', '$2y$10$r5WSsenllw5ehQ8GtFI0nOFOZtfEh3/qKm3TjIt2PdWyWPxEetPdK', 'samuelcarrillo2003@gmail.com', 0, 'user_default.png'),
(8, 'aweew', '$2y$10$elYaLmcrvgiiL3td0CczkeWTNtGvFO5FWxGK3SgWih2gPAC/Py0ce', 'awee@gmail.com', 0, 'user_default.png'),
(9, 'samcarri', '$2y$10$Bghm4TLG444lel409jWSBujhnFoC6Z0m6npbIUHBOqbb02rI9ajbi', 'samcarri@ucm.es', 0, 'user_default.png'),
(10, 'nicolas', '$2y$10$QzNQLc6TxcID1y6Pt4vtJOUoj1gqM6HyYvO4ay7e.zoXdlxp9s4Ri', 'nicolas@gmail.com', 0, 'user_default.png'),
(11, 'asdasdas', '$2y$10$Hl6Fkpx4GWcYEtpQRKcufexRx8BWa.UAKIvhS8FsR8ur9QcmuEE4O', 'adasd@gmail.com', 0, 'user_default.png'),
(15, 'leni', '$2y$10$PN38/BErNYZQYNfcoDduSOK3C5fOoat61DFK5zjL9QRwGtQsW8gSe', 'leni@gmail.com', 0, 'user_default.png'),
(18, 'image', '$2y$10$lLxSQNbDFJZE9KdO3AdCw.xfYiXW6oA2Pfr.4Qldy1QSnCMOIpaKy', 'img@profile.com', 0, 'image.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_post` (`id_post`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_like` (`id_post`);

--
-- Indexes for table `peliculas`
--
ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `idx_post_id` (`ID`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `peliculas`
--
ALTER TABLE `peliculas`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `ID` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `fk_comentarios_post` FOREIGN KEY (`id_post`) REFERENCES `post` (`ID`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `post` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
