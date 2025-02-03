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
('jhonnydeep', 'johndoe@example.com', 'password123.', 'Jhony', 'Deep', '1990-05-15', 'Masculino', 'Aceptado', 2),
('benitoc', 'johndoe@example.com', 'password123.', 'Benito', 'Camela', '1969-05-15', 'Masculino', 'Rechazado', 2),
('janedoe', 'janedoe@example.com', 'password123.', 'Jane', 'Doe', '1992-08-22', 'Femenino', 'Pendiente', 2);

-- Insert into tbl_pelis
INSERT INTO tbl_pelis (nom_peli, descripcion, generos, duracion, portada, trailer) VALUES
('Inception', 'A mind-bending thriller about dreams within dreams.', 1, '02:28:00', 'inception.jpg', 'inception_trailer.mp4'),
('The Matrix', 'A hacker discovers a dystopian future controlled by machines.', 2, '02:16:00', 'matrix.jpg', 'matrix_trailer.mp4');

-- Insert into tbl_likes
INSERT INTO tbl_likes (user_liked, peli_liked) VALUES
(3, 2),
(5, 1);

-- Insert into tbl_pgeneros
INSERT INTO tbl_pgeneros (nom_genero) VALUES
('Ciencia Ficcion'),
('Accion'),
('Drama'),
('Comedia');

-- Insert into genero_peli
INSERT INTO genero_peli (id_genero, id_pelicula) VALUES
(1, 1), 
(2, 2),
(3, 1);

-- Insert into tbl_staff
INSERT INTO tbl_staff (nom_staff, apellido_staff, rol_staff) VALUES
('Christopher', 'Nolan', 1), 
('Keanu', 'Reeves', 2),
('Carrie', 'Ann Moss', 2);

-- Insert into staff_peli
INSERT INTO staff_peli (id_staff, id_pelicula) VALUES
(1, 1), 
(2, 2),
(3, 2);

