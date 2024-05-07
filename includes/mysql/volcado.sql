--
-- Dumping data for table `users`
--

-- Primera parte: usuarios 1 al 15
INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `profile_image`) VALUES
(1, 'john', '$2y$10$JUGZkj3f9V/ElUCqZfKX3uswN9LjmI7zJ.F6ZLEAnQxGnTSX1a8y2', 'john.doe@example.com', 0, 'user_default.png'),
(2, 'jane', '$2y$10$WRRPW7eT5aK0AaXfS9ulnemTEQmDXvqlwFfQb/Fiv2y8BgbwIAbpW', 'jane.doe@example.com', 0, 'user_default.png'),
(3, 'admin', '$2y$10$trGzrDX15w9dOe2sT9BXmuH9hUn3cfN5sUvFwtN8ARs2zFVVnUCmG', 'admin@example.com', 1, 'user_default.png'),
(4, 'usuario', '$2y$10$NjpTa1gbEWGvZ/.sOjNOT.7DfIDOY9oYj8ZoH6iORSF.0YzGpBGVO', 'user@gmail.com', 0, 'user_default.png'),
(5, 'admin', '$2y$10$cYfyWtbnojOf/jDw7cYswuqsbb9WcW7dgVWQioboPCoLWgK4NFh3y', 'admin@gmail.com', 1, 'user_default.png'),
(6, 'administrador', '$2y$10$KwUu5sSB8XiP7myjR4XIb.QSfdP9ue4.nzkMUwQuLHvEksrJ7FpiK', 'administrador@gmail.com', 1, 'user_default.png'),
(7, 'samuel', '$2y$10$r5WSsenllw5ehQ8GtFI0nOFOZtfEh3/qKm3TjIt2PdWyWPxEetPdK', 'samuelcarrillo2003@gmail.com', 0, 'user_default.png'),
(8, 'aweew', '$2y$10$elYaLmcrvgiiL3td0CczkeWTNtGvFO5FWxGK3SgWih2gPAC/Py0ce', 'awee@gmail.com', 0, 'user_default.png'),
(9, 'samcarri', '$2y$10$Bghm4TLG444lel409jWSBujhnFoC6Z0m6npbIUHBOqbb02rI9ajbi', 'samcarri@ucm.es', 0, 'user_default.png'),
(10, 'nicolas', '$2y$10$QzNQLc6TxcID1y6Pt4vtJOUoj1gqM6HyYvO4ay7e.zoXdlxp9s4Ri', 'nicolas@gmail.com', 0, 'user_default.png'),
(11, 'asdasdas', '$2y$10$Hl6Fkpx4GWcYEtpQRKcufexRx8BWa.UAKIvhS8FsR8ur9QcmuEE4O', 'adasd@gmail.com', 0, 'user_default.png'),
(15, 'leni', '$2y$10$PN38/BErNYZQYNfcoDduSOK3C5fOoat61DFK5zjL9QRwGtQsW8gSe', 'leni@gmail.com', 0, 'user_default.png'),
(18, 'image', '$2y$10$lLxSQNbDFJZE9KdO3AdCw.xfYiXW6oA2Pfr.4Qldy1QSnCMOIpaKy', 'img@profile.com', 0, 'image.jpg'),
(19, 'user1', '$2y$10$NjpTa1gbEWGvZ/.sOjNOT.7DfIDOY9oYj8ZoH6iORSF.0YzGpBGVO', 'user1@example.com', 0, 'user_default.png'),
(20, 'user2', '$2y$10$cYfyWtbnojOf/jDw7cYswuqsbb9WcW7dgVWQioboPCoLWgK4NFh3y', 'user2@example.com', 0, 'user_default.png');

-- Segunda parte: usuarios 16 al 30
INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `profile_image`) VALUES
(21, 'user3', '$2y$10$KwUu5sSB8XiP7myjR4XIb.QSfdP9ue4.nzkMUwQuLHvEksrJ7FpiK', 'user3@example.com', 0, 'user_default.png'),
(22, 'user4', '$2y$10$r5WSsenllw5ehQ8GtFI0nOFOZtfEh3/qKm3TjIt2PdWyWPxEetPdK', 'user4@example.com', 0, 'user_default.png'),
(23, 'user5', '$2y$10$elYaLmcrvgiiL3td0CczkeWTNtGvFO5FWxGK3SgWih2gPAC/Py0ce', 'user5@example.com', 0, 'user_default.png'),
(24, 'user6', '$2y$10$NjpTa1gbEWGvZ/.sOjNOT.7DfIDOY9oYj8ZoH6iORSF.0YzGpBGVO', 'user6@example.com', 0, 'user_default.png'),
(25, 'user7', '$2y$10$cYfyWtbnojOf/jDw7cYswuqsbb9WcW7dgVWQioboPCoLWgK4NFh3y', 'user7@example.com', 0, 'user_default.png'),
(26, 'user8', '$2y$10$KwUu5sSB8XiP7myjR4XIb.QSfdP9ue4.nzkMUwQuLHvEksrJ7FpiK', 'user8@example.com', 0, 'user_default.png'),
(27, 'user9', '$2y$10$r5WSsenllw5ehQ8GtFI0nOFOZtfEh3/qKm3TjIt2PdWyWPxEetPdK', 'user9@example.com', 0, 'user_default.png'),
(28, 'user10', '$2y$10$elYaLmcrvgiiL3td0CczkeWTNtGvFO5FWxGK3SgWih2gPAC/Py0ce', 'user10@example.com', 0, 'user_default.png'),
(29, 'user11', '$2y$10$NjpTa1gbEWGvZ/.sOjNOT.7DfIDOY9oYj8ZoH6iORSF.0YzGpBGVO', 'user11@example.com', 0, 'user_default.png'),
(30, 'user12', '$2y$10$cYfyWtbnojOf/jDw7cYswuqsbb9WcW7dgVWQioboPCoLWgK4NFh3y', 'user12@example.com', 0, 'user_default.png');

-- Tercera parte: usuarios 31 al 45
INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `profile_image`) VALUES
(31, 'user13', '$2y$10$KwUu5sSB8XiP7myjR4XIb.QSfdP9ue4.nzkMUwQuLHvEksrJ7FpiK', 'user13@example.com', 0, 'user_default.png'),
(32, 'user14', '$2y$10$r5WSsenllw5ehQ8GtFI0nOFOZtfEh3/qKm3TjIt2PdWyWPxEetPdK', 'user14@example.com', 0, 'user_default.png'),
(33, 'user15', '$2y$10$elYaLmcrvgiiL3td0CczkeWTNtGvFO5FWxGK3SgWih2gPAC/Py0ce', 'user15@example.com', 0, 'user_default.png'),
(34, 'user16', '$2y$10$NjpTa1gbEWGvZ/.sOjNOT.7DfIDOY9oYj8ZoH6iORSF.0YzGpBGVO', 'user16@example.com', 0, 'user_default.png'),
(35, 'user17', '$2y$10$cYfyWtbnojOf/jDw7cYswuqsbb9WcW7dgVWQioboPCoLWgK4NFh3y', 'user17@example.com', 0, 'user_default.png'),
(36, 'user18', '$2y$10$KwUu5sSB8XiP7myjR4XIb.QSfdP9ue4.nzkMUwQuLHvEksrJ7FpiK', 'user18@example.com', 0, 'user_default.png'),
(37, 'user19', '$2y$10$r5WSsenllw5ehQ8GtFI0nOFOZtfEh3/qKm3TjIt2PdWyWPxEetPdK', 'user19@example.com', 0, 'user_default.png'),
(38, 'user20', '$2y$10$elYaLmcrvgiiL3td0CczkeWTNtGvFO5FWxGK3SgWih2gPAC/Py0ce', 'user20@example.com', 0, 'user_default.png'),
(39, 'user21', '$2y$10$NjpTa1gbEWGvZ/.sOjNOT.7DfIDOY9oYj8ZoH6iORSF.0YzGpBGVO', 'user21@example.com', 0, 'user_default.png'),
(40, 'user22', '$2y$10$cYfyWtbnojOf/jDw7cYswuqsbb9WcW7dgVWQioboPCoLWgK4NFh3y', 'user22@example.com', 0, 'user_default.png');

-- Cuarta parte: usuarios 46 al 60
INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `profile_image`) VALUES
(41, 'user23', '$2y$10$KwUu5sSB8XiP7myjR4XIb.QSfdP9ue4.nzkMUwQuLHvEksrJ7FpiK', 'user23@example.com', 0, 'user_default.png'),
(42, 'user24', '$2y$10$r5WSsenllw5ehQ8GtFI0nOFOZtfEh3/qKm3TjIt2PdWyWPxEetPdK', 'user24@example.com', 0, 'user_default.png'),
(43, 'user25', '$2y$10$elYaLmcrvgiiL3td0CczkeWTNtGvFO5FWxGK3SgWih2gPAC/Py0ce', 'user25@example.com', 0, 'user_default.png'),
(44, 'user26', '$2y$10$NjpTa1gbEWGvZ/.sOjNOT.7DfIDOY9oYj8ZoH6iORSF.0YzGpBGVO', 'user26@example.com', 0, 'user_default.png'),
(45, 'user27', '$2y$10$cYfyWtbnojOf/jDw7cYswuqsbb9WcW7dgVWQioboPCoLWgK4NFh3y', 'user27@example.com', 0, 'user_default.png'),
(46, 'user28', '$2y$10$KwUu5sSB8XiP7myjR4XIb.QSfdP9ue4.nzkMUwQuLHvEksrJ7FpiK', 'user28@example.com', 0, 'user_default.png'),
(47, 'user29', '$2y$10$r5WSsenllw5ehQ8GtFI0nOFOZtfEh3/qKm3TjIt2PdWyWPxEetPdK', 'user29@example.com', 0, 'user_default.png'),
(48, 'user30', '$2y$10$elYaLmcrvgiiL3td0CczkeWTNtGvFO5FWxGK3SgWih2gPAC/Py0ce', 'user30@example.com', 0, 'user_default.png'),
(49, 'user31', '$2y$10$NjpTa1gbEWGvZ/.sOjNOT.7DfIDOY9oYj8ZoH6iORSF.0YzGpBGVO', 'user31@example.com', 0, 'user_default.png'),
(50, 'user32', '$2y$10$cYfyWtbnojOf/jDw7cYswuqsbb9WcW7dgVWQioboPCoLWgK4NFh3y', 'user32@example.com', 0, 'user_default.png');

-- Quinta parte: usuarios 61 al 75
INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `profile_image`) VALUES
(51, 'user33', '$2y$10$KwUu5sSB8XiP7myjR4XIb.QSfdP9ue4.nzkMUwQuLHvEksrJ7FpiK', 'user33@example.com', 0, 'user_default.png'),
(52, 'user34', '$2y$10$r5WSsenllw5ehQ8GtFI0nOFOZtfEh3/qKm3TjIt2PdWyWPxEetPdK', 'user34@example.com', 0, 'user_default.png'),
(53, 'user35', '$2y$10$elYaLmcrvgiiL3td0CczkeWTNtGvFO5FWxGK3SgWih2gPAC/Py0ce', 'user35@example.com', 0, 'user_default.png'),
(54, 'user36', '$2y$10$NjpTa1gbEWGvZ/.sOjNOT.7DfIDOY9oYj8ZoH6iORSF.0YzGpBGVO', 'user36@example.com', 0, 'user_default.png'),
(55, 'user37', '$2y$10$cYfyWtbnojOf/jDw7cYswuqsbb9WcW7dgVWQioboPCoLWgK4NFh3y', 'user37@example.com', 0, 'user_default.png'),
(56, 'user38', '$2y$10$KwUu5sSB8XiP7myjR4XIb.QSfdP9ue4.nzkMUwQuLHvEksrJ7FpiK', 'user38@example.com', 0, 'user_default.png'),
(57, 'user39', '$2y$10$r5WSsenllw5ehQ8GtFI0nOFOZtfEh3/qKm3TjIt2PdWyWPxEetPdK', 'user39@example.com', 0, 'user_default.png'),
(58, 'user40', '$2y$10$elYaLmcrvgiiL3td0CczkeWTNtGvFO5FWxGK3SgWih2gPAC/Py0ce', 'user40@example.com', 0, 'user_default.png'),
(59, 'user41', '$2y$10$NjpTa1gbEWGvZ/.sOjNOT.7DfIDOY9oYj8ZoH6iORSF.0YzGpBGVO', 'user41@example.com', 0, 'user_default.png'),
(60, 'user42', '$2y$10$cYfyWtbnojOf/jDw7cYswuqsbb9WcW7dgVWQioboPCoLWgK4NFh3y', 'user42@example.com', 0, 'user_default.png');

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`id`, `user`, `follows`, `since`) VALUES
(16, 4, 5, '2024-04-30'),
(17, 5, 4, '2024-04-30'),
(28, 15, 5, '2024-04-30');

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

--
-- Dumping data for table `peliculas`
--

INSERT INTO `peliculas` (`ID`, `nombre`, `descripcion`, `director`, `genero`, `caratula`, `trailer`, `numValoraciones`, `valoracion`) VALUES
(1, 'Avatar', 'En el futuro, un exmarine parapléjico es enviado a la luna Pandora en una misión única que eventualmente se convierte en una épica batalla por la supervivencia.', 'James Cameron', 'Ciencia ficción', 'avatar.png', 'https://www.youtube.com/embed/CpXJHWSXJW0?si=CYAiBuTn7kGFF3pl', 0, 0),
(2, 'Forrest Gump', 'La vida de Forrest Gump, un hombre con una capacidad intelectual por debajo de la media pero con buen corazón, y su extraordinario viaje a través de la historia estadounidense.', 'Robert Zemeckis', 'Comedia', 'forrestgump.png', 'https://www.youtube.com/embed/bLvqoHBptjg?si=gjVEXAAoHT1ECIoV', 0, 0),
(3, 'The Shawshank Redemp', 'Un banquero condenado a cadena perpetua por el asesinato de su esposa y su amante, encuentra esperanza en medio de la desesperación mientras planea su escape de prisión.', 'Frank Darabont', 'Drama', 'shawshankredemption.png', 'https://www.youtube.com/embed/PLl99DlL6b4?si=uDUmWdMDvjisQ8Ly', 0, 0),
(4, 'Pulp Fiction', 'La vida de varios personajes interconectados, incluidos dos asesinos a sueldo, un boxeador, un gángster y su esposa, en tres historias entrelazadas.', 'Quentin Tarantino', 'Drama', 'pulpfiction.png', 'https://www.youtube.com/embed/s7EdQ4FqbhY?si=ujNd7lHeykVYkB2z', 0, 0),
(5, 'The Dark Knight', 'Cuando el caos irrumpe en Gotham City debido a la aparición del Joker, Batman debe enfrentarse a una de las pruebas más grandes de su vida.', 'Christopher Nolan', 'Acción', 'darkknight.png', 'https://www.youtube.com/embed/Qs-NylETt1E?si=DvuAFY9GLHyAR0QF', 0, 0),
(6, 'Fight Club', 'Un insomne empleado de oficina y un fabricante de jabón deprimido forman un club clandestino de lucha, revolucionando pronto toda la ciudad.', 'David Fincher', 'Drama', 'fightclub.png', 'https://www.youtube.com/embed/BdJKm16Co6M?si=FT_sqL2Ik9OTip7J', 0, 0),
(7, 'Inception', 'Un ladrón especializado en robar secretos del subconsciente durante el estado de sueño es contratado para implantar una idea en la mente de un CEO.', 'Christopher Nolan', 'Acción', 'inception.png', NULL, 0, 0),
(8, 'Titanic', 'Un joven aventurero y una hermosa arist&amp;oacute;crata se encuentran a bordo del infortunado RMS Titanic durante su viaje inaugura.', 'James Cameron', 'Drama', 'titanic.png', 'https://www.youtube.com/embed/tA_qMdzvCvk?si=wGMbhBcJfEXdUDMM', 0, 4),
(9, 'Barbie', 'Después de ser expulsada de Barbieland por no ser una muñeca de aspecto perfecto, Barbie parte hacia el mundo humano para encontrar la verdadera felicidad', 'Greta Gerwig', 'Comedia', 'Barbie.jpg', 'https://www.youtube.com/embed/eUP3hlBel5I?si=IEJg4XVQKfTbESHR', 0, 0),
(10, 'Gladiator', 'El general romano Máximo es el soporte más leal del emperador Marco Aurelio, que lo ha conducido de victoria en victoria. Sin embargo, Cómodo, el hijo de Marco Aurelio, está celoso del prestigio de Máximo y aún más del amor que su padre siente por él.', 'Ridley Scott', 'Acción', 'Gladiator.jpg', 'https://www.youtube.com/embed/P5ieIbInFpg?si=NbeZsbqCNLVbmCKN', 0, 0),
(11, 'El dictador', 'El Almirante Haffaz Aladeen (Baron Cohen), un dictador antioccidental, arriesga su vida con tal de evitar el establecimiento de la democracia en Wadiya, un país norteafricano con recursos petrolíferos. Su más fiel consejero es su tío Tamir (Ben Kingsley), Jefe de la Policía Secreta, Jefe de Seguridad y Proveedor de Mujeres. Por desgracia para Aladeen y sus consejeros, Occidente ha empezado a inmiscuirse en los asuntos de Wadiya, país que ha sido sancionado varias veces por las Naciones Unidas en la última década. Tras sufrir un atentado que le cuesta la vida a uno de sus consejeros, Tamir convence a Aladeen para que vaya a Nueva York a solucionar la cuestión en la ONU', 'Sacha Baron-Cohen', 'Comedia', 'El dictador.jpg', 'https://www.youtube.com/embed/opqLwNj0428?si=Tss0_6DnloibNwsb', 0, 0),
(12, 'Los increibles', 'Un súper héroe retirado lucha contra el aburrimiento en un suburbio y junto con su familia tiene la oportunidad de salvar al mundo.', 'Brad Bird', 'Animación', 'Los increibles.jpeg', '//www.youtube.com/embed/6-Vql6wlW7o?si=SoFxkLB-mrwXRpvl', 0, 0),
(13, 'Cars', 'El aspirante a campeón de carreras Rayo McQueen parece que está a punto de conseguir el éxito. Su actitud arrogante se desvanece cuando llega a una pequeña comunidad olvidada que le enseña las cosas importantes de la vida que había olvidado.', 'John Lasseter', 'Animación', 'Cars.jpg', '//www.youtube.com/embed/W_H7_tDHFE8?si=4-Tfsveidv3qXoex', 0, 5),
(14, 'Gran Torino', 'Walt Kowalski, un veterano de la guerra de Corea, es un obrero jubilado del sector del automóvil que ha enviudado recientemente. Su máxima pasión es cuidar de su más preciado tesoro: un coche Gran Torino de 1972', 'Clint Eastwood', 'Acción', 'Gran Torino.jpg', '//www.youtube.com/embed/RMhbr2XQblk?si=x82aS_3FoX5qLVs3', 0, 0),
(15, 'Shrek', 'Hace mucho tiempo, en una lejana ciénaga, vivía un ogro llamado Shrek. Un día, su preciada soledad se ve interrumpida por un montón de personajes de cuento de hadas que invaden su casa. Todos fueron desterrados de su reino por el malvado Lord Farquaad.', 'Andrew Adamson', 'Animación', 'Shrek.jpg', '//www.youtube.com/embed/B88JfTyJ1Fw?si=_YXlKG1DSve3yboI', 0, 0),
(16, 'Interestellar', 'Un astronauta viaja en el tiempo para salvar la humanidad del cierre de un agujero negro.', 'Christopher Nolan', 'Ciencia ficción', 'interstellar.jpg', 'https://www.youtube.com/embed/hhCtMhk8eHo?si=HvPDlDYZgHqToo0N', 0, 0),
(17, 'Moana', 'Una joven chica de Hawái parte en un peregrinaje para rescatar a su padre y restaurar el poder de la deidad de la vida.', 'Ron Huerta', 'Animación', 'moana.jpg', 'https://www.youtube.com/embed/tmpTGztGJ8E?si=Xf-JBXTWzfmnRZHw', 0, 0),
(18, 'Spotlight', 'Un equipo de periodistas de Boston descubre un escándalo de abusos sexual cometidos por clérigos católicos y lucha contra la corrupción para denunciarlo.', 'Tom McCarthy', 'Drama', 'spotlight.jpg', 'https://www.youtube.com/embed/3G2EgJBkNaQ?si=wK-HCyL70SiCHHHk', 0, 0),
(19, 'La La Land', 'Un músico de jazz y una bailarina de ballet se enamoran mientras trabajan juntos en una producción cinematográfica.', 'James Bill', 'Drama', 'lala-land.jpg', 'https://www.youtube.com/embed/45s24h98iOc?si=V03Z6FtvubQU0k84', 0, 0),
(20, 'The Revenant', 'Un hombre sobreviviente de un masacro en el siglo XIX, que lleva a cabo una travesía peligrosa y perilosa para encontrar a su hermano que también sobrevivió.', 'Alejandro G. Iddia', 'Acción', 'revenant.jpg', 'https://www.youtube.com/embed/LoebZZ8K5N0?si=_unAC9o8C5y6n-E8', 0, 0),
(21, 'The Big Short', 'Tras el desastre bursátil de 2008, un hombre sin trabajo y un experto en juegos de azar se unen para detener a los banqueros y los traders que llevaron al mundo a la quiebra.', 'Adam McKay', 'Documental', 'big-short.jpg', 'https://www.youtube.com/embed/vgqG3ITMv1Q?si=TJM0GZn2Z0lc66oR', 0, 0),
(23, 'Sicario: Otra vida', 'Un hombre de la CIA, que lleva una vida en la que asesina a gente sin cuestionar, debe enfrentarse a su pasado cuando es traído de regreso a la acción.', 'Denis Villeneuve', 'Acción', 'sicario2.jpg', 'https://www.youtube.com/embed/Pymm6cmE9uQ?si=KnpnuWA7jkntsihY', 0, 0),
(24, '12 Hombres Sin Línea', 'Un hombre, desesperado por la muerte de su mujer, se une a un equipo de mercenarios para llevar a cabo una misión peligrosa en el Congo.', 'Kenneth Renker', 'Acción', '12-hombres.jpg', 'https://www.youtube.com/embed/TEN-2uTi2c0?si=hew4RzaJxINO0ILQ', 0, 0),
(25, 'Black Panther', 'En el universo de Wakanda, T’Challa, el rey de Wakanda, lucha por mantener su reino y su gente en paz, mientras se enfrenta a las amenazas externas y内部.', 'Ryan Coogler', 'Acción', 'blackpanther.png', 'https://www.youtube.com/embed/JK-wAfAvJ0g?si=XRJmvGYbp6nQDc9K', 0, 0),
(26, 'Joker', 'Un hombre en el borde de la locura, que comete un asesinato después de otro y lleva a cabo una serie de crímenes en Nueva York.', 'Todd Phillips', 'Terror', 'joker.png', 'https://www.youtube.com/embed/ygUHhImN98w?si=17OZ2VOk6I2xjN7L', 0, 0),
(27, 'Parasitos', 'Una familia de obreros migratorios se encuentra en medio de una lucha económica para ganar el suficiente dinero para pagar una operación quirúrgica que les permitirá a su hija nacer.', 'Bong Joon-ho', 'Terror', 'parasitos.png', 'https://www.youtube.com/embed/5xH0HfJHsaY?si=IxQyzyVEdNHnKAmY', 0, 0),
(28, 'Crazy Rich Asians', 'Una mujer estadounidense se casa con un hombre rico y exclusivo, pero pronto descubre que su nuevo marido vive en un mundo de lujo y extravagancia.', 'Jon M. Chu', 'Romance', 'crazyrichasians.png', 'https://www.youtube.com/embed/ZQ-YX-5bAs0?si=rww4ETBJX_UzNSPv', 0, 0),
(29, 'The Lighthouse', 'Dos hombres de diferentes épocas y lugares, que viven en un islote remoto, se encuentran y comienzan a descubrir verdades sobre su pasado y sobre ellos mismos.', 'Robert Eggers', 'Historia', 'thelighthouse.jpg', 'https://www.youtube.com/embed/Hyag7lR8CPA?si=WRpqs-U6TQHNr4Cu', 0, 0),
(30, 'Midsommar', 'Una mujer y su hija se dirigen a Suecia para pasar las fiestas de San Juan, pero pronto descubren que los antiguos mitos y leyendas de esa tierra serán la realidad.', 'Wilson y Alexander', 'Terror', 'midsommar.jpg', 'https://www.youtube.com/embed/YKhlKGQsyw4?si=f-RjRo_xGdhu8KGr', 0, 0),
(31, 'First Man', 'La historia de Neil Armstrong y los primeros pasos humanos en el espacio.', 'Ryan Coogler', 'Drama', 'firstman.jpg', 'https://www.youtube.com/embed/JnISFkVs4Q0?si=G_5Bdgdsss_nAMIm', 0, 0),
(32, 'The Irishman', 'La historia de las últimas horas de Scarface, Don Vito Andolini, y cómo terminó su vida.', 'Martin Scorsese', 'Terror', 'theirishman.jpg', 'https://www.youtube.com/embed/WHXxVmeGQUc?si=R68vmOWssO6eNolu', 0, 0),
(33, 'The King''s Man', 'Los hombres que salvan el mundo deberán enfrentarse a un mundo que se encuentra en crisis.', 'Todd Phillips', 'Acción', 'thekingsman.jpg', 'https://www.youtube.com/embed/Rs5J8kh62yo?si=adz-G95PqG1svNbn', 0, 0),
(34, 'The Tragedy of Macbeth', 'La historia de Macbeth, un hombre que comete un asesinato y se enfrenta a la conciencia.', 'Sofia Coppola', 'Terror', 'thetragedyofmacbeth.jpg', 'https://www.youtube.com/embed/ptqe7s6pO7g?si=Ex_Desk6T0UcyvK6', 0, 0),
(35, 'The White Princess', 'La historia de una mujer que se encuentra en medio de la Guerra de las Rosas y debe descubrir lo que es amor verdadero.', 'Joan Chombhaut', 'Drama', 'thewhiteprincess.jpg', 'https://www.youtube.com/embed/TJ-q3_b3dkI?si=iS4po3mZ90URqRdu', 0, 0);

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`ID`, `usuario`, `titulo`, `critica`, `puntuacion`, `pelicula`) VALUES
(0, 'administrador', 'nais', 'esta guapa', 5, 'Titanic'),
(2, 'administrador', 'nais', 'esta bien', 3, 'Titanic'),
(5, 'administrador', 'nais', 'asdas', 5, 'Titanic'),
(9, 'user1', 'Genial', 'Una película increíble, la trama te atrapa desde el principio.', 5, 'Forrest Gump'),
(10, 'user2', 'Entretenida', 'Me gustó mucho la historia y los personajes.', 4, 'Pulp Fiction'),
(11, 'user3', 'Muy buena', 'Excelente película, la actuación es sobresaliente.', 5, 'The Shawshank Redemption'),
(12, 'user4', 'Inolvidable', 'Una película que deja huella, la recomiendo totalmente.', 5, 'Gran Torino'),
(13, 'user5', 'Divertida', 'Me reí mucho con esta película, es perfecta para desconectar.', 4, 'Shrek'),
(14, 'user6', 'Impactante', 'La trama te mantiene en vilo todo el tiempo, muy recomendable.', 5, 'Inception'),
(15, 'user7', 'Emocionante', 'Una película que te llega al corazón, no pude contener las lágrimas.', 5, 'Titanic'),
(16, 'user8', 'Interesante', 'Una película que te hace reflexionar, muy bien realizada.', 4, 'Fight Club'),
(17, 'user9', 'Imprescindible', 'Una obra maestra del cine, no te la puedes perder.', 5, 'The Dark Knight'),
(18, 'user10', 'Sorprendente', 'Me dejó sin palabras, una de las mejores películas que he visto.', 5, 'Gladiator'),
(19, 'user11', 'Recomendable', 'Una película muy entretenida, perfecta para pasar un buen rato.', 4, 'Los increíbles'),
(20, 'user12', 'Asombrosa', 'Los efectos especiales son increíbles, te sumergen por completo en la historia.', 5, 'Avatar'),
(21, 'user13', 'Desgarradora', 'Una película que te hace reflexionar sobre la naturaleza humana.', 4, 'El dictador'),
(22, 'user14', 'Divertida', 'Una comedia muy entretenida, perfecta para ver en familia.', 4, 'Barbie'),
(23, 'user15', 'Impactante', 'Me sorprendió gratamente, la trama tiene giros inesperados.', 5, 'Cars'),
(24, 'user16', 'Emocionante', 'Una película que te mantiene en vilo de principio a fin.', 5, 'Shrek'),
(25, 'user17', 'Sobrecogedora', 'No podía apartar la vista de la pantalla, una experiencia inolvidable.', 5, 'Gran Torino'),
(26, 'user18', 'Intrigante', 'Una película que te hace cuestionarte todo, muy interesante.', 4, 'Inception'),
(27, 'user19', 'Divertida', 'Me reí a carcajadas, una comedia perfecta.', 4, 'The Shawshank Redemption'),
(28, 'user20', 'Inolvidable', 'Una película que te deja pensando mucho después de verla.', 5, 'Pulp Fiction'),
(29, 'user21', 'Impactante', 'Los efectos especiales son alucinantes, te transportan a otro mundo.', 5, 'Avatar'),
(30, 'user22', 'Emocionante', 'Una película que te llega al corazón, no pude contener las lágrimas.', 5, 'The Dark Knight'),
(31, 'user23', 'Interesante', 'Una trama intrigante que te mantiene enganchado en todo momento.', 4, 'Fight Club'),
(32, 'user24', 'Divertida', 'Una comedia ligera perfecta para desconectar.', 4, 'Los increíbles'),
(33, 'user25', 'Conmovedora', 'Una película que te hace reflexionar sobre la vida.', 5, 'Forrest Gump'),
(34, 'user26', 'Emocionante', 'Me mantuvo al borde del asiento todo el tiempo, muy recomendable.', 5, 'Gladiator'),
(35, 'user27', 'Impresionante', 'Una película que te deja sin aliento, la recomiendo totalmente.', 5, 'Titanic'),
(36, 'user28', 'Genial', 'Una película que te hace reflexionar sobre la naturaleza humana.', 5, 'El dictador'),
(37, 'user29', 'Divertida', 'Una comedia muy entretenida, perfecta para ver en familia.', 4, 'Barbie'),
(38, 'user30', 'Impactante', 'Los efectos especiales son increíbles, te sumergen por completo en la historia.', 5, 'Cars'),
(39, 'user31', 'Emocionante', 'Una película que te mantiene en vilo de principio a fin.', 5, 'Shrek'),
(40, 'user32', 'Sobrecogedora', 'No podía apartar la vista de la pantalla, una experiencia inolvidable.', 5, 'Gran Torino'),
(41, 'user33', 'Intrigante', 'Una película que te hace cuestionarte todo, muy interesante.', 4, 'Inception'),
(42, 'user34', 'Divertida', 'Me reí a carcajadas, una comedia perfecta.', 4, 'The Shawshank Redemption'),
(43, 'user35', 'Inolvidable', 'Una película que te deja pensando mucho después de verla.', 5, 'Pulp Fiction'),
(44, 'user36', 'Impactante', 'Los efectos especiales son alucinantes, te transportan a otro mundo.', 5, 'Avatar'),
(45, 'user37', 'Emocionante', 'Una película que te llega al corazón, no pude contener las lágrimas.', 5, 'The Dark Knight'),
(46, 'user38', 'Interesante', 'Una trama intrigante que te mantiene enganchado en todo momento.', 4, 'Fight Club'),
(47, 'user39', 'Divertida', 'Una comedia ligera perfecta para desconectar.', 4, 'Los increíbles'),
(48, 'user40', 'Conmovedora', 'Una película que te hace reflexionar sobre la vida.', 5, 'Forrest Gump'),
(49, 'user41', 'Emocionante', 'Me mantuvo al borde del asiento todo el tiempo, muy recomendable.', 5, 'Gladiator'),
(50, 'user42', 'Impresionante', 'Una película que te deja sin aliento, la recomiendo totalmente.', 5, 'Titanic'),
(51, 'user3', 'Excelente película', 'Interstellar es una obra maestra del género de ciencia ficción. La trama es fascinante y la actuación es impresionante. ¡Recomendada al 100%!', 5, 'Interestellar'),
(52, 'user4', 'Una aventura emocionante', 'Moana es una película animada maravillosa que cautiva tanto a niños como a adultos. La música, los personajes y la animación son excelentes.', 4, 'Moana'),
(53, 'user5', 'Impactante y necesario', 'Spotlight es una película impactante que aborda un tema difícil pero importante. La actuación del elenco es sobresaliente y la dirección es impecable.', 5, 'Spotlight'),
(54, 'user6', 'Emocionante y conmovedora', 'La La Land es una película hermosa que combina música, romance y nostalgia de una manera encantadora. ¡No puedes dejar de verla!', 4, 'La La Land'),
(55, 'user7', 'Intensa y visceral', 'The Revenant es una experiencia cinematográfica intensa y visceral. La actuación de Leonardo DiCaprio es fenomenal y la cinematografía es impresionante.', 5, 'The Revenant'),
(56, 'user8', 'Informativa y entretenida', 'The Big Short es un documental ingenioso que explica de manera accesible y entretenida los eventos que llevaron a la crisis financiera de 2008. ¡Muy recomendado!', 4, 'The Big Short'),
(57, 'user9', 'Secuela emocionante', 'Sicario: Otra Vida es una secuela que no decepciona. La trama es emocionante y llena de giros inesperados. ¡Un gran thriller de acción!', 4, 'Sicario: Otra vida'),
(58, 'user10', 'Acción trepidante', '12 Hombres Sin Línea es una película de acción trepidante con una trama emocionante y escenas de combate impresionantes. ¡Una gran película de aventuras!', 4, '12 Hombres Sin Línea'),
(59, 'user3', 'Me encantó Black Panther', '¡Una película emocionante con una gran historia y personajes increíbles!', 9, 'Black Panther'),
(60, 'user4', 'Joker es una obra maestra', 'La actuación de Joaquin Phoenix es sobresaliente y la trama te mantiene en vilo desde el principio hasta el final.', 10, 'Joker'),
(61, 'user5', 'Parasitos: una obra maestra del cine', 'Bong Joon-ho ha creado una película brillante que te hace reflexionar sobre la desigualdad social de una manera impactante.', 9, 'Parasitos'),
(62, 'user6', 'Crazy Rich Asians: una comedia encantadora', 'Esta película es una delicia visual y una historia romántica moderna que te deja con una sonrisa en el rostro.', 8, 'Crazy Rich Asians'),
(63, 'user7', 'The Lighthouse es una experiencia única', 'La cinematografía y las actuaciones en esta película son excepcionales. Te sumerge por completo en la atmósfera claustrofóbica y misteriosa del faro.', 9, 'The Lighthouse'),
(64, 'user8', 'Midsommar: perturbador y fascinante', 'Una película que te deja sin aliento con su belleza visual y su historia inquietante. Definitivamente no es para los débiles de corazón.', 8, 'Midsommar'),
(65, 'user9', 'First Man: una mirada íntima a la historia', 'Esta película ofrece una visión conmovedora de la vida de Neil Armstrong y los desafíos que enfrentó en su viaje a la Luna. Ryan Gosling ofrece una actuación excepcional.', 8, 'First Man'),
(66, 'user10', 'The Irishman: un clásico moderno', 'Martin Scorsese vuelve a entregar una obra maestra con esta épica historia de crimen y redención. Las actuaciones de De Niro, Pacino y Pesci son simplemente impresionantes.', 9, 'The Irishman'),
(67, 'user11', 'The King''s Man: acción sin parar', 'Esta película es una montaña rusa de emociones con secuencias de acción emocionantes y un elenco estelar. Una adición digna a la franquicia Kingsman.', 8, 'The King''s Man'),
(68, 'user12', 'The Tragedy of Macbeth: sombrío y poderoso', 'Una adaptación impresionante de la obra clásica de Shakespeare. Denzel Washington y Frances McDormand entregan actuaciones extraordinarias que te dejarán sin aliento.', 9, 'The Tragedy of Macbeth'),
(69, 'user3', 'The White Princess: drama cautivador', 'Una historia épica de amor y traición ambientada en el oscuro y peligroso mundo de la Guerra de las Rosas. Una serie que te mantiene enganchado desde el primer episodio.', 8, 'The White Princess');

--
-- Dumping data post
--
INSERT INTO post (usuario, titulo, texto, likes, esComentario, IDPadre) 
VALUES 
('john', '¡Acabo de ver una gran película!', 'Me encantó la actuación de los protagonistas. ¿Alguien más la ha visto? #Avatar', 10, 0, -1),
('jane', 'Recomendación de película', 'Esta película es una obra maestra del cine. No te la pierdas. #Forrest_Gump', 15, 0, -1),
('admin', 'Crítica de cine', 'Esta película tiene una narrativa intrigante y una cinematografía impresionante. #The_Shawshank_Redemp', 20, 0, -1),
('john', '¿Alguien ha visto esta película?', 'Estoy pensando en ver esta película este fin de semana. ¿Alguna recomendación? #Pulp_Fiction', 8, 0, -1),
('nicolas', 'Una joya del cine independiente', 'Descubrí esta película recientemente y me dejó sin palabras. Debería ser más conocida. #The_Dark_Knight', 25, 0, -1),
('aweew', 'Análisis de personajes', 'Los personajes de esta película son increíblemente complejos y bien desarrollados. #Fight_Club', 30, 0, -1),
('samuel', 'Nueva película de acción', '¡Acabo de ver la nueva película de acción y me dejó sin aliento! ¿Alguien más la ha visto? #Inception', 12, 0, -1),
('samcarri', '¡Increíble experiencia cinematográfica!', 'No puedo creer lo bien dirigida que está esta película. Definitivamente una de mis favoritas. #Titanic', 18, 0, -1),
('nicolas', 'Comedia romántica imperdible', 'Esta película es perfecta para una noche de risas y buenos momentos. ¡Altamente recomendada! #Barbie', 22, 0, -1),
('leni', 'Drama emocionante', 'El drama en esta película es simplemente impresionante. Prepara los pañuelos. #Gladiator', 14, 0, -1),
('image', 'Nuevo thriller psicológico', 'Si te gustan las películas que te hacen pensar, esta es para ti. ¡No te decepcionará! #The_Shawshank_Redemp', 16, 0, -1),
('user1', 'Una película para reflexionar', 'Esta película me dejó reflexionando sobre la vida durante días. Altamente recomendada para una experiencia introspectiva. #Gran_Torino', 28, 0, -1),
('user2', 'Acción trepidante', 'Los efectos especiales en esta película son simplemente asombrosos. ¡No te la pierdas! #Cars', 20, 0, -1),
('user3', 'Una obra de arte', 'Esta película es una verdadera obra de arte. Cada fotograma es impresionante. #Shrek', 24, 0, -1),
('user4', 'Un clásico moderno', 'Esta película se convertirá en un clásico instantáneo. ¡Ve a verla antes de que sea demasiado tarde! #Los_increibles', 19, 0, -1),
('user5', 'Fantasía épica', 'El mundo creado en esta película es simplemente impresionante. ¡Me encantaría vivir allí! #Dasdasfaasf', 21, 0, -1),
('user6', 'Suspense hasta el final', 'Nunca sabes qué esperar con esta película. #Forrest_Gump', 17, 0, -1),
('user7', 'Drama conmovedor', 'Las actuaciones en esta película son excepcionales. Te dejará con los ojos llorosos. #The_Shawshank_Redemp', 23, 0, -1),
('user8', 'Una joya oculta', 'Descubrí esta película por casualidad y ahora la recomiendo a todo el mundo. Es una joya oculta. #The_Shawshank_Redemp', 27, 0, -1);


-- Insertar nuevos comentarios
INSERT INTO comentarios (id_post, usuario, contenido, fecha) 
VALUES 
(1, 'user9', '¡Sí! La vi también y me encantó.', '2024-05-03 16:45:00'),
(1, 'user10', 'Totalmente de acuerdo. La actuación fue excepcional.', '2024-05-03 17:12:00'),
(2, 'user11', 'Gracias por la recomendación. La agregaré a mi lista.', '2024-05-03 17:30:00'),
(2, 'user12', '¡La vi hace poco y me fascinó!', '2024-05-03 18:02:00'),
(3, 'user13', 'Estoy ansioso por ver esta película. ¡Gracias por compartir tu opinión!', '2024-05-03 18:20:00'),
(3, 'user14', '¡Definitivamente la veré este fin de semana!', '2024-05-03 18:45:00'),
(4, 'user15', 'La vi hace un tiempo y la recomendaría a cualquiera.', '2024-05-03 19:00:00'),
(4, 'user16', 'Es una película increíble. ¡No te arrepentirás de verla!', '2024-05-03 19:30:00'),
(5, 'user17', 'Estoy de acuerdo. Esta película es una joya escondida.', '2024-05-03 20:00:00'),
(5, 'user18', 'Es una de mis películas favoritas. La he visto varias veces.', '2024-05-03 20:15:00'),
(6, 'user19', 'El desarrollo de los personajes es realmente impresionante.', '2024-05-03 20:30:00'),
(6, 'user20', 'Me encanta cómo cada personaje tiene su propia historia.', '2024-05-03 20:45:00'),
(7, 'user21', '¡Acabo de verla! ¡Fue una montaña rusa de emociones!', '2024-05-03 21:00:00'),
(7, 'user22', '¡Esa escena de la persecución en coche fue épica!', '2024-05-03 21:15:00'),
(8, 'user23', 'Coincido totalmente. La dirección fue impecable.', '2024-05-03 21:30:00'),
(8, 'user24', '¡Es una de mis películas favoritas de todos los tiempos!', '2024-05-03 21:45:00'),
(9, 'user25', 'Estaba buscando una película ligera para ver. ¡Gracias por la recomendación!', '2024-05-03 22:00:00'),
(9, 'user26', 'La vi con mi pareja y nos encantó a ambos. ¡Muy recomendable!', '2024-05-03 22:15:00'),
(10, 'user27', '¡Me encantan las comedias románticas! Definitivamente la veré.', '2024-05-03 22:30:00'),
(10, 'user28', 'Es perfecta para verla con tu pareja. ¡Disfrútenla juntos!', '2024-05-03 22:45:00'),
(11, 'user29', 'Me encanta cuando las películas me hacen llorar. ¡Definitivamente la veré!', '2024-05-03 23:00:00'),
(11, 'user30', '¡Prepara los pañuelos! Esta película te llegará al corazón.', '2024-05-03 23:15:00'),
(12, 'user31', '¡Esta película me tuvo en vilo hasta el último minuto!', '2024-05-03 23:30:00'),
(12, 'user32', 'Nunca supe qué iba a pasar a continuación. ¡Una experiencia increíble!', '2024-05-03 23:45:00');