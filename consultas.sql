use master;
CREATE DATABASE pruebaPHP;
USE colegio;
ALTER DATABASE pruebaPHP MODIFY NAME = colegio;
CREATE TABLE estudiantes (
	idEstudiante INT IDENTITY(1,1) NOT NULL PRIMARY KEY, 
	nombres VARCHAR(50), 
	apellidos VARCHAR(50), 	
	genero VARCHAR(1),
	fechaNac DATE
);
alter table estudiantes alter column idEstudiante int NOT NULL;
alter table estudiantes add primary key (idEstudiante);

SELECT is_identity FROM sys.columns WHERE object_id = object_id('profesores') AND name = 'idProfesor'

exec sp_columns estudiantes;
select * from estudiantes;
update estudiantes set nombres='Alexis', apellidos='Paz', genero='M', fechaNac='1998-2-19' where idEstudiante=4;

CREATE TABLE profesores (
	idProfesor INT IDENTITY(1,1) NOT NULL PRIMARY KEY, 
	nombres VARCHAR(50), 
	apellidos VARCHAR(50), 	
	genero VARCHAR(1),
	fechaNac DATE
);
drop table profesores;
select * from profesores;

-- inserts ESTUDIANTES
insert into estudiantes (nombres, apellidos, genero, fechaNac) values ('Randy', 'Choc', 'M', '1997-12-19');