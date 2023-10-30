create database if not exists porteria;
use porteria;

drop table if exists casas;
create table Casas(/*casas con propietarios*/
idCasa int not null primary key unique,
idPropietario int 
);
drop table if exists porteros;
create table Porteros(
idPortero INT primary key not null,
nombrePortero varchar(40) not null,
horarioPortero varchar(40)
);
drop table if exists residentes;
create table Residentes(
idResidente int not null primary key,
nombreResidente varchar(40) not null,
telResidente VARCHAR(10),
casaResidente int not null
);
drop table if exists vehiculos;
create table Vehiculos(
idVehiculo varchar(6) primary key, /*PLACA*/
idPropietario int
);
drop table if exists visitantes;
create table Visitantes(
idVisitante int not null primary key,
nombreVisitante varchar(40) not null
); 
drop table if exists visitas;
create table Visitas(
idVisita INT auto_increment primary key not null,
fecha_horaIngreso varchar(30),
idVisitante int,
lugarVisita int,
motivoVisita varchar(50)
);

/* ----------------------------- TRIGGERS ----------------------------------------- */
-- todos los triggers almacenarán cada cambio en las tablas de la DB en Registros
drop table if exists Registros;
create table Registros(
idRegistro int primary key not null auto_increment,
Registro varchar(200) null,
fecha_horaRegistro datetime null default current_timestamp
);

drop trigger if exists trigger_InsertCasas;
DELIMITER //
CREATE TRIGGER trigger_InsertCasas
AFTER INSERT ON Casas
FOR EACH ROW
BEGIN
    INSERT INTO Registros (Registro, fecha_horaRegistro)
    VALUES (concat(
    'Insert en Casas: ',
    new.idCasa,' ',
    new.idPropietario) ,now());
END;
//

drop trigger if exists trigger_DeleteCasas;
DELIMITER //
CREATE TRIGGER trigger_DeleteCasas
AFTER DELETE ON Casas
FOR EACH ROW
BEGIN
    INSERT INTO Registros (Registro, fecha_horaRegistro)
    VALUES (concat(
    'Delete en Casas: ',
    old.idCasa,' ',
    old.idPropietario) ,now());
END;

drop trigger if exists trigger_UpdateCasas;
DELIMITER //
CREATE TRIGGER trigger_UpdateCasas
AFTER UPDATE ON Casas
FOR EACH ROW
BEGIN
    INSERT INTO Registros (Registro, fecha_horaRegistro)
    VALUES (concat(
    'Update en Casas (datos viejos): ',
    old.idCasa,' ',
    old.idPropietario) ,now()),
    (concat(
    'Update en Casas (datos nuevos): ',
    new.idCasa,' ',
    new.idPropietario) ,now());
END;

drop trigger if exists trigger_InsertPorteros;
DELIMITER //
CREATE TRIGGER trigger_InsertPorteros
AFTER INSERT ON Porteros
FOR EACH ROW
BEGIN
    INSERT INTO Registros (Registro, fecha_horaRegistro)
    VALUES (concat(
    'Insert en Porteros: ',
    new.idPortero,' ',
    new.nombrePortero,' ',
    new.horarioPortero) ,now());
END;
//

drop trigger if exists trigger_DeletePorteros;
DELIMITER //
CREATE TRIGGER trigger_DeletePorteros
AFTER Delete ON Porteros
FOR EACH ROW
BEGIN
    INSERT INTO Registros (Registro, fecha_horaRegistro)
    VALUES (concat(
    'Delete en Porteros: ',
    old.idPortero,' ',
    old.nombrePortero,' ',
    old.horarioPortero) ,now());
END;
//

drop trigger if exists trigger_UpdatePorteros;
DELIMITER //
CREATE TRIGGER trigger_UpdatePorteros
AFTER Update ON Porteros
FOR EACH ROW
BEGIN
    INSERT INTO Registros (Registro, fecha_horaRegistro)
    VALUES (concat(
    'Update en Porteros (datos viejos): ',
    old.idPortero,' ',
    old.nombrePortero,' ',
    old.horarioPortero) ,now()),
    (concat(
    'Update en Porteros (datos nuevos): ',
    new.idPortero,' ',
    new.nombrePortero,' ',
    new.horarioPortero) ,now());
END;
//

drop trigger if exists trigger_InsertResidentes;
DELIMITER //
CREATE TRIGGER trigger_InsertResidentes
AFTER INSERT ON Residentes
FOR EACH ROW
BEGIN
    INSERT INTO Registros (Registro, fecha_horaRegistro)
    VALUES (concat(
    'Insert en Residentes: ',
    new.idResidente,' ',
    new.nombreResidente,' ',
    new.telResidente,' ',
    new.casaResidente) ,now());
END;
//

drop trigger if exists trigger_DeleteResidentes;
DELIMITER //
CREATE TRIGGER trigger_DeleteResidentes
AFTER DELETE ON Residentes
FOR EACH ROW
BEGIN
    INSERT INTO Registros (Registro, fecha_horaRegistro)
    VALUES (concat(
    'Delete en Residentes: ',
    old.idResidente,' ',
    old.nombreResidente,' ',
    old.telResidente,' ',
    old.casaResidente) ,now());
END;

drop trigger if exists trigger_UpdateResidentes;
DELIMITER //
CREATE TRIGGER trigger_UpdateResidentes
AFTER UPDATE ON Residentes
FOR EACH ROW
BEGIN
    INSERT INTO Registros (Registro, fecha_horaRegistro)
    VALUES (concat(
    'Update en Residentes (datos viejos): ',
    old.idResidente,' ',
    old.nombreResidente,' ',
    old.telResidente,' ',
    old.casaResidente) ,now()),
    (concat(
    'Update en Residentes (datos nuevos): ',
    new.idResidente,' ',
    new.nombreResidente,' ',
    new.telResidente,' ',
    new.casaResidente) ,now())
    ;
END;
//

drop trigger if exists trigger_InsertVehiculos;
DELIMITER //
CREATE TRIGGER trigger_InsertVehiculos
AFTER INSERT ON Vehiculos
FOR EACH ROW
BEGIN
    INSERT INTO Registros (Registro, fecha_horaRegistro)
    VALUES (concat(
    'Insert en Vehiculos: ',
    new.idVehiculo,' ',
    new.idPropietario) ,now());
END;
//

drop trigger if exists trigger_DeleteVehiculos;
DELIMITER //
CREATE TRIGGER trigger_DeleteVehiculos
AFTER Delete ON Vehiculos
FOR EACH ROW
BEGIN
    INSERT INTO Registros (Registro, fecha_horaRegistro)
    VALUES (concat(
    'Delete en Vehiculos: ',
    old.idVehiculo,' ',
    old.idPropietario) ,now());
END;
//

drop trigger if exists trigger_UpdateVehiculos;
DELIMITER //
CREATE TRIGGER trigger_UpdateVehiculos
AFTER Update ON Vehiculos
FOR EACH ROW
BEGIN
    INSERT INTO Registros (Registro, fecha_horaRegistro)
    VALUES (concat(
    'Update en Vehiculos (datos viejos): ',
    old.idVehiculo,' ',
    old.idPropietario) ,now()),
    (concat(
    'Update en Vehiculos (datos nuevos): ',
    new.idVehiculo,' ',
    new.idPropietario) ,now());
END;
//

drop trigger if exists trigger_InsertVisitantes;
DELIMITER //
CREATE TRIGGER trigger_InsertVisitantes
AFTER INSERT ON Visitantes
FOR EACH ROW
BEGIN
    INSERT INTO Registros (Registro, fecha_horaRegistro)
    VALUES (concat(
    'Insert en Visitantes: ',
    new.idVisitante,' ',
    new.nombreVisitante) ,now());
END;
//

drop trigger if exists trigger_DeleteVisitantes;
DELIMITER //
CREATE TRIGGER trigger_DeleteVisitantes
AFTER Delete ON Visitantes
FOR EACH ROW
BEGIN
    INSERT INTO Registros (Registro, fecha_horaRegistro)
    VALUES (concat(
    'Delete en Visitantes: ',
    old.idVisitante,' ',
    old.nombreVisitante) ,now());
END;
//

drop trigger if exists trigger_UpdateVisitantes;
DELIMITER //
CREATE TRIGGER trigger_UpdateVisitantes
AFTER Update ON Visitantes
FOR EACH ROW
BEGIN
    INSERT INTO Registros (Registro, fecha_horaRegistro)
    VALUES (concat(
    'Update en Visitantes (datos viejos): ',
    old.idVisitante,' ',
    old.nombreVisitante) ,now()),
    (concat(
    'Update en Visitantes (datos nuevos): ',
    new.idVisitante,' ',
    new.nombreVisitante) ,now());
END;
//

drop trigger if exists trigger_InsertVisitas;
DELIMITER //
CREATE TRIGGER trigger_InsertVisitas
AFTER INSERT ON Visitas
FOR EACH ROW
BEGIN
    INSERT INTO Registros (Registro, fecha_horaRegistro)
    VALUES (concat(
    'Insert en Visitas: ',
    new.idVisita,' ',
    new.fecha_horaIngreso,' ',
    new.idVisitante,' ',
    new.lugarVisita,' ',
    new.motivoVisita) ,now());
END;
//

drop trigger if exists trigger_DeleteVisitas;
DELIMITER //
CREATE TRIGGER trigger_DeleteVisitas
AFTER Delete ON Visitas
FOR EACH ROW
BEGIN
    INSERT INTO Registros (Registro, fecha_horaRegistro)
    VALUES (concat(
    'Delete en Visitas: ',
    old.idVisita,' ',
	old.fecha_horaIngreso,' ',
    old.idVisitante,' ',
    old.lugarVisita,' ',
    old.motivoVisita) ,now());
END;
//

drop trigger if exists trigger_UpdateVisitas;
DELIMITER //
CREATE TRIGGER trigger_UpdateVisitas
AFTER Update ON Visitas
FOR EACH ROW
BEGIN
    INSERT INTO Registros (Registro, fecha_horaRegistro)
    VALUES (concat(
    'Update en Visitas (datos viejos): ',
    old.idVisita,' ',
	old.fecha_horaIngreso,' ',
    old.idVisitante,' ',
    old.lugarVisita,' ',
    old.motivoVisita) ,now()),
    (concat(
    'Update en Visitas (datos nuevos): ',
    new.idVisita,' ',
	new.fecha_horaIngreso,' ',
    new.idVisitante,' ',
    new.lugarVisita,' ',
    new.motivoVisita) ,now());
END;
//
-- FIN TRIGGERS ------------------------------------------------------------------------------------------
drop table if exists Usuarios;
create table Usuarios(
nombreUsuario varchar(20),
contraseña varchar(20)
);
insert into Usuarios values
("admin", "123"),
("portero", "123");

insert into Casas(idCasa, idPropietario) values
(1564, 1000411853),
(1262, 1089234675)
;

insert into Porteros(idPortero ,nombrePortero, horarioPortero) values 
(1593987896,'Arnulfo Francisco Rendon Muñoz', 'LUN A MIE 04:00 - 10:00'),
(1498914368,'Ernesto Damian Mendoza', 'JUE A SAB 04:00 - 10:00'),
(1972840324,'Daniel Ramirez Vargar', 'MIE A VIE 10:00 - 16:00'),
(1907740526,'Alfonso Gomez Jaramillo', 'SAB A DOM 10:00 - 16:00');

insert into Residentes(idResidente, nombreResidente, telResidente, casaResidente ) values
(1000411853, 'Emmanuel Cerón Gómez', '3045874261', 1564),
(1764584378, 'Laura Cerón Gómez', '3184931565', 1564),
(1089234675, 'Ernesto David Chavez Silva', '3154618489', 1262),
(1998745632, 'María Rodríguez', '3023456789', 1432),
(1346578921, 'Luis González', '3187654321', 1530),
(1837465923, 'Sofía Pérez', '3156789432', 1530),
(1567892345, 'Diego Sánchez', '3145678901', 1210),
(1987654321, 'Isabella Martínez', '3012345678', 1368),
(1432567890, 'Juan Soto', '3198765432', 1692)
;

drop view if exists vistaCasasSinResidente;
create view vistaCasasSinResidente as 
SELECT *
FROM Residentes LEFT JOIN Casas ON casaResidente = idCasa
WHERE idCasa IS NULL
AND casaResidente in ( SELECT DISTINCT casaResidente FROM Residentes)
group by casaResidente;

-- select casaResidente, idResidente from vistaCasasSinResidente ;

/*hacer propietarios a los residentes en casas sin propietarios*/
INSERT INTO Casas(idCasa, idPropietario)
select casaResidente, idResidente from vistaCasasSinResidente;

insert into Vehiculos(idVehiculo, idPropietario) values
('OLA123', 1000411853), 
('QBW59D', 1862972587), /*vehiculo domicilio*/
('ENT25D', 1764584378), 
('CBC256', 1089234675);

insert into Visitantes(idVisitante, nombreVisitante) 
values  
(1862972587, 'Humberto Guzman'),
(1567894251, 'Andres Felipe')
;

insert into Visitas(fecha_horaIngreso, idVisitante, lugarVisita, motivoVisita)
values /* formato de fecha y hora: 20XX-XX-XX XX:XX:XX*/
('2023-09-29 12:30:01', 1862972587, 1564, 'Domicilio'),
(now(), 1567894251 , 1262, 'Visita'),
(now(), 1862972587, 1564, 'Domicilio')
;

/*Muestra casas y sus propietarios*/
drop view if exists vistaCasas;
create view vistaCasas as
SELECT idCasa as Casa, 
idPropietario as ID, 
nombreResidente as Propietario,
telResidente as Telefono
from Casas full join Residentes 
on idPropietario = idResidente;

/*select * from Visitas left join Visitantes
		on Visitas.idVisitante = Visitantes.idVisitante;*/
/*VISITAS CON EL NOMBRE DEL VISITANTE*/
/*drop view vistaVisitas;*/

create view vistaVisitas as
select idVisita as ID,
fecha_horaIngreso as `Fecha y hora de ingreso`,
Visitas.idVisitante as `ID Visitante`, nombreVisitante as Nombre, 
lugarVisita as `Lugar de visita`,
motivoVisita as Motivo from Visitas left join Visitantes
on Visitas.idVisitante = Visitantes.idVisitante;

-- select * from vistaVisitas;

/*Ver carros, el ID de sus dueños y sus nombres*/
drop view if exists vistaCarros;
create view vistaCarros as
SELECT idVehiculo as Placa, 
IFNULL(idResidente, idVisitante) as idPropietario,
IFNULL(nombreResidente, nombreVisitante) as Propietario
FROM Vehiculos
LEFT JOIN Residentes ON Vehiculos.idPropietario = idResidente
LEFT JOIN Visitantes ON Vehiculos.idPropietario = idVisitante;

-- select * from vistaCarros;

/*Conteo de residentes en cada casa*/
drop view if exists vistaConteoResidentes;
create view vistaConteoResidentes as
SELECT idCasa, COUNT(idResidente) AS cantidad_de_residentes
FROM Casas
LEFT JOIN Residentes ON idCasa = casaResidente
GROUP BY idCasa;

/*select idCasa, cantidad_de_residentes from vistaConteoResidentes
where idCasa = (Select casaResidente from residentes where idResidente = '1000511645' );*/

drop view if exists usuariosRegistrados;
create view usuariosRegistrados as
select nombreUsuario as Usuarios from usuarios;

-- select * from usuariosRegistrados;

/*Residentes sin propietarios*/
select * from Residentes 
left join Casas on casaResidente = idCasa
where idCasa is NULL;
/*Conteo de residentes sin propietarios*/
select count(*) as Conteo from Residentes 
left join Casas on casaResidente = idCasa
where idCasa is NULL;

select idCasa as Col from Casas where idPropietario = 1000511645 and idCasa != 1442;

select IFNULL(nombreResidente, nombreVisitante) as Propietario from vistaCarros;

select * from Casas left join Residentes on idPropietario = idResidente;

-- Muestra info del propietario de X casa
drop procedure if exists verPropietarioCasa;
DELIMITER //
CREATE PROCEDURE verPropietarioCasa(IN idCasa int)
BEGIN
	SELECT * FROM vistaCasas where Casa = idCasa;
END //
DELIMITER ;

-- call verPropietarioCasa(1564);

drop procedure if exists verPropietarioCarro;
DELIMITER //
CREATE PROCEDURE verPropietarioCarro(IN idCarro varchar(6))
BEGIN
	SELECT * FROM vistaCarros where Placa = idCarro;
END //
DELIMITER ;

-- call verPropietarioCarro('OLA123');

drop procedure if exists insertarResidente;
DELIMITER //
CREATE PROCEDURE insertarResidente(
	IN idResidente int,
    IN nombreResidente VARCHAR(40),
    IN telResidente VARCHAR(10),
    IN casaResidente INT
)
BEGIN
    INSERT INTO Residentes(idResidente, nombreResidente, telResidente, casaResidente)
    VALUES (idResidente, nombreResidente, telResidente, casaResidente);
END //
DELIMITER ;

-- call insertarResidente(1000411856, 'Arnulfo de Jesus', 3161132323, 1210);

drop procedure if exists buscarNombreResidente;
DELIMITER //
CREATE PROCEDURE buscarNombreResidente(in Nombre varchar(40))
BEGIN
	select * from residentes where nombreResidente like concat('%',Nombre,'%');
END //
DELIMITER ;

-- call buscarNombreResidente("Juan");

drop procedure if exists buscarNombreResidente;
DELIMITER //
CREATE PROCEDURE buscarNombreResidente(in Nombre varchar(40))
BEGIN
	select * from residentes where nombreResidente like concat('%',Nombre,'%');
END //
DELIMITER ;

/*PROCEDIMIENTO PARA MODIFICAR PORTERO*/
drop procedure if exists ModificarPortero;
DELIMITER //
CREATE PROCEDURE ModificarPortero(in ID int, in Nombre varchar(40), in Horario varchar(40))
BEGIN
	update porteros set nombrePortero = Nombre, horarioPortero = Horario where idPortero = ID;
END //
DELIMITER ;

/*PROCEDIMIENTO PARA REGISTRAR VISITA*/
/*registrara visitantes y vehiculos que no existan*/
drop procedure if exists insertarVisita;
DELIMITER //
create procedure insertarVisita(
in ID int, in Nombre varchar(40), in Lugar int, in Motivo varchar(40), in Placa varchar(6))
BEGIN
	insert into Visitas(fecha_horaIngreso, idVisitante, lugarVisita, motivoVisita)
	values(now(),ID, Lugar, Motivo);
    -- Si no existe el visitante en la tabla visitantes, lo inserta
    IF NOT EXISTS (SELECT * FROM Visitantes WHERE idVisitante = ID) THEN
		insert into Visitantes(idVisitante, nombreVisitante)
        values(ID,Nombre);
    END IF;
    -- Si no existe el propietario en la tabla vehiculos y la placa no es null o vacia, la inserta
    IF NOT EXISTS (SELECT * FROM Vehiculos WHERE idPropietario = ID) AND Placa != '' THEN
		insert into Vehiculos(idVehiculo, idPropietario)
        values(Placa, ID);
    END IF;
END //
DELIMITER ;

-- call insertarVisita(1666666891, 'Aurelio',1280,"Visita","ABC123");
/*VER Visitantes con vehiculos */
SELECT idVisitante, nombreVisitante, idVehiculo
FROM visitantes
INNER JOIN vehiculos ON idvisitante = idpropietario;

/*Muestra los vehiculos con su propietario y el tipo de propietario*/
drop view if exists vistaVehiculosPropietario;
create view vistaVehiculosPropietario as
SELECT idVehiculo, idPropietario, 
coalesce(nombreResidente, nombreVisitante, nombrePortero) AS nombrePropietario,
       CASE
           WHEN idPropietario = idResidente THEN 'Residente'
           WHEN idPropietario = idVisitante  THEN 'Visitante'
           WHEN idPropietario = idPortero  THEN 'Portero'
           ELSE 'Desconocido'
       END AS tipoPropietario
FROM vehiculos
LEFT JOIN residentes ON idPropietario = idResidente
LEFT JOIN visitantes ON idPropietario = idVisitante
LEFT JOIN porteros  ON idPropietario = idPortero;
select * from vistaVehiculosPropietario;

/*FUNCION PARA COMPROBAR EXISTENCIA DE ID EN LA DB
retorna true si existe en alguna tabla con personas, false si no*/
drop function if exists idExistente;
DELIMITER //
create function idExistente(ID int)
returns int
begin
	IF EXISTS (SELECT * FROM Visitantes WHERE idVisitante = ID) THEN
		return true;
    END IF;
    IF EXISTS (SELECT * FROM Residentes WHERE idResidente = ID) THEN
		return true;
    END IF;
    IF EXISTS (SELECT * FROM Porteros WHERE idPortero = ID) THEN
		return true;
    END IF;
    return false;
end;
//
DELIMITER ;
-- select idExistente(1000411853);

/* FUNCION PARA VER SI LA CASA TIENE PROPIETARIO*/
drop function if exists comprobarExistenciaCasa;
DELIMITER //
create function comprobarExistenciaCasa (Casa INT)
returns int begin
	IF EXISTS (Select * from Casas where idCasa = Casa) THEN
    return true;
    END IF;
    return false;
end
// DELIMITER ;

-- select comprobarExistenciaCasa(1564);

/* FUNCION PARA VER SI LA CASA TIENE RESIDENTES*/
drop function if exists comprobarResidentesCasa;
DELIMITER //
create function comprobarResidentesCasa (Casa INT)
returns int begin
	IF EXISTS (Select * from Residentes where casaResidente = Casa) THEN
    return true;
    END IF;
    return false;
end
// DELIMITER ;

-- select comprobarResidentesCasa(1564);

select * from visitantes;
select * from visitas;
select * from vehiculos;

/* -- A veces no deja borrar por el modo seguro, con esos set se evita ese error
SET SQL_SAFE_UPDATES = 0;
delete from visitas where idVisitante =1234567890;
delete from visitantes where idVisitante =1234567890;
SET SQL_SAFE_UPDATES = 1;
*/
-- SELECT NOT EXISTS (SELECT * FROM Visitantes WHERE idVisitante = 1862972585);


/*
Proyecto final 
- Modelo relación 
- 10 funciones 3/10
- 3 Join >3 (10 joins aprox)
- Crud a dos tablas desde interfaz gráfica, conexión con DB y Lenguaje 
- Aplicar 2 de cada uno de estos:
Vistas >2, Procedimientos almacenados 2, Triggers 18, Funciones 3.

Todo en acompañado de la DB, y Documento descriptivo del proyecto.
*/
/*
cosas para hacer:
CRUD casas (con residentes, crear si no existe) YA
CRUD Residentes (crear registro en tabla casa si es propietario y no existe) YA
CRUD porteros YA 
CRUD visitas, vehiculos y visitantes YA
*/