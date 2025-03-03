DROP DATABASE IF EXISTS Meiga;
Create Database Meiga;
Use Meiga;

CREATE TABLE tbl_users (
    id_usr INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL,
    nombre_usr VARCHAR(50) NOT NULL,
    apellido_usr VARCHAR(50) NOT NULL,
    fecha_nac DATE NOT NULL,
    genero_usr ENUM("Masculino","Femenino"),
    estado ENUM("Aceptado","Pendiente"),
    rol_user INT NOT NULL
)engine innoDB;

CREATE TABLE tbl_roles (
    id_rol INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    nom_rol VARCHAR(50) NOT NULL
);

CREATE TABLE tbl_likes (
    id_like INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    user_liked INT NOT NULL,
    peli_liked INT NOT NULL
)engine innoDB;

CREATE TABLE tbl_pelis (
    id_peli INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    nom_peli VARCHAR(100) NOT NULL,
    descripcion VARCHAR(255) NOT NULL,
    duracion TIME NOT NULL,
    portada VARCHAR(255) NOT NULL,
    trailer VARCHAR(255) NULL
)engine innoDB;

CREATE TABLE tbl_pgeneros (
    id_genero INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    nom_genero VARCHAR(100) NOT NULL
)engine innoDB;

CREATE TABLE genero_peli (
    id_genero_peli INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    id_genero INT NOT NULL, 
    id_pelicula INT NOT NULL
)engine innoDB;

CREATE TABLE tbl_staff (
    id_staff INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    nom_staff VARCHAR(50) NOT NULL, 
    apellido_staff VARCHAR(50) NOT NULL,
    rol_staff INT NOT NULL
)engine innoDB;

CREATE TABLE staff_peli (
    id_staff_peli INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    id_staff INT NOT NULL, 
    id_pelicula INT NOT NULL
)engine innoDB;

CREATE TABLE tbl_rol_staff (
    id_rol_staff INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    nom_rol_staff VARCHAR(50) NOT NULL
)engine innoDB;


-- FKs
-- user roles
ALTER TABLE tbl_users
ADD CONSTRAINT fk_users_roles
FOREIGN KEY (rol_user) REFERENCES tbl_roles(id_rol);

-- staff roles
ALTER TABLE tbl_staff
ADD CONSTRAINT fk_staff_roles
FOREIGN KEY (rol_staff) REFERENCES tbl_rol_staff(id_rol_staff);

-- tabla intermedia likes
ALTER TABLE tbl_likes
ADD CONSTRAINT fk_user_likes
FOREIGN KEY (user_liked) REFERENCES tbl_users(id_usr);

ALTER TABLE tbl_likes
ADD CONSTRAINT fk_liked_peli
FOREIGN KEY (peli_liked) REFERENCES tbl_pelis(id_peli);

-- tabla intermedia para staff
ALTER TABLE staff_peli
ADD CONSTRAINT fk_trabajadores
FOREIGN KEY (id_staff) REFERENCES tbl_staff(id_staff);

ALTER TABLE staff_peli
ADD CONSTRAINT fk_peliculas_trabajadas
FOREIGN KEY (id_pelicula) REFERENCES tbl_pelis(id_peli);

-- tabla intermedia para generos de peli
ALTER TABLE genero_peli
ADD CONSTRAINT fk_genero
FOREIGN KEY (id_genero) REFERENCES tbl_pgeneros(id_genero);

ALTER TABLE genero_peli
ADD CONSTRAINT fk_peli_gen
FOREIGN KEY (id_pelicula) REFERENCES tbl_pelis(id_peli);




