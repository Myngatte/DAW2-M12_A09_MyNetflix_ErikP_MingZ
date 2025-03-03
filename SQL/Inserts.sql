-- Insert into tbl_roles
INSERT INTO tbl_roles (nom_rol) VALUES 
('Admin'),
('User');

-- Insert into tbl_rol_staff
INSERT INTO tbl_rol_staff (nom_rol_staff) VALUES 
('Director'),
('Actor');

-- Insert into tbl_users
INSERT INTO tbl_users (username, email, contrasena, nombre_usr, apellido_usr, fecha_nac, genero_usr, estado, rol_user) VALUES
('erikp', 'erikp@gmail.com', '$2a$12$sDax3uNbAgg7ME5qpnVOS.K3gtzXOWxqte8irwopdnbx0X4wnI4/u', 'Erik', 'Penas', '1999-05-15', 'Masculino', 'Aceptado', 1),
('mingz', 'mingz@gmail.com', '$2a$12$sDax3uNbAgg7ME5qpnVOS.K3gtzXOWxqte8irwopdnbx0X4wnI4/u', 'Ming', 'Zhou', '1999-05-20', 'Masculino', 'Aceptado', 1),
('jhonnydeep', 'johndoe@gmail.com', '$2a$12$sDax3uNbAgg7ME5qpnVOS.K3gtzXOWxqte8irwopdnbx0X4wnI4/u', 'Jhony', 'Deep', '1990-05-15', 'Masculino', 'Aceptado', 2),
('benitoc', 'johndoe@example.com', '$2a$12$sDax3uNbAgg7ME5qpnVOS.K3gtzXOWxqte8irwopdnbx0X4wnI4/u', 'Benito', 'Camela', '1969-05-15', 'Masculino', 'Aceptado', 2),
('janedoe', 'janedoe@hotmail.com', '$2a$12$sDax3uNbAgg7ME5qpnVOS.K3gtzXOWxqte8irwopdnbx0X4wnI4/u', 'Jane', 'Doe', '1992-08-22', 'Femenino', 'Pendiente', 2);

-- Insert into tbl_pgeneros
INSERT INTO tbl_pgeneros (nom_genero) VALUES
('Ciencia Ficcion'),
('Accion'),
('Drama'),
('Comedia'),
('Animacion'),
('Romance'),
('Fantasía'),
('Aventura'),
('Fantasía Oscura'),
('Familiar'),
('Histórico'),
('Guerra'),
('Artes Marciales'),
('Thriller'),
('Misterio'),
('Supernatural'),
('Cyberpunk'),
('Terror'),
('Apocalíptico'),
('Suspense');

-- Insert into tbl_pelis
INSERT INTO tbl_pelis (nom_peli, descripcion, duracion, portada, trailer) VALUES
('Your Name', 'Dos adolescentes descubren que están conectados misteriosamente a través de sus sueños.', '01:46:00', 'Your_Name_poster.png', 'yourname_trailer.mp4'),
('El viaje de Chihiro', 'Una niña entra en un mundo mágico donde debe trabajar en una casa de baños para espíritus.', '02:05:00', 'El_viaje_de_chihiro.png', 'spirited_away_trailer.mp4'),
('Attack on Titan: Chronicle', 'La humanidad lucha por sobrevivir contra gigantes que devoran humanos.', '02:00:00', 'AOT_chronicle.png', 'aot_trailer.mp4'),
('Mi vecino Totoro', 'Dos niñas descubren criaturas mágicas en su nuevo hogar en el campo.', '01:26:00', 'Mi_Vecino_Totoro.png', 'totoro_trailer.mp4'),
('Demon Slayer: Mugen Train', 'Tanjiro y sus compañeros se embarcan en una peligrosa misión en un tren.', '01:57:00', 'Demon_Slayer_Mugen_Train.png', 'demonslayer_trailer.mp4'),
('La tumba de las luciérnagas', 'La historia de dos hermanos que luchan por sobrevivir durante la Segunda Guerra Mundial.', '01:29:00', 'La_Tumba_de_Las_Luciernagas.png', 'fireflies_trailer.mp4'),
('Dragon Ball Super: Broly', 'Goku y Vegeta enfrentan al poderoso guerrero Broly.', '01:40:00', 'DBS_Broly.png', 'broly_trailer.mp4'),
('El castillo ambulante', 'Una joven maldecida con el cuerpo de una anciana busca romper el hechizo.', '01:59:00', 'El_castillo_ambulante.png', 'howls_castle_trailer.mp4'),
('Perfect Blue', 'Una idol convertida en actriz comienza a perder el sentido de la realidad.', '01:21:00', 'Perfectblue.png', 'perfect_blue_trailer.mp4'),
('One Piece Film: Red', 'Luffy y su tripulación descubren secretos sobre una misteriosa cantante.', '01:55:00', 'One_Piece_Film_Red.png', 'onepiece_red_trailer.mp4'),
('La princesa Mononoke', 'Un príncipe se ve envuelto en un conflicto entre los espíritus del bosque y la humanidad.', '02:13:00', 'Princess_Mononoke.png', 'mononoke_trailer.mp4'),
('Jujutsu Kaisen 0', 'Un estudiante lucha contra maldiciones mientras intenta controlar sus propios poderes.', '01:45:00', 'Jujutsu_Kaisen_0.png', 'jjk0_trailer.mp4'),
('Ghost in the Shell', 'Una cyborg policía investiga un misterioso caso de hackeo cerebral.', '01:22:00', 'Ghost_in_the_Shell.png', 'gits_trailer.mp4'),
('Akira', 'En un Neo-Tokyo post-apocalíptico, un adolescente desarrolla poderes psíquicos.', '02:04:00', 'AKIRA.png', 'akira_trailer.mp4'),
('El tiempo contigo', 'Una historia de amor entre un joven que puede controlar el clima y una estudiante.', '01:54:00', 'Weathering_with_You.png', 'weathering_trailer.mp4');

-- Insert into tbl_staff
INSERT INTO tbl_staff (nom_staff, apellido_staff, rol_staff) VALUES
('Makoto', 'Shinkai', 1),
('Hayao', 'Miyazaki', 1),
('Tetsuro', 'Araki', 1),
('Haruo', 'Sotozaki', 1),
('Isao', 'Takahata', 1);

-- Insert into staff_peli
INSERT INTO staff_peli (id_staff, id_pelicula) VALUES
(1, 1),  -- Shinkai con Your Name
(2, 2),  -- Miyazaki con Chihiro
(3, 3),  -- Araki con AOT
(2, 4),  -- Miyazaki con Totoro
(4, 5),  -- Sotozaki con Demon Slayer
(5, 6);  -- Takahata con Luciérnagas

-- Insert into genero_peli
-- Your Name (Película 1): Drama, Romance y Animacion
INSERT INTO genero_peli (id_genero, id_pelicula) VALUES
(3, 1),
(6, 1),
(5, 1);

-- El viaje de Chihiro (Película 2): Animacion, Fantasía y Aventura
INSERT INTO genero_peli (id_genero, id_pelicula) VALUES
(5, 2),
(7, 2),
(8, 2);

-- Attack on Titan: Chronicle (Película 3): Accion, Drama y Fantasía Oscura
INSERT INTO genero_peli (id_genero, id_pelicula) VALUES
(2, 3),
(3, 3),
(9, 3);

-- Mi vecino Totoro (Película 4): Animacion, Fantasía y Familiar
INSERT INTO genero_peli (id_genero, id_pelicula) VALUES
(5, 4),
(7, 4),
(10, 4);

-- Demon Slayer: Mugen Train (Película 5): Accion, Animacion y Supernatural
INSERT INTO genero_peli (id_genero, id_pelicula) VALUES
(2, 5),
(5, 5),
(16, 5);

-- La tumba de las luciérnagas (Película 6): Drama, Animacion y Guerra
INSERT INTO genero_peli (id_genero, id_pelicula) VALUES
(3, 6),
(5, 6),
(12, 6);

-- Dragon Ball Super: Broly (Película 7): Accion, Animacion y Artes Marciales
INSERT INTO genero_peli (id_genero, id_pelicula) VALUES
(2, 7),
(5, 7),
(13, 7);

-- El castillo ambulante (Película 8): Animacion, Fantasía y Romance
INSERT INTO genero_peli (id_genero, id_pelicula) VALUES
(5, 8),
(7, 8),
(6, 8);

-- Perfect Blue (Película 9): Animacion, Thriller y Misterio
INSERT INTO genero_peli (id_genero, id_pelicula) VALUES
(5, 9),
(14, 9),
(15, 9);

-- One Piece Film: Red (Película 10): Accion, Animacion y Aventura
INSERT INTO genero_peli (id_genero, id_pelicula) VALUES
(2, 10),
(5, 10),
(8, 10);

-- La princesa Mononoke (Película 11): Animacion, Fantasía y Histórico
INSERT INTO genero_peli (id_genero, id_pelicula) VALUES
(5, 11),
(7, 11),
(11, 11);

-- Jujutsu Kaisen 0 (Película 12): Accion, Animacion y Terror
INSERT INTO genero_peli (id_genero, id_pelicula) VALUES
(2, 12),
(5, 12),
(18, 12);

-- Ghost in the Shell (Película 13): Ciencia Ficcion, Accion y Cyberpunk
INSERT INTO genero_peli (id_genero, id_pelicula) VALUES
(1, 13),
(2, 13),
(17, 13);

-- Akira (Película 14): Ciencia Ficcion, Accion y Cyberpunk
INSERT INTO genero_peli (id_genero, id_pelicula) VALUES
(1, 14),
(2, 14),
(17, 14);

-- El tiempo contigo (Película 15): Animacion, Romance y Fantasía
INSERT INTO genero_peli (id_genero, id_pelicula) VALUES
(5, 15),
(6, 15),
(7, 15);
