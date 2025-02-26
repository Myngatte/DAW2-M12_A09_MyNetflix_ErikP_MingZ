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
('erikp', 'erikp@gmail.com', 'password123.', 'Erik', 'Penas', '1999-05-15', 'Masculino', 'Aceptado', 1),
('mingz', 'mingz@gmail.com', 'password123.', 'Ming', 'Zhou', '1999-05-20', 'Masculino', 'Aceptado', 1),
('jhonnydeep', 'johndoe@gmail.com', 'password123.', 'Jhony', 'Deep', '1990-05-15', 'Masculino', 'Aceptado', 2),
('benitoc', 'johndoe@example.com', 'password123.', 'Benito', 'Camela', '1969-05-15', 'Masculino', 'Rechazado', 2),
('janedoe', 'janedoe@hotmail.com', 'password123.', 'Jane', 'Doe', '1992-08-22', 'Femenino', 'Pendiente', 2);

-- Insert into tbl_pgeneros
INSERT INTO tbl_pgeneros (nom_genero) VALUES
('Ciencia Ficcion'),
('Accion'),
('Drama'),
('Comedia');

-- Insert into tbl_pelis
INSERT INTO tbl_pelis (nom_peli, descripcion, generos, duracion, portada, trailer) VALUES
('Your Name', 'Dos adolescentes descubren que están conectados misteriosamente a través de sus sueños.', 3, '01:46:00', 'yourname.jpg', 'yourname_trailer.mp4'),
('El viaje de Chihiro', 'Una niña entra en un mundo mágico donde debe trabajar en una casa de baños para espíritus.', 1, '02:05:00', 'spirited_away.jpg', 'spirited_away_trailer.mp4'),
('Attack on Titan: Chronicle', 'La humanidad lucha por sobrevivir contra gigantes que devoran humanos.', 2, '02:00:00', 'aot.jpg', 'aot_trailer.mp4'),
('Mi vecino Totoro', 'Dos niñas descubren criaturas mágicas en su nuevo hogar en el campo.', 1, '01:26:00', 'totoro.jpg', 'totoro_trailer.mp4'),
('Demon Slayer: Mugen Train', 'Tanjiro y sus compañeros se embarcan en una peligrosa misión en un tren.', 2, '01:57:00', 'demonslayer.jpg', 'demonslayer_trailer.mp4'),
('La tumba de las luciérnagas', 'La historia de dos hermanos que luchan por sobrevivir durante la Segunda Guerra Mundial.', 3, '01:29:00', 'fireflies.jpg', 'fireflies_trailer.mp4'),
('Dragon Ball Super: Broly', 'Goku y Vegeta enfrentan al poderoso guerrero Broly.', 2, '01:40:00', 'broly.jpg', 'broly_trailer.mp4'),
('El castillo ambulante', 'Una joven maldecida con el cuerpo de una anciana busca romper el hechizo.', 1, '01:59:00', 'howls_castle.jpg', 'howls_castle_trailer.mp4'),
('Perfect Blue', 'Una idol convertida en actriz comienza a perder el sentido de la realidad.', 3, '01:21:00', 'perfect_blue.jpg', 'perfect_blue_trailer.mp4'),
('One Piece Film: Red', 'Luffy y su tripulación descubren secretos sobre una misteriosa cantante.', 2, '01:55:00', 'onepiece_red.jpg', 'onepiece_red_trailer.mp4'),
('La princesa Mononoke', 'Un príncipe se ve envuelto en un conflicto entre los espíritus del bosque y la humanidad.', 1, '02:13:00', 'mononoke.jpg', 'mononoke_trailer.mp4'),
('Jujutsu Kaisen 0', 'Un estudiante lucha contra maldiciones mientras intenta controlar sus propios poderes.', 2, '01:45:00', 'jjk0.jpg', 'jjk0_trailer.mp4'),
('Ghost in the Shell', 'Una cyborg policía investiga un misterioso caso de hackeo cerebral.', 1, '01:22:00', 'gits.jpg', 'gits_trailer.mp4'),
('Akira', 'En un Neo-Tokyo post-apocalíptico, un adolescente desarrolla poderes psíquicos.', 1, '02:04:00', 'akira.jpg', 'akira_trailer.mp4'),
('El tiempo contigo', 'Una historia de amor entre un joven que puede controlar el clima y una estudiante.', 3, '01:54:00', 'weathering.jpg', 'weathering_trailer.mp4');

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
INSERT INTO genero_peli (id_genero, id_pelicula) VALUES
(3, 1),  -- Drama para Your Name
(1, 2),  -- Ciencia Ficción para Chihiro
(2, 3),  -- Acción para AOT
(1, 4),  -- Ciencia Ficción para Totoro
(2, 5),  -- Acción para Demon Slayer
(3, 6),  -- Drama para Luciérnagas
(2, 7),  -- Acción para Dragon Ball
(1, 8),  -- Ciencia Ficción para Castillo Ambulante
(3, 9),  -- Drama para Perfect Blue
(2, 10), -- Acción para One Piece
(1, 11), -- Ciencia Ficción para Mononoke
(2, 12), -- Acción para Jujutsu Kaisen
(1, 13), -- Ciencia Ficción para Ghost in the Shell
(1, 14), -- Ciencia Ficción para Akira
(3, 15); -- Drama para El tiempo contigo


-- update para las portadas de las pelis
-- Actualizar las rutas de las imágenes en tbl_pelis
UPDATE tbl_pelis SET portada = 'Your_Name_poster.png' WHERE nom_peli = 'Your Name';
UPDATE tbl_pelis SET portada = 'El_viaje_de_chihiro.png' WHERE nom_peli = 'El viaje de Chihiro';
UPDATE tbl_pelis SET portada = 'AOT_chronicle.png' WHERE nom_peli = 'Attack on Titan: Chronicle';
UPDATE tbl_pelis SET portada = 'Mi_Vecino_Totoro.png' WHERE nom_peli = 'Mi vecino Totoro';
UPDATE tbl_pelis SET portada = 'Demon_Slayer_Mugen_Train.png' WHERE nom_peli = 'Demon Slayer: Mugen Train';
UPDATE tbl_pelis SET portada = 'La_Tumba_de_Las_Luciernagas.png' WHERE nom_peli = 'La tumba de las luciérnagas';
UPDATE tbl_pelis SET portada = 'DBS_Broly.png' WHERE nom_peli = 'Dragon Ball Super: Broly';
UPDATE tbl_pelis SET portada = 'El_castillo_ambulante.png' WHERE nom_peli = 'El castillo ambulante';
UPDATE tbl_pelis SET portada = 'Perfectblue.png' WHERE nom_peli = 'Perfect Blue';
UPDATE tbl_pelis SET portada = 'One_Piece_Film_Red.png' WHERE nom_peli = 'One Piece Film: Red';
UPDATE tbl_pelis SET portada = 'Princess_Mononoke.png' WHERE nom_peli = 'La princesa Mononoke';
UPDATE tbl_pelis SET portada = 'Jujutsu_Kaisen_0.png' WHERE nom_peli = 'Jujutsu Kaisen 0';
UPDATE tbl_pelis SET portada = 'Ghost_in_the_Shell.png' WHERE nom_peli = 'Ghost in the Shell';
UPDATE tbl_pelis SET portada = 'AKIRA.png' WHERE nom_peli = 'Akira';
UPDATE tbl_pelis SET portada = 'Weathering_with_You.png' WHERE nom_peli = 'El tiempo contigo';

