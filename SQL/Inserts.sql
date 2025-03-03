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
INSERT INTO tbl_pelis (nom_peli, descripcion, generos, duracion, portada, trailer) VALUES
('Your Name', 'Dos adolescentes descubren que están conectados misteriosamente a través de sus sueños.', 3, '01:46:00', 'Your_Name_poster.png', 'yourname_trailer.mp4'),
('El viaje de Chihiro', 'Una niña entra en un mundo mágico donde debe trabajar en una casa de baños para espíritus.', 1, '02:05:00', 'El_viaje_de_chihiro.png', 'spirited_away_trailer.mp4'),
('Attack on Titan: Chronicle', 'La humanidad lucha por sobrevivir contra gigantes que devoran humanos.', 2, '02:00:00', 'AOT_chronicle.png', 'aot_trailer.mp4'),
('Mi vecino Totoro', 'Dos niñas descubren criaturas mágicas en su nuevo hogar en el campo.', 1, '01:26:00', 'Mi_Vecino_Totoro.png', 'totoro_trailer.mp4'),
('Demon Slayer: Mugen Train', 'Tanjiro y sus compañeros se embarcan en una peligrosa misión en un tren.', 2, '01:57:00', 'Demon_Slayer_Mugen_Train.png', 'demonslayer_trailer.mp4'),
('La tumba de las luciérnagas', 'La historia de dos hermanos que luchan por sobrevivir durante la Segunda Guerra Mundial.', 3, '01:29:00', 'La_Tumba_de_Las_Luciernagas.png', 'fireflies_trailer.mp4'),
('Dragon Ball Super: Broly', 'Goku y Vegeta enfrentan al poderoso guerrero Broly.', 2, '01:40:00', 'DBS_Broly.png', 'broly_trailer.mp4'),
('El castillo ambulante', 'Una joven maldecida con el cuerpo de una anciana busca romper el hechizo.', 1, '01:59:00', 'El_castillo_ambulante.png', 'howls_castle_trailer.mp4'),
('Perfect Blue', 'Una idol convertida en actriz comienza a perder el sentido de la realidad.', 3, '01:21:00', 'Perfectblue.png', 'perfect_blue_trailer.mp4'),
('One Piece Film: Red', 'Luffy y su tripulación descubren secretos sobre una misteriosa cantante.', 2, '01:55:00', 'One_Piece_Film_Red.png', 'onepiece_red_trailer.mp4'),
('La princesa Mononoke', 'Un príncipe se ve envuelto en un conflicto entre los espíritus del bosque y la humanidad.', 1, '02:13:00', 'Princess_Mononoke.png', 'mononoke_trailer.mp4'),
('Jujutsu Kaisen 0', 'Un estudiante lucha contra maldiciones mientras intenta controlar sus propios poderes.', 2, '01:45:00', 'Jujutsu_Kaisen_0.png', 'jjk0_trailer.mp4'),
('Ghost in the Shell', 'Una cyborg policía investiga un misterioso caso de hackeo cerebral.', 1, '01:22:00', 'Ghost_in_the_Shell.png', 'gits_trailer.mp4'),
('Akira', 'En un Neo-Tokyo post-apocalíptico, un adolescente desarrolla poderes psíquicos.', 1, '02:04:00', 'AKIRA.png', 'akira_trailer.mp4'),
('El tiempo contigo', 'Una historia de amor entre un joven que puede controlar el clima y una estudiante.', 3, '01:54:00', 'Weathering_with_You.png', 'weathering_trailer.mp4');

-- Insert into tbl_staff
-- Insertar más directores y actores/dobladores
INSERT INTO tbl_staff (nom_staff, apellido_staff, rol_staff) VALUES
-- Directores
('Makoto', 'Shinkai', 1),  -- Director de "Your Name" y "El tiempo contigo"
('Hayao', 'Miyazaki', 1),  -- Director de "El viaje de Chihiro", "Mi vecino Totoro", "El castillo ambulante" y "La princesa Mononoke"
('Tetsuro', 'Araki', 1),   -- Director de "Attack on Titan: Chronicle"
('Haruo', 'Sotozaki', 1),  -- Director de "Demon Slayer: Mugen Train"
('Isao', 'Takahata', 1),   -- Director de "La tumba de las luciérnagas"
('Mamoru', 'Hosoda', 1),   -- Director de "Perfect Blue"
('Tatsuya', 'Nagamine', 1),-- Director de "Dragon Ball Super: Broly"
('Goro', 'Taniguchi', 1),  -- Director de "One Piece Film: Red"
('Mamoru', 'Oshii', 1),    -- Director de "Ghost in the Shell"
('Katsuhiro', 'Otomo', 1), -- Director de "Akira"
('Sunao', 'Katabuchi', 1), -- Director de "Jujutsu Kaisen 0"

-- Actores/Dobladores
('Ryunosuke', 'Kamiki', 2),  -- Voz de Taki en "Your Name"
('Mone', 'Kamishiraishi', 2),-- Voz de Mitsuha en "Your Name"
('Rumi', 'Hiiragi', 2),      -- Voz de Chihiro en "El viaje de Chihiro"
('Miyu', 'Irino', 2),        -- Voz de Haku en "El viaje de Chihiro"
('Yuki', 'Kaji', 2),         -- Voz de Eren Yeager en "Attack on Titan"
('Marina', 'Inoue', 2),      -- Voz de Armin Arlert en "Attack on Titan"
('Hana', 'Sugisaki', 2),     -- Voz de Tanjiro en "Demon Slayer"
('Natsuki', 'Hanae', 2),     -- Voz de Nezuko en "Demon Slayer"
('Chika', 'Sakamoto', 2),    -- Voz de Totoro en "Mi vecino Totoro"
('Noriko', 'Hidaka', 2),     -- Voz de Satsuki en "Mi vecino Totoro"
('Masako', 'Nozawa', 2),     -- Voz de Goku en "Dragon Ball Super: Broly"
('Ryo', 'Horikawa', 2),      -- Voz de Vegeta en "Dragon Ball Super: Broly"
('Ayano', 'Shiraishi', 2),   -- Voz de Setsuko en "La tumba de las luciérnagas"
('Tsutomu', 'Tatsumi', 2),   -- Voz de Seita en "La tumba de las luciérnagas"
('Jun', 'Iida', 2),          -- Voz de Howl en "El castillo ambulante"
('Chieko', 'Baisho', 2),     -- Voz de Sophie en "El castillo ambulante"
('Junko', 'Iwao', 2),        -- Voz de Mima en "Perfect Blue"
('Rica', 'Matsumoto', 2),    -- Voz de Luffy en "One Piece Film: Red"
('Mayumi', 'Tanaka', 2),     -- Voz de Usopp en "One Piece Film: Red"
('Yuriko', 'Yamaguchi', 2),  -- Voz de Sanji en "One Piece Film: Red"
('Yoji', 'Matsuda', 2),      -- Voz de Ashitaka en "La princesa Mononoke"
('Yuriko', 'Ishida', 2),     -- Voz de San en "La princesa Mononoke"
('Megumi', 'Ogata', 2),      -- Voz de Yuta en "Jujutsu Kaisen 0"
('Kana', 'Hanazawa', 2),     -- Voz de Rika en "Jujutsu Kaisen 0"
('Atsuko', 'Tanaka', 2),     -- Voz de Motoko Kusanagi en "Ghost in the Shell"
('Mitsuo', 'Iwata', 2),      -- Voz de Tetsuo en "Akira"
('Nozomu', 'Sasaki', 2),     -- Voz de Kaneda en "Akira"
('Kotaro', 'Daigo', 2),      -- Voz de Hodaka en "El tiempo contigo"
('Nana', 'Mori', 2);         -- Voz de Hina en "El tiempo contigo"
('Kaito', 'Ishikawa', 2),  -- Voz adicional en "Your Name"
('Akari', 'Kitou', 2),     -- Voz adicional en "El viaje de Chihiro"
('Hiroshi', 'Kamiya', 2),  -- Voz adicional en "Attack on Titan: Chronicle"
('Yuko', 'Sanpei', 2),     -- Voz adicional en "Mi vecino Totoro"
('Yoshitsugu', 'Matsuoka', 2), -- Voz adicional en "Demon Slayer: Mugen Train"
('Ayumi', 'Fujimura', 2),  -- Voz adicional en "La tumba de las luciérnagas"
('Toshio', 'Furukawa', 2), -- Voz adicional en "Dragon Ball Super: Broly"
('Takuya', 'Kimura', 2),   -- Voz adicional en "El castillo ambulante"
('Emiri', 'Katou', 2),     -- Voz adicional en "Perfect Blue"
('Hiroaki', 'Hirata', 2),  -- Voz adicional en "One Piece Film: Red"
('Yuko', 'Tanaka', 2),     -- Voz adicional en "La princesa Mononoke"
('Yuichi', 'Nakamura', 2), -- Voz adicional en "Jujutsu Kaisen 0"
('Kouichi', 'Yamadera', 2),-- Voz adicional en "Ghost in the Shell"
('Mitsuru', 'Miyamoto', 2),-- Voz adicional en "Akira"
('Shun', 'Oguri', 2);      -- Voz adicional en "El tiempo contigo"

-- Insert into staff_peli
-- Relación entre staff y películas
INSERT INTO staff_peli (id_staff, id_pelicula) VALUES
-- Your Name (Película 1)
(12, 1),  -- Ryunosuke Kamiki (Taki)
(13, 1),  -- Mone Kamishiraishi (Mitsuha)

-- El viaje de Chihiro (Película 2)
(14, 2),  -- Rumi Hiiragi (Chihiro)
(15, 2),  -- Miyu Irino (Haku)

-- Attack on Titan: Chronicle (Película 3)
(16, 3),  -- Yuki Kaji (Eren Yeager)
(17, 3),  -- Marina Inoue (Armin Arlert)

-- Mi vecino Totoro (Película 4)
(18, 4),  -- Chika Sakamoto (Totoro)
(19, 4),  -- Noriko Hidaka (Satsuki)

-- Demon Slayer: Mugen Train (Película 5)
(20, 5),  -- Hana Sugisaki (Tanjiro)
(21, 5),  -- Natsuki Hanae (Nezuko)

-- La tumba de las luciérnagas (Película 6)
(22, 6),  -- Ayano Shiraishi (Setsuko)
(23, 6),  -- Tsutomu Tatsumi (Seita)

-- Dragon Ball Super: Broly (Película 7)
(24, 7),  -- Masako Nozawa (Goku)
(25, 7),  -- Ryo Horikawa (Vegeta)

-- El castillo ambulante (Película 8)
(26, 8),  -- Jun Iida (Howl)
(27, 8),  -- Chieko Baisho (Sophie)

-- Perfect Blue (Película 9)
(28, 9),  -- Junko Iwao (Mima)

-- One Piece Film: Red (Película 10)
(29, 10), -- Rica Matsumoto (Luffy)
(30, 10), -- Mayumi Tanaka (Usopp)
(31, 10), -- Yuriko Yamaguchi (Sanji)

-- La princesa Mononoke (Película 11)
(32, 11), -- Yoji Matsuda (Ashitaka)
(33, 11), -- Yuriko Ishida (San)

-- Jujutsu Kaisen 0 (Película 12)
(34, 12), -- Megumi Ogata (Yuta)
(35, 12), -- Kana Hanazawa (Rika)

-- Ghost in the Shell (Película 13)
(36, 13), -- Atsuko Tanaka (Motoko Kusanagi)

-- Akira (Película 14)
(37, 14), -- Mitsuo Iwata (Tetsuo)
(38, 14), -- Nozomu Sasaki (Kaneda)

-- El tiempo contigo (Película 15)
(39, 15), -- Kotaro Daigo (Hodaka)
(40, 15); -- Nana Mori (Hina)

-- Insert into genero_peli

-- Your Name (Película 1): Drama, Romance y Animacion
INSERT INTO genero_peli (id_genero, id_pelicula) VALUES
(3, 1),
(6, 1),
(5, 1),

-- El viaje de Chihiro (Película 2): Animacion, Fantasía y Aventura
(5, 2),
(7, 2),
(8, 2),

-- Attack on Titan: Chronicle (Película 3): Accion, Drama y Fantasía Oscura
(2, 3),
(3, 3),
(9, 3),

-- Mi vecino Totoro (Película 4): Animacion, Fantasía y Familiar
(5, 4),
(7, 4),
(10, 4),

-- Demon Slayer: Mugen Train (Película 5): Accion, Animacion y Supernatural
(2, 5),
(5, 5),
(16, 5),

-- La tumba de las luciérnagas (Película 6): Drama, Animacion y Guerra
(3, 6),
(5, 6),
(12, 6),

-- Dragon Ball Super: Broly (Película 7): Accion, Animacion y Artes Marciales
(2, 7),
(5, 7),
(13, 7),

-- El castillo ambulante (Película 8): Animacion, Fantasía y Romance
(5, 8),
(7, 8),
(6, 8),

-- Perfect Blue (Película 9): Animacion, Thriller y Misterio
(5, 9),
(14, 9),
(15, 9),

-- One Piece Film: Red (Película 10): Accion, Animacion y Aventura
(2, 10),
(5, 10),
(8, 10),

-- La princesa Mononoke (Película 11): Animacion, Fantasía y Histórico
(5, 11),
(7, 11),
(11, 11),

-- Jujutsu Kaisen 0 (Película 12): Accion, Animacion y Terror
(2, 12),
(5, 12),
(18, 12),

-- Ghost in the Shell (Película 13): Ciencia Ficcion, Accion y Cyberpunk
(1, 13),
(2, 13),
(17, 13),

-- Akira (Película 14): Ciencia Ficcion, Accion y Cyberpunk
(1, 14),
(2, 14),
(17, 14),

-- El tiempo contigo (Película 15): Animacion, Romance y Fantasía
(5, 15),
(6, 15),
(7, 15);
