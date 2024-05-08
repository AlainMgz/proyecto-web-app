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
(40, 'user32', 'Sobrecogedora', 'No podía apartar la vista de la pantalla, una experiencia inolvidable.', 5, 'Gran Torino');


--
-- Dumping data for table `post`
--

INSERT INTO `post` (`ID`, `ID_usuario`, `titulo`, `texto`, `likes`) VALUES
(1, 1, '¡Nuevo estreno en cartelera!', 'Acabo de ver la última película de Christopher Nolan y tengo que decir que es una obra maestra. ¡No te la pierdas!', 10),
(2, 2, 'Una comedia para morirse de risa', 'Anoche vi una película de comedia que me tuvo riendo todo el tiempo. ¿Alguien más la ha visto?', 20),
(3, 3, '¡Emocionante película de acción!', 'Acabo de ver una película de acción que me dejó sin aliento. ¡Increíbles efectos especiales y una trama emocionante!', 5),
(4, 4, 'Una joya del cine clásico', 'Hoy me aventuré a ver una película clásica y debo decir que quedé impresionado. ¡Qué actuaciones y qué dirección!', 15),
(5, 5, 'Una película conmovedora', 'Esta película es un viaje emocional que te llega al corazón. Definitivamente, ¡no te dejará indiferente!', 8),
(6, 6, 'La mejor película que he visto este año', 'Acabo de salir del cine y necesito compartir mi entusiasmo por esta película. ¡Simplemente espectacular!', 12),
(7, 7, 'Un thriller lleno de suspenso', 'Si te gustan las películas que te mantienen al borde del asiento, esta es para ti. ¡No te defraudará!', 18),
(8, 8, 'Una película que desafía la realidad', 'Inception es una montaña rusa de emociones. ¡No puedo dejar de pensar en ella!', 25),
(9, 9, 'Una película para reflexionar', 'Después de ver esta película, me quedé pensando en su mensaje durante días. Definitivamente, ¡vale la pena verla!', 30),
(10, 10, 'Una aventura épica', '¡Forrest Gump es una película que te hace reír, llorar y reflexionar sobre la vida! Simplemente inolvidable.', 14),
(11, 11, 'Una historia de amor y tragedia', 'Titanic sigue siendo una de mis películas favoritas. La recreación del hundimiento es simplemente impresionante.', 22),
(12, 12, 'Un clásico animado', 'Shrek es una película que nunca pasará de moda. ¡Sus personajes y su humor son simplemente geniales!', 7),
(13, 13, 'Una película para toda la familia', 'Cars es una película que disfrutan tanto los niños como los adultos. ¡Una verdadera joya de Pixar!', 13),
(14, 14, 'Un thriller psicológico', 'Fight Club es una montaña rusa emocional. ¡No te pierdas este viaje inolvidable!', 19),
(15, 15, 'Una historia de redención', 'The Shawshank Redemption es una película que te hace creer en la esperanza incluso en los momentos más oscuros.', 28),
(16, 16, 'Una película que desafía las expectativas', 'Pulp Fiction rompe todas las reglas del cine convencional. ¡Una experiencia verdaderamente única!', 11),
(17, 17, 'Un viaje al espacio', 'Interestellar te transporta a lugares que nunca imaginaste. ¡Una experiencia visual y emocionalmente impactante!', 17);


-- Insertar nuevos comentarios
--
-- Dumping data for table `comentario`
--

INSERT INTO `comentario` (`ID`, `ID_usuario`, `ID_post`, `texto`, `likes`) VALUES
(1, 21, 1, 'Totalmente de acuerdo contigo. La película es una obra maestra.', 5),
(2, 22, 1, 'Me encantaría verla. ¿En qué cine la viste?', 2),
(3, 23, 1, '¡Tengo que verla! Gracias por la recomendación.', 3),
(4, 24, 2, 'Sí, esa película es hilarante. Me reí mucho viéndola.', 8),
(5, 25, 2, '¡La vi y me encantó! Definitivamente una de las mejores comedias que he visto.', 6),
(6, 26, 2, '¿Cuál es el título de la película? Quiero agregarla a mi lista.', 4),
(7, 27, 3, '¡Tiene una trama increíble! Los efectos especiales son alucinantes.', 10),
(8, 28, 3, 'No puedo esperar para verla. ¿Dónde la viste?', 7),
(9, 29, 3, '¡La vi ayer y quedé asombrado! Definitivamente una de mis favoritas.', 9),
(10, 30, 4, 'Me alegro de que la hayas disfrutado tanto. ¿Cuál fue tu parte favorita?', 12),
(11, 31, 4, '¿Podrías decirme el nombre de la película? Me encantan las películas clásicas.', 13),
(12, 32, 4, '¡Qué buena elección! Las películas clásicas siempre tienen algo especial.', 15),
(13, 33, 5, '¡Totalmente de acuerdo! Esta película me llegó al corazón.', 18),
(14, 34, 5, '¡La vi y me hizo llorar como un bebé! Una experiencia conmovedora.', 20),
(15, 35, 5, 'Definitivamente una de las mejores películas que he visto. ¡No puedo dejar de recomendarla!', 22),
(16, 36, 6, '¡Estoy deseando verla! ¿De qué trata?', 25),
(17, 37, 6, '¿En qué cine la viste? Me gustaría verla este fin de semana.', 27),
(18, 38, 6, '¡No puedo esperar para verla! Gracias por compartir tu opinión.', 28),
(19, 39, 7, '¡Suena genial! Me encantan las películas de suspenso.', 30),
(20, 40, 7, '¿Es tan emocionante como dices? Definitivamente la agregaré a mi lista.', 32),
(21, 41, 7, 'Estoy buscando una buena película para ver esta noche. ¡Gracias por la recomendación!', 33),
(22, 42, 8, 'Inception es una obra maestra. ¡Nunca me canso de verla una y otra vez!', 36),
(23, 43, 8, '¡Totalmente de acuerdo! La trama es tan intrigante que siempre descubres algo nuevo.', 38),
(24, 44, 8, 'Uno de los mejores finales que he visto en una película. ¡Simplemente brillante!', 40),
(25, 45, 9, 'Esta película me hizo reflexionar sobre muchas cosas en mi vida. ¡Altamente recomendada!', 42),
(26, 46, 9, '¡Sí! Es una película que te deja pensando durante días. ¡No te la pierdas!', 44),
(27, 47, 9, 'Definitivamente una película que todos deberían ver al menos una vez en su vida.', 46),
(28, 48, 10, '¡Forrest Gump es una joya del cine! Una historia tan conmovedora y bien contada.', 48),
(29, 49, 10, '¡Me encanta esa película! La he visto tantas veces y nunca me canso de ella.', 50),
(30, 50, 10, 'Una película que captura perfectamente la esencia de la vida. ¡Altamente recomendada!', 52),
(31, 51, 11, 'Titanic es una de mis películas favoritas de todos los tiempos. ¡Una obra maestra!', 55),
(32, 52, 11, '¡Totalmente de acuerdo! Nunca me canso de verla una y otra vez.', 58),
(33, 53, 11, 'Una historia de amor épica que sigue siendo relevante hoy en día.', 60),
(34, 54, 12, 'Shrek es una película que siempre me hace reír. ¡Nunca pasa de moda!', 62),
(35, 55, 12, '¡Los personajes de Shrek son tan memorables! Una de mis películas favoritas de animación.', 65),
(36, 56, 12, '¡Es imposible no amar a Shrek y su pandilla! Una película divertida para todas las edades.', 68),
(37, 57, 13, 'Cars es una de esas películas que siempre disfruto ver, incluso después de tantos años.', 70),
(38, 58, 13, 'Una película llena de carisma y aventura. ¡Pixar siempre entrega lo mejor!', 72),
(39, 59, 13, 'Cars tiene un lugar especial en mi corazón. Una película que nunca me canso de ver.', 75),
(40, 60, 14, 'Fight Club es una montaña rusa emocional que te atrapa desde el principio hasta el final.', 78);
